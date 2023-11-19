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
        Schema::table('user_token', function (Blueprint $table) {
            $table->unique('user_session_token', 'unique_user_session_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_token', function (Blueprint $table) {
            $table->dropUnique('unique_user_session_token');
        });
    }
};
