<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // <-- Importante para generar la cadena de texto aleatoria

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'verification_code', // Aunque se autogenera, lo permitimos aquí por seguridad
        'doc_type',
        'doc_number',
        'student_name',
        'file_path',
    ];

    /**
     * Lógica "silenciosa" para auto-generar el código de 5 caracteres al crear
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            // Genera el código y verifica que no exista en la base de datos
            // El ciclo 'do-while' asegura que si por una extraña coincidencia se repite, intente de nuevo.
            do {
                $code = strtoupper(Str::random(5));
            } while (self::where('verification_code', $code)->exists());

            $certificate->verification_code = $code;
        });
    }

    /**
     * Relación: Un certificado pertenece a un curso
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}