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
        Schema::create('stripe_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('company')->nullable();
            $table->integer('country_id');
            $table->integer('city_id');
            $table->integer('zip_code')->nullable();
            $table->string('notes')->nullable();
            $table->integer('payment_method');
            $table->integer('sub_total');
            $table->integer('charge');
            $table->integer('discount')->nullable();
            $table->integer('total');
            $table->integer('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_orders');
    }
};
