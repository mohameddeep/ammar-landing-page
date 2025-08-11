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
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('slug')->nullable();
            $table->decimal('price');
            $table->integer('discount')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('old_seller')->nullable();
            $table->text('detail_ar');
            $table->text('detail_en')->nullable();
            $table->foreignId('merchant_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->enum('type', ['old', 'new'])->default('new');
            $table->dateTime('expired_at')->nullable();
            $table->string('duration_days')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'sold']);
            $table->text('rejetion_reason')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_active')->default(0);
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
