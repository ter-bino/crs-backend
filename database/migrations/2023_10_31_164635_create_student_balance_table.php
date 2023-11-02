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
        Schema::create('student_balance', function (Blueprint $table) {
            $table->id('student_balance_id');
            $table->foreignId('student_id')->constrained(
                table: 'student', column: 'student_id'
            );
            $table->string('terms_of_payment');
            $table->string('assessment_type');
            $table->string('academic_year');
            $table->integer('term');
            $table->decimal('total_amount', 12, 2);
            $table->decimal('paid_amount', 12, 2);
            $table->decimal('overall_paid', 12, 2);
            $table->decimal('overall_balance', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_balance');
    }
    
};
