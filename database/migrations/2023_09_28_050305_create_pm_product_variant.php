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
        Schema::create('pm_product_variant', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name', 400);
            $table->string('val', 200);
            $table->boolean('active')->default(true);
            $table->integer('variant_group_id');
            
            $table->primary(['id','variant_group_id']);
            $table->foreign('variant_group_id')->references('id')->on('pm_product_variant_group');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_product_variant');
    }
};
