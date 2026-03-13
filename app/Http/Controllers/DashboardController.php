<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {   
        // KPI Metrics
        $patientsToday = PatientHistory::whereDate('created_at', today())->count();
        $patientsYesterday = PatientHistory::whereDate('created_at', Carbon::yesterday())->count();
        $patientsMonth = PatientHistory::whereMonth('created_at', now()->month)->count();
        $patientsLastMonth = PatientHistory::whereMonth('created_at', now()->subMonth()->month)->count();
        $patientsYear = PatientHistory::whereYear('created_at', now()->year)->count();
        $totalPatients = Patient::count();


        if ($patientsYesterday > 0) {
            $percentage = round((($patientsToday - $patientsYesterday) / $patientsYesterday) * 100, 1);
        } else {
            $percentage = 0;
        }

        $trendToday = $percentage . '%';

        if ($patientsYesterday > $patientsToday) {
            $trendTodayClass = 'trend-up';
            $trendTodayIcon = 'fa-arrow-up';
        } elseif ($percentage < 0) {
            $trendTodayClass = 'trend-down';
            $trendTodayIcon = 'fa-arrow-down';
        } else {
            $trendTodayClass = 'trend-neutral';
            $trendTodayIcon = 'fa-minus';
        }

        // if ($patientsLastMonth > 0) {
        //     $percentageMonth = round((($patientsMonth - $patientsLastMonth) / $patientsLastMonth) * 100, 1);
        // } else {
        //     $percentageMonth = 0;
        // }
        // $trendMonth = $percentageMonth . '%';

        // if ($percentageMonth > 0) {
        //     $trendMonthClass = 'trend-up';
        //     $trendMonthIcon = 'fa-arrow-up';
        // } elseif ($percentageMonth < 0) {
        //     $trendMonthClass = 'trend-down';
        //     $trendMonthIcon = 'fa-arrow-down';
        // } else {
        //     $trendMonthClass = 'trend-neutral';
        //     $trendMonthIcon = 'fa-minus';
        // }

        // Weekly Chart (last 7 days)
        $weekly = PatientHistory::selectRaw("
            DATE(created_at) as date,
            DAYNAME(created_at) as day,
            COUNT(*) as total
        ")
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date', 'day')
            ->orderBy('date')
            ->pluck('total', 'day');

        // Monthly Chart (current year)
        $monthly = PatientHistory::selectRaw("
            MONTH(created_at) as month_num,
            MONTHNAME(created_at) as month,
            COUNT(*) as total
        ")
            ->whereYear('created_at', now()->year)
            ->groupBy('month_num', 'month')
            ->orderBy('month_num')
            ->pluck('total', 'month');

        // Type Statistics
        $typeStats = Patient::selectRaw('patient_type, COUNT(*) as total')
            ->groupBy('patient_type')
            ->pluck('total', 'patient_type');

        // Gender Distribution
        $male = Patient::where('sex', 'Male')->count();
        $female = Patient::where('sex', 'Female')->count();

        // Top Symptoms
        $illness = PatientHistory::selectRaw('
            CASE 
                WHEN LENGTH(complaint) > 50 THEN CONCAT(SUBSTRING(complaint, 1, 50), "...")
                ELSE complaint 
            END as complaint_short,
            COUNT(*) as total
        ')
            ->groupBy('complaint_short')
            ->orderByDesc('total')
            ->limit(8)
            ->pluck('total', 'complaint_short');

        // Recent Activities
        $recent = PatientHistory::with(['patient' => function ($query) {
            $query->select('id', 'name', 'patient_type', 'sex');
        }])
            ->latest()
            ->take(12)
            ->get(['id', 'patient_id', 'complaint', 'created_at']);

        // Today's Stats by Time Period
        $todayStats = [
            'morning' => PatientHistory::whereDate('created_at', today())
                ->whereTime('created_at', '>=', '06:00')
                ->whereTime('created_at', '<', '12:00')
                ->count(),
            'afternoon' => PatientHistory::whereDate('created_at', today())
                ->whereTime('created_at', '>=', '12:00')
                ->whereTime('created_at', '<', '18:00')
                ->count(),
            'evening' => PatientHistory::whereDate('created_at', today())
                ->whereTime('created_at', '>=', '18:00')
                ->whereTime('created_at', '<', '24:00')
                ->count(),
        ];

        // Monthly Growth Rate
        $currentMonth = now()->month;
        $previousMonth = now()->subMonth()->month;
        
        $currentMonthPatients = PatientHistory::whereMonth('created_at', $currentMonth)->count();
        $previousMonthPatients = PatientHistory::whereMonth('created_at', $previousMonth)->count();
        
        $growthRate = $previousMonthPatients > 0 
            ? round((($currentMonthPatients - $previousMonthPatients) / $previousMonthPatients) * 100, 2)
            : 0;
        $yesterday = Patient::whereDate('created_at', now()->subDay())->count();
        $today = Patient::whereDate('created_at', now())->count();

        $percentagetodaay = $yesterday > 0
            ? round((($today - $yesterday) / $yesterday) * 100, 1)
            : 0;
        return view('dashboard', compact(
            'patientsToday',
            'patientsMonth',
            'patientsYear',
            'totalPatients',
            'weekly',
            'monthly',
            'typeStats',
            'male',
            'female',
            'illness',
            'recent',
            'todayStats',
            'growthRate',
            'percentagetodaay',
            'patientsYesterday',
            'trendToday',
            'trendTodayClass',
            'trendTodayIcon',
            // 'trendMonth',
            // 'trendMonthClass',
            // 'trendMonthIcon'
        ));
    }
}