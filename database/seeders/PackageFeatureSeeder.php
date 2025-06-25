<?php

namespace Database\Seeders;

use App\Enums\PackageTypeEnum;
use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\PackageFeature;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PackageFeatureSeeder extends Seeder
{
    public function run()
    {
        $features = [
            ['ar' => 'إضافة حتى 20 منتج', 'en' => 'Add up to 20 products'],
            ['ar' => 'دعم فني مباشر', 'en' => 'Live support'],
            ['ar' => 'إعلانات مميزة للمنتجات', 'en' => 'Featured product ads'],
            ['ar' => 'تحليلات وتقارير أداء', 'en' => 'Performance analytics'],
            ['ar' => 'إخفاء المنتجات غير النشطة', 'en' => 'Hide inactive products'],
            ['ar' => 'إضافة وصف تفصيلي', 'en' => 'Detailed product descriptions'],
            ['ar' => 'عرض في الصفحة الرئيسية', 'en' => 'Homepage display'],
        ];

        $packages = Package::all();

        foreach ($packages as $package) {
            $selectedFeatures = collect($features)->random(4);

            foreach ($selectedFeatures as $feature) {
                PackageFeature::create([
                    'package_id'  => $package->id,
                    'feature_ar'  => $feature['ar'],
                    'feature_en'  => $feature['en'],
                    'is_active'   => true,
                ]);
            }
        }
    }
}
