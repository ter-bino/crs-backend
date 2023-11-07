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
        Schema::table('class', function (Blueprint $table) {
            $table->foreignId('instuction_language_id')->after('subject_id')->constrained(
                table: 'instruction_language', column: 'instruction_language_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class', function (Blueprint $table) {
            $table->dropForeign(['instuction_language_id']);
            $table->dropColumn('instuction_language_id');
        });
    }
};
