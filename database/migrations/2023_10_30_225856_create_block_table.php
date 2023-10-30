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
        Schema::create('block', function (Blueprint $table) {
            $table->id('block_id');
            $table->foreignId('program_id')->constrained(
                table: 'program', column: 'program_id'
            );
            $table->string('academic_year');
            $table->integer('term');
            $table->integer('section');
            $table->integer('slots');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block');
    }
};
