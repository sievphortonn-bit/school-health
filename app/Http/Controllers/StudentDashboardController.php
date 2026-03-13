<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentDashboardController extends Controller
{
   public function index()
{
    $grades = [
        'មតេយ្យ',
        '១ ក','១ ខ',
        '២ ក','២ ខ',
        '៣ ក','៣ ខ',
        '៤ ក','៤ ខ',
        '៥ ក','៥ ខ',
        '៦ ក','៦ ខ',
        '៧ ក','៧ ខ',
        '៨ ក','៨ ខ',
        '៩ ក','៩ ខ',
        '១០ ក','១០ ខ',
        '១១ ក','១១ ខ',
        '១២ ក','១២ ខ',
    ];
    $totalStudents = Student::count();

    // ✅ ONE DATABASE QUERY
    $studentCounts = Student::selectRaw('grade, COUNT(*) as total')
        ->groupBy('grade')
        ->pluck('total', 'grade'); 
        // Result example:
        // ['១ ក' => 32, '២ ខ' => 28, ...]

    return view('students.all', compact('grades', 'studentCounts', 'totalStudents'));
}


}