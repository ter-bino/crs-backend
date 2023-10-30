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
            $table->foreignId('instructor_id')->constrained(
                table: 'instructor', column: 'instructor_id'
            );
            $table->string('academic_year');
            $table->integer('term');
            $table->dateTime('start_date');

            # creating composite primary key
            $table->primary(['instructor_id', 'academic_year', 'term']);

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
