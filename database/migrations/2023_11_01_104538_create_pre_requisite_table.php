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
        Schema::create('pre_requisite', function (Blueprint $table) {
            $table->foreignId('subject_id')->constrained(
                table: 'subject', column: 'subject_id'
            );
            $table->foreignId('pre_requisite_subject_id')->constrained(
                table: 'subject', column: 'subject_id'
            );

            # creating composite key
            $table->primary(['subject_id', 'pre_requisite_subject_id']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_requisite');
    }
};
