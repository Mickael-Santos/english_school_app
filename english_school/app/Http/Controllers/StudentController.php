<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $students = DB::select('SELECT * FROM STUDENTS WHERE SCHOOL_ID = ?', [$user->school_id]);

        return view('students.dashboard', [
            'students' => $students
        ]);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        $student = DB::select(    
            'SELECT * FROM STUDENTS 
            WHERE (IDENTIFICATION = ? OR EMAIL = ?)  
            AND SCHOOL_ID = ?',
            [
                $request->identification,
                $request->email,
                $user->school_id
            ]);

        if (count($student) > 0) {
            return redirect('/students/create')->with('msg', 'CPF ou Email já cadastrado!');
        }

        $student = new Student;
        $student->name = $request->name;
        $student->identification = $request->identification;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->school_id = $user->school_id;

        $student->save();

        return redirect('/students')->with('msg', 'Estudante cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return view('students.edit', ['student' => $student]);
    }

    public function update(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $student->name = $request->name;
        $student->identification = $request->identification;
        $student->email = $request->email;
        $student->phone = $request->phone;
    
        $student->save();

        return redirect('/students')->with('msg', 'Estudante atualizado com sucesso!');
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);

        return view('students.delete', ['student' => $student]);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return redirect('/students')->with('msg', 'Estudante excluído com sucesso!');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('students.show', ['student' => $student]);
    }
}
