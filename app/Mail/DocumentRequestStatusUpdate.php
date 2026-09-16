<?php

namespace App\Mail;

use App\Models\DocumentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentRequestStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public DocumentRequest $documentRequest,
        public string $statusLabel,
        public string $updateMessage,
    ) {

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Document Request ' . $this->statusLabel . ' - ISUFSTPASS',
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.document-request-status',
        );
    }
}
