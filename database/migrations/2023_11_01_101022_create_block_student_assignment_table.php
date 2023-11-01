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
        Schema::create('block_student_assignment', function (Blueprint $table) {
            $table->foreignId('block_id')->constrained(
                table: 'block', column: 'block_id'
            );
            $table->foreignId('student_id')->constrained(
                table: 'student', column: 'student_id'
            );
            
            # create composite key
            $table->primary(['block_id', 'student_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_student_assignment');
    }
};
