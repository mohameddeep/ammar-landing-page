<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Deleting a parent keeps its children as top-level services.
            $table->foreignId('parent_id')->nullable()->after('id')->constrained('services')->nullOnDelete();
            $table->index(['parent_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['parent_id', 'is_active']);
            $table->dropConstrainedForeignId('parent_id');
        });
    }
};
