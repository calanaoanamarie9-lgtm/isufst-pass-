<?php

namespace App\Support;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuditLogger
{
    public static function log(string $action, string $description, ?User $actor = null): void
    {
        $actor ??= Auth::user();

        AuditLog::create([
            'user_id' => $actor?->id,
            'actor_name' => $actor?->name,
            'role' => $actor?->role,
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }
}