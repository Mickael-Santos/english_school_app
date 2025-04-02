<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function index()
    {
        return view('student_class.dashboard');
    }
}
