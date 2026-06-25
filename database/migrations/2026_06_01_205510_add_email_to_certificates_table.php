<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            // Agregamos la columna email justo después del student_name
            // Le ponemos nullable() para que los certificados viejos que ya tienes 
            // no hagan colapsar la base de datos al no tener correo.
            $table->string('email')->nullable()->after('student_name');
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            // Si nos arrepentimos, esto borra solo la columna email
            $table->dropColumn('email');
        });
    }
};