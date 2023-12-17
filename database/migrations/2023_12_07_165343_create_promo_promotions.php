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
        Schema::create('promo_promotions', function (Blueprint $table) {
            $table->string('id',100)->primary();
            $table->string('name', 45);
            $table->text('note')->nullable();
            $table->dateTimeTz('start_date', $precision = 0);
            $table->dateTimeTz('end_date', $precision = 0);
            $table->integer('promo_promotion_type_id');
            $table->boolean('active')->default(true);
            $table->integer('priority_order');

            $table->string('group_id', 10)->nullable();
            $table->integer('group_level')->nullable();

            $table->foreign('promo_promotion_type_id')->references('id')->on('promo_promotion_type');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_promotions');
    }
};
