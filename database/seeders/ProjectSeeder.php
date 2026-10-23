<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

/**
 * Sample portfolio projects so the Projects pages have content to show.
 * Replace them with the company's real projects from the dashboard (Projects page).
 *
 * Idempotent: projects are matched by slug and their gallery is rebuilt on each run.
 * Not part of DatabaseSeeder; run with: php artisan db:seed --class=ProjectSeeder
 */
class ProjectSeeder extends Seeder
{
    private const PHOTOS = [
        'villa_evening' => 'photo-1600585154340-be6161a56a0c',
        'villa_interior' => 'photo-1600607687939-ce8a6c25118c',
        'villa_modern' => 'photo-1600047509807-ba8f99d2cdde',
        'office_towers' => 'photo-1486406146926-c627a92ad1ab',
        'site_survey' => 'photo-1541888946425-d81bb19240f5',
        'blueprint' => 'photo-1503387762-592deb58ef4e',
        'modern_facade' => 'photo-1487958449943-2429e8be8625',
        'office_interior' => 'photo-1497366216548-37526070297c',
        'rebar_works' => 'photo-1504307651254-35680f356dfd',
        'residential_towers' => 'photo-1582407947304-fd86f028f716',
    ];

    public function run(): void
    {
        foreach ($this->projects() as $order => $item) {
            $gallery = $item['gallery'];
            $photo = $item['photo'];
            unset($item['gallery'], $item['photo']);

            $project = Project::query()->updateOrCreate(
                ['slug' => $item['slug']],
                $item + ['image' => $this->photo($photo), 'sort_order' => $order + 1, 'is_active' => true, 'is_featured' => false]
            );

            $project->images()->delete();
            foreach ($gallery as $index => $photo) {
                $project->images()->create(['image' => $this->photo($photo), 'sort_order' => $index + 1]);
            }
        }
    }

    private function photo(string $key): string
    {
        return 'https://images.unsplash.com/'.self::PHOTOS[$key].'?auto=format&fit=crop&w=1600&q=80';
    }

