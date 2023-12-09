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
        Schema::create('cm_cart_process_history', function (Blueprint $table) {
            $table->id();
            $table->string('cm_cart_hed_id', 100);
            $table->integer('cm_cart_status_id');
            $table->string('ref_no', 100);
            $table->mediumText('note');
            $table->timestamps();

            $table->foreign('cm_cart_hed_id')->references('id')->on('cm_cart_hed');
            $table->foreign('cm_cart_status_id')->references('id')->on('cm_cart_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cm_cart_process_history');
    }
};
