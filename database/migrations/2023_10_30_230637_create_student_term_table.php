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
        Schema::create('student_term', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained(
                table: 'student', column: 'student_id'
            );
            $table->foreignId('program_id')->constrained(
                table: 'program', column: 'program_id'
            );
            $table->string('academic_year');
            $table->integer('term');
            $table->foreignId('college_id')->constrained(
                table: 'college', column: 'college_id'
            );
            $table->foreignId('block_id')->constrained(
                table: 'block', column: 'block_id'
            );
            $table->foreignId('enrollment_status_id')->constrained(
                table: 'enrollment_status', column: 'enrollment_status_id'
            );
            $table->integer('year_level');
            $table->string('student_type'); # Old, New, Returnee, Transferee, Shifter
            $table->string('registration_code'); # Regular Irregular
            $table->string('scholastic_status'); # PAYING
            $table->boolean('is_graduating');


            # creating the composite primary key
            $table->primary(['student_id', 'program_id', 'academic_year', 'term']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_term');
    }
};
