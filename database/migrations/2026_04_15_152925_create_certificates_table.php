<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            
            // Relación con el curso (Si se borra el curso, se borran sus certificados en cascada)
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            
            // El código de verificación único de exactamente 5 caracteres
            $table->string('verification_code', 5)->unique();
            
            // Datos del estudiante
            $table->string('doc_type');
            $table->string('doc_number');
            $table->string('student_name');
            // Ruta donde guardaremos el PDF de forma privada
            $table->string('file_path');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
    
};