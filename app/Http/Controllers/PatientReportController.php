<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientHistory;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PatientReportExport;

class PatientReportController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientHistory::with('patient')->latest();

        // 📆 DATE RANGE
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // 🧍 PATIENT TYPE
        if ($request->filled('type')) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('patient_type', $request->type);
            });
        }

        $histories = $query->get();

        // 📊 SUMMARY
        $total = $histories->count();

        return view('patients.report', compact(
            'histories',
            'total'
        ));
    }

   public function print(Request $request)
    {
        $query = PatientHistory::with('patient')->latest();

        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to   = Carbon::parse($request->to)->endOfDay();

            $query->whereBetween('created_at', [$from, $to]);
        }

        if ($request->filled('type')) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('patient_type', $request->type);
            });
        }

        $histories = $query->get();
        $total = $histories->count();

        return view('patients.report_print', compact('histories', 'total'));
    }



    public function excel()
    {
        return Excel::download(
            new PatientReportExport,
            'patient-report.xlsx'
        );
    }

    public function report(Request $request)
    {
        $query = History::with('patient');

        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [
                $request->from.' 00:00:00',
                $request->to.' 23:59:59'
            ]);
        }

        if ($request->type) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('patient_type', $request->type);
            });
        }

        return view('patients.report_print', [
            'histories' => $query->get(),
            'from' => $request->from,
            'to' => $request->to,
            'type' => $request->type
        ]); 
    }   
    private function filteredQuery($request)
    {
        $q = PatientHistory::with('patient');

        // DATE RANGE
        if ($request->from && $request->to) {
            $q->whereBetween('created_at', [
                Carbon::parse($request->from)->startOfDay(),
                Carbon::parse($request->to)->endOfDay(),
            ]);
        }

        // TYPE
        if ($request->type) {
            $q->whereHas('patient', function ($p) use ($request) {
                $p->where('patient_type', $request->type);
            });
        }

        return $q;
    }

}
