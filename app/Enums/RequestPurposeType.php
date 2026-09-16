<?php

namespace App\Enums;

enum RequestPurposeType: string
{
    case Employment = 'employment';
    case PRC = 'prc';
    case Transfer = 'transfer';

    public function label(): string
    {
        return match ($this) {
            self::Employment => 'Employment',
            self::PRC => 'PRC',
            self::Transfer => 'Transfer',
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