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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->foreignId('room_id')->constrained(
                table: 'room', column: 'room_id'
            ); 
            $table->foreignId('meeting_type_id')->constrained(
                table: 'meeting_type', column: 'meeting_type_id'
            ); 
            $table->foreignId('class_id')->constrained(
                table: 'class', column: 'class_id'
            ); 
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
