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
        Schema::create('class_student_assignment', function (Blueprint $table) {
            $table->foreignId('class_id')->constrained(
                table: 'class', column: 'class_id'
            );
            $table->foreignId('student_id')->constrained(
                table: 'student', column: 'student_id'
            );
            
            # create composite key
            $table->primary(['class_id', 'student_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_student_assignment');
    }
};
