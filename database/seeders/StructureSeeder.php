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
                    'en' => [
                        'title' => 'About Us',
                        'desc' => 'A company specialized in construction and licensing services with over 15 years of experience in the Saudi market.',
                         'statistics' => [
                            [
                                'value' => '+500',
                                'name' => 'Completed Projects',
                                'icon' => '/assets/images/icons/four.svg'
                            ],
                            [
                                'value' => '100%',
                                'name' => 'Adherence to Standards',
                                'icon' => '/assets/images/icons/five.svg'
                            ],
                             [
                                'value' => '15+',
                                'name' => 'Years of Experience',
                                'icon' => '/assets/images/icons/six.svg'
                            ]
                        ]
                    ],
                    'ar' => [
                        'title' => 'من نحن',
                        'desc' => 'شركة متخصصة في خدمات البناء والتراخيص مع خبرة تمتد لأكثر من 15 عاماً في السوق السعودي',
                        'statistics' => [
                            [
                                'value' => '+500',
                                'name' => 'مشروع مكتمل',
                                'icon' => '/assets/images/icons/four.svg'
                            ],
                            [
                                'value' => '100%',
                                'name' => 'التزام بالمعايير',
                                'icon' => '/assets/images/icons/five.svg'
                            ],
                             [
                                'value' => '15+',
                                'name' => 'سنة خبرة',
                                'icon' => '/assets/images/icons/six.svg'
                            ]
                        ]
                    ],
                ]),
            ]
        );
        Structure::query()->updateOrCreate(
            [
                'key' => 'service',
            ],
            [
                'content' => json_encode([
                    'en' => [['title' => 'service'], ['content' => 'Feature services']],
                    'ar' => [['title' => 'خدماتنا'], ['content' => ' خدماتنا المتميزة ']],
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

        Structure::query()->updateOrCreate(
            [
                'key' => 'privacy_policy',
            ],
            [
                'content' => json_encode([
                    'en' => [['content' => 'Privacy Policy content']],
                    'ar' => [['content' => 'محتوى سياسة الخصوصية']],
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
