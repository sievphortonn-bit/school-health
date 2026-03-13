@extends('layouts.app')
@section('title','គ្រូបង្រៀន')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- MODERN TOAST NOTIFICATIONS --}}
@if (session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideInRight 0.3s ease;">
    <div class="modern-toast d-flex align-items-center" style="border-left: 4px solid var(--success);">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-check-circle-fill" style="color: var(--success); font-size: 20px;"></i>
            <div class="fw-semibold" style="color: var(--dark);">{{ session('success') }}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.modern-toast').remove()"></button>
        </div>
    </div>
</div>
@endif

@if (session('error'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideInRight 0.3s ease;">
    <div class="modern-toast d-flex align-items-center" style="border-left: 4px solid var(--danger);">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-exclamation-triangle-fill" style="color: var(--danger); font-size: 20px;"></i>
            <div class="fw-semibold" style="color: var(--dark);">{{ session('error') }}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.modern-toast').remove()"></button>
        </div>
    </div>
</div>
@endif

@php
    // ================ HELPER FUNCTION FOR LEVEL CLASS ================
    function getLevelClass($level) {
        if (empty($level)) return 'level-default';
        $classes = [
            'គ្រូមតេយ្យសិក្សា' => 'level-preschool',
            'គ្រូបឋមសិក្សា'    => 'level-elementary',
            'គ្រូអនុវិទ្យាល័យ'  => 'level-middle',
            'គ្រូវិទ្យាល័យ'     => 'level-high'
        ];
        return $classes[trim($level)] ?? 'level-default';
    }
@endphp

<div class="row g-4 animate-fade-in">

    <!-- ================= MODERN FORM CARD ================= -->
    <div class="col-lg-4">
        <div class="modern-card">
            <div class="card-header-gradient d-flex">
                <i class="bi bi-person-video3 fs-5"></i>
                <h5 class="mb-0 fw-bold">ទម្រង់ព័ត៌មានគ្រូបង្រៀន</h5>
            </div>

            <div class="form-container">
                <form id="teacherForm" method="POST" action="{{ route('teachers.store') }}">
                    @csrf
                    <input type="hidden" id="teacher_id">
                    <input type="hidden" name="_method" id="methodField">

                    {{-- Full Name --}}
                    <div class="form-label ">
                        <i class="bi bi-person-circle"></i>
                        ឈ្មោះគ្រូបង្រៀន
                    </div>
                    <div class="position-relative mb-3">
                        <input id="name" name="name" class="modern-input" placeholder="ឧ. សុខ មករា">
                        <div class="invalid-feedback">សូមបញ្ចូលឈ្មោះគ្រូបង្រៀន</div>
                    </div>

                    {{-- Age & Gender Row --}}
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <div class="form-label">
                                <i class="bi bi-calendar3"></i>
                                អាយុ
                            </div>
                            <div class="position-relative">
                                <input id="age" name="age" class="modern-input" placeholder="១៨-៨០ ឆ្នាំ">
                                <div class="invalid-feedback">អាយុត្រូវចន្លោះ ១៨-៨០ ឆ្នាំ</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-label">
                                <i class="bi bi-gender-ambiguous"></i>
                                ភេទ
                            </div>
                            <div class="position-relative">
                                <select id="sex" name="sex" class="modern-select">
                                    <option value="">— ជ្រើសរើស —</option>
                                    <option value="Male">ប្រុស</option>
                                    <option value="Female">ស្រី</option>
                                </select>
                                <div class="invalid-feedback">សូមជ្រើសរើសភេទ</div>
                            </div>
                        </div>
                    </div>

                    {{-- Teaching Level --}}
                    <div class="form-label">
                        <i class="bi bi-bar-chart-steps"></i>
                        កម្រិតបង្រៀន
                    </div>
                    <div class="position-relative">
                        <select id="level" name="level" class="modern-select">
                            <option value="">— ជ្រើសរើសកម្រិត —</option>
                            <option>គ្រូមតេយ្យសិក្សា</option>
                            <option>គ្រូបឋមសិក្សា</option>
                            <option>គ្រូអនុវិទ្យាល័យ</option>
                            <option>គ្រូវិទ្យាល័យ</option>
                        </select>
                        <div class="invalid-feedback">សូមជ្រើសរើសកម្រិតបង្រៀន</div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-4">
                        <button class="btn-glass-light-pri mt-2" id="saveBtn">
                            <i class="bi bi-save2"></i>
                            រក្សាទុក
                        </button>

                        <button type="button" class="btn-glass-light-pri d-none mt-2" id="updateBtn">
                            <i class="bi bi-pencil-square"></i>
                            កែប្រែព័ត៌មាន
                        </button>

                        <button type="button" class="btn-glass-light-dan w-100 d-none mt-2" id="deleteBtn">
                            <i class="bi bi-trash3"></i>
                            លុបគ្រូបង្រៀន
                        </button>

                        <button type="button" class="btn-glass-light-war mt-2" id="clearBtn">
                            <i class="bi bi-arrow-repeat"></i>
                            សម្អាតទម្រង់
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= MODERN TABLE CARD ================= -->
    <div class="col-lg-8">
        <div class="modern-card">
            <div class="card-header-gradient d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-people-fill fs-5"></i>
                    <h5 class="mb-0 fw-bold">បញ្ជីគ្រូបង្រៀន</h5>
                    {{-- <span class="gender-badge gender-st  px-3 py-2 rounded-pill" id="teacherCount" 
                          style="background: rgba(30, 155, 19, 0.536); color: white; border: 1px solid rgb(6, 110, 6);">
                        @if(method_exists($teachers, 'total'))
                            {{ $teachers->total() }} នាក់
                        @else
                            {{ count($teachers) }} នាក់
                        @endif
                    </span> --}}
                </div>

                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    {{-- FIXED: use modern-search-dark for dark header --}}
                    <input id="search" class="modern-search-light" placeholder="ស្វែងរកឈ្មោះ ឬកម្រិតបង្រៀន...">
                </div>
            </div>

            {{-- Filter Buttons --}}
            <div class="px-4 pt-4 pb-2">
                <div class="filter-container">
                    <button class="filter-btn active" data-level="all">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        ទាំងអស់
                    </button>
                    <button class="filter-btn" data-level="គ្រូមតេយ្យសិក្សា">
                        <i class="bi bi-house-heart"></i>
                        គ្រូមតេយ្យ
                    </button>
                    <button class="filter-btn" data-level="គ្រូបឋមសិក្សា">
                        <i class="bi bi-book"></i>
                        គ្រូបឋម
                    </button>
                    <button class="filter-btn" data-level="គ្រូអនុវិទ្យាល័យ">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        គ្រូអនុវិទ្យាល័យ
                    </button>
                    <button class="filter-btn" data-level="គ្រូវិទ្យាល័យ">
                        <i class="bi bi-mortarboard"></i>
                        គ្រូវិទ្យាល័យ
                    </button>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 60px">#</th>
                            <th><i class="bi bi-person me-1"></i> ឈ្មោះ</th>
                            <th style="width: 100px"><i class="bi bi-gender-ambiguous me-1"></i> ភេទ</th>
                            <th style="width: 180px"><i class="bi bi-bar-chart-steps me-1"></i> កម្រិតបង្រៀន</th>
                        </tr>
                    </thead>
                    <tbody id="teacherTable">
                        @forelse ($teachers as $index => $t)
                        <tr onclick="selectTeacher({{ $t->id }}, this)" style="cursor:pointer">
                            <td>
                                <span class="fw-bold" style="color: var(--primary);">{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="teacher-avatar">
                                        {{ strtoupper(substr($t->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $t->name }}</div>
                                        <small class="text-muted">ID: T{{ str_pad($t->id, 4, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="gender-badge {{ $t->sex == 'Male' ? 'gender-male' : 'gender-female' }}">
                                    {{ $t->sex == 'Male' ? 'ប្រុស' : 'ស្រី' }}
                                </span>
                            </td>
                            <td>
                                <span class="level-badge {{ getLevelClass($t->level) }}">
                                    {{ $t->level }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="empty-state">
                                <i class="bi bi-person-video3"></i>
                                <p>មិនទាន់មានទិន្នន័យគ្រូបង្រៀននៅឡើយទេ</p>
                                <small class="text-muted">សូមបន្ថែមគ្រូបង្រៀនតាមរយៈទម្រង់ខាងឆ្វេងដៃ</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination / Footer --}}
            <div class="card-footer-modern">
                @if(method_exists($teachers, 'links'))
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="text-muted small">
                        <i class="bi bi-info-circle me-1"></i>
                        បង្ហាញ 
                        <span class="fw-bold" style="color: var(--primary);">{{ $teachers->firstItem() ?? 0 }}</span> - 
                        <span class="fw-bold" style="color: var(--primary);">{{ $teachers->lastItem() ?? 0 }}</span> 
                        នៃ 
                        <span class="fw-bold" style="color: var(--primary);">{{ $teachers->total() }}</span> 
                        គ្រូបង្រៀន
                    </div>
                    <div class="pagination-modern">
                        {{ $teachers->links() }}
                    </div>
                </div>
                @else
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        <i class="bi bi-info-circle me-1"></i>
                        បង្ហាញ 
                        <span class="fw-bold" style="color: var(--primary);">{{ count($teachers) }}</span> 
                        គ្រូបង្រៀន
                    </div>
                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(58, 134, 255, 0.1); color: var(--primary);">
                        <i class="bi bi-people-fill me-1"></i>
                        សរុប {{ count($teachers) }} នាក់
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- ================= MODERN DELETE CONFIRMATION MODAL ================= -->
<div class="modal fade modern-modal" id="deleteTeacherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-danger">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    បញ្ជាក់ការលុបគ្រូបង្រៀន
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body-warning">
                <div class="warning-icon">
                    <i class="bi bi-person-dash-fill"></i>
                </div>
                <h5 class="fw-bold mb-3" style="color: var(--dark);">តើអ្នកពិតជាចង់លុបមែនទេ?</h5>
                <p class="text-muted mb-0">
                    ការលុបគ្រូបង្រៀននេះនឹងមិនអាចត្រឡប់វិញបានទេ។<br>
                    រាល់ទិន្នន័យដែលពាក់ព័ន្ធនឹងត្រូវបានលុបចេញពីប្រព័ន្ធ។
                </p>
            </div>
            
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i> បោះបង់
                </button>
                <button type="button" class="btn btn-danger px-4 py-2" id="confirmDeleteTeacherBtn">
                    <i class="bi bi-trash3 me-1"></i> បញ្ជាក់ការលុប
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODERN JAVASCRIPT ================= -->
<script>
// ... (keep your existing JavaScript, but replace the getLevelClass function)
function getLevelClass(level) {
    if (!level) return 'level-default';
    level = level.toString().trim();
    const levelMap = {
        'គ្រូមតេយ្យសិក្សា': 'level-preschool',
        'គ្រូបឋមសិក្សា': 'level-elementary',
        'គ្រូអនុវិទ្យាល័យ': 'level-middle',
        'គ្រូវិទ្យាល័យ': 'level-high'
    };
    if (!levelMap[level]) console.warn('Unmapped level:', level);
    return levelMap[level] || 'level-default';
}
// ... rest of the JavaScript unchanged
</script>
<!-- ================= MODERN JAVASCRIPT ================= -->
<script>
// ================ GLOBAL VARIABLES ================
let hasSubmitted = false;
let selectedTeacherId = null;
let currentFilter = 'all';

// ================ DOM ELEMENTS ================
const form = document.getElementById('teacherForm');
const methodField = document.getElementById('methodField');
const teacherIdInput = document.getElementById('teacher_id');

const saveBtn = document.getElementById('saveBtn');
const updateBtn = document.getElementById('updateBtn');
const deleteBtn = document.getElementById('deleteBtn');
const clearBtn = document.getElementById('clearBtn');

const name = document.getElementById('name');
const age = document.getElementById('age');
const sex = document.getElementById('sex');
const level = document.getElementById('level');

// ================ SELECT TEACHER ================
window.selectTeacher = function(id, row) {
    if (!id || !row) return;
    
    hasSubmitted = false;
    selectedTeacherId = id;
    teacherIdInput.value = id;

    // Remove active class from all rows
    document.querySelectorAll('#teacherTable tr').forEach(tr => {
        tr.classList.remove('active-row');
    });
    row.classList.add('active-row');

    // Show loading state
    row.style.opacity = '0.7';
    row.style.cursor = 'wait';
    
    fetch(`/teachers/${id}`)
        .then(r => {
            if (!r.ok) throw new Error(`HTTP error! status: ${r.status}`);
            return r.json();
        })
        .then(t => {
            // Safely set values with fallbacks
            name.value = t.name || '';
            age.value = t.age || '';
            sex.value = t.sex || '';
            level.value = t.level || '';

            clearValidation();

            // Toggle buttons
            saveBtn.classList.add('d-none');
            updateBtn.classList.remove('d-none');
            deleteBtn.classList.remove('d-none');

            // Set form action for update
            form.action = `/teachers/${id}`;
            methodField.value = 'PUT';
            
            showToast('បានជ្រើសរើសគ្រូបង្រៀន: ' + (t.name || ''), 'success');
        })
        .catch(error => {
            console.error('Select Teacher Error:', error);
            showToast('មានបញ្ហាក្នុងការទាញទិន្នន័យ', 'error');
        })
        .finally(() => {
            row.style.opacity = '1';
            row.style.cursor = 'pointer';
        });
};

// ================ VALIDATION ================
function clearValidation() {
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.style.display = 'none';
    });
}

function validateField(field) {
    if (!hasSubmitted || !field) return true;

    let valid = true;
    // Find the feedback element
    let feedback = field.nextElementSibling;
    
    // Check if feedback exists and has the correct class
    if (!feedback || !feedback.classList.contains('invalid-feedback')) {
        // Try to find it in the parent
        feedback = field.closest('.position-relative')?.querySelector('.invalid-feedback');
    }

    if (field === name) {
        valid = field.value.trim() !== '';
    } else if (field === age) {
        const v = field.value.trim();
        valid = v !== '' && !isNaN(v) && Number(v) >= 18 && Number(v) <= 80;
    } else if (field === sex || field === level) {
        valid = field.value !== '';
    }

    // Apply validation styles
    if (!valid) {
        field.classList.add('is-invalid');
        if (feedback) feedback.style.display = 'block';
    } else {
        field.classList.remove('is-invalid');
        if (feedback) feedback.style.display = 'none';
    }

    return valid;
}

function validateForm() {
    let ok = true;
    const fieldsToValidate = [name, age, sex, level];
    
    fieldsToValidate.forEach(f => {
        if (f && !validateField(f)) ok = false;
    });
    
    return ok;
}

// ================ REAL-TIME VALIDATION ================
if (name) name.addEventListener('input', () => validateField(name));
if (age) age.addEventListener('input', () => validateField(age));
if (sex) sex.addEventListener('change', () => validateField(sex));
if (level) level.addEventListener('change', () => validateField(level));

// ================ SAVE ================
if (saveBtn) {
    saveBtn.addEventListener('click', function(e) {
        e.preventDefault();
        hasSubmitted = true;

        if (!validateForm()) {
            showToast('សូមបំពេញព័ត៌មានឲ្យបានត្រឹមត្រូវ', 'error');
            return;
        }

        form.action = '/teachers';
        methodField.value = '';
        form.submit();
    });
}

// ================ UPDATE ================
if (updateBtn) {
    updateBtn.addEventListener('click', function(e) {
        e.preventDefault();
        hasSubmitted = true;

        if (!validateForm()) {
            showToast('សូមបំពេញព័ត៌មានឲ្យបានត្រឹមត្រូវ', 'error');
            return;
        }

        if (!selectedTeacherId) {
            showToast('សូមជ្រើសរើសគ្រូបង្រៀន', 'error');
            return;
        }

        form.action = `/teachers/${selectedTeacherId}`;
        methodField.value = 'PUT';
        form.submit();
    });
}

// ================ DELETE ================
if (deleteBtn) {
    deleteBtn.addEventListener('click', function() {
        if (!selectedTeacherId) {
            showToast('សូមជ្រើសរើសគ្រូបង្រៀន', 'error');
            return;
        }

        const modal = new bootstrap.Modal(document.getElementById('deleteTeacherModal'));
        modal.show();
    });
}

// ================ CONFIRM DELETE ================
const confirmDeleteBtn = document.getElementById('confirmDeleteTeacherBtn');
if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
        if (!selectedTeacherId) {
            showToast('សូមជ្រើសរើសគ្រូបង្រៀន', 'error');
            return;
        }

        form.action = `/teachers/${selectedTeacherId}`;
        methodField.value = 'DELETE';
        form.submit();
    });
}

// ================ CLEAR ================
if (clearBtn) {
    clearBtn.addEventListener('click', function() {
        hasSubmitted = false;
        selectedTeacherId = null;
        teacherIdInput.value = '';

        form.reset();
        methodField.value = '';
        clearValidation();

        saveBtn.classList.remove('d-none');
        updateBtn.classList.add('d-none');
        deleteBtn.classList.add('d-none');

        document.querySelectorAll('#teacherTable tr').forEach(tr => {
            tr.classList.remove('active-row');
        });

        form.action = '/teachers';
        
        showToast('ទម្រង់ត្រូវបានសម្អាត', 'info');
    });
}

// ================ SEARCH ================
let searchTimeout;
const searchInput = document.getElementById('search');

if (searchInput) {
    searchInput.addEventListener('keyup', function() {
        clearTimeout(searchTimeout);
        const q = this.value.trim();
        
        searchTimeout = setTimeout(() => {
            if (q.length === 0) {
                location.reload();
                return;
            }
            
            fetch(`/teachers/search?q=${encodeURIComponent(q)}`)
                .then(res => {
                    if (!res.ok) throw new Error('Search failed');
                    return res.json();
                })
                .then(data => {
                    updateTableRows(data);
                    updateTeacherCount(data.length);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    showToast('មានបញ្ហាក្នុងការស្វែងរក', 'error');
                });
        }, 500);
    });
    
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            this.value = '';
            location.reload();
        }
    });
}

