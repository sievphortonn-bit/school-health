@extends('layouts.app')
@section('title','ផ្ទាំងគ្រប់គ្រងទូទៅ')

@section('content')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Battambang:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<style>
:root {
    --primary: #355912;
    --secondary: #F2BF27;
    --warning: #F2921D;
    --danger: #C1312D;
    --success: #10710f;
    --dark: #402709;
    --light: #f8f9fa;
    --border-radius: 16px;
    --card-shadow: 0 10px 30px rgba(0,0,0,0.05);
    --card-shadow-hover: 0 20px 40px rgba(53, 89, 18, 0.15);
    --transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

body { 
    font-family: 'Inter', 'Battambang', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
}

/* ============= DASHBOARD HEADER ============= */
.dashboard-header-glass {
    background: var(--primary);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(53, 89, 18, 0.3);
    border-radius: 24px;
    padding: 25px 30px;
    color: white;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
}

.dashboard-header-glass::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    pointer-events: none;
}

.dashboard-header-glass h1, 
.dashboard-header-glass p {
    position: relative;
    z-index: 2;
}

.dashboard-header-glass h1 i {
    color: var(--warning);
}

/* ============= KPI CARDS - GLASS STYLE ============= */
.kpi-card {
    background: white;
    border: none;
    border-radius: 20px;
    box-shadow: var(--card-shadow);
    transition: var(--transition);
    overflow: hidden;
    height: 100%;
    position: relative;
}

.kpi-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--card-shadow-hover);
}

.kpi-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
}

