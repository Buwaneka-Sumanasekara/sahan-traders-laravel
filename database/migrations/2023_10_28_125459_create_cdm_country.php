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
        Schema::create('cdm_country', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 60);
            $table->string('courier_code', 10);
            $table->string('payment_code', 10);
            $table->boolean('active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdm_country');
    }
};
