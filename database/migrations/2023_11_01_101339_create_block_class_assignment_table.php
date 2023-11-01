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
        Schema::create('block_class_assignment', function (Blueprint $table) {
            $table->foreignId('block_id')->constrained(
                table: 'block', column: 'block_id'
            );
            $table->foreignId('class_id')->constrained(
                table: 'class', column: 'class_id'
            );
            
            # create composite key
            $table->primary(['block_id', 'class_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_class_assignment');
    }
};
