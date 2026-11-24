<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->char('visitor_hash', 64)->unique();
            $table->string('locale', 10)->nullable();
            $table->string('first_path')->nullable();
            $table->timestamp('first_visited_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
