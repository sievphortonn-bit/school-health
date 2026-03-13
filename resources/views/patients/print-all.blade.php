<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ប្រវត្តិជំងឺអ្នកជំងឺ | សាលាសន្តសាវីយេ</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@300;400;500;600;700&family=Koulen&family=Moul&display=swap" rel="stylesheet">
    
    <style>
        @page {
            size: A4;
            margin: 12mm 10mm;
            counter-increment: page;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Battambang', 'Koulen', sans-serif;
            font-size: 10.5pt;
            line-height: 1.5;
            color: #1a1a1a;
            background: #fff;
            padding: 0;
            width: 100%;
        }
        
        /* ============= HEADER STYLES ============= */
        .report-header {
            border-bottom: 3px double #2c5530;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .logo-container {
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
            font-size: 18pt;
            color: #2c5530;
            line-height: 1.2;
        }
        
        .school-subtitle {
            font-size: 8.5pt;
            color: #666;
        }
        
        .report-title-box {
            border: 1px solid #2c5530;
            padding: 8px 16px;
            border-radius: 8px;
            text-align: right;
            min-width: 200px;
            background: #f8fdf9;
        }
        
        .main-title {
            font-family: 'Moul', sans-serif;
            font-size: 13pt;
            color: #d62828;
        }
        
        /* ============= PATIENT INFO SECTION ============= */
        .patient-info-section {
            background: linear-gradient(135deg, #f8fdf9 0%, #e8f4e8 100%);
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #cde0cd;
            page-break-inside: avoid;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        
        .info-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 10pt;
        }
        
        .info-label {
            font-weight: 600;
            color: #2c5530;
            min-width: 115px;
        }
        
        .info-value {
            font-weight: 700;
            color: #1a1a1a;
            padding: 3px 8px;
            background: white;
            border-radius: 5px;
            border: 1px solid #d4e6d4;
            flex: 1;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 9pt;
            font-weight: 600;
        }
        
        .badge-student {
            background: #e3f2fd;
            color: #1565c0;
            border: 1px solid #bbdefb;
        }
        
        .badge-teacher {
            background: #fff3e0;
            color: #ef6c00;
            border: 1px solid #ffe0b2;
        }
        
        .badge-staff {
            background: #f3e5f5;
            color: #7b1fa2;
            border: 1px solid #e1bee7;
        }
        
        /* ============= FIXED TABLE STYLES ============= */
        .history-section {
            margin: 20px 0;
            page-break-inside: auto;
        }
        
        .section-title {
            font-family: 'Moul', sans-serif;
            font-size: 13pt;
            color: #2c5530;
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 8px;
            position: relative;
            page-break-after: avoid;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #2c5530, #3d7342);
            border-radius: 2px;
        }
        
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            margin: 15px 0;
        }
        
        .history-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
            table-layout: fixed;
            word-wrap: break-word;
            page-break-inside: auto;
        }
        
        .history-table thead {
            background: linear-gradient(135deg, #2c5530, #3d7342);
            color: white;
            page-break-after: avoid;
        }
        
        .history-table th {
            padding: 10px 6px;
            text-align: center;
            font-weight: 600;
            border: 1px solid #3d7342;
            font-size: 9.5pt;
        }
        
        .history-table tbody tr {
            border-bottom: 1px solid #e8e8e8;
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .history-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .history-table td {
            padding: 8px 6px;
            vertical-align: middle;
            border: 1px solid #ddd;
            word-break: break-word;
        }
        
        /* ============= OPTIMIZED COLUMN WIDTHS ============= */
        .col-no { width: 40px; text-align: center; }
        .col-date { width: 110px; text-align: center; }
        .col-complaint { width: 200px; }
        .col-treatment { width: 180px; }
        .col-admin { width: 90px; text-align: center; }
        
        .date-cell {
            text-align: center;
        }
        
        .date-day {
            font-weight: 600;
            color: #2c5530;
            font-size: 9pt;
        }
        
        .date-time {
            font-size: 8.5pt;
            color: #666;
            margin-top: 2px;
        }
        
        /* ============= STATISTICS ============= */
        .stats-box {
            background: linear-gradient(135deg, #f0f7ff 0%, #e8f4e8 100%);
            border-radius: 8px;
            padding: 12px 15px;
            margin: 15px 0;
            border: 1px solid #cde0cd;
            page-break-inside: avoid;
        }
        
        .stats-text {
            font-size: 10.5pt;
            color: #1a1a1a;
            text-align: center;
        }
        
        .highlight {
            background: linear-gradient(120deg, #ffef9f 0%, #ffef9f 100%);
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 700;
            color: #b8860b;
        }
        
        /* ============= SIGNATURE SECTION ============= */
        .signature-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px dashed #ccc;
            page-break-inside: avoid;
        }
        
        .signature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 25px;
        }
        
        .signature-box {
            text-align: center;
            padding: 15px;
        }
        
        .signature-line {
            margin-top: 40px;
            border-top: 1px solid #1a1a1a;
            padding-top: 8px;
            font-weight: 700;
            color: #2c5530;
        }
        
        .report-date {
            text-align: center;
            margin-top: 15px;
            padding: 12px;
            background: #f8fdf9;
            border-radius: 8px;
            border: 1px solid #d4e6d4;
        }
        
        /* ============= FOOTER ============= */
        .report-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 12px;
            border-top: 1px solid #e8e8e8;
            font-size: 8.5pt;
            color: #888;
            page-break-after: avoid;
        }
        
        /* ============= PAGE BREAK CONTROL ============= */
        .page-break-before {
            page-break-before: always;
        }
        
        .page-break-after {
            page-break-after: always;
        }
        
        .keep-together {
            page-break-inside: avoid;
        }
        
        /* ============= PRINT OPTIMIZATIONS ============= */
        @media print {
            body {
                font-size: 9.5pt;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .history-table {
                page-break-inside: auto;
            }
            
            .history-table thead {
                display: table-header-group;
                background: #2c5530 !important;
            }
            
            .history-table tbody tr {
                page-break-inside: avoid;
            }
            
            .history-table tfoot {
                display: table-footer-group;
            }
            
            .history-table th,
            .history-table td {
                border: 1px solid #2c5530;
            }
            
            .patient-info-section,
            .stats-box,
            .signature-section {
                page-break-inside: avoid;
                -webkit-print-color-adjust: exact;
            }
            
            @page {
                margin: 12mm 10mm;
            }
        }
        
        /* ============= RESPONSIVE ============= */
        @media screen and (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .report-title-box {
                width: 100%;
                text-align: left;
            }
            
            .table-responsive {
                overflow-x: auto;
            }
            
            .history-table {
                min-width: 700px;
            }
        }
        
        /* ============= UTILITY CLASSES ============= */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .fw-bold { font-weight: 700; }
        .mb-10 { margin-bottom: 10px; }
        .mt-10 { margin-top: 10px; }
    </style>
</head>

<body onload="window.print(); window.onafterprint = window.close;">

@php
    // Khmer numbers array
    $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
    $arabicNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    
    // Helper function to convert to Khmer numbers
    $toKhmer = function($number) use ($khmerNumbers, $arabicNumbers) {
        return str_replace($arabicNumbers, $khmerNumbers, (string)$number);
    };
    
    // Khmer months
    $khmerMonths = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 
                    'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'];
    
    // Khmer days
    $khmerDays = ['អាទិត្យ', 'ច័ន្ទ', 'អង្គារ', 'ពុធ', 'ព្រហស្បតិ៍', 'សុក្រ', 'សៅរ៍'];
    
    // Get badge class and label
    $badgeClass = match($patient->patient_type) {
        'student' => 'badge-student',
        'teacher' => 'badge-teacher',
        'staff'   => 'badge-staff',
        default   => 'badge-staff'
    };
    
    $patientTypeLabel = match($patient->patient_type) {
        'student' => 'សិស្ស',
        'teacher' => 'គ្រូបង្រៀន',
        'staff'   => 'បុគ្គលិក',
        default   => 'បុគ្គលិក'
    };
    
    // Page counter
    $pageNumber = 1;
@endphp

<!-- REPORT HEADER -->
<div class="report-header keep-together">
    <div class="header-content">
        <div class="logo-container">
            <img src="{{ asset('img/Logo-Xavier.png') }}" class="logo" alt="សាលាសន្តសាវីយេ">
            <div class="school-info">
                <div class="school-name">សាលាសន្តសាវីយេ</div>
                <div class="school-subtitle">ប្រវត្តិជំងឺអ្នកជំងឺ</div>
            </div>
        </div>
        
        <div class="report-title-box">
            <div class="main-title">ប្រវត្តិជំងឺ</div>
            <div style="font-size: 8.5pt; color: #2c5530; margin-top: 3px;">
                HIS-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}-{{ now()->format('Ymd') }}
            </div>
        </div>
    </div>
