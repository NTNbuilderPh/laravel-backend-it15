<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('birthdate');
            $table->string('address');
            $table->string('province')->default('Davao del Norte');
            $table->string('city');
            $table->string('year_level');
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->date('enrollment_date');
            $table->string('status')->default('Enrolled');
            $table->string('school_year')->default('2025-2026');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
