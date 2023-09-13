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
        Schema::create('sm_permissions', function (Blueprint $table) {
            $table->string('id', 5)->primary()->unique();
            $table->string('name', 150);
            $table->string('parent_id', 5)->nullable();
        });

        Schema::table('sm_permissions', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('sm_permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_permissions');
    }
};
