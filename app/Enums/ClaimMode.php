<?php

namespace App\Enums;

enum ClaimMode: string
{
    case Personal = 'personal';
    case Representative = 'representative';

    public function label(): string
    {
        return match ($this) {
            self::Personal => 'Personally',
            self::Representative => 'Representative',
        };
    }

    public function statement(): string
    {
        return match ($this) {
            self::Personal => 'I shall come back for my record personally.',
            self::Representative => 'I shall have my authorized representative claim my request.',
        };
    }

    public static function toSelect(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->all();
    }

    public static function toSelectKeys(): array
    {
        return array_keys(self::toSelect());
    }
}