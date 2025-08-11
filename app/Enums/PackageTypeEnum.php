<?php

declare(strict_types=1);

namespace App\Enums;

enum PackageTypeEnum: string
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
            self::Shop => asset('icons/store.svg'),
            self::Designer => asset('icons/designer.svg'),
            self::User => asset('icons/individual.svg'),
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
