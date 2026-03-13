<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientHistory;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    // 📄 Patient list
    // public function index()
    // {
    //      $students = Student::select('id','code','name','age','sex','grade')->get();
    //     $teachers = Teacher::select('id','name','age','sex','level')->get();
    //     $staffs = Staff::select('id','code','name','role')->get();

    //     $patients = Patient::latest()->get();
    //     return view('patients.index', compact('patients','students','teachers', 'staffs'));
    // }
    public function index(Request $request)
    {
        $query = Patient::query();

        // 🔍 Search by name
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        // // 🧍 Filter by type
        // if ($request->filled('type')) {
        //     $query->where('patient_type', $request->type);
        // }

        // // 🎓 Filter by grade / level
        // if ($request->filled('grade')) {
        //     $query->where('grade_or_level', $request->grade);
        // }

        $patients = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // ⭐ important

        // for filter dropdowns
        $grades = Patient::whereNotNull('grade_or_level')
            ->distinct()
            ->pluck('grade_or_level');
        $grades = Student::distinct()->orderBy('grade')->pluck('grade');
$levels = Teacher::distinct()->orderBy('level')->pluck('level');

        $students = Student::select('id','code','name','age','sex','grade')->get();
        $teachers = Teacher::select('id','name','age','sex','level')->get();
        $staffs = Staff::select('id','code','name','role')->get();  

        return view('patients.index', compact('patients', 'grades', 'levels', 'students', 'teachers', 'staffs'));
    }
    public function ajax(Request $request)
    {
        $query = Patient::query();

        // ✅ Filter by type ONLY if provided
        if ($request->filled('type')) {
            $query->where('patient_type', $request->type);
        }

        // ✅ Filter by grade / level ONLY if provided
        if ($request->filled('grade')) {
            $query->where('grade_or_level', $request->grade);
        }

        // ✅ IMPORTANT: always return data
        $patients = $query->latest()->paginate(10);

        return response()->json([
            'tbody' => view('patients.partials.tbody', compact('patients'))->render(),
            'pagination' => $patients->links('pagination::bootstrap-5')->render(),
        ]);
    }


    // 👁 Patient view (details + ALL history)
    // ➕ Add form

    public function create()
    {
        $students = Student::select(
            'id', 'code', 'name', 'age', 'sex', 'grade'
        )->get();

        $teachers = Teacher::select(
            'id', 'name', 'age', 'sex', 'level'
        )->get();

        $staffs = Staff::select(
            'id', 'code', 'name', 'role'
        )->get();

        return view('patients.create', compact('students', 'teachers', 'staffs'));
    }

// 💾 Store new patient
    public function store(Request $request)
    {
        $request->validate([
            'patient_type' => 'required|in:student,teacher',
            'ref_id'       => 'required',
            'complaint'    => 'required',   // 🔥 first history required
        ]);

        DB::transaction(function () use ($request) {

            // 1️⃣ CREATE PATIENT FROM STUDENT / TEACHER
            if ($request->patient_type === 'student') {
                $student = Student::findOrFail($request->ref_id);

                $patient = Patient::create([
                    'patient_type'    => 'student',
                    'ref_id'          => $student->id,
                    'name'            => $student->name,
                    'age'             => $student->age,
                    'sex'             => $student->sex,
                    'grade_or_level'  => $student->grade,
                ]);
            }

            if ($request->patient_type === 'teacher') {
                $teacher = Teacher::findOrFail($request->ref_id);

                $patient = Patient::create([
                    'patient_type'    => 'teacher',
                    'ref_id'          => $teacher->id,
                    'name'            => $teacher->name,
                    'age'             => $teacher->age,
                    'sex'             => $teacher->sex,
                    'grade_or_level'  => $teacher->level,
                ]);
            }

            // 2️⃣ CREATE FIRST HISTORY (STORY)
            $patient->histories()->create([
                'complaint'       => $request->complaint,
                'intervention'    => $request->intervention,
                'treatment'       => $request->treatment,
                'administered_by' => auth()->user()->name,
            ]);
        });

        return redirect()->route('patients.index')
            ->with('success','បានបញ្ចូលអ្នកជំងឺថ្មីដោយជោគជ័យ');
    }
    public function show(Patient $patient)
    {
        // 🔥 THIS creates $patient
        $histories = $patient->histories()->latest()->get();

        return view('patients.show', compact('patient','histories'));
    }

    // ➕ Add history (story)
    public function storeHistory(Request $request, Patient $patient)
    {
        $request->validate([
            'complaint' => 'required',
        ]);

        $patient->histories()->create([
            'complaint' => $request->complaint,
            'intervention' => $request->intervention,
            'treatment' => $request->treatment,
            'administered_by' => auth()->user()->name,
        ]);

        return back()->with('success', 'បានបន្ថែមប្រវត្តិជំងឺថ្មីដោយជោគជ័យ');
    }

