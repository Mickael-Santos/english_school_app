<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;

class StudentClassController extends Controller
{
    public function index()
    {
        $search = request('search');
        $searchTerm = '%' . $search . '%';

        $user = auth()->user();

        if ($search) {
            $studentClasses = DB::select(
                'SELECT * FROM STUDENT_CLASSES WHERE SCHOOL_ID = ? 
                AND (TITLE LIKE ? OR DESCRIPTION LIKE ?)',
                [$user->school_id, $searchTerm, $searchTerm]
            );

            return view('student_classes.dashboard', [
                'studentClasses' => $studentClasses,
                'search' => $search
            ]);
        }

        $studentClasses = DB::select('SELECT * FROM STUDENT_CLASSES WHERE SCHOOL_ID = ?', [$user->school_id]);

        return view('student_classes.dashboard', [
            'studentClasses' => $studentClasses,
            'search' => $search
        ]);
    }

    public function create()
    {
        $user = auth()->user();
        $tutors = DB::select('SELECT * FROM TUTORS WHERE SCHOOL_ID = ?', [$user->school_id]);

        return view('student_classes.create', [
            'tutors' => $tutors
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $studentClass = DB::select(    
            'SELECT * FROM STUDENT_CLASSES 
            WHERE TITLE = ? AND SCHOOL_ID = ?',
            [
                $request->title,
                $user->school_id
            ]);

        if (count($studentClass) > 0) {
            return redirect('/student_classes/create')->with('msg', 'Turma já cadastrada!');
        }

        $studentClass = new StudentClass;
        $studentClass->title = $request->title;
        $studentClass->description = $request->description;
        $studentClass->tutor_id = $request->tutor_id;
        $studentClass->start_date = $request->start_date;
        $studentClass->end_date = $request->end_date;
        $studentClass->school_id = $user->school_id;

        $studentClass->save();

        return redirect('/student_classes')->with('msg', 'Turma cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $studentClass = StudentClass::findOrFail($id);

        // Obter todos os tutores da escola
        $tutors = DB::select('SELECT * FROM tutors WHERE school_id = ?', [auth()->user()->school_id]);

        // Obter o tutor selecionado como um objeto
        $selectedTutor = DB::table('tutors')
            ->where('id', $studentClass->tutor_id)
            ->where('school_id', auth()->user()->school_id)
            ->first();

        return view('student_classes.edit', [
            'studentClass' => $studentClass,
            'selectedTutor' => $selectedTutor,
            'tutors' => $tutors
        ]);
    }

    public function update(Request $request)
    {
        $studentClass = StudentClass::findOrFail($request->id);

        $studentClass->title = $request->title;
        $studentClass->description = $request->description;
        $studentClass->tutor_id = $request->tutor_id;
        $studentClass->start_date = $request->start_date;
        $studentClass->end_date = $request->end_date;
    
        $studentClass->save();

        return redirect('/student_classes')->with('msg', 'Turma atualizada com sucesso!');
    }

    public function delete($id)
    {
        $studentClass = StudentClass::findOrFail($id);

        return view('student_classes.delete', ['studentClass' => $studentClass]);
    }

    public function destroy($id)
    {
        $studentClass = StudentClass::findOrFail($id);

        $studentsInClass = DB::select('SELECT STUDENTS.* FROM STUDENTS
        INNER JOIN STUDENT_CLASS_STUDENTS ON STUDENTS.ID = STUDENT_CLASS_STUDENTS.STUDENT_ID
        WHERE STUDENT_CLASS_STUDENTS.STUDENT_CLASS_ID = ?', [$id]);

        if(count($studentsInClass) > 0) {
            return redirect('/student_classes')->with('msg', 'Não é possível excluir a turma, pois existem alunos vinculados a ela!');
        }

        $studentClass->delete();

        return redirect('/student_classes')->with('msg', 'Classe excluída com sucesso!');
    }

    public function show($id)
    {
        $studentClass = StudentClass::findOrFail($id);

        $students = DB::select('SELECT * FROM STUDENTS WHERE SCHOOL_ID = ?', [auth()->user()->school_id]);

        $studentsInClass = DB::select('SELECT STUDENTS.* FROM STUDENTS
        INNER JOIN STUDENT_CLASS_STUDENTS ON STUDENTS.ID = STUDENT_CLASS_STUDENTS.STUDENT_ID
        WHERE STUDENT_CLASS_STUDENTS.STUDENT_CLASS_ID = ?', [$id]);

        $studentsNotInClass = DB::select('SELECT * FROM STUDENTS 
        WHERE SCHOOL_ID = ?
        AND ID NOT IN (
        SELECT STUDENTS.ID FROM STUDENT_CLASS_STUDENTS
        WHERE STUDENT_CLASS_STUDENTS.STUDENT_CLASS_ID = ?)', [auth()->user()->school_id, $id]);

        return view('student_classes.show', [
            'studentClass' => $studentClass,
            'studentsInClass' => $studentsInClass,
            'studentsNotInClass' => $studentsNotInClass
        ]);
    }

    public function addStudent(Request $request, $id)
    {
        $studentClass = StudentClass::findOrFail($id);
        $studentId = $request->student_id;

        $studentClass->students()->attach($studentId);


        $studentsInClass = DB::select('SELECT STUDENTS.* FROM STUDENTS
        INNER JOIN STUDENT_CLASS_STUDENTS ON STUDENTS.ID = STUDENT_CLASS_STUDENTS.STUDENT_ID
        WHERE STUDENT_CLASS_STUDENTS.STUDENT_CLASS_ID = ?', [$id]);

        $studentsNotInClass = DB::select('SELECT * FROM STUDENTS 
        WHERE SCHOOL_ID = ?
        AND ID NOT IN (
        SELECT STUDENTS.ID FROM STUDENT_CLASS_STUDENTS
        WHERE STUDENT_CLASS_STUDENTS.STUDENT_CLASS_ID = ?)', [auth()->user()->school_id, $id]);
        

        return view('student_classes.show', [
            'studentClass' => $studentClass,
            'studentsInClass' => $studentsInClass,
            'studentsNotInClass' => $studentsNotInClass
        ]);
    }

    public function removeStudent($id, $studentId)
    {
        $studentClass = StudentClass::findOrFail($id);

        $studentClass->students()->detach($studentId);
        $studentClass->save();

        $studentsInClass = DB::select('SELECT STUDENTS.* FROM STUDENTS
        INNER JOIN STUDENT_CLASS_STUDENTS ON STUDENTS.ID = STUDENT_CLASS_STUDENTS.STUDENT_ID
        WHERE STUDENT_CLASS_STUDENTS.STUDENT_CLASS_ID = ?', [$id]);

        $studentsNotInClass = DB::select('SELECT * FROM STUDENTS 
        WHERE SCHOOL_ID = ?
        AND ID NOT IN (
        SELECT STUDENTS.ID FROM STUDENT_CLASS_STUDENTS
        WHERE STUDENT_CLASS_STUDENTS.STUDENT_CLASS_ID = ?)', [auth()->user()->school_id, $id]);

        return view('student_classes.show', [
            'studentClass' => $studentClass,
            'studentsInClass' => $studentsInClass,
            'studentsNotInClass' => $studentsNotInClass
        ]);
    }
}
