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
        Schema::create('pm_product', function (Blueprint $table) {
            $table->string('id', 60)->primary();
            $table->string('name', 400);
            $table->string('slug', 500);
            $table->boolean('is_inquiry_item')->default(false);
            $table->text('note')->nullable();
            $table->text('note_html')->nullable();
            $table->boolean('active')->default(true);
            $table->string('pm_group1_id', 10);
            $table->string('pm_group2_id', 10);
            $table->string('pm_group3_id', 10);
            $table->string('pm_group4_id', 10);
            $table->string('pm_group5_id', 10);
            $table->bigInteger('cr_by_user_id');
            $table->bigInteger('md_by_user_id');
            $table->boolean('en_batch')->default(true);
            $table->integer('pm_unit_group_id');
            $table->boolean('is_featured_product')->default(false);
            $table->double('prop_width')->nullable();
            $table->double('prop_height')->nullable();
            $table->double('prop_depth')->nullable();
            $table->double('prop_weight')->nullable();
            $table->integer('pm_product_variant_group_id');

            $table->foreign('pm_group1_id')->references('id')->on('pm_group1');
            $table->foreign('pm_group2_id')->references('id')->on('pm_group2');
            $table->foreign('pm_group3_id')->references('id')->on('pm_group3');
            $table->foreign('pm_group4_id')->references('id')->on('pm_group4');
            $table->foreign('pm_group5_id')->references('id')->on('pm_group5');

            $table->foreign('cr_by_user_id')->references('id')->on('um_user');
            $table->foreign('md_by_user_id')->references('id')->on('um_user');

            $table->foreign('pm_unit_group_id')->references('id')->on('pm_unit_group');

            $table->foreign('pm_product_variant_group_id')->references('id')->on('pm_product_variant_group');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_product');
    }
};
