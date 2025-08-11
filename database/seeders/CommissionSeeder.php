<?php

namespace Database\Seeders;

use App\Enums\CommissionTypeEnum;
use App\Models\Commission;
use Illuminate\Database\Seeder;

class CommissionSeeder extends Seeder
{
    public function run(): void
    {
        $commissions = [
            [
                'name_ar' => 'عمولة المتجر',
                'name_en' => 'Store Commission',
                'value' => 5,
                'type' => CommissionTypeEnum::Store->value,
            ],
            [
                'name_ar' => 'عمولة المصمم',
                'name_en' => 'Designer Commission',
                'value' => 10,
                'type' => CommissionTypeEnum::Designer->value,
            ],
            [
                'name_ar' => 'عمولة الفردي',
                'name_en' => 'Individual Commission',
                'value' => 7,
                'type' => CommissionTypeEnum::Individual->value,
            ],
        ];

        foreach ($commissions as $commission) {
            Commission::create(array_merge($commission, ['is_active' => true]));
        }
    }
}
