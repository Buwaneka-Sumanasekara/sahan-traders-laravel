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
        Schema::create('pm_group_mapping', function (Blueprint $table) {
            $table->boolean('active')->default(true);
            $table->string('pm_group1_id', 10);
            $table->string('pm_group2_id', 10);
            $table->string('pm_group3_id', 10);
            $table->string('pm_group4_id', 10);
            $table->string('pm_group5_id', 10);
            $table->foreign('pm_group1_id')->references('id')->on('pm_group1');
            $table->foreign('pm_group2_id')->references('id')->on('pm_group2');
            $table->foreign('pm_group3_id')->references('id')->on('pm_group3');
            $table->foreign('pm_group4_id')->references('id')->on('pm_group4');
            $table->foreign('pm_group5_id')->references('id')->on('pm_group5');
            $table->primary(['pm_group1_id', 'pm_group2_id', 'pm_group3_id', 'pm_group4_id', 'pm_group5_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_group_mapping');
    }
};
