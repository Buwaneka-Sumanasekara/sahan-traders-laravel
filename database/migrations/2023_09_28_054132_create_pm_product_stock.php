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
        Schema::create('pm_product_stock', function (Blueprint $table) {
            $table->string('pm_product_id', 60);
            $table->integer('pm_product_variant_group_id');
            $table->integer('pm_product_variant_id');
            $table->string('batch', 5);
            $table->double('cost_price');
            $table->double('sell_price');
            $table->double('qty');
         
            $table->boolean('active')->default(true);
            $table->bigInteger('cr_by_user_id');
            $table->bigInteger('md_by_user_id');
            $table->integer('pm_unit_group_id');
            $table->integer('pm_unit_id');

            $table->foreign('pm_unit_id')->references('id')->on('pm_unit');
            $table->foreign('pm_unit_group_id')->references('id')->on('pm_unit_group');
            $table->foreign('pm_product_id')->references('id')->on('pm_product');
            $table->foreign('pm_product_variant_group_id')->references('id')->on('pm_product_variant_group');
            $table->foreign('pm_product_variant_id')->references('id')->on('pm_product_variant');
            $table->foreign('cr_by_user_id')->references('id')->on('um_user');
            $table->foreign('md_by_user_id')->references('id')->on('um_user');

            $table->primary(['pm_product_id', 'batch','pm_product_variant_id','pm_product_variant_group_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_product_stock');
    }
};
