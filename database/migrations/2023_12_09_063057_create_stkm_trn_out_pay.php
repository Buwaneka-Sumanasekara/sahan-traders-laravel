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
        Schema::create('stkm_trn_out_pay', function (Blueprint $table) {
            $table->integer('id');
            $table->string('stkm_trn_out_hed_id', 100);
            $table->double('frg_amount', 20, 2);
            $table->double('paid_amount', 20, 2);
            $table->double('balance_amount', 20, 2);
            $table->string('ref_no', 200);

            $table->string('cdm_pay_hed_id', 5);
            $table->string('cdm_pay_det_id', 5);
            $table->bigInteger('cr_by_user_id');
            $table->bigInteger('md_by_user_id');

            $table->timestamps();

            $table->primary(['id', 'stkm_trn_out_hed_id']);

            //foreign key
            $table->foreign('stkm_trn_out_hed_id')->references('id')->on('stkm_trn_out_hed');
            $table->foreign('cdm_pay_hed_id')->references('id')->on('cdm_pay_hed');
            $table->foreign('cdm_pay_det_id')->references('id')->on('cdm_pay_det');
            $table->foreign('cr_by_user_id')->references('id')->on('um_user');
            $table->foreign('md_by_user_id')->references('id')->on('um_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stkm_trn_out_pay');
    }
};