// ================ FILTER BY LEVEL ================
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Update active state
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('active');
        });
        this.classList.add('active');

        const level = this.dataset.level;
        currentFilter = level;
        
        let url = '/teachers/filter';
        if (level && level !== 'all') {
            url += `?level=${encodeURIComponent(level)}`;
        }
        
        // Show loading state
        const tableBody = document.getElementById('teacherTable');
        if (tableBody) {
            tableBody.style.opacity = '0.5';
        }

        fetch(url)
            .then(res => {
                if (!res.ok) throw new Error('Filter failed');
                return res.json();
            })
            .then(data => {
                updateTableRows(data);
                updateTeacherCount(data.length);
            })
            .catch(error => {
                console.error('Filter error:', error);
                showToast('មានបញ្ហាក្នុងការត្រងទិន្នន័យ', 'error');
            })
            .finally(() => {
                if (tableBody) {
                    tableBody.style.opacity = '1';
                }
            });
    });
});

// ================ UPDATE TABLE ROWS ================
function updateTableRows(data) {
    const tableBody = document.getElementById('teacherTable');
    if (!tableBody) return;
    
    let rows = '';
    
    if (!data || data.length === 0) {
        rows = `
        <tr>
            <td colspan="4" class="empty-state">
                <i class="bi bi-person-video3"></i>
                <p>មិនមានគ្រូបង្រៀនទេ</p>
                <small class="text-muted">សូមបន្ថែមគ្រូបង្រៀនតាមរយៈទម្រង់ខាងឆ្វេងដៃ</small>
            </td>
        </tr>`;
    } else {
        data.forEach((t, index) => {
            const levelClass = getLevelClass(t.level);
            const genderClass = t.sex === 'Male' ? 'gender-male' : 'gender-female';
            const genderText = t.sex === 'Male' ? 'ប្រុស' : 'ស្រី';
            const avatar = t.name ? t.name.charAt(0).toUpperCase() : '?';
            const teacherId = t.id ? t.id.toString().padStart(4, '0') : '0000';
            
            rows += `
            <tr onclick="selectTeacher(${t.id}, this)" style="cursor:pointer">
                <td>
                    <span class="fw-bold" style="color: var(--primary);">${index + 1}</span>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="teacher-avatar">${avatar}</div>
                        <div>
                            <div class="fw-semibold">${escapeHtml(t.name) || ''}</div>
                            <small class="text-muted">ID: T${teacherId}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="gender-badge ${genderClass}">
                        ${genderText}
                    </span>
                </td>
                <td>
                    <span class="level-badge ${levelClass}">${escapeHtml(t.level) || ''}</span>
                </td>
            </tr>`;
        });
    }
    
    tableBody.innerHTML = rows;
}

