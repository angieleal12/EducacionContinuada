<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            
            // Relación con el curso
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            
            // 1. Identificación y Demografía (Paso 1)
            $table->string('full_name');
            $table->string('doc_type');
            $table->string('doc_number');
            $table->string('birth_place'); // NUEVO: Lugar de nacimiento (Cascada)
            $table->date('birth_date');
            $table->integer('age');
            $table->string('expedition_place');
            $table->date('expedition_date');
            $table->string('gender');
            $table->string('blood_type');
            
            // 2. Contacto y ubicación (Paso 1)
            $table->string('city'); // Residencia (Cascada)
            $table->string('address');
            $table->string('personal_email');
            $table->string('institutional_email')->nullable(); // Ahora se llena en el Paso 2
            $table->string('phone_number');
            
            // 3. Horario Seleccionado (Paso 3)
            $table->string('schedule')->nullable(); // NUEVO: Guarda el horario que elija
            
            // 4. Archivos Adjuntos (Paso 1 y Paso 3)
            $table->string('id_document_path'); // Cédula (Obligatorio)
            $table->string('approval_document_path')->nullable(); // Aval Opción de Grado (Opcional)
            
            // 5. La Bóveda Dinámica para todo lo extra del Paso 2 (Títulos, estudiante UT, etc.)
            $table->json('extra_details')->nullable(); 
            
            // Estado de la inscripción
            $table->enum('status', ['Pendiente', 'Aprobado', 'Rechazado'])->default('Pendiente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};