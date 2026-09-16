<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = AuditLog::query()->with('actor')->latest();

        if ($action = $request->query('action')) {
            $query->where('action', $action);
        }

        if ($search = trim((string) $request->query('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('actor_name', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            });
        }

        if ($from = $request->query('from')) {
            try {
                $query->whereDate('created_at', '>=', $from);
            } catch (\Throwable) {
            }
        }

        if ($to = $request->query('to')) {
            try {
                $query->whereDate('created_at', '<=', $to);
            } catch (\Throwable) {
            }
        }

        $actions = AuditLog::query()
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view('admin.audits.index', [
            'logs' => $query->paginate(25)->withQueryString(),
            'actions' => $actions,
            'actionFilter' => $request->query('action'),
            'search' => trim((string) $request->query('q')),
            'from' => $request->query('from'),
            'to' => $request->query('to'),
        ]);
    }
}