<?php

declare(strict_types=1);

namespace App\Enums;

enum CommissionTypeEnum: string
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
            self::Store => 'ti ti-building-store',         
            self::Designer => 'ti ti-brush',               
            self::Individual => 'ti ti-user-circle',      
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
