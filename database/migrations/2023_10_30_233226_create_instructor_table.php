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
        Schema::create('instructor', function (Blueprint $table) {
            $table->id('instructor_id');
            $table->foreignId('staff_id')->constrained(
                table: 'staff', column: 'staff_id'
            );
            $table->string('instructor_code')->unique();
            $table->string('teaching_position');
            $table->string('employment_type'); # part time, full time
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor');
    }
};
