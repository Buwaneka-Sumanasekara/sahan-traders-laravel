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
        Schema::create('cdm_site_sliders', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('title')->default('');
            $table->text('subtitle')->nullable();
            $table->string('img_path')->default('');
            $table->boolean('active')->default(true);
            $table->integer('order')->default(0);
            $table->string('link')->nullable()->default(null);
            $table->string('link_text')->nullable()->default(null);
            $table->string('link_target')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdm_site_sliders');
    }
};
