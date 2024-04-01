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
        Schema::create('cdm_pay_det', function (Blueprint $table) {
            $table->string('id', 10);
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->string('cdm_pay_hed_id', 10);

            $table->primary(['id', 'cdm_pay_hed_id']);

            $table->foreign('cdm_pay_hed_id')->references('id')->on('cdm_pay_hed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdm_pay_det');
    }
};
