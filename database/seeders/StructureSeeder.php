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
                    'ar' => [ ['content' => 'الشروط واالاحكام']],
                ]),
            ]
        );

}
}