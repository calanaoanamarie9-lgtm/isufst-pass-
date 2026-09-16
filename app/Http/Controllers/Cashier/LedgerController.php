<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LedgerController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->with('studentProfile')->where('role', 'student');

        if ($search = trim((string) $request->query('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('studentProfile', fn ($p) => $p
                        ->where('course', 'like', "%{$search}%")
                        ->orWhere('contact_number', 'like', "%{$search}%"));
            });
        }

        return view('cashier.ledger.index', [
            'students' => $query->latest()->paginate(12)->withQueryString(),
            'search' => $search,
        ]);
    }

    public function show(User $user): View
    {
        abort_unless($user->role === 'student', 404);

        $user->load(['studentProfile', 'documentRequests.documents']);

        $requests = $user->documentRequests->sortByDesc('created_at');

        return view('cashier.ledger.show', [
            'student' => $user,
            'requests' => $requests,
            'totalPaid' => $requests->filter(fn ($r) => $r->isPaid())->sum(fn ($r) => $r->totalFee()),
            'totalOutstanding' => $requests->filter(fn ($r) => ! $r->isPaid())->sum(fn ($r) => $r->totalFee()),
        ]);
    }
}