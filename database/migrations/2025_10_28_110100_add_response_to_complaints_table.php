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
        Schema::table('complaints', function (Blueprint $table) {
            $table->text('response')->nullable()->after('complaint');
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->nullOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            $table->dropColumn(['response', 'user_id']);

        });
    }
};
