<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        // 🟦 Slider (1 row)
        DB::table('landing_pages')->insert([
            'key' => 'header',
            'title_ar' => 'سلايدر',
            'title_en' => 'Slider',
            'content_ar' => 'محتوى السلايدر',
            'content_en' => 'Slider content',
            'image' => null,
            'android_link' => null,
            'ios_link' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 🟩 Features (6 rows)
        for ($i = 1; $i <= 6; $i++) {
            DB::table('landing_pages')->insert([
                'key' => 'feature',
                'title_ar' => "ميزة رقم $i",
                'title_en' => "Feature $i",
                'content_ar' => "وصف الميزة رقم $i",
                'content_en' => "Feature $i description",
                'image' => null,
                'android_link' => null,
                'ios_link' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 🟨 Experience (4 rows)
        for ($i = 1; $i <= 4; $i++) {
            DB::table('landing_pages')->insert([
                'key' => 'discover',
                'title_ar' => "خبرة رقم $i",
                'title_en' => "Experience $i",
                'content_ar' => "وصف الخبرة رقم $i",
                'content_en' => "Experience $i description",
                'image' => null,
                'android_link' => null,
                'ios_link' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 🟧 Content One (1 row)
        DB::table('landing_pages')->insert([
            'key' => 'content_one',
            'title_ar' => 'المحتوى الأول',
            'title_en' => 'Content One',
            'content_ar' => 'وصف المحتوى الأول',
            'content_en' => 'Description for content one',
            'image' => null,
            'android_link' => null,
            'ios_link' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 🟥 Content Two (1 row)
        DB::table('landing_pages')->insert([
            'key' => 'content_two',
            'title_ar' => 'المحتوى الثاني',
            'title_en' => 'Content Two',
            'content_ar' => 'وصف المحتوى الثاني',
            'content_en' => 'Description for content two',
            'image' => null,
            'android_link' => null,
            'ios_link' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 🟪 Ready to Transform Your Wardrobe? (1 row with all data)
        DB::table('landing_pages')->insert([
            'key' => 'ready_to_transform',
            'title_ar' => 'هل أنت مستعد لتجديد خزانة ملابسك؟',
            'title_en' => 'Ready to Transform Your Wardrobe?',
            'content_ar' => 'ابدأ رحلتك معنا لتحسين مظهرك واكتشاف أزياء جديدة تناسب شخصيتك.',
            'content_en' => 'Start your journey with us to enhance your style and discover new fashion that fits you.',
            'image' => 'images/landing/transform.png', // you can change this path
            'android_link' => 'https://play.google.com/store/apps/details?id=com.example.app',
            'ios_link' => 'https://apps.apple.com/app/example-app/id1234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
