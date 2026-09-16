<?php

namespace App\Jobs;

use App\Mail\AppointmentReminder;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAppointmentReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public function handle(): void
    {
        $tomorrow = now()->addDay()->toDateString();

        $appointments = Appointment::with('user')
            ->where('date', $tomorrow)
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereNull('reminder_sent_at')
            ->get();

        foreach ($appointments as $appointment) {
            Mail::to($appointment->user->email)
                ->send(new AppointmentReminder($appointment));

            $appointment->update(['reminder_sent_at' => now()]);
        }
    }
}
