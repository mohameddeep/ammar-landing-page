<?php

declare(strict_types=1);

namespace App\Enums;

enum PackageTypeEnum: string
{
    use Enumable;

    case Provider = 'provider';
    case User = 'user';

    public function t(): string
    {
        return match ($this) {
            self::Provider => __('Provider'),
            self::User => __('User'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Provider => asset('icons/provider.svg'),
            self::User => asset('icons/individual.svg'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Provider => 'bg-purple',
            self::User => 'bg-teal',
        };
    }
}
