<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main About Section
        $mainAbout = AboutUs::create([
            'parent_id' => null,
            'title_ar' => 'من نحن',
            'title_en' => 'About Us',
            'content_ar' => 'شركة متخصصة في خدمات البناء والتراخيص مع خبرة تمتد لأكثر من 15 عاماً في السوق السعودي',
            'content_en' => 'A company specialized in construction and licensing services with over 15 years of experience in the Saudi market.',
            'image' => null,
            'is_active' => true,
        ]);

        // Overview Section
        AboutUs::create([
            'parent_id' => $mainAbout->id,
            'title_ar' => 'شركة رائدة في مجال البناء',
            'title_en' => 'A Leading Company in Construction',
            'content_ar' => 'نحن شركة متخصصة في تقديم خدمات البناء والتراخيص في المملكة العربية السعودية. مع أكثر من 15 عاماً من الخبرة المتراكمة، نقدم حلولاً شاملة ومبتكرة لعملائنا.',
            'content_en' => 'We are a company specialized in providing construction and licensing services in the Kingdom of Saudi Arabia. With over 15 years of accumulated experience, we provide comprehensive and innovative solutions to our clients.',
            'image' => '/assets/images/icons/sex.svg',
            'is_active' => true,
        ]);

        // Mission
        AboutUs::create([
            'parent_id' => $mainAbout->id,
            'title_ar' => 'رؤيتنا',
            'title_en' => 'Our Vision',
            'content_ar' => 'أن نكون الرائدين في مجال خدمات البناء والتراخيص في المملكة العربية السعودية من خلال تقديم حلول مبتكرة وخدمات عالية الجودة',
            'content_en' => 'To be the leaders in construction and licensing services in the Kingdom of Saudi Arabia by providing innovative solutions and high-quality services',
            'image' => '/assets/images/icons/seven.svg',
            'is_active' => true,
        ]);

        // Vision
        AboutUs::create([
            'parent_id' => $mainAbout->id,
            'title_ar' => 'مهمتنا',
            'title_en' => 'Our Mission',
            'content_ar' => 'تقديم خدمات متكاملة وشاملة في مجال البناء والتراخيص مع الالتزام بأعلى معايير الجودة والاحترافية لضمان رضا عملائنا',
            'content_en' => 'Providing comprehensive and integrated services in construction and licensing with commitment to the highest standards of quality and professionalism to ensure customer satisfaction',
            'image' => '/assets/images/icons/eight.svg',
            'is_active' => true,
        ]);

        // Values
        AboutUs::create([
            'parent_id' => $mainAbout->id,
            'title_ar' => 'قيمنا',
            'title_en' => 'Our Values',
            'content_ar' => 'الجودة، الاحترافية، الشفافية، والالتزام بمواعيد التسليم هي القيم الأساسية التي نؤمن بها ونطبقها في كل مشروع',
            'content_en' => 'Quality, professionalism, transparency, and commitment to delivery deadlines are the core values we believe in and apply in every project',
            'image' => '/assets/images/icons/nine.svg',
            'is_active' => true,
        ]);

        // Feature 1: Wide Experience
        AboutUs::create([
            'parent_id' => $mainAbout->id,
            'title_ar' => 'خبرة واسعة',
            'title_en' => 'Wide Experience',
            'content_ar' => 'أكثر من 15 عاماً من الخبرة المتراكمة',
            'content_en' => 'Over 15 years of accumulated experience',
            'image' => '/assets/images/icons/ten.svg',
            'is_active' => true,
        ]);

        // Feature 2: High Quality
        AboutUs::create([
            'parent_id' => $mainAbout->id,
            'title_ar' => 'جودة عالية',
            'title_en' => 'High Quality',
            'content_ar' => 'الالتزام بأعلى معايير الجودة',
            'content_en' => 'Commitment to the highest quality standards',
            'image' => '/assets/images/icons/eleven.svg',
            'is_active' => true,
        ]);

        // Feature 3: Speed of Completion
        AboutUs::create([
            'parent_id' => $mainAbout->id,
            'title_ar' => 'سرعة الإنجاز',
            'title_en' => 'Speed of Completion',
            'content_ar' => 'إنجاز المشاريع في الوقت المحدد',
            'content_en' => 'Completing projects on time',
            'image' => '/assets/images/icons/twelve.svg',
            'is_active' => true,
        ]);

        // Feature 4: Customer Service
        AboutUs::create([
            'parent_id' => $mainAbout->id,
            'title_ar' => 'خدمة عملاء',
            'title_en' => 'Customer Service',
            'content_ar' => 'دعم مستمر ومتابعة دقيقة',
            'content_en' => 'Continuous support and precise follow-up',
            'image' => '/assets/images/icons/thirteen.svg',
            'is_active' => true,
        ]);
    }
}
