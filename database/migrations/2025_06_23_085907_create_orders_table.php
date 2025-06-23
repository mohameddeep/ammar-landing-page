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
        Schema::create('orders', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->integer('order_num')->nullable();
            $table->double('grand_total', 10, 2)->default(0);
            $table->enum('payment_type', ['cash', 'online']);
            $table->enum('order_status', ['pending','processing','shipped','delivered','cancelled','refunded'])->default("pending");
            $table->enum('payment_status', ['paid','failed']);
            $table->foreignId(column: "user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId('address_id')->constrained('user_addresses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('coupon_code')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
