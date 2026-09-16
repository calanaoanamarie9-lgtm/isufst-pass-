<?php

namespace App\Enums;

enum DocumentRequestStatus: string
{
    case SUBMITTED = 'submitted';
    case PROCESSING = 'processing';
    case FOR_SIGNATURE = 'for_signature';
    case READY_FOR_PICKUP = 'ready_for_pickup';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    /**
     * Label used across the UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::SUBMITTED => 'Submitted',
            self::PROCESSING => 'Processing',
            self::FOR_SIGNATURE => 'For Signature',
            self::READY_FOR_PICKUP => 'Ready for Pick-up',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }

    /**
     * Ordered tracking pipeline steps (excluding terminal states).
     */
    public static function pipeline(): array
    {
        return [
            self::SUBMITTED,
            self::PROCESSING,
            self::FOR_SIGNATURE,
            self::READY_FOR_PICKUP,
            self::COMPLETED,
        ];
    }
}