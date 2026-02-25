<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * To run this seeder, use one of the following commands:
     * 
     * Run only this seeder:
     * php artisan db:seed --class=AboutUsSeeder
     * 
     * Or run all seeders:
     * php artisan db:seed
     * 
     * Or refresh database and seed:
     * php artisan migrate:fresh --seed
     */
    public function run(): void
    {
        // Tab 1: Overview Tab (Parent)
        $overviewTab = AboutUs::create([
            'parent_id' => null,
            'title_ar' => 'نظرة عامة',
            'title_en' => 'Overview',
            'content_ar' => null,
            'content_en' => null,
            'image' => null,
            'is_active' => true,
        ]);

        // Overview Tab Content (Child)
        AboutUs::create([
            'parent_id' => $overviewTab->id,
            'title_ar' => 'شركة رائدة في مجال البناء',
            'title_en' => 'A Leading Company in Construction',
            'content_ar' => 'نحن شركة متخصصة في تقديم خدمات البناء والتراخيص في المملكة العربية السعودية. مع أكثر من 15 عاماً من الخبرة المتراكمة، نقدم حلولاً شاملة ومبتكرة لعملائنا.',
            'content_en' => 'We are a company specialized in providing construction and licensing services in the Kingdom of Saudi Arabia. With over 15 years of accumulated experience, we provide comprehensive and innovative solutions to our clients.',
            'image' => '/assets/images/icons/sex.svg',
            'is_active' => true,
        ]);

        // Tab 2: Stats Tab (Parent)
        $statsTab = AboutUs::create([
            'parent_id' => null,
            'title_ar' => 'الإحصائيات',
            'title_en' => 'Statistics',
            'content_ar' => null,
            'content_en' => null,
            'image' => null,
            'is_active' => true,
        ]);

        // Stats Tab Children
        AboutUs::create([
            'parent_id' => $statsTab->id,
            'title_ar' => 'مشروع مكتمل',
            'title_en' => 'Completed Projects',
            'content_ar' => '+500',
            'content_en' => '+500',
            'image' => '/assets/images/icons/four.svg',
            'is_active' => true,
        ]);

        AboutUs::create([
            'parent_id' => $statsTab->id,
            'title_ar' => 'التزام بالمعايير',
            'title_en' => 'Compliance',
            'content_ar' => '100%',
            'content_en' => '100%',
            'image' => '/assets/images/icons/five.svg',
            'is_active' => true,
        ]);

        AboutUs::create([
            'parent_id' => $statsTab->id,
            'title_ar' => 'سنة خبرة',
            'title_en' => 'Years of Experience',
            'content_ar' => '15+',
            'content_en' => '15+',
            'image' => '/assets/images/icons/six.svg',
            'is_active' => true,
        ]);

        // Tab 3: Mission/Vision Tab (Parent)
        $missionTab = AboutUs::create([
            'parent_id' => null,
            'title_ar' => 'الرؤية والمهمة',
            'title_en' => 'Vision & Mission',
            'content_ar' => null,
            'content_en' => null,
            'image' => null,
            'is_active' => true,
        ]);

        // Mission Tab Children
        AboutUs::create([
            'parent_id' => $missionTab->id,
            'title_ar' => 'رؤيتنا',
            'title_en' => 'Our Vision',
            'content_ar' => 'أن نكون الرائدين في مجال خدمات البناء والتراخيص في المملكة العربية السعودية من خلال تقديم حلول مبتكرة وخدمات عالية الجودة',
            'content_en' => 'To be the leaders in construction and licensing services in the Kingdom of Saudi Arabia by providing innovative solutions and high-quality services',
            'image' => '/assets/images/icons/seven.svg',
            'is_active' => true,
        ]);

        AboutUs::create([
            'parent_id' => $missionTab->id,
            'title_ar' => 'مهمتنا',
            'title_en' => 'Our Mission',
            'content_ar' => 'تقديم خدمات متكاملة وشاملة في مجال البناء والتراخيص مع الالتزام بأعلى معايير الجودة والاحترافية لضمان رضا عملائنا',
            'content_en' => 'Providing comprehensive and integrated services in construction and licensing with commitment to the highest standards of quality and professionalism to ensure customer satisfaction',
            'image' => '/assets/images/icons/eight.svg',
            'is_active' => true,
        ]);

        AboutUs::create([
            'parent_id' => $missionTab->id,
            'title_ar' => 'قيمنا',
            'title_en' => 'Our Values',
            'content_ar' => 'الجودة، الاحترافية، الشفافية، والالتزام بمواعيد التسليم هي القيم الأساسية التي نؤمن بها ونطبقها في كل مشروع',
            'content_en' => 'Quality, professionalism, transparency, and commitment to delivery deadlines are the core values we believe in and apply in every project',
            'image' => '/assets/images/icons/nine.svg',
            'is_active' => true,
        ]);

        // Tab 4: Features Tab (Parent)
        $featuresTab = AboutUs::create([
            'parent_id' => null,
            'title_ar' => 'المميزات',
            'title_en' => 'Features',
            'content_ar' => null,
            'content_en' => null,
            'image' => null,
            'is_active' => true,
        ]);

        // Features Tab Children
        AboutUs::create([
            'parent_id' => $featuresTab->id,
            'title_ar' => 'خبرة واسعة',
            'title_en' => 'Wide Experience',
            'content_ar' => 'أكثر من 15 عاماً من الخبرة المتراكمة',
            'content_en' => 'Over 15 years of accumulated experience',
            'image' => '/assets/images/icons/ten.svg',
            'is_active' => true,
        ]);

        AboutUs::create([
            'parent_id' => $featuresTab->id,
            'title_ar' => 'جودة عالية',
            'title_en' => 'High Quality',
            'content_ar' => 'الالتزام بأعلى معايير الجودة',
            'content_en' => 'Commitment to the highest quality standards',
            'image' => '/assets/images/icons/eleven.svg',
            'is_active' => true,
        ]);

        AboutUs::create([
            'parent_id' => $featuresTab->id,
            'title_ar' => 'سرعة الإنجاز',
            'title_en' => 'Speed of Completion',
            'content_ar' => 'إنجاز المشاريع في الوقت المحدد',
            'content_en' => 'Completing projects on time',
            'image' => '/assets/images/icons/twelve.svg',
            'is_active' => true,
        ]);

        AboutUs::create([
            'parent_id' => $featuresTab->id,
            'title_ar' => 'خدمة عملاء',
            'title_en' => 'Customer Service',
            'content_ar' => 'دعم مستمر ومتابعة دقيقة',
            'content_en' => 'Continuous support and precise follow-up',
            'image' => '/assets/images/icons/thirteen.svg',
            'is_active' => true,
        ]);
    }
}
