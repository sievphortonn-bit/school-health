<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientVisit;

class PatienController extends Controller
{
    // 📄 Patient list
    public function index()
    {
        $patients = PatientVisit::latest()->get();
        return view('patients.index', compact('patients'));
    }

    // 👁 Patient view (details + ALL history)
    public function show(Patient $patient)
    {
        // 🔥 THIS creates $patient
        $histories = $patient->histories()->latest()->get();

        return view('patients.show', compact('patient','histories'));
    }
    public function create()
    {
        $students = Student::select('id','code','name','age','sex','grade')->get();
        $teachers = Teacher::select('id','name','age','sex','level')->get();

        return view('patients.create', compact('students','teachers'));
    }
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
            ->with('success','Patient created with first history');
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

        return back();
    }

    // ✏️ Update history
    public function updateHistory(Request $request, PatientHistory $history)
    {
        $history->update($request->only([
            'complaint','intervention','treatment'
        ]));

        return back();
    }

    // 🗑 Delete history
    public function destroyHistory(PatientHistory $history)
    {
        $history->delete();
        return back();
    }
}

