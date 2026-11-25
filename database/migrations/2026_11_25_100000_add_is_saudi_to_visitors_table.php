<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Null = unknown (visitors recorded before this column existed).
            $table->boolean('is_saudi')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropIndex(['is_saudi']);
            $table->dropColumn('is_saudi');
        });
    }
};
