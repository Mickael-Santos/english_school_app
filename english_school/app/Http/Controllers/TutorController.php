<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    public function index()
    {

        $tutors = DB::select('SELECT * FROM TUTORS');

        return view('tutors.dashboard', [
            'tutors' => $tutors
        ]);
    }

    public function create()
    {
        return view('tutors.create');
    }

    public function store(Request $request)
    {
        $tutor = DB::select('SELECT * FROM TUTORS WHERE IDENTIFICATION = ? OR EMAIL = ?',
            [$request->identification, $request->email]);

        if(count($tutor) > 0) {
            return redirect('/tutors/create')->with('msg', 'CPF ou Email já cadastrado!');
        }

        $tutor = new Tutor;
        $tutor->name = $request->name;
        $tutor->identification = $request->identification;
        $tutor->email = $request->email;
        $tutor->phone = $request->phone;

        $tutor->save();

        return redirect('/tutors')->with('msg', 'Professor cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $tutor = Tutor::findOrFail($id);

        return view('tutors.edit', ['tutor' => $tutor]);
    }

    public function update(Request $request)
    {
        $tutor = Tutor::findOrFail($request->id);

        $tutor->name = $request->name;
        $tutor->identification = $request->identification;
        $tutor->email = $request->email;
        $tutor->phone = $request->phone;

        $tutor->save();

        return redirect('/tutors')->with('msg', 'Professor atualizado com sucesso!');
    }
}
