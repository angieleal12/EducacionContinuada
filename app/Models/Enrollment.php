<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['course_id', 'student_name', 'student_email', 'academic_level', 'phone'];

public function course()
{
    return $this->belongsTo(Course::class);
}
}