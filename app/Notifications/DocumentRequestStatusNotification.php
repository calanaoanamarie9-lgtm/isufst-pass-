<?php

namespace App\Notifications;

use App\Models\DocumentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DocumentRequestStatusNotification extends Notification
{
    use Queueable;

    public function __construct(
        public DocumentRequest $documentRequest,
        public string $statusLabel,
        public string $message,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => "Document request {$this->statusLabel}",
            'message' => $this->message . " ({$this->documentRequest->request_number})",
            'url' => route('student.documents.show', $this->documentRequest),
        ];
    }
}