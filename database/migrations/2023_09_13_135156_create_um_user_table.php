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
        Schema::create('um_user', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->integer('um_user_status_id');
            $table->integer('um_user_role_id');
            $table->foreign('um_user_status_id')->references('id')->on('um_user_status');
            $table->foreign('um_user_role_id')->references('id')->on('um_user_role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('um_user');
    }
};
