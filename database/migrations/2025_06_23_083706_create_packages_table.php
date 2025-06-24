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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string("name_ar");
            $table->string("name_en")->nullable();
            $table->string("duration")->comment("Duration of the package, in days");
            $table->decimal("price");
            $table->string("product_number")->comment("Unique identifier for the package");
            $table->enum("type", ["store", "designer", "individual"]);
            $table->boolean("is_active")->default(0);
            $table->boolean("is_hidden")->default(0);
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
