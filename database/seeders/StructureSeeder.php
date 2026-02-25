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
                    'ar' => [
                        'desc' => '<h3 class="text-2xl font-bold mb-4 text-emerald-400">1. قبول الشروط</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            بالدخول إلى هذا الموقع واستخدام خدماتنا، فإنك توافق على الالتزام بهذه الشروط والأحكام. إذا كنت لا توافق على أي من هذه الشروط، يرجى عدم استخدام الموقع والخدمات.
                        </p>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">2. استخدام الموقع</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            تسمح لك بموجب هذه الشروط باستخدام الموقع لأغراض قانونية فقط. أنت توافق على عدم استخدام الموقع بأي طريقة قد تكون غير قانونية أو مؤذية أو تنتهك حقوق أي شخص.
                        </p>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">3. الملكية الفكرية</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            جميع المحتويات على الموقع، بما في ذلك النصوص والصور والرسومات والشعار وأكواد البرنامج، مملوكة لنا أو لمزودي المحتوى لدينا ومحمية بقوانين الملكية الفكرية. يُحظر نسخ أو توزيع أو تعديل أي محتوى بدون الحصول على إذن صريح منا.
                        </p>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">4. خدماتنا</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            نقدم خدمات في مجال البناء والتراخيص. نحتفظ بالحق في تعديل أو إيقاف أي جزء من الخدمات في أي وقت. لن نكون مسؤولين عن أي أضرار تنتج عن تعديل أو إيقاف الخدمات.
                        </p>',
                    ],
                    'en' => [
                        'desc' => '<h3 class="text-2xl font-bold mb-4 text-emerald-400">1. Acceptance of Terms</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            By accessing this website and using our services, you agree to be bound by these terms and conditions. If you do not agree to any of these terms, please do not use the website and services.
                        </p>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">2. Use of Website</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            Under these terms, you are permitted to use the website for lawful purposes only. You agree not to use the website in any way that may be illegal, harmful, or violate the rights of any person.
                        </p>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">3. Intellectual Property</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            All content on the website, including texts, images, graphics, logos, and program codes, is owned by us or our content providers and protected by intellectual property laws. Copying, distributing, or modifying any content without our explicit permission is prohibited.
                        </p>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">4. Our Services</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            We provide services in the field of construction and licensing. We reserve the right to modify or stop any part of the services at any time. We will not be liable for any damages resulting from modification or cessation of services.
                        </p>',
                    ],
                ]),
            ]
        );

        Structure::query()->updateOrCreate(
            [
                'key' => 'privacy_policy',
            ],
            [
                'content' => json_encode([
                    'ar' => [
                        'content' => '<h3 class="text-2xl font-bold mb-4 text-emerald-400">1. جمع المعلومات</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            نقوم بجمع معلومات شخصية من خلال نموذج الاتصال بهدف توفير الخدمات بشكل أفضل وللتواصل معك بشأن طلبات الخدمة. المعلومات التي نجمعها تشمل الاسم والبريد الإلكتروني ورقم الهاتف والرسالة.
                        </p>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">2. استخدام المعلومات</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            نستخدم المعلومات التي نجمعها للأغراض التالية:
                        </p>
                        <ul class="list-disc list-inside text-slate-300 mb-6 space-y-2">
                            <li>الرد على استفسارات العملاء</li>
                            <li>تقديم الخدمات المطلوبة</li>
                            <li>تحسين تجربة المستخدم</li>
                            <li>إرسال تحديثات وإعلانات ذات صلة (بعد الحصول على الموافقة)</li>
                            <li>الامتثال للمتطلبات القانونية</li>
                        </ul>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">3. حماية البيانات</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            نحن نتخذ جميع التدابير المعقولة لحماية بيانات العملاء من الوصول غير المصرح به والتعديل والحذف والإفصاح. نستخدم تقنيات التشفير وطرق أمان أخرى لضمان سلامة بيانات العملاء.
                        </p>',
                    ],
                    'en' => [
                        'content' => '<h3 class="text-2xl font-bold mb-4 text-emerald-400">1. Information Collection</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            We collect personal information through the contact form to provide better services and communicate with you regarding service requests. The information we collect includes name, email, phone number, and message.
                        </p>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">2. Use of Information</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            We use the information we collect for the following purposes:
                        </p>
                        <ul class="list-disc list-inside text-slate-300 mb-6 space-y-2">
                            <li>Responding to customer inquiries</li>
                            <li>Providing requested services</li>
                            <li>Improving user experience</li>
                            <li>Sending relevant updates and announcements (after obtaining consent)</li>
                            <li>Compliance with legal requirements</li>
                        </ul>
                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">3. Data Protection</h3>
                        <p class="text-slate-300 leading-relaxed mb-6">
                            We take all reasonable measures to protect customer data from unauthorized access, modification, deletion, and disclosure. We use encryption technologies and other security methods to ensure the integrity of customer data.
                        </p>',
                    ],
                ]),
            ]
        );




        // Footer
        Structure::query()->updateOrCreate(
            ['key' => 'footer'],
            [
                'content' => json_encode([
                    'all' => [
                        'email' => 'info@example.com',
                        'phone' => '+966 XX XXX XXXX',
                        'whatsapp' => '+966501234567',
                        'location' => 'المملكة العربية السعودية، الرياض',
                        'location_en' => 'Riyadh, Saudi Arabia',
                        'google_map_link' => 'https://www.google.com/maps/search/?api=1&query=Riyadh+Saudi+Arabia',
                        'facebook_link' => 'https://facebook.com/example',
                        'instagram_link' => 'https://instagram.com/example',
                        'twitter_link' => 'https://twitter.com/example',
                        'linkedin_link' => 'https://linkedin.com/example',
                    ],
                    'website_name' => [
                        'ar' => 'البناء المتقدم',
                        'en' => 'Advanced Building',
                    ],
                    'image' => null,
                    'content' => [
                        'en' => 'Your trusted partner in construction and licensing services with over 15 years of experience in the Saudi market.',
                        'ar' => 'شريكك الموثوق في خدمات البناء والتراخيص مع خبرة تمتد لأكثر من 15 عاماً في السوق السعودي',
                    ],
                    'copyright' => [
                        'en' => '© 2024 Advanced Building. All rights reserved.',
                        'ar' => '© 2024 البناء المتقدم. جميع الحقوق محفوظة.',
                    ],
                ]),
            ]
        );
    }
}
