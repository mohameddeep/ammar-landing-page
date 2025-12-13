<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Service 1: Building Permits
        Service::create([
            'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
            'is_active' => true,
            'title_ar' => 'رخص البناء',
            'title_en' => 'Building Permits',
            'content_ar' => 'إصدار رخص البناء بكفاءة عالية وسرعة في الإنجاز مع ضمان استيفاء جميع المتطلبات القانونية',
            'content_en' => 'Issuing building permits with high efficiency and speed, ensuring all legal requirements are met.',
        ]);

        // Service 2: Demolition and Restoration Permits
        Service::create([
            'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80',
            'is_active' => true,
            'title_ar' => 'رخص الهدم والترميم',
            'title_en' => 'Demolition and Restoration Permits',
            'content_ar' => 'استخراج تراخيص الهدم والترميم وفقاً للمواصفات والإجراءات المعتمدة',
            'content_en' => 'Obtaining demolition and restoration permits according to approved specifications and procedures.',
        ]);

        // Service 3: Construction Completion Certificates
        Service::create([
            'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2092&q=80',
            'is_active' => true,
            'title_ar' => 'شهادات إتمام البناء',
            'title_en' => 'Construction Completion Certificates',
            'content_ar' => 'إصدار شهادات إتمام البناء بعد التأكد من مطابقة المشروع للمخططات المعتمدة',
            'content_en' => 'Issuing construction completion certificates after verifying project compliance with approved plans.',
        ]);

        // Service 4: Building Status Correction
        Service::create([
            'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
            'is_active' => true,
            'title_ar' => 'تصحيح أوضاع المباني',
            'title_en' => 'Building Status Correction',
            'content_ar' => 'إصدار رخص تصحيح وضع المباني القائمة وتوفيق أوضاعها القانونية',
            'content_en' => 'Issuing permits to correct the status of existing buildings and legalize their situation.',
        ]);

        // Service 5: Safety and Security
        Service::create([
            'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80',
            'is_active' => true,
            'title_ar' => 'الأمن والسلامة',
            'title_en' => 'Safety and Security',
            'content_ar' => 'إعداد مخططات الأمن والسلامة وتقارير السلامة الإنشائية المعتمدة',
            'content_en' => 'Preparing safety and security plans and approved structural safety reports.',
        ]);

        // Service 6: Contracting and Supervision
        Service::create([
            'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2092&q=80',
            'is_active' => true,
            'title_ar' => 'المقاولات والإشراف',
            'title_en' => 'Contracting and Supervision',
            'content_ar' => 'تنفيذ أعمال المقاولات والترميم مع الإشراف الكامل على تنفيذ المشاريع',
            'content_en' => 'Execution of contracting and restoration works with full supervision of project implementation.',
        ]);
    }
}
