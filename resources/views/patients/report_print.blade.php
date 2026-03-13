<!DOCTYPE html>
<html lang="km">
<head>
<meta charset="UTF-8">
<title>របាយការណ៍អ្នកជំងឺ | សាលាសន្តសាវីយេ</title>

{{-- KHMER FONTS --}}
<link href="https://fonts.googleapis.com/css2?family=Battambang:wght@300;400;500;600;700&family=Koulen&family=Moul&display=swap" rel="stylesheet">

<style>
@page {
    size: A4;
    margin: 12mm 10mm; /* Reduced margins for more content space */
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Battambang', sans-serif;
    font-size: 10pt; /* Slightly smaller font */
    color: #1a1a1a;
    line-height: 1.4;
    background: #fff;
}

/* HEADER STYLES */
.report-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 3px double #2c5530;
    padding-bottom: 12px;
    margin-bottom: 15px;
}

.logo-section {
    display: flex;
    align-items: center;
    gap: 12px;
}

.logo {
    width: 65px;
    height: 65px;
    object-fit: contain;
}

.school-name {
    font-family: 'Koulen', sans-serif;
    font-size: 20pt;
    color: #2c5530;
    line-height: 1.2;
}

.school-subtitle {
    font-size: 9pt;
    color: #666;
}

.report-meta-box {
    text-align: right;
    border: 1px solid #2c5530;
    border-radius: 8px;
    padding: 10px 12px;
    background: #f8fdf9;
    min-width: 220px;
}

.report-title-main {
    font-family: 'Moul', sans-serif;
    font-size: 14pt;
    color: #d62828;
    margin-bottom: 3px;
}

/* FILTER INFO */
.filter-info {
    background: linear-gradient(135deg, #f8fdf9 0%, #e8f4e8 100%);
    border-radius: 8px;
    padding: 12px;
    margin: 15px 0;
    border-left: 5px solid #2c5530;
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.filter-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 9.5pt;
}

.filter-label {
    font-weight: 600;
    color: #2c5530;
    min-width: 110px;
}

.filter-value {
    font-weight: 700;
    color: #1a1a1a;
    padding: 3px 8px;
    background: white;
    border-radius: 4px;
    border: 1px solid #d4e6d4;
    flex: 1;
}

/* ============= FIXED TABLE STYLES ============= */
.report-table-container {
    width: 100%;
    overflow-x: visible;
    margin: 15px 0;
    page-break-inside: auto;
}

.report-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 9pt; /* Smaller font for table */
    table-layout: fixed; /* Fixed layout for better control */
    word-wrap: break-word;
    page-break-inside: auto;
}

