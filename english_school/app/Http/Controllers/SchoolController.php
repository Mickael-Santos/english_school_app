<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\School;
use \App\Models\CustomUser;

class SchoolController extends Controller
{
    public function register()
    {
        $user = session('user');

        if (!$user) {
            return redirect('/register');
        }

        return view('school.register', [
            'user' => $user
        ]);
    }

    public function store(Request $request, $userId)
    {
        $school = new School();

        $school->name = $request->input('name');
        $school->email = $request->input('email');
        $school->identification = $request->input('identification');

        $school->save();

        $user = CustomUser::findOrFail($userId);
        $user->school_id = $school->id;

        $user->save();

        return redirect('/login')->with('msg', 'Escola cadastrada com sucesso! Você já pode fazer login!');
    }
}
