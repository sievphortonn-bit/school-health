<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    
   public function index()
    {
        $teachers = Teacher::latest()->get();
        return view('teachers.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'sex' => 'required',
            'level' => 'required'
        ], [
            'name.required' => 'សូមបញ្ចូលឈ្មោះ',
            'age.required' => 'សូមបញ្ចូលអាយុ',
            'age.numeric' => 'អាយុត្រូវជាលេខ',
        ]);

        Teacher::create($request->all());
        return back()->with('success', 'គ្រូត្រូវបានបញ្ចូលដោយជោគជ័យ');
    }

    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        return back()->with('success', 'គ្រូត្រូវបានកែប្រែដោយជោគជ័យ');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return back()->with('success', 'គ្រូត្រូវបានលុបដោយជោគជ័យ');
    }

    public function search(Request $request)
    {
        $q = $request->q;

        return Teacher::where('name', 'like', "%{$q}%")
            ->orWhere('level', 'like', "%{$q}%")
            ->get();
    }
    // app/Http/Controllers/TeacherController.php

    public function filter(Request $request)
    {
        $level = $request->level;

        $query = Teacher::query();

        if ($level) {
            $query->where('level', $level);
        }

        return response()->json(
            $query->orderBy('name')->get()
        );
    }



}
