<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $search = request('search');
        $searchTerm = '%' . $search . '%';

        $user = auth()->user();

        if ($search) {
            $students = DB::select(
                'SELECT * FROM STUDENTS WHERE SCHOOL_ID = ? 
                AND (NAME LIKE ? OR IDENTIFICATION LIKE ? OR EMAIL LIKE ? OR PHONE LIKE ? OR CAST(REGISTRATION_NUMBER AS TEXT) LIKE ?)',
                [$user->school_id, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]
            );

            return view('students.dashboard', [
                'students' => $students,
                'search' => $search
            ]);
        }

        $students = DB::select('SELECT * FROM STUDENTS WHERE SCHOOL_ID = ?', [$user->school_id]);

        return view('students.dashboard', [
            'students' => $students,
            'search' => $search
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

        do
        {
            $ramdomNumber = mt_rand(100000, 999999);
            $exist = Student::where('registration_number', $student->registration_number)
            ->where('school_id', $user->school_id)
            ->exists();
            
        }while($exist);

        $student->registration_number = $ramdomNumber;

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
