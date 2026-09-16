<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DocumentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QrVerifyController extends Controller
{
    public function index(Request $request): View
    {
        $result = null;
        $documentRequest = null;
        $appointment = null;
        $query = trim((string) $request->query('q'));

        if ($query !== '') {
            [$passToken, $claimToken, $appointmentToken] = $this->extractTokens($query);

            if ($claimToken) {
                $documentRequest = DocumentRequest::query()
                    ->with(['user.studentProfile', 'documents'])
                    ->where('claim_token', $claimToken)
                    ->first();

                if ($documentRequest) {
                    $result = $documentRequest->user;
                }
            }

            if (! $documentRequest && $appointmentToken) {
                $appointment = Appointment::query()
                    ->with(['user.studentProfile'])
                    ->where('qr_token', $appointmentToken)
                    ->first();

                if ($appointment) {
                    $result = $appointment->user;
                }
            }

            if (! $documentRequest && ! $appointment && $passToken) {
                $result = User::query()
                    ->with([
                        'studentProfile',
                        'documentRequests' => fn ($q) => $q->latest()->limit(3),
                        'appointments' => fn ($q) => $q->latest()->limit(3),
                    ])
                    ->where('role', 'student')
                    ->whereHas('studentProfile', fn ($p) => $p->where('pass_token', $passToken))
                    ->first();
            }

            // A bare UUID may also belong to an appointment QR.
            if (! $result && ! $documentRequest && ! $appointment && $passToken === $query) {
                $appointment = Appointment::query()
                    ->with(['user.studentProfile'])
                    ->where('qr_token', $passToken)
                    ->first();

                if ($appointment) {
                    $result = $appointment->user;
                }
            }

            if (! $result && ! $claimToken && ! $appointmentToken && ! $passToken) {
                // Plain text (or unknown payload): treat as a name / email search.
                $result = User::query()
                    ->with([
                        'studentProfile',
                        'documentRequests' => fn ($q) => $q->latest()->limit(3),
                        'appointments' => fn ($q) => $q->latest()->limit(3),
                    ])
                    ->where('role', 'student')
                    ->where(fn ($w) => $w
                        ->where('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%"))
                    ->first();
            }
        }

        return view('registrar.qr-verification.index', [
            'student' => $result,
            'documentRequest' => $documentRequest,
            'appointment' => $appointment,
            'query' => $query,
        ]);
    }

    /**
     * Resolve a scanned value into [passToken, claimToken, appointmentToken].
     *
     * Supports:
     *  - full verify URLs   http://host/verify/pass/{uuid} | .../verify/document/{uuid} | .../verify/appointment/{uuid}
     *  - bare token UUIDs
     *  - legacy JSON payloads {"type":"isufstpass"|"isufstdoc", ...}
     */
    private function extractTokens(string $value): array
    {
        $uuid = '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}';

        if (preg_match("#/verify/pass/({$uuid})#i", $value, $m)) {
            return [$m[1], null, null];
        }

        if (preg_match("#/verify/document/({$uuid})#i", $value, $m)) {
            return [null, $m[1], null];
        }

        if (preg_match("#/verify/appointment/({$uuid})#i", $value, $m)) {
            return [null, null, $m[1]];
        }

        if (preg_match("/^{$uuid}$/i", $value)) {
            return [$value, null, null];
        }

        $payload = json_decode($value, true);

        if (is_array($payload)) {
            $type = $payload['type'] ?? null;

            if ($type === 'isufstpass' && isset($payload['token'])) {
                return [$payload['token'], null, null];
            }

            if ($type === 'isufstdoc' && isset($payload['request'])) {
                return [null, $payload['request'], null];
            }
        }

        return [null, null, null];
    }
}