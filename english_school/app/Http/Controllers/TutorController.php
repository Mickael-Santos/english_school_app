<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    public function index()
    {
        $search = request('search');
        $searchTerm = '%' . $search . '%';

        $user = auth()->user();

        if ($search) {
            $tutors = DB::select(
                'SELECT * FROM TUTORS WHERE SCHOOL_ID = ? 
                AND (NAME LIKE ? OR IDENTIFICATION LIKE ? OR EMAIL LIKE ? OR PHONE LIKE ?)',
                [$user->school_id, $searchTerm, $searchTerm, $searchTerm, $searchTerm]
            );

            return view('tutors.dashboard', [
                'tutors' => $tutors,
                'search' => $search
            ]);
        }

        $tutors = DB::select('SELECT * FROM TUTORS WHERE SCHOOL_ID = ?', [$user->school_id]);

        return view('tutors.dashboard', [
            'tutors' => $tutors,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('tutors.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        $tutor = DB::select(    
            'SELECT * FROM TUTORS 
            WHERE (IDENTIFICATION = ? OR EMAIL = ?)  
            AND SCHOOL_ID = ?',
            [
                $request->identification,
                $request->email,
                $user->school_id
            ]);

        if(count($tutor) > 0) {
            return redirect('/tutors/create')->with('msg', 'CPF ou Email já cadastrado!');
        }

        $tutor = new Tutor;
        $tutor->name = $request->name;
        $tutor->identification = $request->identification;
        $tutor->email = $request->email;
        $tutor->phone = $request->phone;
        $tutor->school_id = $user->school_id;

        $tutor->save();

        return redirect('/tutors')->with('msg', 'Tutor cadastrado com sucesso!');
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

        return redirect('/tutors')->with('msg', 'Tutor atualizado com sucesso!');
    }

    public function delete($id)
    {
        $tutor = Tutor::findOrFail($id);

        return view('tutors.delete', ['tutor' => $tutor]);;
    }

    public function destroy($id)
    {
        $tutor = Tutor::findOrFail($id);

        $studentClasses = DB::select('SELECT * FROM STUDENT_CLASSES WHERE TUTOR_ID = ?', [$id]);

        if(count($studentClasses) > 0) {
            return redirect('/tutors')->with('msg', 'Tutor não pode ser excluído, pois possui turmas associadas!');
        }

        $tutor->delete();

        return redirect('/tutors')->with('msg', 'Tutor excluído com sucesso!');
    }

    public function show($id)
    {
        $tutor = Tutor::findOrFail($id);

        

        return view('tutors.show', ['tutor' => $tutor]);
    }
}
