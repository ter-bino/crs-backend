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
        Schema::create('teaching_assignment', function (Blueprint $table) {
            $table->id('teaching_assignment_id');
            $table->foreignId('instructor_id')->constrained(
                table: 'instructor', column: 'instructor_id'
            );
            $table->foreignId('consultation_hour_id')->constrained(
                table: 'consultation_hour', column: 'consultation_hour_id'
            );
            $table->string('academic_year');
            $table->integer('term');
            $table->dateTime('start_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_assignment');
    }
};
