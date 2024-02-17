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
        Schema::create('stkm_trn_out_hed', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->double('gross_amount', 20, 2);
            $table->double('dis_per', 10, 2);
            $table->double('net_amount', 20, 2);
            $table->dateTimeTz('trn_date', $precision = 0);
            $table->integer('stkm_trn_status_id');
            $table->string('stkm_trn_setup_id', 10);
            $table->string('trn_ref_no', 100);
            $table->double('tax_per', 10, 2);
            $table->double('tax_amount', 20, 2);
            $table->bigInteger('cr_by_user_id');
            $table->bigInteger('md_by_user_id');

            $table->timestamps();


            //foreign key
            $table->foreign('stkm_trn_status_id')->references('id')->on('stkm_trn_status');
            $table->foreign('stkm_trn_setup_id')->references('id')->on('stkm_trn_setup');
            $table->foreign('cr_by_user_id')->references('id')->on('um_user');
            $table->foreign('md_by_user_id')->references('id')->on('um_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stkm_trn_out_hed');
    }
};