.kpi-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 15px;
    color: white;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.kpi-icon-1 { background: linear-gradient(135deg, var(--primary), #4d7a1a); }
.kpi-icon-2 { background: linear-gradient(135deg, var(--success), #2e8b57); }
.kpi-icon-3 { background: linear-gradient(135deg, var(--warning), #f5a623); }
.kpi-icon-4 { background: linear-gradient(135deg, var(--danger), #ff6b6b); }

.counter {
    font-size: 34px;
    font-weight: 800;
    color: var(--dark);
    line-height: 1.2;
    margin: 5px 0;
}

.kpi-trend {
    font-size: 13px;
    padding: 4px 12px;
    border-radius: 30px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
}

.trend-up { 
    background: rgba(16, 113, 15, 0.1); 
    color: var(--success); 
}
.trend-down { 
    background: rgba(193, 49, 45, 0.1); 
    color: var(--danger); 
}

/* ============= STATS CARDS ============= */
.stat-card-modern {
    background: white;
    border-radius: 20px;
    padding: 20px;
    box-shadow: var(--card-shadow);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: var(--transition);
    height: 100%;
}

.stat-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: var(--card-shadow-hover);
}

.stat-icon-glass {
    width: 55px;
    height: 55px;
    background: rgba(53, 89, 18, 0.1);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: var(--primary);
}

.stat-info h6 {
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 5px;
    font-weight: 600;
}

.stat-info span {
    font-size: 26px;
    font-weight: 700;
    color: var(--dark);
    line-height: 1;
}

/* ============= GROWTH CARD ============= */
.growth-card {
    background: white;
    border-radius: 20px;
    padding: 20px 25px;
    box-shadow: var(--card-shadow);
    transition: var(--transition);
}

.growth-card:hover {
    box-shadow: var(--card-shadow-hover);
    transform: translateY(-3px);
}

/* ============= CHART CONTAINERS ============= */
.chart-container {
    background: white;
    border-radius: 20px;
    padding: 22px;
    box-shadow: var(--card-shadow);
    transition: var(--transition);
    height: 100%;
}

.chart-container:hover {
    box-shadow: var(--card-shadow-hover);
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}

.chart-title {
    font-weight: 700;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 16px;
}

.chart-title i {
    color: var(--primary);
    font-size: 18px;
}

.chart-box {
    position: relative;
    height: 280px;
    width: 100%;
}

/* ============= TABLE STYLES ============= */
.recent-activities-card {
    background: white;
    border-radius: 20px;
    padding: 22px;
    box-shadow: var(--card-shadow);
    height: 100%;
}

.patient-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
}

.patient-table thead th {
    background: rgba(53, 89, 18, 0.08);
    color: var(--primary);
    font-weight: 700;
    padding: 12px 15px;
    border: none;
    border-radius: 12px;
    font-size: 13px;
}

.patient-table tbody tr {
    background: #f8f9fa;
    border-radius: 12px;
    transition: var(--transition);
}

.patient-table tbody tr:hover {
    background: rgba(53, 89, 18, 0.05);
    transform: translateX(5px);
}

.patient-table tbody td {
    padding: 12px 15px;
    border: none;
    vertical-align: middle;
}

/* ============= STATUS BADGES ============= */
.status-badge {
    padding: 5px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-new { background: rgba(53, 89, 18, 0.1); color: var(--primary); }
.status-followup { background: rgba(242, 146, 29, 0.1); color: var(--warning); }
.status-emergency { background: rgba(193, 49, 45, 0.1); color: var(--danger); }

/* ============= BUTTON GLASS ============= */
.btn-glass-light {
    background: white;
    border: 2px solid #e9ecef;
    color: var(--dark);
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: var(--transition);
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.02);
}

.btn-glass-light:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(53, 89, 18, 0.2);
}

.btn-glass-light i {
    color: var(--primary);
    transition: var(--transition);
}

.btn-glass-light:hover i {
    color: white;
}

.btn-glass-light-sm {
    padding: 6px 14px;
    font-size: 12px;
}

/* ============= STATS BADGE HEADER ============= */
.stats-badge-glass {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50px;
    padding: 10px 20px;
    color: white;
    display: inline-flex;
    align-items: center;
    gap: 12px;
}

.stats-badge-glass i {
    color: var(--warning);
    font-size: 20px;
}

.stats-badge-glass small {
    color: rgba(255,255,255,0.9);
}

/* ============= RESPONSIVE ============= */
@media (max-width: 768px) {
    .dashboard-header-glass {
        padding: 20px;
    }
    
    .counter {
        font-size: 26px;
    }
    
    .kpi-icon {
        width: 50px;
        height: 50px;
        font-size: 22px;
    }
    
    .chart-box {
        height: 220px;
    }
    
    .patient-table thead th {
        font-size: 12px;
        padding: 10px;
    }
    
    .patient-table tbody td {
        font-size: 12px;
        padding: 10px;
    }
}

/* ============= KHMER NUMBERS ============= */
.khmer-number {
    font-family: 'Battambang', sans-serif;
}

/* ============= ANIMATIONS ============= */
@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fadeInUp 0.5s ease;
}

/* ============= TOAST ============= */
.toast-modern {
    border: none;
    border-radius: 14px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    background: white;
    padding: 12px 20px;
    animation: slideInRight 0.3s ease;
    border-left: 4px solid var(--success);
}

.toast-error {
    border-left-color: var(--danger);
}

/* ============= ACTIVE BUTTON STATE ============= */
.btn-group .btn.active {
    background: var(--primary) !important;
    color: white !important;
    border-color: var(--primary) !important;
}
</style>

<div class="container-fluid px-4 py-4 animate-fade-in">
    
    {{-- ============= GLASS DASHBOARD HEADER ============= --}}
    <div class="dashboard-header-glass d-flex flex-wrap align-items-center justify-content-between">
        <div>
            <h1 class="fw-bold mb-2">
                <i class="fas fa-chart-pie me-2"></i>
                ផ្ទាំងគ្រប់គ្រងប្រព័ន្ធសុខភាព
            </h1>
            {{-- <p class="mb-0 opacity-75 fs-6">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ now()->locale('km')->translatedFormat('dddd, DD MMMM YYYY') }}
            </p> --}}
        </div>
        <div class="d-flex gap-3 align-items-center">
            <div class="stats-badge-glass">
                <i class="fas fa-clock"></i>
                <div>
                    <div id="current-time" class="fw-bold">{{ now()->format('h:i A') }}</div>
                    <small id="current-date">{{ now()->translatedFormat('l, F j, Y') }}</small>
                </div>
            </div>
            <button class="btn-glass-light" onclick="refreshDashboard()" id="refreshBtn">
                <i class="fas fa-sync-alt"></i>
                ធ្វើឲ្យទាន់សម័យ
            </button>
        </div>
    </div>

    {{-- ============= KPI CARDS - GLASS STYLE ============= --}}
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="card-body p-4">
                    <div class="kpi-icon kpi-icon-1">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <div class="mb-1 text-muted fw-semibold">អ្នកជំងឺថ្ងៃនេះ</div>
                    <div class="counter" data-target="{{ $patientsToday }}">0</div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        {{-- @php
                            
                            
                            if ($yesterday > 0) {
                                $percentage = round((($today - $yesterday) / $yesterday) * 100, 1);
                            } else {
                                $percentage = 0;
                            }

                            $trendToday = $percentage . '%';

                            if ($percentage > 0) {
                                $trendTodayClass = 'trend-up';
                                $trendTodayIcon = 'fa-arrow-up';
                            } elseif ($percentage < 0) {
                                $trendTodayClass = 'trend-down';
                                $trendTodayIcon = 'fa-arrow-down';
                            } else {
                                $trendTodayClass = 'trend-neutral';
                                $trendTodayIcon = 'fa-minus';
                            }
                        @endphp --}}

                       
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="card-body p-4">
                    <div class="kpi-icon kpi-icon-2">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="mb-1 text-muted fw-semibold">អ្នកជំងឺខែនេះ</div>
                    <div class="counter" data-target="{{ $patientsMonth }}">0</div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="card-body p-4">
                    <div class="kpi-icon kpi-icon-3">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="mb-1 text-muted fw-semibold">អ្នកជំងឺឆ្នាំនេះ</div>
                    <div class="counter" data-target="{{ $patientsYear }}">0</div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="kpi-card">
                <div class="card-body p-4">
                    <div class="kpi-icon kpi-icon-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="mb-1 text-muted fw-semibold">សរុបអ្នកជំងឺទាំងអស់</div>
                    <div class="counter" data-target="{{ $totalPatients }}">0</div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============= TODAY'S STATISTICS - GLASS CARDS ============= --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card-modern">
                <div class="stat-icon-glass" style="background: rgba(242, 146, 29, 0.1); color: var(--warning);">
                    <i class="fas fa-sun"></i>
                </div>
                <div class="stat-info">
                    <h6>ពេលព្រឹក</h6>
                    <span>{{ $todayStats['morning'] ?? 0 }}</span>
                    <small class="text-muted d-block">៦ព្រឹក-១២ថ្ងៃត្រង់</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="stat-card-modern">
                <div class="stat-icon-glass" style="background: rgba(53, 89, 18, 0.1); color: var(--primary);">
                    <i class="fas fa-cloud-sun"></i>
                </div>
                <div class="stat-info">
                    <h6>ពេលរសៀល</h6>
                    <span>{{ $todayStats['afternoon'] ?? 0 }}</span>
                    <small class="text-muted d-block">១២ថ្ងៃត្រង់-៦ល្ងាច</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="stat-card-modern">
                <div class="stat-icon-glass" style="background: rgba(193, 49, 45, 0.1); color: var(--danger);">
                    <i class="fas fa-moon"></i>
                </div>
                <div class="stat-info">
                    <h6>ពេលយប់</h6>
                    <span>{{ $todayStats['evening'] ?? 0 }}</span>
                    <small class="text-muted d-block">៦ល្ងាច-១២យប់</small>
                </div>
            </div>
        </div>
    </div>

    {{-- ============= GROWTH RATE CARD ============= --}}
    {{-- <div class="row mb-4">
        <div class="col-12">
            <div class="growth-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon-glass" style="background: rgba(16, 113, 15, 0.1);">
                            <i class="fas fa-chart-line" style="color: var(--success);"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">អត្រាកំណើនប្រចាំខែ</h6>
                            <p class="mb-0 text-muted small">ប្រៀបធៀបនឹងខែមុន</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold fs-2" style="color: {{ $growthRate >= 0 ? 'var(--success)' : 'var(--danger)' }};">
                            {{ $growthRate >= 0 ? '+' : '' }}{{ number_format($growthRate, 1) }}%
                        </span>
                        <div class="mt-1">
                            <span class="badge px-3 py-2 rounded-pill" style="background: {{ $growthRate >= 0 ? 'rgba(16, 113, 15, 0.1)' : 'rgba(193, 49, 45, 0.1)' }}; color: {{ $growthRate >= 0 ? 'var(--success)' : 'var(--danger)' }};">
                                <i class="fas fa-arrow-{{ $growthRate >= 0 ? 'up' : 'down' }} me-1"></i>
                                {{ $growthRate >= 0 ? 'កំណើន' : 'ថយចុះ' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- ============= MAIN CHARTS ROW ============= --}}
    <div class="row g-4 mb-4" >
        <div class="col-xl-4">
            <div class="chart-container">
                <div class="chart-header">
                    <div class="chart-title">
                        <i class="fas fa-stethoscope"></i> រោគសញ្ញាកំពូល
                    </div>
                    <input type="number" class="form-control form-control-sm w-auto" id="topCount" value="5" min="3" max="10" style="width: 70px; border-radius: 30px; border: 2px solid #e9ecef;" onchange="updateTopSymptoms(this.value)">
                </div>
                <div class="chart-box">
                    <canvas id="illnessChart"></canvas>
                </div>
                <div class="mt-3">
                    @foreach($illness->take(3) as $symptom => $count)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-truncate" style="max-width: 70%; color: var(--dark);">{{ $symptom }}</small>
                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(53, 89, 18, 0.1); color: var(--primary);">{{ $count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="chart-container">
                <div class="chart-header">
                    <div class="chart-title">
                        <i class="fas fa-venus-mars"></i> ការបែងចែកភេទ
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-glass-light btn-glass-light-sm" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#" onclick="downloadChart('genderChart')"><i class="fas fa-download me-2"></i> ទាញយក</a></li>
                            <li><a class="dropdown-item" href="#" onclick="toggleChartView('genderChart')"><i class="fas fa-exchange-alt me-2"></i> ប្ដូរទិដ្ឋភាព</a></li>
                        </ul>
                    </div>
                </div>
                <div class="chart-box">
                    <canvas id="genderChart"></canvas>
                </div>
                <div class="row mt-3 text-center">
                    <div class="col-6">
                        <div class="p-3 rounded-3" style="background: rgba(53, 89, 18, 0.05);">
                            <small class="d-block fw-bold" style="color: var(--primary);">ប្រុស</small>
                            <span class="h4 fw-bold" style="color: var(--dark);">{{ $male }}</span>
                            <small class="d-block text-muted">{{ $male + $female > 0 ? round(($male/($male+$female))*100) : 0 }}%</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3" style="background: rgba(193, 49, 45, 0.05);">
                            <small class="d-block fw-bold" style="color: var(--danger);">ស្រី</small>
                            <span class="h4 fw-bold" style="color: var(--dark);">{{ $female }}</span>
                            <small class="d-block text-muted">{{ $male + $female > 0 ? round(($female/($male+$female))*100) : 0 }}%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="chart-container">
                <div class="chart-header">
                    <div class="chart-title">
                        <i class="fas fa-user-tag"></i> ប្រភេទអ្នកជំងឺ
                    </div>
                    <select class="form-select form-select-sm w-auto" id="typeChartFilter" onchange="updateTypeChart(this.value)" style="border-radius: 30px; border: 2px solid #e9ecef;">
                        <option value="doughnut">ដូណាត់</option>
                        <option value="pie">ផាយ</option>
                        <option value="bar">របារ</option>
                    </select>
                </div>
                <div class="chart-box">
                    <canvas id="typeChart"></canvas>
                </div>
                <div class="mt-3">
                    @foreach($typeStats as $type => $count)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <span class="badge rounded-circle me-2" style="width: 12px; height: 12px; background: {{ ['#355912','#F2BF27','#10710f','#C1312D'][$loop->index % 4] }};"></span>
                            <small style="color: var(--dark);">{{ $type }}</small>
                        </div>
                        <div>
                            <span class="fw-bold">{{ $count }}</span>
                            <small class="text-muted ms-1">({{ round(($count/$typeStats->sum())*100) }}%)</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ============= SECONDARY CHARTS ROW ============= --}}
    <div class="row g-4 mb-4">
        <div class="col-xl-8">
            <div class="recent-activities-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="chart-title">
                        <i class="fas fa-history"></i> សកម្មភាពអ្នកជំងឺថ្មីៗ
                    </div>
                    <button class="btn-glass-light btn-glass-light-sm" onclick="loadMoreActivities()">
                        <i class="fas fa-redo-alt"></i> ទាញយកថែម
                    </button>
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="patient-table">
                        <thead>
                            <tr>
                                <th>ល.រ</th>
                                <th>ឈ្មោះ</th>
                                <th>រោគសញ្ញា</th>
                                <th>ប្រភេទ</th>
                                <th>ពេលវេលា</th>
                                <th>សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody id="recentActivitiesBody">
                            @foreach($recent as $index => $r)
                            <tr>
                                <td><span class="fw-semibold" style="color: var(--primary);">{{ $loop->iteration }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 32px; height: 32px; background: rgba(53, 89, 18, 0.1); color: var(--primary); font-weight: 700;">
                                            {{ strtoupper(substr($r->patient->name, 0, 1)) }}
                                        </div>
                                        <span class="fw-medium">{{ $r->patient->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="max-width: 150px;" title="{{ $r->complaint }}">
                                        {{ \Illuminate\Support\Str::limit($r->complaint, 25) }}
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $typeBadgeClass = $r->patient->patient_type == 'student' ? 'status-new' : ($r->patient->patient_type == 'teacher' ? 'status-followup' : 'status-emergency');
                                        $typeText = $r->patient->patient_type == 'student' ? 'សិស្ស' : ($r->patient->patient_type == 'teacher' ? 'គ្រូ' : 'បុគ្គលិក');
                                    @endphp
                                    <span class="status-badge {{ $typeBadgeClass }}">{{ $typeText }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">{{ $r->created_at->format('d M') }}</small>
                                        <small class="fw-semibold">{{ $r->created_at->format('h:i A') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('patients.show', $r->patient_id) }}" class="btn btn-sm" 
                                       style="background: rgba(53, 89, 18, 0.1); color: var(--primary); border-radius: 30px; padding: 5px 15px; text-decoration: none;">
                                        <i class="fas fa-eye me-1"></i> មើល
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="chart-container">
                <div class="chart-header">
                    <div class="chart-title">
                        <i class="fas fa-chart-bar"></i> គំរូប្រចាំសប្តាហ៍
                    </div>
                    <button class="btn btn-glass-light btn-glass-light-sm" onclick="toggleWeeklyView()">
                        <i class="fas fa-exchange-alt"></i> ប្ដូរ
                    </button>
                </div>
                <div class="chart-box">
                    <canvas id="weeklyChart"></canvas>
                </div>
                <div class="row mt-3 text-center">
                    <div class="col-4">
                        <small class="text-muted d-block">សប្តាហ៍នេះ</small>
                        <span class="fw-bold">{{ $weekly->sum() }}</span>
                    </div>
                    <div class="col-4">
                        <small class="text-muted d-block">មធ្យម/ថ្ងៃ</small>
                        <span class="fw-bold">{{ round($weekly->avg()) }}</span>
                    </div>
                    <div class="col-4">
                        <small class="text-muted d-block">ថ្ងៃច្រើនជាងគេ</small>
                        <span class="fw-bold">{{ $weekly->max() }}</span>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    {{-- ============= RECENT ACTIVITIES ============= --}}
    
</div>

{{-- ============= TOAST NOTIFICATION CONTAINER ============= --}}
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;" id="toastContainer"></div>

<script>
// ============= GLOBAL VARIABLES =============
let charts = {};
let refreshInterval;
let realTimeInterval;

// ============= INITIALIZE CHARTS =============
function initCharts() {
    // Monthly Chart
    charts.monthlyChart = new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($monthly->keys()) !!},
            datasets: [{
                label: 'អ្នកជំងឺ',
                data: {!! json_encode($monthly->values()) !!},
                borderColor: '#355912',
                backgroundColor: 'rgba(53, 89, 18, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#355912',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(64, 39, 9, 0.95)',
                    titleFont: { size: 12, family: 'Battambang' },
                    bodyFont: { size: 12, family: 'Battambang' },
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(226, 232, 240, 0.5)' },
                    ticks: { color: '#64748b' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b' }
                }
            }
        }
    });

    // Weekly Chart
    charts.weeklyChart = new Chart(document.getElementById('weeklyChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($weekly->keys()) !!},
            datasets: [{
                data: {!! json_encode($weekly->values()) !!},
                backgroundColor: 'rgba(53, 89, 18, 0.8)',
                borderColor: 'rgba(53, 89, 18, 1)',
                borderWidth: 1,
                borderRadius: 6,
                hoverBackgroundColor: 'rgba(53, 89, 18, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(226, 232, 240, 0.5)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Type Chart
    charts.typeChart = new Chart(document.getElementById('typeChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($typeStats->keys()) !!},
            datasets: [{
                data: {!! json_encode($typeStats->values()) !!},
                backgroundColor: ['#355912', '#F2BF27', '#10710f', '#C1312D', '#6c757d'],
                borderColor: 'white',
                borderWidth: 2,
                spacing: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 11 },
                    formatter: (value, context) => {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((value / total) * 100);
                        return percentage + '%';
                    }
                }
            },
            cutout: '65%'
        }
    });

    // Gender Chart
    charts.genderChart = new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: ['ប្រុស', 'ស្រី'],
            datasets: [{
                data: [{{ $male }}, {{ $female }}],
                backgroundColor: ['rgba(53, 89, 18, 0.9)', 'rgba(193, 49, 45, 0.9)'],
                borderColor: 'white',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        color: '#1a1a1a',
                        font: { size: 12, family: 'Battambang' }
                    }
                },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 12 },
                    formatter: (value, context) => {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((value / total) * 100);
                        return percentage + '%';
                    }
                }
            }
        }
    });

    // Illness Chart
    charts.illnessChart = new Chart(document.getElementById('illnessChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($illness->keys()) !!},
            datasets: [{
                data: {!! json_encode($illness->values()) !!},
                backgroundColor: 'rgba(193, 49, 45, 0.8)',
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: { display: false },
                datalabels: {
                    color: '#fff',
                    anchor: 'end',
                    align: 'right',
                    font: { weight: 'bold', size: 11 }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { display: false }
                },
                y: {
                    grid: { display: false }
                }
            }
        }
    });
}

