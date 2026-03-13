<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientVisit;
use App\Models\Student;
use App\Models\Teacher;

class PatientVisitController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::select('id','code','name','age','grade')->get();
        $teachers = Teacher::select('id','name','age')->get();

        $history = [];

        if ($request->patient_type && $request->patient_id) {
            $history = PatientVisit::where('patient_type', $request->patient_type)
                ->where('patient_id', $request->patient_id)
                ->latest()
                ->get();
        }

        return view('patient_visits.index', compact(
            'students',
            'teachers',
            'history'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_type' => 'required',
            'patient_id'   => 'required',
            'complaint'    => 'required',
        ]);

        PatientVisit::create([
            'patient_type'    => $request->patient_type,
            'patient_id'      => $request->patient_id,
            'complaint'       => $request->complaint,
            'intervention'    => $request->intervention,
            'treatment'       => $request->treatment,
            'remark'          => $request->remark,
            'administered_by' => auth()->user()->name,
        ]);

        // 🔁 redirect back WITH selected patient
        return redirect('/patient-visits?patient_type='.$request->patient_type
            .'&patient_id='.$request->patient_id);
    }
    public function update(Request $request, PatientVisit $patientVisit)
    {
        $patientVisit->update([
            'complaint'    => $request->complaint,
            'intervention' => $request->intervention,
            'treatment'    => $request->treatment,
            'remark'       => $request->remark,
        ]);

        return back()->with('success','Visit updated');
    }

    public function destroy(PatientVisit $patientVisit)
    {
        $patientVisit->delete();
        return back()->with('success','Visit deleted');
    }

}
