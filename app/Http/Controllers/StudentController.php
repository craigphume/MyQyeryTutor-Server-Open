<?php

namespace App\Http\Controllers;

use App\Result;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function show($id) {
        $student = Student::findOrFail($id);

        if($student->classroom->school_id != Auth::user()->school_id)
        {
            abort(404);
        }

        $results = Result::where('student_id', $id)->paginate(20);

        return view('teacher.student.show', compact('student', 'results'));
    }
}
