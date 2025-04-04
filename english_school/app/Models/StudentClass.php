<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_class_students', 'student_class_id', 'student_id');
    }
}
