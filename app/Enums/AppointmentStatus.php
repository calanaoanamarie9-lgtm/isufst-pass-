<?php

namespace App\Enums;

enum AppointmentStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case FOR_RESCHEDULE = 'for_reschedule';
    case CHECKED_IN = 'checked_in';
    case RESCHEDULED = 'rescheduled';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case NO_SHOW = 'no_show';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::FOR_RESCHEDULE => 'For Reschedule',
            self::CHECKED_IN => 'Checked In',
            self::RESCHEDULED => 'Rescheduled',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            self::NO_SHOW => 'No Show',
        };
    }

    /**
     * Statuses that still occupy an appointment slot.
     */
    public static function activeValues(): array
    {
        return [
            self::PENDING->value,
            self::CONFIRMED->value,
            self::CHECKED_IN->value,
            self::RESCHEDULED->value,
        ];
    }

    /**
     * Active statuses plus For Reschedule (overflow bookings that no longer
     * consume capacity but are still visible/upcoming for the student).
     */
    public static function schedulableValues(): array
    {
        return [
            ...self::activeValues(),
            self::FOR_RESCHEDULE->value,
        ];
    }

    public static function toSelect(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $status) => [$status->value => $status->label()])
            ->all();
    }
}