<?php

namespace App\Mail;

use App\Models\DocumentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentRequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public DocumentRequest $documentRequest,
        public ?string $reason = null,
    ) {

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Request Rejected / Action Required - ISUFSTPASS',
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.document-request-rejected',
        );
    }
}
