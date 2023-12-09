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
        Schema::create('cdm_pay_hed', function (Blueprint $table) {
            $table->string('id', 5)->primary();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->boolean('has_det')->default(false);
            $table->boolean('has_ref')->default(false);
            $table->boolean('en_front')->default(false);
            $table->boolean('en_back')->default(false);
            $table->boolean('over_pay')->default(false);
            $table->boolean('is_adv_pay')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdm_pay_hed');
    }
};
