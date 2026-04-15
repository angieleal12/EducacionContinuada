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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('mode')->nullable();
            $table->integer('hours');
            $table->string('duration')->nullable();
            $table->text('justification');
            $table->text('general_objective')->nullable();
            $table->json('specific_objectives')->nullable();
            $table->json('topics')->nullable();
            $table->string('cost')->nullable();
            
            // --- NUEVOS CAMPOS AGREGADOS ---
            $table->string('image_url')->nullable(); 
            $table->string('pdf_document')->nullable();
            // -------------------------------

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};