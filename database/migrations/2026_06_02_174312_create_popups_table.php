<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nombre interno de la campaña
            $table->string('image_path'); // Ruta de la imagen guardada
            $table->string('link')->nullable(); // URL de redirección al hacer clic (opcional)
            $table->boolean('is_active')->default(false); // Estado: encendido o apagado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('popups');
    }
};