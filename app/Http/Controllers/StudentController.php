<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'age'  => 'required|numeric',
            'sex'  => 'required',
            'grade'=> 'required',
        ], [
            'code.required' => 'សូមបញ្ចូលអត្តលេខ',
            'name.required' => 'សូមបញ្ចូលឈ្មោះ',
            'age.required'  => 'សូមបញ្ចូលអាយុ',
            'age.numeric'   => 'អាយុត្រូវជាលេខ',
            'sex.required'  => 'សូមជ្រើសភេទ',
            'grade.required'=> 'សូមជ្រើសថ្នាក់',
        ]);


        Student::create($request->all());

        return redirect()->back()->with('success', 'បន្ថែមសិស្សថ្មីដោយជោគជ័យ');
    }

    public function show(Student $student)
    {
        return response()->json($student);
    }

   public function update(Request $request, Student $student)
    {
        $request->validate([
            'code' => 'required|unique:students,code,' . $student->id,
            'name' => 'required',
            'age' => 'required|numeric',
            'sex' => 'required',
            'grade' => 'required',
            'section' => 'nullable'
        ], [
            'code.required' => 'សូមបញ្ចូលអត្តលេខ',
            'code.unique' => 'អត្តលេខនេះបានប្រើរួចហើយ',
            'name.required' => 'សូមបញ្ចូលឈ្មោះ',
            'age.required' => 'សូមបញ្ចូលអាយុ',
            'age.numeric' => 'អាយុត្រូវជាលេខ',
        ]);

        $student->update($request->all());

        return redirect()->back()->with('success', 'បានកែប្រែសិស្សដោយជោគជ័យ');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'បានលុបសិស្សដោយជោគជ័យ');
    }
    public function search(Request $request)
    {
        $q = $request->q;

        $students = Student::where('name', 'like', "%{$q}%")
            ->orWhere('code', 'like', "%{$q}%")
            ->orWhere('grade', 'like', "%{$q}%")
            ->get();

        return response()->json($students);
    }


}
