<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->index(['parent_id', 'is_active'], 'about_us_parent_id_is_active_index');
        });
    }

    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropIndex('about_us_parent_id_is_active_index');
        });
    }
};
