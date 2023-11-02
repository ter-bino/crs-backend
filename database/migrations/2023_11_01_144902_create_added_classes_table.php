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
        Schema::create('added_classes', function (Blueprint $table) {
            $table->foreignId('add_drop_request_id')->constrained(
                table: 'add_drop_request', column: 'add_drop_request_id'
            );
            $table->foreignId('class_id')->constrained(
                table: 'class', column: 'class_id'
            );


            # create composite key
            $table->primary(['add_drop_request_id', 'class_id']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('added_classes');
    }
};
