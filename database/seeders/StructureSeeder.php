<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Structure::query()->updateOrCreate(
            [
                'key' => 'about',
            ],
            [
                'content' => json_encode([
                    'en' => [['title' => 'about'], ['content' => 'About site']],
                    'ar' => [['title' => 'عن'], ['content' => 'عن المنصه']],
                ]),
            ]
        );

        Structure::query()->updateOrCreate(
            [
                'key' => 'terms_and_conditions',
            ],
            [
                'content' => json_encode([
                    'en' => [['content' => 'term condition ']],
                    'ar' => [['content' => 'الشروط واالاحكام']],
                ]),
            ]
        );




        // Footer
        Structure::query()->updateOrCreate(
            ['key' => 'footer'],
            [
                'content' => json_encode([
                    'email' => 'info@example.com',
                    'phone' => '+123456789',
                    'whatsapp' => '+123456789',
                    'facebook_link' => 'https://facebook.com/example',
                    'instagram_link' => 'https://instagram.com/example',
                    'twitter_link' => 'https://instagram.com/example',
                    'linkedin_link' => 'https://instagram.com/example',
                    'image' => null,
                    'content' => [
                        'en' => 'Footer content in English',
                        'ar' => 'محتوى الفوتر بالعربية',
                    ],
                    'copyright' => [
                        'en' => ' © 2024 مجموعة ألور. جميع الحقوق محفوظة. ',
                        'ar' => ' © 2024 مجموعة ألور. جميع الحقوق محفوظة. ',
                    ],
                ]),
            ]
        );
    }
}
