<?php

declare(strict_types=1);

namespace App\Enums;

enum PackageTypeEnum: string
{
    use Enumable;

    case Store = 'store';
    case Designer = 'designer';
    case Individual = 'individual';

    public function t(): string
    {
        return match ($this) {
            self::Store => __('Store'),
            self::Designer => __('Designer'),
            self::Individual => __('Individual'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Store => asset('icons/store.svg'),
            self::Designer => asset('icons/designer.svg'),
            self::Individual => asset('icons/individual.svg'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Store => 'bg-primary',
            self::Designer => 'bg-purple',
            self::Individual => 'bg-teal',
        };
    }
}
