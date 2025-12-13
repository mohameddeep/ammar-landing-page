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

        // Slide 1
        // Slide 1
        Slider::create([
            'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
            'is_active' => true,
            'title_one_ar' => 'شريكك الموثوق في',
            'title_one_en' => 'Your Trusted Partner in',
            'title_two_ar' => 'البناء والتراخيص',
            'title_two_en' => 'Construction and Permits',
            'title_three_ar' => null, // Optional as per design
            'title_three_en' => null,
            'content_ar' => 'نقدم خدمات متكاملة في إصدار التراخيص والإشراف على المشاريع والمقاولات بأعلى معايير الجودة والاحترافية',
            'content_en' => 'We provide integrated services in issuing permits, supervising projects, and contracting with the highest standards of quality and professionalism.'
        ]);

        // Slide 2
        Slider::create([
            'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80',
            'is_active' => true,
            'title_one_ar' => 'رخص البناء',
            'title_one_en' => 'Building Permits',
            'title_two_ar' => 'بسرعة وكفاءة عالية',
            'title_two_en' => 'Quickly and Efficiently',
            'title_three_ar' => null,
            'title_three_en' => null,
            'content_ar' => 'نحن نضمن لك الحصول على جميع التراخيص المطلوبة في أسرع وقت ممكن مع الالتزام الكامل بجميع المعايير والمواصفات',
            'content_en' => 'We guarantee you get all required permits as quickly as possible with full compliance with all standards and specifications.'
        ]);

        // Slide 3
        Slider::create([
            'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2092&q=80',
            'is_active' => true,
            'title_one_ar' => 'إشراف احترافي',
            'title_one_en' => 'Professional Supervision',
            'title_two_ar' => 'على مشاريعك',
            'title_two_en' => 'of Your Projects',
            'title_three_ar' => null,
            'title_three_en' => null,
            'content_ar' => 'فريقنا المتخصص يضمن تنفيذ مشروعك بأعلى معايير الجودة والأمان مع متابعة مستمرة في كل مرحلة',
            'content_en' => 'Our specialized team ensures your project is executed with the highest standards of quality and safety with continuous monitoring at every stage.'
        ]);
    }
}
