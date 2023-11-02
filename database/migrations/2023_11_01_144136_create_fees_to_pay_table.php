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
        Schema::create('fees_to_pay', function (Blueprint $table) {
            $table->foreignId('student_balance_id')->constrained(
                table: 'student_balance', column: 'student_balance_id'
            );
            $table->foreignId('enrollment_fee_id')->constrained(
                table: 'enrollment_fee', column: 'enrollment_fee_id'
            );

            # create composite key
            $table->primary(['student_balance_id', 'enrollment_fee_id']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_to_pay');
    }
};
