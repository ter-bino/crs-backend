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
        Schema::create('enrollment_fee', function (Blueprint $table) {
            $table->id('enrollment_fee_id');
            $table->string('enrollment_fee_type');
            $table->string('enrollment_fee_name');
            $table->decimal('cost', 12, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_fee');
    }
};
