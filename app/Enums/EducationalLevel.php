<?php

namespace App\Enums;

enum EducationalLevel: string
{
    case HighSchool = 'high_school';
    case College = 'college';

    public function label(): string
    {
        return match ($this) {
            self::HighSchool => 'High School',
            self::College => 'College',
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