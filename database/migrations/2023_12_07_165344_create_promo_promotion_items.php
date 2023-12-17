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
        Schema::create('promo_promotion_items', function (Blueprint $table) {
            $table->integer('id');
            $table->string('promotion_id', 100);
            $table->double('dis_per');
            $table->double('dis_amt');
            $table->string('pm_product_id', 60);
            $table->integer('pm_product_varient_id')->nullable();
            $table->boolean('all_varients');

            $table->primary(['id','promotion_id']);
            $table->foreign('promotion_id')->references('id')->on('promo_promotions');
            $table->foreign('pm_product_id')->references('id')->on('pm_product');
            $table->foreign('pm_product_varient_id')->references('id')->on('pm_product_varient');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_promotion_items');
    }
};
