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
        Schema::create('pm_product_varient', function (Blueprint $table) {
            $table->integer('id');
            $table->string('product_id', 60);
            $table->string('name', 400);
            $table->boolean('active')->default(true);
            
            $table->primary(['id','product_id']);
            $table->foreign('product_id')->references('id')->on('pm_product');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_product_varient');
    }
};
