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
        Schema::create('faculty_class_assignment', function (Blueprint $table) {
            $table->foreignId('teaching_assignment_id')->constrained(
                table: 'teaching_assignment', column: 'teaching_assignment_id'
            );
            $table->foreignId('class_id')->constrained(
                table: 'class', column: 'class_id'
            );
            $table->foreignId('load_type_id')->constrained(
                table: 'load_type', column: 'load_type_id'
            );

            # creating composite key
            $table->primary(['teaching_assignment_id', 'class_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_class_assignment');
    }
};
