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
        Schema::table('workspace_list', function (Blueprint $table) {
            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('workSpaceID')->references('id')->on('workspaces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspace_list');
    }
};
