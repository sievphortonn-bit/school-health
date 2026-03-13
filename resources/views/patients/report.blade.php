@extends('layouts.app')
@section('title','របាយការណ៍អ្នកជំងឺ')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
    body, .navbar, .sidebar {
        font-family: 'Inter', 'Battambang', sans-serif;
    }
    /* Additional fine‑tuning for the report page */
    .report-filter-group {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 16px;
    }
    .quick-filter-group {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .summary-stat-card {
        background: white;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: var(--card-shadow);
        display: flex;
        align-items: center;
        gap: 16px;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .summary-stat-card i {
        font-size: 32px;
        color: var(--primary);
    }
    .summary-stat-card .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: var(--dark);
        line-height: 1.2;
    }
    .summary-stat-card .stat-label {
        font-size: 14px;
        color: #6c757d;
    }
</style>

<div class="edit-container">
    <div class="modern-card">
        {{-- ================= GLASS HEADER ================= --}}
        <div class="card-header-gradient d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-clipboard-data fs-5"></i>
                <h5 class="mb-0 fw-bold">រាយការណ៍សុខភាពអ្នកជំងឺ</h5>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('patients.report.print', request()->query()) }}"
                   target="_blank"
                   class="btn-glass-light" style="text-decoration: none;">
                    <i class="bi bi-printer"></i> បោះពុម្ព ឬ PDF
                </a>
                {{-- <a href="{{ route('patients.report', request()->query()) }}"
                   class="btn-glass-light-dan">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                </a> --}}
            </div>
        </div>

        {{-- ================= BODY ================= --}}
        <div class="form-body">

            {{-- ================= FILTER FORM ================= --}}
            <form method="GET" class="report-filter-group mb-4">
                {{-- FROM --}}
                <div class="form-group-modern" style="flex: 1 1 180px;">
                    <div class="form-label-modern">
                        <i class="bi bi-calendar3"></i>
                        ពី
                    </div>
                    <div class="input-wrapper">
                        <i class="bi bi-arrow-right-circle input-icon"></i>
                        <input type="date" id="from" name="from"
                               value="{{ request('from') }}"
                               class="modern-input">
                    </div>
                </div>

                {{-- TO --}}
                <div class="form-group-modern" style="flex: 1 1 180px;">
                    <div class="form-label-modern">
                        <i class="bi bi-calendar3"></i>
                        ទៅ
                    </div>
                    <div class="input-wrapper">
                        <i class="bi bi-arrow-left-circle input-icon"></i>
                        <input type="date" id="to" name="to"
                               value="{{ request('to') }}"
                               class="modern-input">
                    </div>
                </div>

                {{-- TYPE --}}
                <div class="form-group-modern" style="flex: 0 1 180px;">
                    <div class="form-label-modern">
                        <i class="bi bi-tag-fill"></i>
                        ប្រភេទអ្នកជំងឺ
                    </div>
                    <div class="input-wrapper">
                        <i class="bi bi-grid-3x3-gap-fill input-icon"></i>
                        <select name="type" class="modern-select">
                            <option value="">ទាំងអស់</option>
                            <option value="student" {{ request('type')=='student'?'selected':'' }}>សិស្ស</option>
                            <option value="teacher" {{ request('type')=='teacher'?'selected':'' }}>គ្រូបង្រៀន</option>
                            <option value="staff"   {{ request('type')=='staff'?'selected':'' }}>បុគ្គលិកផ្សេង</option>
                        </select>
                    </div>
                </div>

                {{-- APPLY BUTTON --}}
                {{-- <div class="form-group-modern">
                    <div class="form-label-modern">&nbsp;</div>

                </div> --}}

                {{-- QUICK FILTERS – full width row --}}
                <div class="w-100">
                    <div class="form-label-modern mb-2">
                        <i class="bi bi-lightning-charge-fill"></i> លឿនៗ
                    </div>
                    <div class="filter-container quick-filter-group" id="quickFilters">
                        <button type="button" class="filter-btn" onclick="setToday(this)">ថ្ងៃនេះ</button>
                        <button type="button" class="filter-btn" onclick="setThisWeek(this)">សប្តាហ៍នេះ</button>
                        <button type="button" class="filter-btn" onclick="setLastWeek(this)">សប្តាហ៍មុន</button>
                        <button type="button" class="filter-btn" onclick="setLast2Weeks(this)">២ សប្តាហ៍មុន</button>
                        <button type="button" class="filter-btn" onclick="setThisMonth(this)">ខែនេះ</button>
                        <button type="button" class="filter-btn" onclick="setLastMonth(this)">ខែមុន</button>
                        <button type="button" class="filter-btn" onclick="setLast2Months(this)">២ ខែមុន</button>
                        <button type="button" class="filter-btn" onclick="setThisYear(this)">ឆ្នាំនេះ</button>
                        <button type="button" class="filter-btn" onclick="setLastYear(this)">ឆ្នាំមុន</button>
                        <button type="button" class="filter-btn" onclick="setLast2Years(this)">២ ឆ្នាំមុន</button>
                        <button type="button" class="btn-glass-light-war" style="width: auto; padding: 8px 18px;" onclick="resetFilter(this)">Reset</button>
                        <button type="submit" class="btn-glass-light-pri" style="width: auto;">
                            <i class="bi bi-search"></i> កំណត់
                        </button>
                    </div>
                </div>
            </form>

            {{-- ================= SUMMARY STAT CARD ================= --}}
            <div class="summary-stat-card mb-4 border-2" style="border-color: rgba(0, 0, 0, 0.1);">
                <i class="bi bi-bar-chart-fill"></i>
                <div>
                    <div class="stat-number">{{ $total }}</div>
                    <div class="stat-label">ចំនួនសរុប (អ្នកជំងឺ)</div>
                </div>
            </div>

            {{-- ================= MODERN TABLE ================= --}}
            <div class="table">
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th class="text-center">កាលបរិច្ឆេទ ម៉ោង</th>
                                <th class="text-center">អ្នកជំងឺ</th>
                                <th class="text-center">ប្រភេទ</th>
                                <th class="text-center">អាការៈ</th>
                                <th class="text-center">ការព្យាបាល</th>
                                <th class="text-center">កត់ត្រាដោយ</th>
                            </tr>
                        </thead>
                        @php
                            $khmerDays = ['អាទិត្យ', 'ច័ន្ទ', 'អង្គារ', 'ពុធ', 'ព្រហស្បតិ៍', 'សុក្រ', 'សៅរ៍'];
                            $khmerMonths = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'];
                            $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
                        @endphp
                        <tbody>
                            @forelse($histories as $h)
                            <tr>
                                <td class="text-center">
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">
                                            {{ $khmerDays[$h->created_at->dayOfWeek] }},
                                            {{ $khmerMonths[$h->created_at->month - 1] }}
                                            {{ str_replace(range(0,9), $khmerNumbers, $h->created_at->day) }},
                                            {{ str_replace(range(0,9), $khmerNumbers, $h->created_at->year) }}
                                        </small>
                                        <small class="fw-semibold">{{ $h->created_at->format('h:i A') }}</small>
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $h->patient->name }}</td>
                                <td class="text-center">
                                    @php
                                        $type = $h->patient->patient_type;
                                        $typeText = $type === 'student' ? 'សិស្ស' : ($type === 'teacher' ? 'គ្រូបង្រៀន' : 'បុគ្គលិក');
                                        $typeClass = $type === 'student' ? 'type-student' : ($type === 'teacher' ? 'type-teacher' : 'type-staff');
                                    @endphp
                                    <span class="type-badge {{ $typeClass }}">
                                        {{ $typeText }}
                                    </span>
                                </td>
                                <td>{{ $h->complaint }}</td>
                                <td>{{ $h->treatment }}</td>
                                <td>{{ $h->administered_by }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="bi bi-clipboard-data"></i>
                                    <p>មិនមានទិន្នន័យ</p>
                                    <small class="text-muted">សូមផ្លាស់ប្តូរលក្ខខណ្ឌតម្រង</small>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>{{-- /.form-body --}}
    </div>{{-- /.modern-card --}}
</div>{{-- /.edit-container --}}

<script>
/* ================= CORE ================= */
const fromInput = document.getElementById('from');
const toInput   = document.getElementById('to');

function formatLocalDate(d) {
    const y = d.getFullYear();
    const m = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${y}-${m}-${day}`;
}

function setRange(from, to, btn = null) {
    fromInput.value = formatLocalDate(from);
    toInput.value   = formatLocalDate(to);
    setActive(btn);
}

function setActive(btn) {
    document.querySelectorAll('#quickFilters .filter-btn').forEach(b => {
        b.classList.remove('active');
    });
    if (btn) {
        btn.classList.add('active');
    }
}

/* ================= QUICK FILTERS ================= */
function setToday(btn) {
    const d = new Date();
    setRange(d, d, btn);
}

function setThisWeek(btn) {
    const now = new Date();
    const first = new Date(now);
    first.setDate(now.getDate() - now.getDay());
    const last = new Date(first);
    last.setDate(first.getDate() + 6);
    setRange(first, last, btn);
}

function setLastWeek(btn) {
    const now = new Date();
    const first = new Date(now);
    first.setDate(now.getDate() - now.getDay() - 7);
    const last = new Date(first);
    last.setDate(first.getDate() + 6);
    setRange(first, last, btn);
}

function setLast2Weeks(btn) {
    const now = new Date();
    const first = new Date(now);
    first.setDate(now.getDate() - 13);
    setRange(first, now, btn);
}

function setThisMonth(btn) {
    const now = new Date();
    const first = new Date(now.getFullYear(), now.getMonth(), 1);
    const last  = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    setRange(first, last, btn);
}

function setLastMonth(btn) {
    const now = new Date();
    const first = new Date(now.getFullYear(), now.getMonth() - 1, 1);
    const last  = new Date(now.getFullYear(), now.getMonth(), 0);
    setRange(first, last, btn);
}

function setLast2Months(btn) {
    const now = new Date();
    const first = new Date(now.getFullYear(), now.getMonth() - 2, 1);
    const last  = new Date(now.getFullYear(), now.getMonth() - 1, 0);
    setRange(first, last, btn);
}

function setThisYear(btn) {
    const now = new Date();
    const first = new Date(now.getFullYear(), 0, 1);
    const last  = new Date(now.getFullYear(), 11, 31);
    setRange(first, last, btn);
}

function setLastYear(btn) {
    const now = new Date();
    const first = new Date(now.getFullYear() - 1, 0, 1);
    const last  = new Date(now.getFullYear() - 1, 11, 31);
    setRange(first, last, btn);
}

function setLast2Years(btn) {
    const now = new Date();
    const first = new Date(now.getFullYear() - 2, 0, 1);
    const last  = new Date(now.getFullYear() - 2, 11, 31);
    setRange(first, last, btn);
}

function resetFilter(btn) {
    fromInput.value = '';
    toInput.value   = '';
    setActive(null);
}
</script>

@endsection
