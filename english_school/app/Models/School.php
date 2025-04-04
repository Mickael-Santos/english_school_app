<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function customUsers()
    {
        return $this->hasMany(CustomUser::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }
}
