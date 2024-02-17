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
        Schema::create('pm_product_variant_group', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 400);
            $table->boolean('active')->default(true);
            $table->integer('type_id');//color, size, etc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_product_variant_group');
    }
};
