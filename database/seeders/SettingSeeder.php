<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id' => 1,
                'slug_ar' => 'الاصدار',
                'slug_en' => 'version',
                'key' => 'version',
                'value' => '1.0.9',
                'is_shown' => 0,
                'created_at' => '2024-09-03 06:07:36',
                'updated_at' => '2024-09-03 11:41:48',
            ],
            [
                'id' => 2,
                'slug_ar' => 'اصدار الاندرويد',
                'slug_en' => 'android_version',
                'key' => 'android_url',
                'value' => 'https://play.google.com/store/apps/details?id=com.elryad.searchfor',
                'is_shown' => 0,
                'created_at' => '2024-09-03 06:28:48',
                'updated_at' => '2024-09-03 06:28:48',
            ],
            [
                'id' => 3,
                'slug_ar' => 'اصدار الايفون',
                'slug_en' => 'ios_version',
                'key' => 'ios_url',
                'value' => 'https://apps.apple.com/us/app/',
                'is_shown' => 0,
                'created_at' => '2024-09-03 06:29:36',
                'updated_at' => '2024-09-03 06:29:36',
            ],
            [
                'id' => 4,
                'slug_ar' => 'عدد البوستات المجانية للمستخدم',
                'slug_en' => 'عدد البوستات المجانية للمستخدم',
                'key' => 'free_for_users',
                'value' => '2',
                'is_shown' => 1,
                'created_at' => '2024-09-03 10:47:24',
                'updated_at' => '2024-12-10 10:30:19',
            ],
            [
                'id' => 5,
                'slug_ar' => 'عدد البوستات المجانية للصيدلية',
                'slug_en' => 'nom of posts to ph',
                'key' => 'free_for_pharmacies',
                'value' => '20',
                'is_shown' => 1,
                'created_at' => '2024-09-03 10:48:04',
                'updated_at' => '2024-12-10 10:30:50',
            ],
            [
                'id' => 7,
                'slug_ar' => 'فيسبوك',
                'slug_en' => 'facebook',
                'key' => 'facebook',
                'value' => 'https://www.facebook.com',
                'is_shown' => 1,
                'created_at' => '2024-09-06 14:07:20',
                'updated_at' => '2024-09-08 03:53:35',
            ],
            [
                'id' => 8,
                'slug_ar' => 'يوتيوب',
                'slug_en' => 'youtube',
                'key' => 'youtube',
                'value' => 'https://www.youtube.com',
                'is_shown' => 1,
                'created_at' => '2024-09-08 03:54:35',
                'updated_at' => '2024-09-08 03:54:35',
            ],
            [
                'id' => 9,
                'slug_ar' => 'تويتر',
                'slug_en' => 'twitter',
                'key' => 'twitter',
                'value' => 'https://x.com/home',
                'is_shown' => 1,
                'created_at' => '2024-09-08 03:55:39',
                'updated_at' => '2024-09-08 03:55:39',
            ],
            [
                'id' => 10,
                'slug_ar' => 'انستقرام',
                'slug_en' => 'instagram',
                'key' => 'instagram',
                'value' => 'https://www.instagram.com',
                'is_shown' => 1,
                'created_at' => '2024-09-08 03:56:15',
                'updated_at' => '2024-09-08 03:56:33',
            ],
            [
                'id' => 11,
                'slug_ar' => 'لينك التيست',
                'slug_en' => 'APP_TEST_URL',
                'key' => 'APP_TEST_URL',
                'value' => 'https://eslam.azq1.com/search/api/v1/mobile/',
                'is_shown' => 0,
                'created_at' => '2024-09-08 07:15:45',
                'updated_at' => '2024-09-08 07:15:45',
            ],
            [
                'id' => 12,
                'slug_ar' => 'لينك الدومين الرئيسي',
                'slug_en' => 'APP_PRODUCTION_URL',
                'key' => 'APP_PRODUCTION_URL',
                'value' => 'https://search-for.net/api/v1/mobile/',
                'is_shown' => 0,
                'created_at' => '2024-09-08 07:16:36',
                'updated_at' => '2024-09-08 07:16:36',
            ],
            [
                'id' => 13,
                'slug_ar' => 'مرفوع على الدومين الرئيسي',
                'slug_en' => 'IS_PRODUCTION',
                'key' => 'IS_PRODUCTION',
                'value' => '1',
                'is_shown' => 0,
                'created_at' => '2024-09-08 07:17:29',
                'updated_at' => '2024-09-08 07:17:29',
            ],
            [
                'id' => 14,
                'slug_ar' => 'تفعيل التحقق',
                'slug_en' => 'enable validation',
                'key' => 'IN_REVIEW',
                'value' => '0',
                'is_shown' => 0,
                'created_at' => '2024-09-08 07:17:29',
                'updated_at' => '2024-09-08 07:17:29',
            ],
            [
                'id' => 15,
                'slug_ar' => 'موظفين المستشفي',
                'slug_en' => 'Hospital staff',
                'key' => 'hospital_employee',
                'value' => '3',
                'is_shown' => 10,
                'created_at' => '2024-09-03 06:07:36',
                'updated_at' => '2024-12-10 11:55:48',
            ],
            [
                'id' => 16,
                'slug_ar' => 'موظفين الصيدلية',
                'slug_en' => 'pharmacy employee',
                'key' => 'pharmacy_employee',
                'value' => '12',
                'is_shown' => 10,
                'created_at' => '2024-09-03 06:07:36',
                'updated_at' => '2024-12-10 13:19:56',
            ],
        ]);
    }
}
