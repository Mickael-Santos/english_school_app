<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function studentClasses()
    {
        return $this->belongsToMany(StudentClass::class, 'student_class_students', 'student_id', 'student_class_id');
    }
}
