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
        Schema::create('bm_buyer', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('total_orders');
            $table->string('contact_1', 45);
            $table->string('contact_2', 45);

            $table->bigInteger('user_id');
            $table->integer('address_ship_id');
            $table->integer('address_bill_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('um_user');
            $table->foreign('address_ship_id')->references('id')->on('bm_buyer_addresses');
            $table->foreign('address_bill_id')->references('id')->on('bm_buyer_addresses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bm_buyer');
    }
};
