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
        Schema::create('student', function (Blueprint $table) {
            $table->id('student_id');
            $table->foreignId('user_account_id')->constrained(
                table: 'user_account', column: 'user_account_id'
            );
            $table->foreignId('address_id')->constrained(
                table: 'address', column: 'address_id'
            );
            $table->string('student_no')->unique();
            $table->string('entry_academic_year');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('name_extension');
            $table->string('pedigree');
            $table->string('sex');
            $table->string('civil_status');
            $table->string('citizenship');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('contact_no')->unique();
            $table->string('personal_email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
