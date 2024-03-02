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
        Schema::create('bm_buyer_addresses', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('address_1', 100);
            $table->string('address_2', 100);
            $table->string('city', 100);
            $table->string('zip_code', 20);
            $table->integer('cdm_country_id');
            $table->string('province_name', 100);
            $table->string('contact_number', 20);
            $table->string('name', 100);
            $table->timestamps();

            $table->foreign('cdm_country_id')->references('id')->on('cdm_country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bm_buyer_addresses');
    }
};
