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
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('order_number');
            $table->string('username');
            $table->boolean('paid')->default(0);//not paid
            $table->boolean('method')->default(1);//cash , 0 by card
            $table->boolean('registered')->default(0);//not registered
            $table->string('promo')->nullable(); //get the promo after pressing on place order (if there is promo)
            $table->double('total_usd')->nullable();
            $table->boolean('confirm')->nullable(); // 1-confirmed 2-not confirmed
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
