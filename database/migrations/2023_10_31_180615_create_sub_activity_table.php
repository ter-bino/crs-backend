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
        Schema::create('sub_activity', function (Blueprint $table) {
            $table->id('sub_activity_id');
            $table->foreignId('activity_id')->constrained(
                table: 'activity', column: 'activity_id'
            );
            $table->string('sub_activity_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_activity');
    }
};
