<?php

namespace App\Http\Controllers\Website\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Services\Website\LandingPage\LandingPageService;

class LandingPageController extends Controller
{
    public function __construct(private readonly LandingPageService $service) {}

    public function index()
    {

        return $this->service->index();
    }

    public function services()
    {
        return view('website.services.index');
    }

    public function serviceDetails($id)
    {
        $services = [
            'building-licenses' => [
                'id' => 'building-licenses',
                'name' => 'تراخيص البناء',
                'badge' => '📜 تراخيص البناء',
                'description' => 'نحصل على جميع التراخيص المطلوبة لمشروعك بسرعة واحترافية عالية، مع ضمان الامتثال الكامل للمعايير والقوانين المحلية والدولية'
            ],
            'project-supervision' => [
                'id' => 'project-supervision',
                'name' => 'الإشراف على المشاريع',
                'badge' => '👷 الإشراف على المشاريع',
                'description' => 'فريقنا المتخصص يوفر إشرافاً كاملاً على تنفيذ المشاريع مع ضمان الجودة والالتزام بالجداول الزمنية'
            ],
            'contracting' => [
                'id' => 'contracting',
                'name' => 'المقاولات والتنفيذ',
                'badge' => '🏢 المقاولات والتنفيذ',
                'description' => 'خدمات مقاولات شاملة من التصميم إلى التسليم النهائي مع ضمان أعلى معايير الجودة والأمان'
            ],
            'consulting' => [
                'id' => 'consulting',
                'name' => 'الاستشارات الهندسية',
                'badge' => '💼 الاستشارات الهندسية',
                'description' => 'استشارات متخصصة من فريق هندسي متمرس لضمان نجاح مشروعك من الألف إلى الياء'
            ],
            'quality-assurance' => [
                'id' => 'quality-assurance',
                'name' => 'ضمان الجودة',
                'badge' => '✅ ضمان الجودة',
                'description' => 'برامج مراقبة الجودة الشاملة لضمان التزام المشاريع بأعلى المعايير الدولية والمحلية'
            ],
            'safety-management' => [
                'id' => 'safety-management',
                'name' => 'إدارة السلامة',
                'badge' => '🛡️ إدارة السلامة',
                'description' => 'برامج شاملة لضمان سلامة الموقع والعاملين وتطبيق أفضل الممارسات الدولية'
            ]
        ];

        $service = $services[$id] ?? null;

        if (!$service) {
            abort(404);
        }

        return view('website.services.show', compact('service'));
    }

}
