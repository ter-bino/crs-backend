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
        Schema::table('add_drop_request', function (Blueprint $table) {
            $table->foreignId('student_id')->after('add_drop_request_id')->constrained(
                'student', 'student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_drop_request', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
        });
    }
};