// ================ UPDATE TEACHER COUNT ================
function updateTeacherCount(count) {
    const countBadge = document.getElementById('teacherCount');
    if (countBadge) {
        countBadge.innerHTML = `${count || 0} នាក់`;
    }
    
    // Update footer
    const footer = document.querySelector('.card-footer-modern .text-muted.small');
    if (footer) {
        footer.innerHTML = `
            <i class="bi bi-info-circle me-1"></i>
            បង្ហាញ <span class="fw-bold" style="color: var(--primary);">${count || 0}</span> គ្រូបង្រៀន
        `;
    }
}

// ================ HELPER FUNCTIONS ================
function getLevelClass(level) {
    if (!level) return 'level-default';
    
    // Trim and normalize
    level = level.toString().trim();
    
    const levelMap = {
        'គ្រូមតេយ្យសិក្សា': 'level-preschool',
        'គ្រូបឋមសិក្សា': 'level-elementary',
        'គ្រូអនុវិទ្យាល័យ': 'level-middle',
        'គ្រូវិទ្យាល័យ': 'level-high'
    };
    
    // Debug: log unmapped levels
    if (!levelMap[level]) {
        console.warn('Unmapped level:', level);
    }
    
    return levelMap[level] || 'level-default';
}

function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// ================ SHOW TOAST ================
function showToast(message, type = 'success') {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.modern-toast');
    existingToasts.forEach(toast => toast.remove());
    
    const toastContainer = document.querySelector('.position-fixed.top-0.end-0') || (() => {
        const div = document.createElement('div');
        div.className = 'position-fixed top-0 end-0 p-3';
        div.style.zIndex = '9999';
        document.body.appendChild(div);
        return div;
    })();

    const toast = document.createElement('div');
    toast.className = 'modern-toast d-flex align-items-center mb-2';
    
    let icon = 'bi-check-circle-fill';
    let color = 'var(--success)';
    
    if (type === 'error') {
        icon = 'bi-exclamation-triangle-fill';
        color = 'var(--danger)';
    } else if (type === 'info') {
        icon = 'bi-info-circle-fill';
        color = 'var(--primary)';
    }

    toast.style.borderLeft = `4px solid ${color}`;
    toast.innerHTML = `
        <div class="d-flex align-items-center gap-3">
            <i class="bi ${icon}" style="color: ${color}; font-size: 20px;"></i>
            <div class="fw-semibold" style="color: var(--dark);">${escapeHtml(message)}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.remove()"></button>
        </div>
    `;

    toastContainer.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

// ================ AUTO HIDE TOASTS ================
setTimeout(() => {
    document.querySelectorAll('.modern-toast').forEach(t => {
        t.style.opacity = '0';
        setTimeout(() => t.remove(), 500);
    });
}, 3000);

// ================ INITIAL ACTIVE FILTER ================
document.addEventListener('DOMContentLoaded', function() {
    const allFilterBtn = document.querySelector('.filter-btn[data-level="all"]');
    if (allFilterBtn) {
        allFilterBtn.classList.add('active');
    }
    
    // Fix for count badge in dark header
    const teacherCount = document.getElementById('teacherCount');
    if (teacherCount) {
        teacherCount.style.background = 'rgba(255,255,255,0.2)';
        teacherCount.style.color = 'white';
        teacherCount.style.border = '1px solid rgba(255,255,255,0.1)';
    }
});
</script>

@endsection