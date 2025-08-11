<?php

namespace Database\Seeders;

use App\Enums\PackageTypeEnum;
use App\Models\Package;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $i) {
            $type = $faker->randomElement(PackageTypeEnum::cases());

            Package::create([
                'name_ar' => 'باقة '.$faker->word,
                'name_en' => 'Package '.$faker->word,
                'duration' => $faker->numberBetween(7, 90),
                'price' => $faker->randomFloat(2, 10, 500),
                'product_number' => $faker->numberBetween(7, 90),
                'type' => $type->value,
                'is_active' => $faker->boolean(80),
                'is_hidden' => $faker->boolean(20),
                'description_ar' => 'باقة '.$faker->word.$faker->word.' وصف',
                'description_en' => 'Package '.$faker->word.$faker->word.' description',
            ]);
        }
    }
}
