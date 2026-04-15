<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = [
        'title', 'category_id','mode','hours', 'duration', 'cost',
        'justification', 'general_objective', 'specific_objectives', 
        'topics', 'facultad', 'mode', 
        'image_url', 'pdf_document' // <- Aquí están los nuevos campos autorizados
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     * Esto permite que 'specific_objectives' y 'topics' funcionen como arrays de PHP.
     */
    protected $casts = [
        'specific_objectives' => 'array',
        'topics' => 'array',
    ];

    /**
     * Relación: Un curso pertenece a una categoría.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}