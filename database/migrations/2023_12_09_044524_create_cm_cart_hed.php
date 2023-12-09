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
        Schema::create('cm_cart_hed', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->double('gross_amount', 20, 2);
            $table->double('dis_per', 10, 2);
            $table->double('net_amount', 20, 2);
            $table->dateTimeTz('trn_date', $precision = 0);
            $table->integer('stkm_trn_status_id');
            $table->string('stkm_trn_setup_id', 10);
            $table->string('trn_ref_no', 100);
            $table->bigInteger('bm_buyer_id');
            $table->double('tax_per', 10, 2);
            $table->double('shipping_cost', 20, 2);
            $table->integer('ship_address_id');
            $table->integer('bill_address_id');
            $table->integer('cm_cart_status_id');
            $table->string('tracking_no', 200);

            $table->timestamps();


            //foreign key
            $table->foreign('stkm_trn_status_id')->references('id')->on('stkm_trn_status');
            $table->foreign('stkm_trn_setup_id')->references('id')->on('stkm_trn_setup');
            $table->foreign('bm_buyer_id')->references('id')->on('bm_buyer');
            $table->foreign('ship_address_id')->references('id')->on('cm_cart_addresses');
            $table->foreign('bill_address_id')->references('id')->on('cm_cart_addresses');
            $table->foreign('cm_cart_status_id')->references('id')->on('cm_cart_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cm_cart_hed');
    }
};