.report-table thead {
    background: linear-gradient(135deg, #2c5530, #3d7342);
    color: white;
    page-break-after: avoid;
}

.report-table th {
    padding: 8px 4px;
    text-align: center;
    font-weight: 600;
    border: 1px solid #3d7342;
    font-size: 9pt;
}

.report-table td {
    padding: 6px 4px;
    vertical-align: middle;
    border: 1px solid #ddd;
    word-break: break-word;
}

/* ============= OPTIMIZED COLUMN WIDTHS ============= */
.col-date { width: 90px; text-align: center; }
.col-patient { width: 100px; }
.col-gender { width: 50px; text-align: center; }
.col-age { width: 45px; text-align: center; }
.col-grade { width: 70px; text-align: center; }
.col-complaint { width: 130px; }
.col-treatment { width: 120px; }
.col-admin { width: 80px; text-align: center; }

/* Table row styles */
.report-table tbody tr {
    border-bottom: 1px solid #e8e8e8;
    page-break-inside: avoid;
}

.report-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* ============= COMPACT CONTENT STYLES ============= */
.compact-date {
    font-weight: 600;
    color: #2c5530;
    font-size: 8.5pt;
    margin-bottom: 2px;
}

.compact-time {
    font-size: 8pt;
    color: #666;
}

.compact-badge {
    display: inline-block;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 8.5pt;
    font-weight: 600;
}

.patient-type {
    font-size: 8.5pt;
    color: #666;
}

.grade-badge-compact {
    display: inline-block;
    padding: 2px 6px;
    background: #e8f4e8;
    border-radius: 4px;
    font-weight: 600;
    color: #2c5530;
    font-size: 8.5pt;
}

/* SUMMARY SECTION */
.summary-section {
    background: linear-gradient(135deg, #f0f7ff 0%, #e8f4e8 100%);
    border-radius: 10px;
    padding: 20px;
    margin: 25px 0;
    border: 1px solid #cde0cd;
}

.summary-title {
    font-family: 'Moul', sans-serif;
    font-size: 13pt;
    color: #2c5530;
    margin-bottom: 15px;
    text-align: center;
    position: relative;
    padding-bottom: 8px;
}

.summary-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, #2c5530, #3d7342);
    border-radius: 2px;
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.summary-card {
    background: white;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    border-top: 4px solid;
}

.summary-card.total {
    border-top-color: #2c5530;
}

.summary-card.students {
    border-top-color: #3a86ff;
}

.summary-card.teachers {
    border-top-color: #ff9f1c;
}

.summary-card.staff {
    border-top-color: #e71d36;
}

.summary-label {
    font-size: 10pt;
    color: #666;
    margin-bottom: 8px;
    display: block;
}

.summary-value {
    font-family: 'Koulen', sans-serif;
    font-size: 22pt;
    color: #1a1a1a;
    line-height: 1;
}

.summary-text {
    background: white;
    border-radius: 8px;
    padding: 15px;
    font-size: 10.5pt;
    line-height: 1.6;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    border-left: 4px solid #2c5530;
}

.highlight {
    background: linear-gradient(120deg, #ffef9f 0%, #ffef9f 100%);
    padding: 0 5px;
    border-radius: 3px;
    font-weight: 700;
    color: #b8860b;
}

/* SIGNATURE SECTION - COMPACT */
.signature-section {
    margin-top: 25px;
    padding-top: 15px;
    border-top: 2px dashed #ccc;
    page-break-inside: avoid;
}

.signature-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 20px;
}

.signature-line {
    margin-top: 40px;
    border-top: 1px solid #1a1a1a;
    padding-top: 6px;
    font-weight: 700;
    color: #2c5530;
    font-size: 10pt;
}

/* FOOTER */
.report-footer {
    text-align: center;
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid #e8e8e8;
    font-size: 8.5pt;
    color: #888;
    page-break-after: avoid;
}

/* PRINT OPTIMIZATIONS - CRITICAL FIX */
@media print {
    body {
        font-size: 9pt;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    .report-table-container {
        page-break-inside: auto;
    }
    
    .report-table {
        page-break-inside: auto;
        border: 1px solid #ddd;
    }
    
    .report-table thead {
        display: table-header-group;
        page-break-after: avoid;
    }
    
    .report-table tbody tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    
    .report-table tfoot {
        display: table-footer-group;
    }
    
    .report-table th, 
    .report-table td {
        border: 1px solid #ddd;
    }
    
    .filter-info,
    .summary-section,
    .signature-section {
        page-break-inside: avoid;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    /* Force table to stay on first page if possible */
    .report-table-container {
        break-inside: auto;
    }
    
    .report-table tr {
        break-inside: avoid;
    }
}

/* PAGE BREAK CONTROL */
.page-break-before {
    page-break-before: always;
}

.page-break-after {
    page-break-after: always;
}

.no-break {
    page-break-inside: avoid;
}

/* Responsive table helper */
@media print and (max-width: 210mm) {
    .col-complaint { width: 120px; }
    .col-treatment { width: 110px; }
    .col-date { width: 85px; }
    .col-patient { width: 95px; }
}
</style>
</head>

<body onload="window.print()">

{{-- REPORT HEADER --}}
<div class="report-header">
    <div class="logo-section">
        <img src="{{ asset('img/Logo-Xavier.png') }}" class="logo" alt="សាលាសន្តសាវីយេ">
        <div class="school-info">
            <div class="school-name">សាលាសន្តសាវីយេ</div>
            <div class="school-subtitle">Health Center Report System</div>
        </div>
    </div>
    
    <div class="report-meta-box">
        <div class="report-title-main">របាយការណ៍អ្នកជំងឺ</div>
        <div class="report-id">លេខយោង: REP-{{ str_pad($histories->count(), 4, '0', STR_PAD_LEFT) }}-{{ now()->format('Ymd') }}</div>
    </div>
</div>

@php
    use Carbon\Carbon;
    
    Carbon::setLocale('km');
    $now = Carbon::now();
    
    $toKhmerNum = function ($number) {
        $en = range(0, 9);
        $kh = ['០','១','២','៣','៤','៥','៦','៧','៨','៩'];
        return str_replace($en, $kh, $number);
    };

    $from = request('from');
    $to   = request('to');
    $type = request('type');
    
    $label = '-'; 

    if ($from && $to) {
        $fromDate = Carbon::parse($from)->startOfDay();
        $toDate   = Carbon::parse($to)->endOfDay();
        
        $startOfWeek = $now->copy()->startOfWeek();
        $endOfWeek   = $now->copy()->endOfWeek();
        $startOfLastWeek = $now->copy()->subWeek()->startOfWeek();
        $endOfLastWeek   = $now->copy()->subWeek()->endOfWeek();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth   = $now->copy()->endOfMonth();

        if ($fromDate->isSameDay($now) && $toDate->isSameDay($now)) {
            $label = 'ថ្ងៃនេះ';
        }
        elseif ($fromDate->isSameDay($startOfWeek) && $toDate->isSameDay($endOfWeek)) {
            $label = 'សប្តាហ៍នេះ';
        }
        elseif ($fromDate->isSameDay($startOfLastWeek) && $toDate->isSameDay($endOfLastWeek)) {
            $label = 'សប្តាហ៍មុន';
        }
        elseif ($fromDate->isSameDay($startOfMonth) && $toDate->isSameDay($endOfMonth)) {
            $month = $now->translatedFormat('F');
            $year  = $toKhmerNum($now->year);
            $label = "ខែ $month $year";
        }
        elseif ($fromDate->isSameDay($now->copy()->subMonth()->startOfMonth()) && 
                $toDate->isSameDay($now->copy()->subMonth()->endOfMonth())) {
            $lastMonthDate = $now->copy()->subMonth();
            $month = $lastMonthDate->translatedFormat('F');
            $year  = $toKhmerNum($lastMonthDate->year);
            $label = "ខែ $month $year";
        }
        elseif ($fromDate->isSameDay($now->copy()->startOfYear()) && 
                $toDate->isSameDay($now->copy()->endOfYear())) {
            $label = 'ឆ្នាំ ' . $toKhmerNum($now->year);
        }
        else {
            $startStr = $toKhmerNum($fromDate->format('d')) . ' ' . $fromDate->translatedFormat('F Y');
            $endStr   = $toKhmerNum($toDate->format('d')) . ' ' . $toDate->translatedFormat('F Y');
            $startStr = str_replace(range(0,9), ['០','១','២','៣','៤','៥','៦','៧','៨','៩'], $startStr);
            $endStr   = str_replace(range(0,9), ['០','១','២','៣','៤','៥','៦','៧','៨','៩'], $endStr);
            $label = "$startStr → $endStr";
        }
    }

    $typeLabel = match($type) {
        'student' => 'សិស្ស',
        'teacher' => 'គ្រូបង្រៀន',
        'staff'   => 'បុគ្គលិក',
        default   => 'ទាំងអស់'
    };
    
    $khmerDays = ['អាទិត្យ', 'ច័ន្ទ', 'អង្គារ', 'ពុធ', 'ព្រហស្បតិ៍', 'សុក្រ', 'សៅរ៍'];
    $khmerMonths = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'];
    $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
    
    $toKhmer = function($number) {
        $arabic = ['0','1','2','3','4','5','6','7','8','9'];
        $khmer  = ['០','១','២','៣','៤','៥','៦','៧','៨','៩'];
        return str_replace($arabic, $khmer, $number);
    };

    $total = $histories->count();
    $students = $histories->filter(fn($h) => optional($h->patient)->patient_type == 'student')->count();
    $teachers = $histories->filter(fn($h) => optional($h->patient)->patient_type == 'teacher')->count();
    $staffs   = $histories->filter(fn($h) => optional($h->patient)->patient_type == 'staff')->count();
    
    $page = $page ?? 1; 
    $currentPage = $page;
    $totalPages = $totalPages ?? 1;
@endphp

{{-- FILTER INFORMATION --}}
<div class="filter-info no-break">
    <div class="filter-grid">
        <div class="filter-item">
            <span class="filter-label">ប្រភេទអ្នកជំងឺ:</span>
            <span class="filter-value">{{ $typeLabel }}</span>
        </div>
        <div class="filter-item">
            <span class="filter-label">រយៈពេល:</span>
            <span class="filter-value">{{ $label }}</span>
        </div>
        <div class="filter-item">
            <span class="filter-label">អ្នកធ្វើរបាយការណ៍:</span>
            <span class="filter-value">{{ auth()->user()->name ?? 'គិលានុបដ្ឋាយិកា' }}</span>
        </div>
        <div class="filter-item">
            <span class="filter-label">តួនាទី:</span>
            <span class="filter-value">{{ auth()->user()->role == 'nurse' ? 'គិលានុបដ្ឋាយិកា' : 'គិលានុបដ្ឋាយិកា' }}</span>
        </div>
        <div class="filter-item">
            <span class="filter-label">ថ្ងៃបង្កើត:</span>
            <span class="filter-value">{{ str_replace(range(0, 9), $khmerNumbers, now()->format('d/m/Y')) }}</span>
        </div>
        <div class="filter-item">
            <span class="filter-label">ពេលវេលា:</span>
            <span class="filter-value">{{ now()->format('h:i A') }}</span>
        </div>
    </div>
</div>

{{-- ============= PATIENT DATA TABLE - FIXED ============= --}}
<div class="report-table-container">
    <table class="report-table">
        <thead>
            <tr>
                <th class="col-date">កាលបរិច្ឆេទ</th>
                <th class="col-patient">អ្នកជំងឺ</th>
                <th class="col-gender">ភេទ</th>
                <th class="col-age">អាយុ</th>
                <th class="col-grade">ថ្នាក់/កម្រិត</th>
                <th class="col-complaint">រោគសញ្ញា</th>
                <th class="col-treatment">ការព្យាបាល</th>
                <th class="col-admin">កត់ត្រាដោយ</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($histories as $h)
            <tr>
                <td>
                    <div style="font-size: 9pt;">
                        {{ str_replace(range(0, 9), $khmerNumbers, $h->created_at->format('d')) }}
                        {{ $khmerMonths[$h->created_at->month - 1] }}
                        {{ str_replace(range(0, 9), $khmerNumbers, $h->created_at->year) }}
                    </div>
                    <div style="font-size: 8pt; color: #666; margin-top: 2px;">
                        {{ $h->created_at->format('h:i A') }}
                    </div>
                </td>
                
                <td class="col-patient">
                    <div style="font-weight: 600; color: #1a1a1a; font-size: 9pt;">
                        {{ $h->patient->name }}
                    </div>
                    <div class="patient-type">
                        @if($h->patient->patient_type == 'student')
                            សិស្ស
                        @elseif($h->patient->patient_type == 'teacher')
                            គ្រូ
                        @else
                            បុគ្គលិក
                        @endif
                    </div>
                </td>
                
                <td class="col-gender">
                    <span style="display: inline-block; padding: 2px 6px; border-radius: 10px; 
                          background: {{ $h->patient->sex == 'Male' ? '#e3f2fd' : '#fce4ec' }};
                          color: {{ $h->patient->sex == 'Male' ? '#1565c0' : '#c2185b' }};
                          font-size: 8.5pt;">
                        {{ $h->patient->sex == 'Male' ? 'ប្រុស' : 'ស្រី' }}
                    </span>
                </td>
                
                <td class="col-age">
                    <span style="font-weight: 600;">{{ $h->patient->age }}</span>
                </td>
                
                <td class="col-grade">
                    @if($h->patient->grade_or_level)
                    <span class="grade-badge-compact">
                        {{ $h->patient->grade_or_level }}
                    </span>
                    @else
                    <span style="color: #999;">-</span>
                    @endif
                </td>
                
                <td class="col-complaint">
                    <div style="font-size: 8.5pt; line-height: 1.3;">
                        {{ \Illuminate\Support\Str::limit($h->complaint, 60) }}
                    </div>
                </td>
                
                <td class="col-treatment">
                    <div style="font-size: 8.5pt; line-height: 1.3;">
                        {{ \Illuminate\Support\Str::limit($h->treatment ?? '-', 50) }}
                    </div>
                </td>
                
                <td class="col-admin">
                    <div style="font-weight: 600; color: #2c5530; font-size: 8.5pt;">
                        {{ $h->administered_by }}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- SUMMARY SECTION --}}
<div class="summary-section">
    <div class="summary-title">សង្ខេបទិន្នន័យ</div>
    
    <div class="summary-grid">
        <div class="summary-card total">
            <span class="summary-label">សរុបអ្នកជំងឺ</span>
            <div class="summary-value">{{ $toKhmer($total) }}</div>
            <div style="font-size: 9pt; color: #666; margin-top: 5px;">នាក់</div>
        </div>
        
        <div class="summary-card students">
            <span class="summary-label">សិស្ស</span>
            <div class="summary-value">{{ $toKhmer($students) }}</div>
            <div style="font-size: 9pt; color: #666; margin-top: 5px;">នាក់</div>
        </div>
        
        <div class="summary-card teachers">
            <span class="summary-label">គ្រូបង្រៀន</span>
            <div class="summary-value">{{ $toKhmer($teachers) }}</div>
            <div style="font-size: 9pt; color: #666; margin-top: 5px;">នាក់</div>
        </div>
        
        <div class="summary-card staff">
            <span class="summary-label">បុគ្គលិក</span>
            <div class="summary-value">{{ $toKhmer($staffs) }}</div>
            <div style="font-size: 9pt; color: #666; margin-top: 5px;">នាក់</div>
        </div>
    </div>
    
    <div class="summary-text">
        <strong>សេចក្តីសង្ខេប៖</strong> 
        ក្នុងរយៈពេល 
        <span class="highlight">{{ $label }}</span> 
        មានអ្នកជំងឺឬមានបញ្ហាសុខភាពសរុបចំនួន 
        <span class="highlight">{{ $toKhmer($total) }} នាក់</span> 
        ដែលក្នុងនោះមានសិស្សចំនួន 
        <span class="highlight">{{ $toKhmer($students) }} នាក់</span>, 
        គ្រូបង្រៀនចំនួន 
        <span class="highlight">{{ $toKhmer($teachers) }} នាក់</span>, 
        និងបុគ្គលិកផ្សេងៗចំនួន 
        <span class="highlight">{{ $toKhmer($staffs) }} នាក់</span>។
    </div>
</div>


{{-- SIGNATURE SECTION --}}
<div class="signature-section no-break">
    <div class="signature-grid">
        <div class="signature-box">
            <div class="signature-name">នាយកសាលា</div>
            <div class="signature-role">សាលាសន្តសាវីយេ</div>
            <div class="signature-line">ហត្ថលេខា និងត្រា</div>
        </div>
        
        <div class="signature-box">
            <div class="signature-name">{{ auth()->user()->name ?? 'គិលានុបដ្ឋាយិកា' }}</div>
            <div class="signature-role">គិលានុបដ្ឋាយិកា</div>
            <div class="signature-line">អ្នកធ្វើរបាយការណ៍</div>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 15px; padding: 12px; background: #f8fdf9; border-radius: 6px;">
        <div style="font-weight: 600; color: #2c5530;">សាលាសន្តសាវីយេ</div>
        <div style="color: #666; font-size: 9pt;">
            ថ្ងៃទី {{ str_replace(range(0, 9), $khmerNumbers, now()->format('d')) }} 
            ខែ {{ now()->locale('km')->translatedFormat('F') }} 
            ឆ្នាំ {{ str_replace(range(0, 9), $khmerNumbers, now()->year) }}
        </div>
    </div>
</div>

{{-- FOOTER --}}
<div class="report-footer">
    <div>--- បញ្ចប់របាយការណ៍ ---</div>
    <div class="print-info">
        <div>ប្រព័ន្ធគ្រប់គ្រងសុខភាព</div>
        {{-- <div>ទំព័រ 1/1</div> --}}
        <div>{{ str_replace(range(0, 9), $khmerNumbers, now()->format('d/m/Y')) }}</div>
    </div>
</div>

</body>
</html>