    /** @return list<array<string, mixed>> */
    private function projects(): array
    {
        return [
            [
                'slug' => 'modern-villa-al-narjis',
                'photo' => 'villa_evening',
                'gallery' => ['villa_interior', 'villa_modern', 'blueprint'],
                'is_featured' => true,
                'title_ar' => 'فيلا سكنية حديثة - حي النرجس',
                'title_en' => 'Modern Residential Villa - Al Narjis',
                'category_ar' => 'سكني', 'category_en' => 'Residential',
                'city_ar' => 'الرياض', 'city_en' => 'Riyadh',
                'client_ar' => 'عميل خاص', 'client_en' => 'Private client',
                'area' => '650 m²', 'year' => 2024,
                'summary_ar' => 'تصميم وإصدار رخصة البناء والإشراف الهندسي على تنفيذ فيلا سكنية بطابع معاصر وواجهات زجاجية واسعة.',
                'summary_en' => 'Design, building permit and engineering supervision for a contemporary residential villa with wide glazed facades.',
                'content_ar' => '<p>شمل نطاق العمل إعداد المخططات المعمارية والإنشائية، واستخراج رخصة البناء من الأمانة، ثم الإشراف الكامل على مراحل التنفيذ حتى التسليم.</p><ul><li>تصميم معماري يراعي الخصوصية والإضاءة الطبيعية</li><li>إشراف على الهيكل الإنشائي وأعمال التشطيبات</li><li>متابعة الجودة والجدول الزمني</li></ul>',
                'content_en' => '<p>The scope covered architectural and structural drawings, obtaining the building permit from the municipality, and full supervision of every construction stage through handover.</p><ul><li>Architectural design balancing privacy and natural light</li><li>Supervision of the structural frame and finishing works</li><li>Quality and schedule control</li></ul>',
            ],
            [
                'slug' => 'business-tower-king-fahd-road',
                'photo' => 'office_towers',
                'gallery' => ['residential_towers', 'office_interior', 'modern_facade'],
                'is_featured' => true,
                'title_ar' => 'برج إداري - طريق الملك فهد',
                'title_en' => 'Office Tower - King Fahd Road',
                'category_ar' => 'تجاري', 'category_en' => 'Commercial',
                'city_ar' => 'الرياض', 'city_en' => 'Riyadh',
                'client_ar' => 'شركة تطوير عقاري', 'client_en' => 'Real estate developer',
                'area' => '18,000 m²', 'year' => 2023,
                'summary_ar' => 'إشراف هندسي على تنفيذ برج مكاتب إدارية متعدد الطوابق مع أنظمة واجهات زجاجية حديثة.',
                'summary_en' => 'Engineering supervision of a multi-storey office tower with a modern curtain-wall facade.',
                'content_ar' => '<p>تولى فريقنا الإشراف على أعمال الهيكل الخرساني والواجهات والأنظمة الكهروميكانيكية، مع إعداد تقارير دورية للمالك ومطابقة التنفيذ للمخططات المعتمدة.</p>',
                'content_en' => '<p>Our team supervised the concrete frame, facade and MEP works, issuing regular reports to the owner and verifying compliance with the approved drawings.</p>',
            ],
            [
                'slug' => 'contemporary-villa-jeddah',
                'photo' => 'villa_modern',
                'gallery' => ['villa_evening', 'villa_interior'],
                'title_ar' => 'فيلا معاصرة - شمال جدة',
                'title_en' => 'Contemporary Villa - North Jeddah',
                'category_ar' => 'سكني', 'category_en' => 'Residential',
                'city_ar' => 'جدة', 'city_en' => 'Jeddah',
                'area' => '480 m²', 'year' => 2024,
                'summary_ar' => 'تصميم معماري وتنفيذ فيلا بواجهات تجمع بين الحجر والخشب ومساحات خضراء.',
                'summary_en' => 'Architectural design and delivery of a villa combining stone and timber facades with landscaped gardens.',
                'content_ar' => '<p>مشروع سكني متكامل من التصميم حتى التسليم، مع الالتزام بكود البناء السعودي واشتراطات الأمانة.</p>',
                'content_en' => '<p>A complete residential project from design to handover, in line with the Saudi Building Code and municipal requirements.</p>',
            ],
            [
                'slug' => 'residential-towers-dammam',
                'photo' => 'residential_towers',
                'gallery' => ['office_towers', 'modern_facade'],
                'title_ar' => 'مجمع أبراج سكنية',
                'title_en' => 'Residential Towers Complex',
                'category_ar' => 'سكني', 'category_en' => 'Residential',
                'city_ar' => 'الدمام', 'city_en' => 'Dammam',
                'client_ar' => 'مطور عقاري', 'client_en' => 'Property developer',
                'area' => '32,000 m²', 'year' => 2022,
                'summary_ar' => 'استشارات هندسية وتراخيص وإشراف لمجمع سكني من عدة أبراج.',
                'summary_en' => 'Engineering consultancy, permits and supervision for a multi-tower residential complex.',
                'content_ar' => '<p>تنسيق كامل بين الجهات المعنية لاستخراج التراخيص، ومتابعة التنفيذ وفق الجدول الزمني المعتمد.</p>',
                'content_en' => '<p>Full coordination with the relevant authorities to obtain permits, and follow-up of construction against the approved schedule.</p>',
            ],
            [
                'slug' => 'commercial-showroom-khobar',
                'photo' => 'modern_facade',
                'gallery' => ['office_interior', 'blueprint'],
                'title_ar' => 'مبنى معارض تجارية',
                'title_en' => 'Commercial Showroom Building',
                'category_ar' => 'تجاري', 'category_en' => 'Commercial',
                'city_ar' => 'الخبر', 'city_en' => 'Khobar',
                'area' => '2,400 m²', 'year' => 2023,
                'summary_ar' => 'تصميم وتنفيذ مبنى معارض بواجهة معمارية مميزة ومساحات عرض مفتوحة.',
                'summary_en' => 'Design and delivery of a showroom building with a distinctive facade and open display spaces.',
                'content_ar' => '<p>تم تصميم المبنى ليمنح حضوراً بصرياً قوياً على الشارع التجاري مع مرونة في تقسيم المساحات الداخلية.</p>',
                'content_en' => '<p>The building was designed for a strong street presence on the commercial road, with flexible interior layouts.</p>',
            ],
            [
                'slug' => 'concrete-structure-supervision-makkah',
                'photo' => 'rebar_works',
                'gallery' => ['site_survey', 'blueprint'],
                'title_ar' => 'الإشراف على هيكل خرساني',
                'title_en' => 'Concrete Structure Supervision',
                'category_ar' => 'إشراف هندسي', 'category_en' => 'Engineering Supervision',
                'city_ar' => 'مكة المكرمة', 'city_en' => 'Makkah',
                'area' => '5,600 m²', 'year' => 2024,
                'summary_ar' => 'إشراف ميداني على أعمال التسليح والصب لمبنى متعدد الاستخدامات.',
                'summary_en' => 'Site supervision of reinforcement and concrete works for a mixed-use building.',
                'content_ar' => '<p>فحص التسليح قبل الصب، ومتابعة اختبارات الخرسانة، والتأكد من مطابقة الأعمال للمخططات الإنشائية.</p>',
                'content_en' => '<p>Inspection of reinforcement before each pour, concrete testing follow-up, and verification against the structural drawings.</p>',
            ],
            [
                'slug' => 'foundation-works-madinah',
                'photo' => 'site_survey',
                'gallery' => ['rebar_works'],
                'title_ar' => 'أعمال الأساسات والبنية التحتية',
                'title_en' => 'Foundations & Infrastructure Works',
                'category_ar' => 'إشراف هندسي', 'category_en' => 'Engineering Supervision',
                'city_ar' => 'المدينة المنورة', 'city_en' => 'Madinah',
                'year' => 2023,
                'summary_ar' => 'إشراف على أعمال الحفر والأساسات لموقع مشروع تجاري.',
                'summary_en' => 'Supervision of excavation and foundation works for a commercial project site.',
                'content_ar' => '<p>متابعة أعمال الحفر والردم وصب الأساسات وفق تقرير التربة والمخططات المعتمدة.</p>',
                'content_en' => '<p>Follow-up of excavation, backfilling and foundation pours according to the soil report and approved drawings.</p>',
            ],
            [
                'slug' => 'design-and-permit-residential-building',
                'photo' => 'blueprint',
                'gallery' => ['villa_modern', 'office_interior'],
                'title_ar' => 'تصميم وترخيص عمارة سكنية',
                'title_en' => 'Residential Building Design & Permit',
                'category_ar' => 'تصميم وتراخيص', 'category_en' => 'Design & Permits',
                'city_ar' => 'الرياض', 'city_en' => 'Riyadh',
                'area' => '1,100 m²', 'year' => 2025,
                'summary_ar' => 'إعداد المخططات المعمارية والإنشائية واستخراج رخصة البناء لعمارة سكنية.',
                'summary_en' => 'Architectural and structural drawings and building permit for a residential building.',
                'content_ar' => '<p>من الفكرة الأولى حتى صدور رخصة البناء: تصميم، ومراجعة اشتراطات البلدية، ورفع الطلب عبر منصة بلدي.</p>',
                'content_en' => '<p>From first concept to issued permit: design, municipal requirement review, and submission through the Balady platform.</p>',
            ],
        ];
    }
}
