<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->enum('type', ['admin', 'provider'])
                ->default('admin')
                ->after('name');

            $table->foreignId('provider_id')
                ->nullable()
                ->after('usage_count')
                ->constrained('users')
                ->cascadeOnDelete();
        });
    }


    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropForeign(['provider_id']);
            $table->dropColumn(['type', 'provider_id']);
        });
    }
};
