<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'mode',
        'hours',
        'duration',
        'justification',
        'general_objective',
        'specific_objectives',
        'topics',
        'cost',
        'image_url',
        'pdf_document',
        'schedules', // Permite guardar los horarios en la base de datos
    ];

    // Esto es vital para que Laravel maneje tus campos JSON correctamente
    protected $casts = [
        'specific_objectives' => 'array',
        'topics' => 'array',
        'schedules' => 'array', // Transforma el arreglo a JSON automáticamente
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}