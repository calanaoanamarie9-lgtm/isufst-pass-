<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verify My Email - ISUFSTPASS')
            ->view('emails.verify-email', [
                'url' => $verificationUrl,
                'userName' => $notifiable->name,
            ]);
    }
}
