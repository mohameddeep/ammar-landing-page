<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * Creates the three top-level service categories and files the seeded services under them.
 *
 * Safe to run more than once: parents are matched by Arabic title, and only services that
 * are still top-level (no parent, no children of their own) are moved under a parent.
 */
class ServiceParentSeeder extends Seeder
{
    /** @var array<int, array{parent: array<string, string>, children: list<string>}> */
    private const TREE = [
        [
            'parent' => [
                'title_ar' => 'مقاولات',
                'title_en' => 'Contracting',
                'content_ar' => 'تنفيذ أعمال المقاولات للمشاريع السكنية والتجارية بإشراف هندسي متكامل والتزام بالجودة والجداول الزمنية.',
                'content_en' => 'Contracting works for residential and commercial projects under full engineering supervision, delivered to quality standards and on schedule.',
            ],
            'children' => ['المقاولات والإشراف'],
        ],
        [
            'parent' => [
                'title_ar' => 'مقاولات عامة',
                'title_en' => 'General Contracting',
                'content_ar' => 'أعمال المقاولات العامة من الهيكل الإنشائي حتى التشطيب والتسليم.',
                'content_en' => 'General contracting works, from the structural frame through finishing and handover.',
            ],
            'children' => [],
        ],
        [
            'parent' => [
                'title_ar' => 'استشارات هندسية',
                'title_en' => 'Engineering Consultancy',
                'content_ar' => 'استشارات هندسية وإصدار التراخيص وشهادات المباني وفق الأنظمة والاشتراطات المعتمدة.',
                'content_en' => 'Engineering consultancy, building permits and certificates in line with approved regulations and requirements.',
            ],
            'children' => [
                'رخص البناء',
                'رخص الهدم والترميم',
                'شهادات إتمام البناء',
                'تصحيح أوضاع المباني',
                'الأمن والسلامة',
            ],
        ],
    ];

    public function run(): void
    {
        foreach (self::TREE as $branch) {
            $parent = Service::query()->firstOrCreate(
                ['title_ar' => $branch['parent']['title_ar'], 'parent_id' => null],
                $branch['parent'] + ['is_active' => true, 'image' => null],
            );

            if ($branch['children'] === []) {
                continue;
            }

            // Ids are selected first: MySQL can't UPDATE a table using a subquery on itself.
            $childIds = Service::query()
                ->whereIn('title_ar', $branch['children'])
                ->whereNull('parent_id')
                ->whereKeyNot($parent->id)
                ->whereDoesntHave('children')
                ->pluck('id');

            Service::query()->whereKey($childIds)->update(['parent_id' => $parent->id]);
        }
    }
}
