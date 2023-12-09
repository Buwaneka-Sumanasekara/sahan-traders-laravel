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
        Schema::create('cm_cart_pay', function (Blueprint $table) {
            $table->integer('id');
            $table->string('cm_cart_hed_id', 100);
            $table->double('frg_amount', 20, 2);
            $table->double('paid_amount', 20, 2);
            $table->double('balance_amount', 20, 2);
            $table->string('ref_no', 200);

            $table->string('cdm_pay_hed_id', 5);
            $table->string('cdm_pay_det_id', 5);
            $table->integer('cm_cart_pay_status_id');

            $table->timestamps();

            $table->primary(['id', 'cm_cart_hed_id']);

            //foreign key
            $table->foreign('cm_cart_hed_id')->references('id')->on('cm_cart_hed');
            $table->foreign('cdm_pay_hed_id')->references('id')->on('cdm_pay_hed');
            $table->foreign('cdm_pay_det_id')->references('id')->on('cdm_pay_det');
            $table->foreign('cm_cart_pay_status_id')->references('id')->on('cm_cart_pay_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cm_cart_pay');
    }
};
