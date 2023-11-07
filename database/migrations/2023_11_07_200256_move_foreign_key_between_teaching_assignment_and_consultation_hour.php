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
        Schema::table('teaching_assignment', function (Blueprint $table) {
            $table->dropForeign(['consultation_hour_id']);
            $table->dropColumn('consultation_hour_id');
        });
        Schema::table('consultation_hour', function (Blueprint $table) {
            $table->foreignId('teaching_assignment_id')->after('consultation_hour_id')
                ->constrained('teaching_assignment', 'teaching_assignment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultation_hour', function (Blueprint $table) {
            $table->dropForeign(['teaching_assignment_id']);
            $table->dropColumn('teaching_assignment_id');
        });
        Schema::table('teaching_assignment', function (Blueprint $table) {
            $table->foreignId('consultation_hour_id')->after('instructor_id')
                ->constrained('consultation_hour', 'consultation_hour_id');
        });
    }
};
