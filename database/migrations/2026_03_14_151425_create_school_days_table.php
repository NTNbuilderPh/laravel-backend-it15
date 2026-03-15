<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_days', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('day_type'); // regular, holiday, event, exam, no-class
            $table->integer('attendance_count')->default(0);
            $table->string('remarks')->nullable();
            $table->string('school_year')->default('2025-2026');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_days');
    }
};