</div>

<!-- PATIENT INFORMATION -->
<div class="patient-info-section keep-together">
    <div class="info-grid">
        <div class="info-row">
            <span class="info-label">ឈ្មោះអ្នកជំងឺ:</span>
            <span class="info-value">{{ $patient->name }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">ប្រភេទ:</span>
            <span class="badge {{ $badgeClass }}">{{ $patientTypeLabel }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">ភេទ:</span>
            <span class="info-value">{{ $patient->sex == 'Male' ? 'ប្រុស' : 'ស្រី' }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">អាយុ:</span>
            <span class="info-value">{{ $patient->age ?? 'មិនមាន' }} ឆ្នាំ</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">ថ្នាក់/កម្រិត:</span>
            <span class="info-value">{{ $patient->grade_or_level ?? 'មិនមាន' }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">ថ្ងៃរបាយការណ៍:</span>
            <span class="info-value">{{ $toKhmer(now()->format('d/m/Y')) }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">អ្នកធ្វើរបាយការណ៍:</span>
            <span class="info-value">{{ auth()->user()->name ?? 'គិលានុបដ្ឋាយិកា' }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">តួនាទី:</span>
            <span class="info-value">{{ auth()->user()->role === 'nurse' ? 'គិលានុបដ្ឋាយិកា' : 'បុគ្គលិក' }}</span>
        </div>
    </div>
</div>

<!-- HISTORY TABLE -->
<div class="history-section">
    <div class="section-title">ប្រវត្តិការព្យាបាល</div>
    
    <div class="stats-box keep-together">
        <div class="stats-text">
            <i class="fa-solid fa-notes-medical" style="color: #2c5530; margin-right: 5px;"></i>
            សរុបចំនួនការព្យាបាល: 
            <span class="highlight">{{ $toKhmer($histories->count()) }} ដង</span>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="history-table" id="history-table">
            <thead>
                <tr>
                    <th class="col-no">ល.រ</th>
                    <th class="col-date">កាលបរិច្ឆេទ</th>
                    <th class="col-complaint">រោគសញ្ញា</th>
                    <th class="col-treatment">ការព្យាបាល</th>
                    <th class="col-admin">កត់ត្រាដោយ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histories as $h)
                <tr>
                    <td class="col-no">{{ $toKhmer($loop->iteration) }}</td>
                    <td class="col-date date-cell">
                        <div class="date-day">
                            {{ $khmerDays[$h->created_at->dayOfWeek] }}
                        </div>
                        <div style="font-size: 9pt; font-weight: 600; color: #1a1a1a;">
                            {{ $toKhmer($h->created_at->format('d')) }} 
                            {{ $khmerMonths[$h->created_at->month - 1] }} 
                            {{ $toKhmer($h->created_at->format('Y')) }}
                        </div>
                        <div class="date-time">
                            ម៉ោង {{ $toKhmer($h->created_at->format('h')) }}:{{ $toKhmer($h->created_at->format('i')) }}
                            {{ $h->created_at->format('A') == 'AM' ? 'ព្រឹក' : 'ល្ងាច' }}
                        </div>
                    </td>
                    <td class="col-complaint">{{ $h->complaint }}</td>
                    <td class="col-treatment">{{ $h->treatment ?? '-' }}</td>
                    <td class="col-admin">{{ $h->administered_by }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #666;">
                        <div style="font-size: 12pt; margin-bottom: 10px;">📋</div>
                        <div>មិនមានប្រវត្តិជំងឺ</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- SIGNATURE SECTION -->
<div class="signature-section keep-together">
    <div class="signature-grid">
        <div class="signature-box">
            <div class="signature-name">នាយកសាលា</div>
            <div class="signature-role">សាលាសន្តសាវីយេ</div>
            <div class="signature-line">ហត្ថលេខា និងត្រា</div>
        </div>
        
        <div class="signature-box">
            <div class="signature-name">{{ auth()->user()->name ?? 'គិលានុបដ្ឋាយិកា' }}</div>
            <div class="signature-role">{{ auth()->user()->role === 'nurse' ? 'គិលានុបដ្ឋាយិកា' : 'បុគ្គលិកសុខាភិបាល' }}</div>
            <div class="signature-line">អ្នកធ្វើរបាយការណ៍</div>
        </div>
    </div>
    
    <div class="report-date">
        <div style="font-weight: 700; color: #2c5530; margin-bottom: 3px;">
            សាលាសន្តសាវីយេ
        </div>
        <div style="color: #666; font-size: 9.5pt;">
            ថ្ងៃទី {{ $toKhmer(now()->format('d')) }} 
            ខែ {{ now()->locale('km')->translatedFormat('F') }} 
            ឆ្នាំ {{ $toKhmer(now()->year) }}
        </div>
    </div>
</div>

<!-- FOOTER -->
<div class="report-footer">
    <div class="footer-text">--- បញ្ចប់របាយការណ៍ ---</div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px;">
        <span>ប្រព័ន្ធគ្រប់គ្រងសុខភាព</span>
        {{-- <span style="font-weight: 600; color: #2c5530;">ទំព័រ ១/១</span> --}}
        <span>{{ $toKhmer(now()->format('d/m/Y')) }} ម៉ោង {{ $toKhmer(now()->format('h:i')) }} {{ now()->format('A') == 'AM' ? 'ព្រឹក' : 'ល្ងាច' }}</span>
    </div>
</div>

<script>
    // Auto-close print dialog
    window.onafterprint = function() {
        window.close();
    };
    
    // Handle page breaks for large tables
    document.addEventListener('DOMContentLoaded', function() {
        // Add page number to footer when printing
        const style = document.createElement('style');
        style.textContent = `
            @page {
                @bottom-center {
                    content: "ទំព័រ " counter(page) " នៃ " counter(pages);
                    font-size: 8pt;
                    color: #666;
                    font-family: 'Battambang', sans-serif;
                }
            }
        `;
        document.head.appendChild(style);
    });
</script>

</body>
</html>