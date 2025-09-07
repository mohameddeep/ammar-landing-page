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

        foreach (range(1, 6) as $i) {

            Package::create([
                'name_ar' => 'باقة '.$faker->word,
                'name_en' => 'Package '.$faker->word,
                'duration' => $faker->numberBetween(7, 90),
                'price' => $faker->randomFloat(2, 10, 500),
                'product_count' => $faker->numberBetween(30, 90),
                'free_product_count' => $faker->numberBetween(0, 20),
                'is_active' => $faker->boolean(80),
                'coming_soon' => $faker->boolean(20),
            ]);
        }
    }
}
