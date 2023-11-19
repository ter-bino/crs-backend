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
        Schema::table('user_account', function (Blueprint $table) {
            $table->dropColumn('user_password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_account', function (Blueprint $table) {
            $table->string('user_password', 255)->after('plm_email_address')->nullable();
        });
    }
};
