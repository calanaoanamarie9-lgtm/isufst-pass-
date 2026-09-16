<?php

namespace App\Enums;

enum EducationalStatus: string
{
    case Graduated = 'graduated';
    case NotGraduated = 'not_graduated';

    public function label(): string
    {
        return match ($this) {
            self::Graduated => 'Graduated',
            self::NotGraduated => 'Not Graduated',
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