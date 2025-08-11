<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypeEnum: string
{
    use Enumable;

    case Shop = 'shop';
    case Designer = 'designer';
    case User = 'user';

    public function t(): string
    {
        return match ($this) {
            self::Shop => __('Shop'),
            self::Designer => __('Designer'),
            self::User => __('User'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Shop => 'ti ti-building-store',
            self::Designer => 'ti ti-brush',
            self::User => 'ti ti-user-circle',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Shop => 'bg-primary',
            self::Designer => 'bg-purple',
            self::User => 'bg-teal',
        };
    }
}
