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
        Schema::create('add_drop_request', function (Blueprint $table) {
            $table->id('add_drop_request_id'); 
            $table->foreignId('approved_by')->constrained(
                table: 'staff', column: 'staff_id'
            );
            $table->date('request_date');
            $table->integer('total_units');
            $table->text('reason');
            $table->string('status');  // pending, approved, or rejected -> default = pending
            $table->date('approved_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_drop_request');
    }
};
