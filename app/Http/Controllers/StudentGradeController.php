<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentGradeController extends Controller
{
    public function index($grade)
    {
        $students = Student::where('grade', $grade)
            ->orderBy('name')
            ->paginate(15);

        return view('students.by-grade', compact('students', 'grade'));
    }
    public function edit(Student $student)
    {
        $grade = $student->grade;   
        return view('students.edit', compact('student', 'grade'));
    }
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'code'    => 'required|string|max:50',
            'name'    => 'required|string|max:255',
            'age'     => 'nullable|integer|min:3|max:30',
            'sex'     => 'required|in:Male,Female',
            'grade'   => 'required|string',
            'section' => 'nullable|string|max:50',
        ]);

        $student->update([
            'code'    => $request->code,
            'name'    => $request->name,
            'age'     => $request->age,
            'sex'     => $request->sex,
            'grade'   => $request->grade,
            'section' => $request->section,
        ]);

        return redirect()->back()->with('success', 'កែប្រែព័ត៌មានសិស្សបានជោគជ័យ');
    }

}

