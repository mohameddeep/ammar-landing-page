<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $images = [
            'static_images/1.png',
            'static_images/2.png',
            'static_images/3.png',
            'static_images/4.png',
        ];
        for ($i = 1; $i <= 4; $i++) {
            $image = $images[array_rand($images)];

            Slider::create([
                'title_ar' => 'صورة '.$i,
                'title_en' => 'image'.$i,
                'content_ar' => 'محتوي '.$i,
                'content_en' => 'content'.$i,
                'image' => $image,
                'is_active' => rand(0, 1),
            ]);
        }
    }
}
