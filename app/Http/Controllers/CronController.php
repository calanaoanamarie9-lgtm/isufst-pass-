<?php

namespace App\Http\Controllers;

use App\Jobs\SendAppointmentReminders;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CronController extends Controller
{
    /**
     * Fired by Vercel Cron (daily) or an external scheduler.
     * Accepts the X-Cron-Secret header, or Vercel's own cron request headers.
     */
    public function reminders(Request $request): JsonResponse
    {
        $expected = config('app.cron_secret');
        $fromVercel = $request->header('x-vercel-cron') === '1'
            || str_contains((string) $request->userAgent(), 'vercel-cron');

        $authorized = $expected !== null && hash_equals($expected, (string) $request->header('X-Cron-Secret', ''))
            || $fromVercel;

        if (! $authorized) {
            abort(403);
        }

        SendAppointmentReminders::dispatchSync();

        return response()->json(['ok' => true]);
    }
}