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
        Schema::create('stkm_trn_setup', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('type', 5);
            $table->string('name');
            $table->integer('mode')->default(0);
            $table->boolean('en_cprice')->default(true);
            $table->boolean('en_sprice')->default(false);
            $table->boolean('en_payment')->default(false);
            $table->string('cal_mode')->default(config("global.cal_mode.cost_price"));
            $table->boolean('en_line_dis_per')->default(false);
            $table->boolean('en_line_dis_amt')->default(false);
            $table->boolean('en_display')->default(false);
            $table->boolean('en_check_qty')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stkm_trn_setup');
    }
};
