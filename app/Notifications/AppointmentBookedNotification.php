<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentBookedNotification extends Notification
{
    use Queueable;

    public function __construct(public Appointment $appointment)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Appointment Booked',
            'message' => 'Your ' . $this->appointment->office . ' appointment on ' . $this->appointment->date->format('F j, Y') . ' at ' . $this->appointment->time_slot . ' is pending confirmation.',
            'url' => route('student.appointments.index'),
        ];
    }
}