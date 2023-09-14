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
        Schema::create('um_user_role_has_sm_permissions', function (Blueprint $table) {
            $table->integer('um_user_role_id');
            $table->string('sm_permissions_id', 5);
            $table->foreign('sm_permissions_id')->references('id')->on('sm_permissions');
            $table->foreign('um_user_role_id')->references('id')->on('um_user_role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('um_user_role_has_sm_permissions');
    }
};
