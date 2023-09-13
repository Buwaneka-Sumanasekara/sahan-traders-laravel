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
        Schema::create('sm_user_login', function (Blueprint $table) {
            $table->string('username', 150)->primary()->unique();
            $table->string('password', 255);
            $table->bigInteger('um_user_id');
            $table->foreign('um_user_id')->references('id')->on('um_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_user_login');
    }
};