// ✏️ Edit form

public function edit(Patient $patient)
{
    $students = Student::select('id','code','name','age','sex','grade')->get();
    $teachers = Teacher::select('id','name','age','sex','level')->get();
     $staffs = Staff::select(
            'id', 'code', 'name', 'role'
        )->get();
    return view('patients.edit',
        compact('patient','students','teachers', 'staffs'));
}
// 🔄 Update patient
public function update(Request $request, Patient $patient)
{
    $request->validate([
        'patient_type' => 'required|in:student,teacher',
        'ref_id' => 'required',
    ]);

    if ($request->patient_type === 'student') {
        $s = Student::findOrFail($request->ref_id);

        $patient->update([
            'patient_type'   => 'student',
            'ref_id'         => $s->id,
            'name'           => $s->name,
            'age'            => $s->age,
            'sex'            => $s->sex,
            'grade_or_level' => $s->grade,
        ]);
    }

    if ($request->patient_type === 'teacher') {
        $t = Teacher::findOrFail($request->ref_id);

        $patient->update([
            'patient_type'   => 'teacher',
            'ref_id'         => $t->id,
            'name'           => $t->name,
            'age'            => $t->age,
            'sex'            => $t->sex,
            'grade_or_level' => $t->level,
        ]);
    }

    return redirect()
        ->route('patients.show', $patient->id)
        ->with('success','បានកែប្រែអ្នកជំងឺឈ្មោះ '.$patient->name.' ដោយជោគជ័យ');
}

// 🗑 Delete patient
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->with('success','បានលុបអ្នកជំងឺដោយជោគជ័យ');
    }

    public function getRoleKhAttribute()
    {
        return [
            'admin'       => 'អ្នកគ្រប់គ្រង',
            'nurse'       => 'គិលានុបដ្ឋាយិកា',
            'teacher'     => 'គ្រូ',
            'staff'       => 'បុគ្គលិក',
            'security'    => 'សន្តិសុខ',
            'hr'          => 'មន្ត្រីធនធានមនុស្ស',
            'office'      => 'បុគ្គលិកការិយាល័យ',
            'secretary'   => 'លេខាធិការ',
            'cleaner'     => 'អ្នកសម្អាត',
            'it_officer'  => 'អ្នកគ្រប់គ្រងប្រព័ន្ធកុំព្យូទ័រ',
            'gardener'    => 'អ្នកថែសួន',
            'other'       => 'ផ្សេងៗ',
        ][$this->role] ?? '-';
    }

    public function updateHis(Request $request, PatientHistory $history)
    {
        $request->validate([
            'complaint' => 'required|string',
            'intervention' => 'nullable|string',
            'treatment' => 'nullable|string',
        ]);

        $history->update([
            'complaint' => $request->complaint,
            'intervention' => $request->intervention,
            'treatment' => $request->treatment,
        ]);

        return back()->with('success', 'ប្រវត្តិជំងឺបានកែប្រែដោយជោគជ័យ');
    }

    // DELETE history
    public function destroyHis(PatientHistory $history)
    {
        $history->delete();

        return back()->with('success', 'ប្រវត្តិជំងឺបានលុបដោយជោគជ័យ');
    }

    // 🖨 Print ALL histories
    public function printAll(Patient $patient)
    {
        $histories = $patient->histories()->latest()->get();
        return view('patients.print-all', compact('patient', 'histories'));
    }

    // 🖨 Print ONE history
    public function printHistory(PatientHistory $history)
    {
        $patient = $history->patient;
        return view('patients.print-one', compact('patient', 'history'));
    }


}
