<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $images = [
            'face_images/1.jpeg',
            'face_images/2.jpeg',
            'face_images/3.jpeg',

        ];
        for ($i = 1; $i <= 8; $i++) {
            $image = $images[array_rand($images)];

        Merchant::create([
                'name' => $faker->name,
                'email' => "merchant{$i}@example.com",
                'phone' => $faker->unique()->phoneNumber,
                'image' => $image,
                'password' => Hash::make('123123123'),
                'is_active' => $faker->boolean(90),
                'type' => $faker->randomElement(UserTypeEnum::values()),
                'fcm_token' => Str::random(32),
                'is_featured' => $faker->boolean(30),
                'otp_verified' => $faker->boolean(70),
            ]);
           
        }
    }
}
