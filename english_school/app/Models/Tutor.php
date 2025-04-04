<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }
}
