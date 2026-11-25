<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('pricing_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email');
            $table->string('phone', 20);
            $table->string('project_space', 400);
            $table->string('city', 400);
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->string('locale', 10)->nullable();
            $table->string('status', 20)->default('new')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('pricing_request_project_type', function (Blueprint $table) {
            $table->foreignId('pricing_request_id')->constrained()->cascadeOnDelete();
            // A type that is used by a request cannot be deleted, only deactivated.
            $table->foreignId('project_type_id')->constrained()->restrictOnDelete();
            $table->primary(['pricing_request_id', 'project_type_id'], 'pricing_request_type_primary');
        });

        // The options that were previously hardcoded in the website form.
        $defaults = [
            ['عمارة سكنية', 'Residential building'],
            ['معارض تجارية', 'Commercial showrooms'],
            ['فيلا', 'Villa'],
            ['مستودعات', 'Warehouses'],
            ['أخرى', 'Other'],
            ['مشروع سياحي', 'Tourism project'],
            ['مستشفى', 'Hospital'],
            ['فندق', 'Hotel'],
        ];

        foreach ($defaults as $position => [$ar, $en]) {
            DB::table('project_types')->insert([
                'name_ar' => $ar,
                'name_en' => $en,
                'sort_order' => $position + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing_request_project_type');
        Schema::dropIfExists('pricing_requests');
        Schema::dropIfExists('project_types');
    }
};
