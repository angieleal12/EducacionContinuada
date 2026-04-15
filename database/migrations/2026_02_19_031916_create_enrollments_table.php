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
    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();
        // Relación con el curso (si el curso se borra, la inscripción también)
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->string('student_name');
        $table->string('student_email');
        $table->enum('academic_level', ['pregrado', 'posgrado']);
        $table->string('phone');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};