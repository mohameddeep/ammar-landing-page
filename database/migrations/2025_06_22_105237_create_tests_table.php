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

        // users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(1);
            $table->enum("role",["client","store","designer","individual"]);
            $table->text("fcm_token")->nullable();
            $table->boolean('otp_verified')->default(0);
            $table->timestamps();
        });

        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('phone');
            $table->string('street_name');
            $table->string('city');
            $table->string('building_name')->nullable();
            $table->string('landmark')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_default')->default(0);
            $table->timestamps();
        });



        // categories

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name_ar");
            $table->string("name_en")->nullable();
            $table->string("slug")->nullable();
            $table->string("image")->nullable();
            $table->boolean("is_active");
            $table->foreignId("parent_id")->nullable()->constrained("categories")->cascadeOnDelete();
            $table->timestamps();
        });

        //packages
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("duration");
            $table->decimal("price");
            $table->string("product_num");
            $table->boolean("is_active")->default(0);
            $table->boolean("is_hidden")->default(0);
            $table->timestamps();
        });

        //package_features
        Schema::create('package_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: "package_id")->constrained("packages")->cascadeOnDelete();
            $table->text("feature_ar");
            $table->text("feature_en")->nullable();
            $table->boolean("is_active")->default(0);
            $table->timestamps();
        });


         //subscriptions
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: "package_id")->constrained("packages")->cascadeOnDelete();
            $table->foreignId(column: "user_id")->constrained("users")->cascadeOnDelete();
            $table->dateTime("end_date")->nullable();
            $table->boolean("is_active")->default(0);
            $table->timestamps();
        });


        //products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name_ar");
            $table->string("name_en")->nullable();
            $table->string("slug")->nullable();
            $table->decimal("price");
            $table->integer("discount")->nullable();
            $table->integer("quantity")->nullable();
            $table->text("detail_ar");
            $table->text("detail_en")->nullable();
            $table->foreignId(column: "seller_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId(column: "category_id")->constrained("categories")->cascadeOnDelete();
            $table->enum("type",["old","new"])->default("new");
            $table->string("show_duration")->nullable();
            $table->boolean("is_approved")->default(0);
            $table->text("rejetion_reason")->nullable();
            $table->boolean("is_featured")->default(0);
            $table->boolean("is_active")->default(0);
            $table->boolean("is_selled")->default(0);
            $table->timestamps();
        });



          Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: "product_id")->constrained("products")->cascadeOnDelete();
            $table->string("image");
            $table->boolean("is_active")->default(0);
            $table->timestamps();
        });

        //favourites
          Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: "product_id")->constrained("products")->cascadeOnDelete();
            $table->foreignId(column: "user_id")->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });

          Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->timestamps();
        });

         Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId(column: "user_id")->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->integer('quantity');
            $table->foreignId(column: "product_id")->constrained("products")->cascadeOnDelete();
            $table->foreignId(column: "cart_id")->constrained("carts")->cascadeOnDelete();
            $table->timestamps();
        });


        //orders

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

        //orders details

         Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('item_price', 10, 2);
            $table->integer('quantity');
            $table->foreignId(column: "order_id")->constrained("orders")->cascadeOnDelete();
            $table->foreignId(column: "product_id")->constrained("products")->cascadeOnDelete();
;
             $table->timestamps();
        });
    }


    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
