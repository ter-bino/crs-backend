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
        Schema::create('payment_transaction', function (Blueprint $table) {
            $table->id('payment_transaction_id');
            $table->foreignId('student_balance_id')->constrained(
                table: 'student_balance', column: 'student_balance_id'
            ); 
            $table->string('payment_order');
            $table->string('payment_method'); // Cash or Cashless
            $table->string('payment_status'); //paid or unpaid
            $table->decimal('amount', 12, 2);
            $table->decimal('excess_amount', 12, 2)->nullable();
            $table->string('or_number');
            $table->string('code');
            $table->text('remark')->nullable();
            $table->timestamp('time');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transaction');
    }
};
