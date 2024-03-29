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
        Schema::create('pm_product_images', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name', 60);
            $table->string('path', 500);
            $table->boolean('active')->default(true);
            $table->boolean('is_primary')->default(true);
            $table->string('pm_product_id', 60);
            $table->integer('pm_product_variant_id');
            $table->bigInteger('cr_by_user_id');
            $table->bigInteger('md_by_user_id');
            $table->timestamps();

            $table->foreign('pm_product_id')->references('id')->on('pm_product');
            $table->foreign('pm_product_variant_id')->references('id')->on('pm_product_variant');
            $table->foreign('cr_by_user_id')->references('id')->on('um_user');
            $table->foreign('md_by_user_id')->references('id')->on('um_user');

            $table->primary(['id', 'pm_product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_product_images');
    }
};
