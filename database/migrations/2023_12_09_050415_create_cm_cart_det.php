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
        Schema::create('cm_cart_det', function (Blueprint $table) {
            $table->integer('id');
            $table->double('cprice', 20, 2);
            $table->double('sprice', 20, 2);
            $table->double('qty', 20, 2);
            $table->double('free_qty', 20, 2);
            $table->double('line_dis_per', 10, 2);
            $table->double('line_dis_amt', 10, 2);
            $table->double('amount', 20, 2);
            $table->boolean('is_taxable_item')->default(true);

            $table->integer('pm_unit_group_id');
            $table->integer('pm_unit_id');
            $table->string('cm_cart_hed_id', 100);
            $table->string('product_id', 60);
            $table->string('stk_batch_id', 5);

            $table->integer('pm_product_variant_id');
            $table->integer('pm_product_variant_group_id');
            $table->string('promo_promotions_id', 100)->nullable();
            $table->integer('additional_product_cost_id')->nullable();
            $table->double('additional_product_cost')->default(0);

            $table->timestamps();


            $table->primary(['id', 'cm_cart_hed_id']);

            //foreign key
            $table->foreign('pm_unit_group_id')->references('id')->on('pm_unit_group');
            $table->foreign('pm_unit_id')->references('id')->on('pm_unit');
            $table->foreign('cm_cart_hed_id')->references('id')->on('cm_cart_hed');
            $table->foreign('product_id')->references('id')->on('pm_product');
            $table->foreign('promo_promotions_id')->references('id')->on('promo_promotions');
            $table->foreign('pm_product_variant_group_id')->references('id')->on('pm_product_variant_group');
            $table->foreign('pm_product_variant_id')->references('id')->on('pm_product_variant');
            $table->foreign('additional_product_cost_id')->references('id')->on('pm_product_additional_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cm_cart_det');
    }
};
