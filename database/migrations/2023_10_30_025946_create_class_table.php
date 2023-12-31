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
        Schema::create('class', function (Blueprint $table) {
            $table->id('class_id');
            $table->foreignId('subject_id')->constrained(
                table: 'subject', column: 'subject_id'
            );
            $table->string('academic_year');
            $table->integer('term');
            $table->integer('minimum_year_level');
            $table->integer('section');
            $table->integer('slots');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('active_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class');
    }
};