// ============= COUNTER ANIMATION =============
function animateCounters() {
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.dataset.target);
        if (target === 0) {
            counter.innerText = '0';
            return;
        }
        
        const duration = 2000;
        const startTime = performance.now();
        
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const currentValue = Math.floor(easeOutQuart * target);
            counter.innerText = currentValue.toLocaleString();
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };
        
        requestAnimationFrame(animate);
    });
}

// ============= REAL-TIME CLOCK =============
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit',
        second: '2-digit',
        hour12: true 
    });
    
    const days = ['អាទិត្យ', 'ច័ន្ទ', 'អង្គារ', 'ពុធ', 'ព្រហស្បតិ៍', 'សុក្រ', 'សៅរ៍'];
    const months = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'];
    
    const dayName = days[now.getDay()];
    const monthName = months[now.getMonth()];
    const dateString = `${dayName}, ${monthName} ${now.getDate()}, ${now.getFullYear()}`;
    
    const timeElement = document.getElementById('current-time');
    const dateElement = document.getElementById('current-date');
    
    if (timeElement) timeElement.innerHTML = timeString;
    if (dateElement) dateElement.innerHTML = dateString;
}

// ============= UPDATE CHART TYPE =============
function updateChartType(chartId, type, btn, isArea = false) {
    if (charts[chartId]) {
        // Update button active state
        if (btn) {
            document.querySelectorAll(`#${chartId}Toggle .btn`).forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        
        // Update chart type
        if (isArea) {
            charts[chartId].config.type = 'line';
            charts[chartId].data.datasets[0].fill = true;
            charts[chartId].data.datasets[0].backgroundColor = 'rgba(53, 89, 18, 0.1)';
        } else {
            charts[chartId].config.type = type;
            if (type === 'line') {
                charts[chartId].data.datasets[0].fill = true;
                charts[chartId].data.datasets[0].backgroundColor = 'rgba(53, 89, 18, 0.1)';
            } else if (type === 'bar') {
                charts[chartId].data.datasets[0].fill = false;
                charts[chartId].data.datasets[0].backgroundColor = 'rgba(53, 89, 18, 0.8)';
            }
        }
        
        charts[chartId].update();
        showNotification('បានប្ដូរទិដ្ឋភាពតារាង', 'info');
    }
}

// ============= UPDATE TYPE CHART =============
function updateTypeChart(type) {
    if (charts.typeChart) {
        charts.typeChart.config.type = type;
        if (type === 'doughnut' || type === 'pie') {
            charts.typeChart.config.options.cutout = type === 'doughnut' ? '65%' : 0;
        }
        charts.typeChart.update();
    }
}

// ============= TOGGLE WEEKLY VIEW =============
function toggleWeeklyView() {
    const chart = charts.weeklyChart;
    if (chart.config.type === 'bar') {
        chart.config.type = 'line';
        chart.data.datasets[0].backgroundColor = 'rgba(53, 89, 18, 0.1)';
        chart.data.datasets[0].borderColor = 'rgba(53, 89, 18, 1)';
        chart.data.datasets[0].fill = true;
    } else {
        chart.config.type = 'bar';
        chart.data.datasets[0].backgroundColor = 'rgba(53, 89, 18, 0.8)';
        chart.data.datasets[0].borderColor = 'rgba(53, 89, 18, 1)';
        chart.data.datasets[0].fill = false;
    }
    chart.update();
    showNotification('បានប្ដូរទិដ្ឋភាពតារាងប្រចាំសប្តាហ៍', 'success');
}

// ============= UPDATE TOP SYMPTOMS =============
function updateTopSymptoms(limit) {
    // This would normally fetch new data from server
    showNotification(`បង្ហាញរោគសញ្ញាកំពូល ${limit} ប្រភេទ`, 'info');
}

// ============= DOWNLOAD CHART =============
function downloadChart(chartId) {
    const canvas = document.getElementById(chartId);
    if (canvas) {
        const link = document.createElement('a');
        link.download = `${chartId}-${new Date().toISOString().split('T')[0]}.png`;
        link.href = canvas.toDataURL('image/png');
        link.click();
        showNotification('បានទាញយករូបភាពតារាង', 'success');
    }
}

// ============= TOGGLE CHART VIEW =============
function toggleChartView(chartId) {
    if (chartId === 'genderChart' && charts.genderChart) {
        const currentType = charts.genderChart.config.type;
        charts.genderChart.config.type = currentType === 'pie' ? 'doughnut' : 'pie';
        charts.genderChart.update();
        showNotification('បានប្ដូរទិដ្ឋភាពតារាង', 'success');
    }
}

// ============= REFRESH DASHBOARD =============
function refreshDashboard() {
    const btn = document.getElementById('refreshBtn');
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> កំពុងធ្វើឲ្យទាន់សម័យ...';
    btn.disabled = true;
    
    setTimeout(() => {
        updateStats();
        btn.innerHTML = originalHTML;
        btn.disabled = false;
        showNotification('ផ្ទាំងគ្រប់គ្រងត្រូវបានធ្វើឲ្យទាន់សម័យដោយជោគជ័យ!', 'success');
    }, 1000);
}

// ============= UPDATE STATS =============
function updateStats() {
    const avgWait = document.getElementById('avg-wait-time');
    const bedOcc = document.getElementById('bed-occupancy');
    const doctorAvail = document.getElementById('doctor-availability');
    const satisRate = document.getElementById('satisfaction-rate');
    
    if (avgWait) avgWait.textContent = Math.floor(Math.random() * 10) + 15;
    if (bedOcc) bedOcc.textContent = Math.floor(Math.random() * 15) + 70 + '%';
    if (doctorAvail) doctorAvail.textContent = `${Math.floor(Math.random() * 4) + 11}/15`;
    if (satisRate) satisRate.textContent = Math.floor(Math.random() * 6) + 90 + '%';
}

// ============= LOAD MORE ACTIVITIES =============
function loadMoreActivities() {
    showNotification('កំពុងទាញយកសកម្មភាពថ្មីៗ...', 'info');
    
    setTimeout(() => {
        showNotification('ទាញយកសកម្មភាពថ្មីៗបានជោគជ័យ', 'success');
    }, 1500);
}

// ============= SHOW NOTIFICATION =============
function showNotification(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    
    const toast = document.createElement('div');
    toast.className = 'toast-modern d-flex align-items-center mb-2';
    if (type === 'error') toast.classList.add('toast-error');
    
    let icon = type === 'success' ? 'fa-check-circle' : (type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle');
    let color = type === 'success' ? 'var(--success)' : (type === 'error' ? 'var(--danger)' : 'var(--primary)');
    
    toast.style.borderLeft = `4px solid ${color}`;
    toast.innerHTML = `
        <div class="d-flex align-items-center gap-3 p-2">
            <i class="fas ${icon}" style="color: ${color}; font-size: 20px;"></i>
            <div class="fw-semibold" style="color: var(--dark);">${message}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.toast-modern').remove()"></button>
        </div>
    `;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

// ============= INITIALIZE =============
document.addEventListener('DOMContentLoaded', function() {
    initCharts();
    animateCounters();
    updateClock();
    updateStats();
    
    // Real-time clock update
    setInterval(updateClock, 1000);
    
    // Auto-refresh every 2 minutes
    refreshInterval = setInterval(() => {
        refreshDashboard();
    }, 120000);
    
    // Real-time stats update if enabled
    realTimeInterval = setInterval(() => {
        if (document.getElementById('realTimeSwitch')?.checked) {
            updateStats();
            showNotification('បានធ្វើឲ្យទិន្នន័យទាន់សម័យ', 'info');
        }
    }, 10000);
});
</script>

@endsection