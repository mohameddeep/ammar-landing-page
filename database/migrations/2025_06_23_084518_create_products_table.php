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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->decimal('price');
            $table->text('description');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->enum('type', ['old', 'new'])->default('new');
            $table->enum('status', ['pending', 'approved', 'rejected', 'sold']);
            $table->text('rejection_reason')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_stopped')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
