<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parents = [];
        $images = [
            'static_images/1.png',
            'static_images/2.png',
            'static_images/3.png',
            'static_images/4.png',
        ];

        for ($i = 1; $i <= 2; $i++) {
            $image = $images[array_rand($images)];

            $category = Category::create([
                'name_ar' => 'قسم الفساتين الرئيسي '.$i,
                'name_en' => 'Main Category '.$i,
                'slug' => Str::slug('Main Category '.$i),
                'image' => $image,
                'is_active' => rand(0, 1),
                'parent_id' => null,
            ]);

            $parents[] = $category->id;
        }

        for ($i = 1; $i <= 4; $i++) {
            $parentId = $parents[array_rand($parents)];
            $image = $images[array_rand($images)];

            Category::create([
                'name_ar' => 'قسم فرعي '.$i,
                'name_en' => 'Sub Category '.$i,
                'slug' => Str::slug('Sub Category '.$i),
                'image' => $image,
                'is_active' => rand(0, 1),
                'parent_id' => $parentId,
            ]);
        }
    }
}
