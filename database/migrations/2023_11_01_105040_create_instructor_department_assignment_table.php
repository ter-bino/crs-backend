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
        Schema::create('instructor_department_assignment', function (Blueprint $table) {
            $table->foreignId('instructor_id')->constrained(
                table: 'instructor', column: 'instructor_id'
            );
            $table->foreignId('department_id')->constrained(
                table: 'department', column: 'department_id'
            );

            # create composite key
            $table->primary(['instructor_id', 'department_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_department_assignment');
    }
};
