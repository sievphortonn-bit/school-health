<!DOCTYPE html>
<html lang="km">
<head>
    <title>វេជ្ជបញ្ជា | គ្លីនិកសុខភាពសាលាសន្តសាវីយេ</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@300;400;500;600;700&family=Koulen&family=Moul&display=swap');
        
        @page {
            size: A4;
            margin: 15mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Battambang', sans-serif;
            font-size: 11pt;
            color: #1a1a1a;
            line-height: 1.5;
            background: #fff;
        }
        
        /* HEADER STYLES */
        .prescription-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px double #2c5530;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .clinic-logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }
        
        .clinic-details {
            flex: 1;
            margin-left: 15px;
        }
        
        .clinic-name-kh {
            font-family: 'Koulen', sans-serif;
            font-size: 18pt;
            color: #2c5530;
            letter-spacing: 0.5px;
            line-height: 1.2;
            margin-bottom: 3px;
        }
        
        .clinic-name-en {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            color: #666;
            margin-bottom: 5px;
        }
        
        .clinic-contact {
            font-size: 10pt;
            color: #555;
        }
        
        .prescription-number {
            text-align: right;
            min-width: 150px;
        }
        
        .rx-symbol {
            font-size: 24pt;
            color: #d62828;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .rx-text {
            font-size: 9pt;
            color: #666;
            font-weight: 500;
        }
        
        /* TITLE SECTION */
        .prescription-title {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }
        
        .title-main {
            font-family: 'Moul', sans-serif;
            font-size: 16pt;
            color: #d62828;
            margin-bottom: 5px;
        }
        
        .title-sub {
            font-size: 10pt;
            color: #666;
            font-style: italic;
        }
        
        .title-decoration {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #2c5530, transparent);
            z-index: -1;
        }
        
        /* PATIENT INFO SECTION */
        .patient-info-card {
            background: linear-gradient(135deg, #f8fdf9 0%, #e8f4e8 100%);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            border: 1px solid #cde0cd;
            box-shadow: 0 3px 10px rgba(44, 85, 48, 0.1);
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-label {
            font-weight: 600;
            color: #2c5530;
            font-size: 10.5pt;
            min-width: 100px;
        }
        
        .info-value {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 10.5pt;
        }
        
        /* PRESCRIPTION SECTIONS */
        .prescription-section {
            margin-bottom: 20px;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e8e8e8;
        }
        
        .section-icon {
            width: 24px;
            height: 24px;
            background: #2c5530;
            color: white;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
            font-size: 10pt;
        }
        
        .section-title {
            font-weight: 700;
            color: #2c5530;
            font-size: 12pt;
            flex: 1;
        }
        
        .section-title-en {
            font-size: 10pt;
            color: #666;
            font-style: italic;
            margin-left: 10px;
        }
        
        .section-content {
            border: 1.5px solid #2c5530;
            border-radius: 8px;
            padding: 15px;
            min-height: 80px;
            background: white;
            font-size: 11pt;
            line-height: 1.6;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
            white-space: pre-line;
            vertical-align: middle;
        }
        
        .highlight {
            background: linear-gradient(120deg, #ffef9f 0%, #ffef9f 100%);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
        }
        
        /* MEDICATION TABLE (if needed) */
        .medication-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10pt;
        }
        
        .medication-table th {
            background: #2c5530;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: 600;
        }
        
        .medication-table td {
            padding: 8px;
            border-bottom: 1px solid #e8e8e8;
        }
        
        .medication-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        
        /* SIGNATURE SECTION */
        .signature-section {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px dashed #ccc;
        }
        
        .signature-grid {
            display: grid;
            /* grid-template-columns: 1fr 1fr; */
            gap: 30px;
        }
        
        .signature-box {
            text-align: center;
            padding: 15px;
            background: #f8fdf9;
            border-radius: 8px;
            border: 1px solid #d4e6d4;
        }
        
        .doctor-info {
            margin-bottom: 15px;
        }
        
        .doctor-name {
            font-weight: 700;
            color: #2c5530;
            font-size: 11pt;
            margin-bottom: 3px;
        }
        
        .doctor-title {
            font-size: 10pt;
            color: #666;
        }
        
        .signature-line {
            margin-top: 30px;
            border-top: 1px solid #1a1a1a;
            padding-top: 8px;
            font-weight: 600;
            color: #2c5530;
            font-size: 10.5pt;
        }
        
        /* FOOTER */
        .prescription-footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e8e8e8;
            text-align: center;
            font-size: 9pt;
            color: #888;
        }
        
        .footer-text {
            margin-bottom: 8px;
        }
        
        .prescription-id {
            font-weight: 600;
            color: #2c5530;
            background: #f8fdf9;
            padding: 4px 10px;
            border-radius: 15px;
            display: inline-block;
            margin-top: 10px;
            font-size: 9pt;
        }
        
        /* PRINT OPTIMIZATIONS */
        @media print {
            body {
                font-size: 10pt;
            }
            
            .patient-info-card {
                background: #f8fdf9 !important;
                -webkit-print-color-adjust: exact;
            }
            
            .section-content {
                box-shadow: none !important;
            }
            
            @page {
                margin: 15mm;
            }
            
            .no-print {
                display: none;
            }
        }
        
        /* UTILITY CLASSES */
        .text-center { text-align: center; }
        .mb-10 { margin-bottom: 10px; }
        .mb-15 { margin-bottom: 15px; }
        .mt-10 { margin-top: 10px; }
        .mt-15 { margin-top: 15px; }
    </style>
</head>

<body onload="window.print(); window.onafterprint = () => window.close();">

@php
    // Khmer numbers array
    $khmerNumbers = ['០','១','២','៣','៤','៥','៦','៧','៨','៩'];
    
    // Helper function to convert to Khmer numbers
    $toKhmer = function($number) use ($khmerNumbers) {
        return str_replace(range(0, 9), $khmerNumbers, (string)$number);
    };
    
    // Khmer months for date formatting
    $khmerMonths = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'];
@endphp

<!-- PRESCRIPTION HEADER -->
<div class="prescription-header">
    <div style="display: flex; align-items: center;">
        <img src="{{ asset('img/Logo-Xavier.png') }}" class="clinic-logo" alt="គ្លីនិកសុខភាពសាលា">
        <div class="clinic-details">
            <div class="clinic-name-kh">គ្លីនិកសុខភាពសាលាសន្តសាវីយេ</div>
            <div class="clinic-name-en">Xavier School Health Clinic</div>
            <div class="clinic-contact">
                អ៊ីមែល៖ {{ auth()->user()->email ?? 'មិនមានអ៊ីមែល' }}
            </div>
        </div>
    </div>
    
    <div class="prescription-number">
        <div class="rx-symbol">℞</div>
        <div class="rx-text prescription-id">លេខសម្គាល់: {{ str_pad($history->id, 6, '0', STR_PAD_LEFT) }}</div>
    </div>
</div>

<!-- PRESCRIPTION TITLE -->
<div class="prescription-title">
    <div class="title-decoration"></div>
    <div class="title-main">វេជ្ជបញ្ជា</div>
    <div class="title-sub">Medical Prescription</div>
</div>

<!-- PATIENT INFORMATION -->
<div class="patient-info-card">
    <div class="info-grid">
        <div class="info-item">
            <span class="info-label">ឈ្មោះអ្នកជំងឺ:</span>
            <span class="info-value">{{ $patient->name }}</span>
        </div>
        
        <div class="info-item">
            <span class="info-label">អាយុ:</span>
            <span class="info-value">{{ $patient->age ?? '-' }} ឆ្នាំ</span>
        </div>
        
        <div class="info-item">
            <span class="info-label">ភេទ:</span>
            <span class="info-value">{{ $patient->sex == 'Male' ? 'ប្រុស' : 'ស្រី' }}</span>
        </div>
        
        <div class="info-item">
            <span class="info-label">ប្រភេទ:</span>
            <span class="info-value">
                @if($patient->patient_type == 'student')
                    សិស្ស
                @elseif($patient->patient_type == 'teacher')
                    គ្រូបង្រៀន
                @else
                    បុគ្គលិក
                @endif
            </span>
        </div>
        
        <div class="info-item">
            <span class="info-label">ថ្នាក់/កម្រិត:</span>
            <span class="info-value">{{ $patient->grade_or_level ?? 'មិនមានទិន្នន័យ' }}</span>
        </div>
        
        <div class="info-item">
            <span class="info-label">កាលបរិច្ឆេទ:</span>
            <span class="info-value">
                {{ $toKhmer($history->created_at->format('d')) }} 
                {{ $khmerMonths[$history->created_at->month - 1] }} 
                {{ $toKhmer($history->created_at->year) }}
            </span>
        </div>
    </div>
</div>

<!-- CHIEF COMPLAINT -->
<div class="prescription-section">
    <div class="section-header">
        <div class="section-icon">១</div>
        <div class="section-title">អាការៈចម្បង</div>
        <div class="section-title-en">Chief Complaint</div>
    </div>
    <div class="section-content">
        {{ $history->complaint }}
    </div>
</div>

<!-- INTERVENTION -->
<div class="prescription-section">
    <div class="section-header">
        <div class="section-icon">២</div>
        <div class="section-title">ការអន្តរាគមន៍</div>
        <div class="section-title-en">Intervention</div>
    </div>
    <div class="section-content">
        {{ $history->intervention ?? 'មិនមានការអន្តរាគមន៍ពិសេស' }}
    </div>
</div>

<!-- TREATMENT / PRESCRIPTION -->
<div class="prescription-section">
    <div class="section-header">
        <div class="section-icon">៣</div>
        <div class="section-title">ការព្យាបាល / វេជ្ជបញ្ជា</div>
        <div class="section-title-en">Treatment / Prescription</div>
    </div>
    <div class="section-content">
        {!! nl2br(e($history->treatment ?? 'មិនមានវេជ្ជបញ្ជាពិសេស')) !!}
        
        @if(strpos(strtolower($history->treatment ?? ''), 'tab') !== false || 
            strpos(strtolower($history->treatment ?? ''), 'cap') !== false ||
            strpos(strtolower($history->treatment ?? ''), 'syrup') !== false)
        <div class="mt-10">
            <span class="highlight">សំគាល់៖</span> សូមទទួលទានថ្នាំតាមការណែនាំរបស់គិលានុបដ្ឋាយិកា។
        </div>
        @endif
    </div>
</div>

<!-- ADVICE / FOLLOW-UP (Optional section) -->
{{-- @if(!empty($history->intervention) || !empty($history->treatment))
<div class="prescription-section">
    <div class="section-header">
        <div class="section-icon">៤</div>
        <div class="section-title">ដំបូន្មាន / ការតាមដាន</div>
        <div class="section-title-en">Advice / Follow-up</div>
    </div>
    <div class="section-content">
        • សម្រាកគ្រប់គ្រាន់ និងផឹកទឹកឲ្យបានច្រើន<br>
        • ត្រឡប់មកពិនិត្យឡើងវិញ ប្រសិនបើរោគសញ្ញាមិនបានធូរស្រាល<br>
        • ទាក់ទងគ្លីនិក ប្រសិនបើមានអាការៈធ្ងន់ធ្ងរ
    </div>
</div>
@endif --}}

<!-- SIGNATURE SECTION -->
<div class="signature-section">
    <div class="signature-grid">
        <div class="signature-box">
            <div class="doctor-info">
                <div class="text-center mt-15" style="font-size: 12pt; color: #666;">
                    ថ្ងៃទី {{ $toKhmer($history->created_at->format('d')) }} 
                    ខែ {{ $khmerMonths[$history->created_at->month - 1] }} 
                    ឆ្នាំ {{ $toKhmer($history->created_at->year) }}
                </div>
                <div class="signature" style="color: #666;">ហត្ថលេខា និងត្រា</div>
                <br>
                <br>
                {{-- <div class="doctor-name">{{ $history->administered_by }}</div> --}}
                <div class="doctor-title">{{ auth()->user()->name ?? 'គិលានុបដ្ឋាយិកា' }}</div>
            </div>
            
        </div>
        
        {{-- <div class="signature-box">
            <div class="doctor-info">
                <div class="doctor-name">ប្រធានគ្លីនិក</div>
                <div class="doctor-title">គ្លីនិកសុខភាពសាលា</div>
            </div>
            <div class="signature-line">ហត្ថលេខា និងត្រា</div>
        </div> --}}
    </div>
    
    {{-- <div class="text-center mt-15" style="font-size: 10pt; color: #666;">
        ថ្ងៃទី {{ $toKhmer($history->created_at->format('d')) }} 
        ខែ {{ $khmerMonths[$history->created_at->month - 1] }} 
        ឆ្នាំ {{ $toKhmer($history->created_at->year) }}
    </div> --}}
</div>

<!-- FOOTER -->
<div class="prescription-footer">
    <div class="footer-text">--- វេជ្ជបញ្ជានេះមានសុពលភាពក្នុងរយៈពេល ៧ថ្ងៃ ---</div>
    <div>គ្លីនិកសុខភាពសាលាសន្តសាវីយេ</div>
    {{-- <div class="prescription-id">
        លេខសម្គាល់វេជ្ជបញ្ជា: {{ str_pad($history->id, 6, '0', STR_PAD_LEFT) }}
    </div> --}}
</div>

</body>
</html>