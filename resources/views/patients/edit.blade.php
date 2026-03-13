@extends('layouts.app')
@section('title','កែប្រែព័ត៌មានអ្នកជំងឺ '.$patient->name)
@section('content')

{{-- ================= STYLES ================= --}}
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"/>

<style>
    /* Override Selectize to match glass aesthetic */
    .selectize-input {
        border: 2px solid #e9ecef !important;
        border-radius: 14px !important;
        padding: 12px 16px !important;
        font-size: 14px !important;
        font-family: 'Inter', 'Battambang', sans-serif !important;
        box-shadow: none !important;
        line-height: 1.5 !important;
    }
    .selectize-input.focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 4px rgba(53, 89, 18, 0.1) !important;
    }
    .selectize-dropdown {
        border: 2px solid #e9ecef !important;
        border-radius: 14px !important;
        margin-top: 4px !important;
        box-shadow: var(--card-shadow) !important;
    }
    .selectize-dropdown .option.active {
        background: rgba(53, 89, 18, 0.1) !important;
        color: var(--primary) !important;
    }
</style>

{{-- ================= MODERN CARD ================= --}}
<div class="modern-card col-md-7">
    {{-- ================= GLASS PRIMARY HEADER ================= --}}
    <div class="card-header-gradient">
        <i class="bi bi-person-gear me-1"></i>
        <span class="fw-bold">កែប្រែព័ត៌មានអ្នកជំងឺ</span>
    </div>

    <div class="form-body">
        {{-- ================= PATIENT ID BADGE ================= --}}
        <div class="patient-id-badge">
            <i class="bi bi-upc-scan"></i>
            <div>
                <small class="text-muted d-block">អត្តលេខអ្នកជំងឺ</small>
                <span>{{ $patient->code }}</span>
            </div>
            <div class="ms-auto">
                <span class="badge px-3 py-2 rounded-pill" 
                      style="background: rgba(53,89,18,0.1); color: var(--primary); border: 1px solid rgba(53,89,18,0.2);">
                    ID: PT{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        <form method="POST" action="{{ route('patients.update', $patient->id) }}">
            @csrf
            @method('PUT')

            {{-- ================= PATIENT TYPE ================= --}}
            <div class="form-group-modern">
                <div class="form-label-modern">
                    <i class="bi bi-tag-fill"></i>
                    ប្រភេទអ្នកជំងឺ <span class="text-danger">*</span>
                </div>
                <div class="input-wrapper">
                    <i class="bi bi-grid-3x3-gap-fill input-icon"></i>
                    <select name="patient_type" id="patient_type" class="modern-select" required>
                        <option value="">— ជ្រើសរើសប្រភេទ —</option>
                        <option value="student" {{ $patient->patient_type=='student'?'selected':'' }}>សិស្ស</option>
                        <option value="teacher" {{ $patient->patient_type=='teacher'?'selected':'' }}>គ្រូបង្រៀន</option>
                        <option value="staff" {{ $patient->patient_type=='staff'?'selected':'' }}>បុគ្គលិក</option>
                    </select>
                </div>
            </div>

            {{-- ================= FILTER (CLASS / LEVEL) ================= --}}
            <div id="filter_box" class="form-group-modern d-none">
                <div class="form-label-modern" id="filter_label"></div>
                <div id="filter_buttons" class="d-flex flex-wrap gap-2"></div>
            </div>

            {{-- ================= PERSON SELECT ================= --}}
            <div class="form-group-modern mt-4">
                <div class="form-label-modern">
                    <i class="bi bi-person-badge-fill"></i>
                    ស្វែងរក & ជ្រើសរើសឈ្មោះ <span class="text-danger">*</span>
                </div>
                <select name="ref_id" id="ref_id" class="" required>
                    <option value="">— ស្វែងរក & ជ្រើសរើស —</option>
                </select>
                <div class="small text-muted mt-2">
                    <i class="bi bi-info-circle me-1"></i>
                    សូមជ្រើសរើសប្រភេទអ្នកជំងឺ និងតម្រងជាមុន
                </div>
            </div>

            <hr class="my-4">

            {{-- ================= ACTION BUTTONS ================= --}}
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-glass-light-pri flex-fill">
                    <i class="bi bi-save2 me-1"></i> រក្សាទុកការកែប្រែ
                </button>
                {{-- <a href="{{ route('patients.show', $patient->id) }}" 
                   class="btn-glass-light- flex-fill text-center text-decoration-none">
                    <i class="bi bi-x-lg me-1"></i> បោះបង់
                </a> --}}
            </div>

            <div class="mt-3">
                <a href="{{ route('patients.index') }}" class="btn-glass-light-war w-100 text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> ត្រឡប់ទៅបញ្ជីអ្នកជំងឺ
                </a>
            </div>

        </form>
    </div>
</div>

{{-- ================= SCRIPTS ================= --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>

<script>
/* ================= DATA ================= */
const students = @json($students);
const teachers = @json($teachers);
const staffs   = @json($staffs);

const currentType = "{{ $patient->patient_type }}";
const currentRef  = "{{ $patient->ref_id }}";

/* ================= SELECTIZE ================= */
let selectize;

$(document).ready(function() {
    selectize = $('#ref_id').selectize({
        valueField: 'id',
        labelField: 'label',
        searchField: 'label',
        create: false,
        placeholder: '— ស្វែងរកឈ្មោះ —',
        loadingClass: 'loading',
        render: {
            option: function(item, escape) {
                return `<div class="option">${escape(item.label)}</div>`;
            }
        }
    })[0].selectize;
    
    setTimeout(() => {
        document.getElementById('patient_type').dispatchEvent(new Event('change'));
        restoreSelection();
    }, 300);
});

/* ================= HELPERS ================= */
function unique(arr) {
    return [...new Set(arr)];
}

function resetAll() {
    selectize.clear();
    selectize.clearOptions();
    document.getElementById('filter_box').classList.add('d-none');
    document.getElementById('filter_buttons').innerHTML = '';
}

function activate(btn) {
    document.querySelectorAll('#filter_buttons .filter-btn').forEach(b => {
        b.classList.remove('btn-primary', 'active');
        b.classList.add('btn-outline-primary');
    });
    btn.classList.remove('btn-outline-primary');
    btn.classList.add('btn-primary', 'active');
}

function loadNames(list, labelFn, restore = false) {
    selectize.clear();
    selectize.clearOptions();

    selectize.addOption(
        list.map(x => ({ id: x.id, label: labelFn(x) }))
    );

    selectize.refreshOptions(false);

    if (restore && currentRef) {
        selectize.setValue(currentRef);
    }
}

/* ================= TYPE CHANGE ================= */
document.getElementById('patient_type').addEventListener('change', function () {
    resetAll();

    const box   = document.getElementById('filter_box');
    const label = document.getElementById('filter_label');
    const btns  = document.getElementById('filter_buttons');

    /* ===== STUDENT ===== */
    if (this.value === 'student') {
        box.classList.remove('d-none');
        label.innerHTML = '<i class="bi bi-diagram-3 me-1" style="color: var(--primary);"></i> ជ្រើសរើសថ្នាក់ <span class="text-danger">*</span>';

        unique(students.map(s => s.grade)).filter(g => g).forEach(g => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-outline-primary btn-sm filter-btn';
            btn.innerHTML = `<i class="bi bi-mortarboard me-1"></i> ${g}`;
            btn.onclick = () => {
                activate(btn);
                loadNames(
                    students.filter(s => s.grade === g),
                    s => `${s.code} | ${s.name}`,
                    false
                );
            };
            btns.appendChild(btn);
        });
    }

    /* ===== TEACHER ===== */
    if (this.value === 'teacher') {
        box.classList.remove('d-none');
        label.innerHTML = '<i class="bi bi-bar-chart-steps me-1" style="color: var(--primary);"></i> ជ្រើសរើសកម្រិត <span class="text-danger">*</span>';

        unique(teachers.map(t => t.level)).filter(l => l).forEach(l => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-outline-primary btn-sm filter-btn';
            btn.innerHTML = `<i class="bi bi-person-video3 me-1"></i> ${l}`;
            btn.onclick = () => {
                activate(btn);
                loadNames(
                    teachers.filter(t => t.level === l),
                    t => `${t.name}`,
                    false
                );
            };
            btns.appendChild(btn);
        });
    }

    /* ===== STAFF ===== */
    if (this.value === 'staff') {
        loadNames(
            staffs,
            s => `${s.code} | ${s.name} | ${s.role_kh || s.role || 'បុគ្គលិក'}`,
            true
        );
    }
});

/* ================= RESTORE EXISTING SELECTION ================= */
function restoreSelection() {
    if (!currentRef || !selectize) return;

    if (currentType === 'student') {
        const s = students.find(x => x.id == currentRef);
        if (!s) return;

        const gradeBtn = [...document.querySelectorAll('#filter_buttons .filter-btn')]
            .find(b => b.innerText.includes(s.grade));
        if (gradeBtn) gradeBtn.click();

        setTimeout(() => {
            loadNames(
                students.filter(x => x.grade === s.grade),
                x => `${x.code} | ${x.name}`,
                true
            );
        }, 100);
    }

    if (currentType === 'teacher') {
        const t = teachers.find(x => x.id == currentRef);
        if (!t) return;

        const levelBtn = [...document.querySelectorAll('#filter_buttons .filter-btn')]
            .find(b => b.innerText.includes(t.level));
        if (levelBtn) levelBtn.click();

        setTimeout(() => {
            loadNames(
                teachers.filter(x => x.level === t.level),
                x => x.name,
                true
            );
        }, 100);
    }
}
</script>

<style>
/* ============= PATIENT ID BADGE ============= */
.patient-id-badge {
    background: rgba(53, 89, 18, 0.08);
    padding: 12px 18px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
    border: 1px solid rgba(53, 89, 18, 0.15);
}
.patient-id-badge i {
    font-size: 20px;
    color: var(--primary);
}
.patient-id-badge span {
    font-weight: 700;
    color: var(--primary);
    font-size: 16px;
}
</style>

@endsection