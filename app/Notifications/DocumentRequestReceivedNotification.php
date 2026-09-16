<?php

namespace App\Notifications;

use App\Models\DocumentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DocumentRequestReceivedNotification extends Notification
{
    use Queueable;

    public function __construct(public DocumentRequest $documentRequest)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Document Request Received',
            'message' => 'Your request ' . $this->documentRequest->request_number . ' (' . $this->documentRequest->documentsSummary() . ') has been received and is now being processed.',
            'url' => route('student.documents.show', $this->documentRequest),
        ];
    }
}