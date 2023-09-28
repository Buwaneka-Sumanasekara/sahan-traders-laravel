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
        Schema::create('pm_unit_has_pm_unit_group', function (Blueprint $table) {
            $table->integer('pm_unit_id');
            $table->integer('pm_unit_group_id');
            $table->double('volume')->default(1); //increment of the base unit: Eg: kg,g if kg is base unit then g volume is 0.001
            $table->boolean('is_base')->default(false);
            $table->boolean('is_sales_unit')->default(false);
            $table->boolean('is_purchase_unit')->default(false);
            $table->foreign('pm_unit_id')->references('id')->on('pm_unit');
            $table->foreign('pm_unit_group_id')->references('id')->on('pm_unit_group');
            $table->primary('pm_unit_id', 'pm_unit_group_id');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_unit_has_pm_unit_group');
    }
};
