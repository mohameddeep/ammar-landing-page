<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypeEnum: string
{
    use Enumable;

    case User = 'user';
    case Provider = 'provider';

    public function t(): string
    {
        return match ($this) {
            self::User => __('User'),
            self::Provider => __('Provider'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::User => 'ti ti-user-circle',
            self::Provider => 'ti ti-user',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::User => 'bg-teal',
            self::Provider => 'bg-info',
        };
    }
}
