<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'full_name',
        'doc_type',
        'doc_number',
        'birth_place',
        'birth_date',
        'age',
        'expedition_place',
        'expedition_date',
        'gender',
        'blood_type',
        'city',
        'address',
        'personal_email',
        'institutional_email',
        'phone_number',
        'schedule',
        'id_document_path',
        'approval_document_path',
        'extra_details',
        'status'
    ];

    protected $casts = [
        'extra_details' => 'array',
        'expedition_date' => 'date',
        'birth_date' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}