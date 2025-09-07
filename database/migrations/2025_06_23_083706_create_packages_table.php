<?php

use App\Enums\PackageTypeEnum;
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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('duration')->comment('Duration of the package, in days');
            $table->decimal('price');
            $table->integer('product_count')->comment('Unique identifier for the package');
            $table->integer('free_product_count')->default(0)->comment('Number of free dresses included in the package');

            $table->enum('type', PackageTypeEnum::values());
            $table->boolean('is_active')->default(0);
            $table->boolean('coming_soon')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
