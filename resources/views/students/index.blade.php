@extends('layouts.app')

@section('content')


<div class="row g-4 animate-fade-in">

    <!-- ================= MODERN FORM CARD ================= -->
    <div class="col-lg-4">
        <div class="modern-card">
            <div class="card-header-gradient">
                <i class="bi bi-person-lines-fill"></i>
                <span class="fw-bold">ទម្រង់ព័ត៌មានសិស្ស</span>
            </div>

            <div class="form-container">
                <form id="studentForm" method="POST">
                    @csrf
                    <input type="hidden" id="student_id">
                    <input type="hidden" name="_method" id="methodField">

                    <!-- Student Code -->
                    <div class="form-label-modern">
                        <i class="bi bi-upc-scan"></i>
                        អត្តលេខ
                    </div>
                    <div class="input">
                        <input id="code" name="code" class="modern-input" placeholder="STU-001" value="{{ old('code') }}">
                    </div>
                    <div class="invalid-feedback">សូមបញ្ចូលអត្តលេខ</div>

                    <!-- Full Name -->
                    <div class="form-label-modern mt-3">
                        <i class="bi bi-person-circle"></i>
                        ឈ្មោះសិស្ស
                    </div>
                    <div class="input">
                        <input id="name" name="name" class="modern-input" placeholder="ឧ. សុខ មករា" value="{{ old('name') }}">
                    </div>
                    <div class="invalid-feedback">សូមបញ្ចូលឈ្មោះ</div>

                    <!-- Age & Gender Row -->
                    <div class="row g-2 mt-3">
                        <div class="col-6">
                            <div class="form-label-modern">
                                <i class="bi bi-calendar3"></i>
                                អាយុ
                            </div>
                            <div class="input">
                                <input id="age" name="age" type="number" class="modern-input" placeholder="១៨" value="{{ old('age') }}">
                            </div>
                            <div class="invalid-feedback">អាយុត្រូវចន្លោះ ១-១០០</div>
                        </div>

                        <div class="col-6">
                            <div class="form-label-modern">
                                <i class="bi bi-gender-ambiguous"></i>
                                ភេទ
                            </div>
                            <div class="input">
                                <select id="sex" name="sex" class="modern-select">
                                    <option value="">— ជ្រើសរើស —</option>
                                    <option value="Male">ប្រុស</option>
                                    <option value="Female">ស្រី</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">សូមជ្រើសរើសភេទ</div>
                        </div>
                    </div>

                    <!-- Grade -->
                    <div class="form-label-modern mt-3">
                        <i class="bi bi-bar-chart-steps"></i>
                        ថ្នាក់ទី
                    </div>
                    <div class="input">
                        <select id="grade" name="grade" class="modern-select">
                            <option value="">— ជ្រើសរើសថ្នាក់ —</option>
                            @foreach (['មតេយ្យ', '១ ក', '១ ខ', '២ ក', '២ ខ', '៣ ក', '៣ ខ', '៤ ក', '៤ ខ', '៥ ក', '៥ ខ', '៦ ក', '៦ ខ', '៧ ក', '៧ ខ', '៨ ក', '៨ ខ', '៩ ក', '៩ ខ', '១០ ក', '១០ ខ', '១១ ក', '១១ ខ', '១២ ក', '១២ ខ'] as $g)
                                <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback">សូមជ្រើសរើសថ្នាក់</div>

                    <!-- Address -->
                    <div class="form-label-modern mt-3">
                        <i class="bi bi-geo-alt"></i>
                        អាស័យដ្ឋាន
                    </div>
                    <div class="input">
                        <input id="section" name="section" class="modern-input" placeholder="ឧ. ភ្នំពេញ, ផ្សារដើមថ្កូវ" value="{{ old('section') }}">
                    </div>
                    <div class="invalid-feedback">សូមបញ្ចូលអាស័យដ្ឋាន</div>

                    <!-- Action Buttons -->
                    <div class="mt-4">
                        <button class="btn-glass-light-pri mt-2" id="saveBtn">
                            <i class="bi bi-save2"></i> រក្សាទុក
                        </button>

                        <button type="button" class="btn-glass-light-pri mt-2 d-none" id="updateBtn">
                            <i class="bi bi-pencil-square"></i> កែប្រែ
                        </button>

                        <button type="button" class="btn-glass-light-dan mt-2 w-100 d-none" id="deleteBtn">
                            <i class="bi bi-trash3"></i> លុប
                        </button>

                        <button type="button" class="btn-glass-light-war mt-2" id="clearBtn">
                            <i class="bi bi-arrow-repeat"></i> សម្អាត
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
                    <i class="bi bi-table"></i>
                    <span class="fw-bold">បញ្ជីសិស្ស</span>
                    <span class="badge bg-light bg-opacity-20 text-light px-3 py-2 rounded-pill" id="studentCount">
                        {{ $students->total() ?? $students->count() }} នាក់
                    </span>
                </div>

                <!-- ===== FIXED SEARCH BAR ===== -->
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input id="search" class="modern-search-light" type="text" placeholder="ស្វែងរកតាមឈ្មោះ ឬអត្តលេខ...">
                </div>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th><i class="bi bi-upc-scan me-1"></i> អត្តលេខ</th>
                                <th><i class="bi bi-person-circle me-1"></i> ឈ្មោះ</th>
                                <th style="width: 100px;"><i class="bi bi-gender-ambiguous me-1"></i> ភេទ</th>
                                <th style="width: 120px;"><i class="bi bi-bar-chart-steps me-1"></i> ថ្នាក់</th>
                                <th><i class="bi bi-geo-alt me-1"></i> អាស័យដ្ឋាន</th>
                            </tr>
                        </thead>

                        <tbody id="studentTable">
                            @forelse ($students as $s)
                                <tr onclick="selectStudent({{ $s->id }}, this)" style="cursor:pointer">
                                    <td>
                                        <span class="fw-semibold" style="color: var(--primary);">{{ $s->code }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="student-avatar">
                                                {{ strtoupper(substr($s->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $s->name }}</div>
                                                <small class="text-muted">ID: ST{{ str_pad($s->id, 5, '0', STR_PAD_LEFT) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="gender-badge {{ $s->sex == 'Male' ? 'gender-male' : 'gender-female' }}">
                                            {{ $s->sex == 'Male' ? 'ប្រុស' : 'ស្រី' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="grade-badge">
                                            <i class="bi bi-mortarboard me-1"></i>
                                            {{ $s->grade }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-pin-map-fill me-2" style="color: var(--secondary);"></i>
                                            {{ $s->section ?? 'មិនមានទិន្នន័យ' }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <p>មិនទាន់មានទិន្នន័យសិស្សនៅឡើយទេ</p>
                                        <small class="text-muted">សូមបន្ថែមសិស្សថ្មីតាមរយៈទម្រង់ខាងឆ្វេងដៃ</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($students, 'links'))
                <div class="card-footer bg-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            បង្ហាញ 
                            <span class="fw-bold" style="color: var(--primary);">{{ $students->firstItem() ?? 0 }}</span> - 
                            <span class="fw-bold" style="color: var(--primary);">{{ $students->lastItem() ?? 0 }}</span> 
                            នៃ 
                            <span class="fw-bold" style="color: var(--primary);">{{ $students->total() }}</span> 
                            សិស្ស
                        </div>
                        <div class="pagination-modern">
                            {{ $students->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="card-footer bg-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            បង្ហាញ <span class="fw-bold" style="color: var(--primary);">{{ count($students) }}</span> សិស្ស
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- ================= MODERN DELETE MODAL ================= -->
<div class="modal fade modern-modal" id="deleteStudentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-danger">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    បញ្ជាក់ការលុបសិស្ស
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body-warning">
                <div class="warning-icon">
                    <i class="bi bi-person-dash-fill"></i>
                </div>
                <h5 class="fw-bold mb-3" style="color: var(--dark);" id="deleteStudentName">តើអ្នកពិតជាចង់លុបសិស្សនេះមែនទេ?</h5>
                <p class="text-muted mb-0">
                    ការលុបសិស្សនេះនឹងមិនអាចត្រឡប់វិញបានទេ។<br>
                    រាល់ទិន្នន័យដែលពាក់ព័ន្ធនឹងត្រូវបានលុបចេញពីប្រព័ន្ធ។
                </p>
            </div>

            <div class="modal-footer border-0 pb-4">
                <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i> បោះបង់
                </button>
                <button type="button" class="btn btn-danger px-4 py-2" id="confirmDeleteStudentBtn">
                    <i class="bi bi-trash3 me-1"></i> បញ្ជាក់ការលុប
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ================= TOAST NOTIFICATIONS ================= -->
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideInRight 0.3s ease;">
    <div class="toast-modern d-flex align-items-center">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-check-circle-fill" style="color: var(--success); font-size: 20px;"></i>
            <div class="fw-semibold" style="color: var(--dark);">{{ session('success') }}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.toast-modern').remove()"></button>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideInRight 0.3s ease;">
    <div class="toast-modern toast-error d-flex align-items-center">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-exclamation-triangle-fill" style="color: var(--danger); font-size: 20px;"></i>
            <div class="fw-semibold" style="color: var(--dark);">{{ session('error') }}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.toast-modern').remove()"></button>
        </div>
    </div>
</div>
@endif

<!-- ================= MODERN JAVASCRIPT ================= -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DOM References
        const studentForm = document.getElementById('studentForm');
        const student_id  = document.getElementById('student_id');
        const methodField = document.getElementById('methodField');

        const code    = document.getElementById('code');
        const name    = document.getElementById('name');
        const age     = document.getElementById('age');
        const sex     = document.getElementById('sex');
        const grade   = document.getElementById('grade');
        const section = document.getElementById('section');

        const saveBtn   = document.getElementById('saveBtn');
        const updateBtn = document.getElementById('updateBtn');
        const deleteBtn = document.getElementById('deleteBtn');
        const clearBtn  = document.getElementById('clearBtn');
        const search    = document.getElementById('search');

        const fields = [code, name, age, sex, grade, section];
        let submitted = false;

        // Gender icon change
        if (sex) {
            sex.addEventListener('change', function() {
                const icon = document.getElementById('genderIcon');
                if (this.value === 'Male') {
                    icon.className = 'bi bi-gender-male input-icon';
                    icon.style.color = 'var(--primary)';
                } else if (this.value === 'Female') {
                    icon.className = 'bi bi-gender-female input-icon';
                    icon.style.color = 'var(--danger)';
                } else {
                    icon.className = 'bi bi-gender-ambiguous input-icon';
                    icon.style.color = '#adb5bd';
                }
            });
        }

        // Validation
        function clearErrors() {
            fields.forEach(el => {
                el.classList.remove('is-invalid');
                const feedback = el.parentElement.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.style.display = 'none';
                }
            });
        }

        function validate() {
            let ok = true;
            clearErrors();

            function check(el, condition) {
                if (!condition) {
                    el.classList.add('is-invalid');
                    const feedback = el.parentElement.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.style.display = 'block';
                    }
                    ok = false;
                }
            }

            check(code, code.value.trim() !== '');
            check(name, name.value.trim() !== '');
            check(age, age.value > 0 && age.value <= 100);
            check(sex, sex.value !== '');
            check(grade, grade.value !== '');
            check(section, section.value.trim() !== '');

            return ok;
        }

        // Form Submit (Save)
        studentForm.addEventListener('submit', function(e) {
            submitted = true;
            if (!validate()) {
                e.preventDefault();
                showNotification('សូមបំពេញព័ត៌មានឲ្យបានត្រឹមត្រូវ', 'error');
            }
        });

        // Update
        updateBtn.onclick = function() {
            submitted = true;
            if (!validate()) {
                showNotification('សូមបំពេញព័ត៌មានឲ្យបានត្រឹមត្រូវ', 'error');
                return;
            }
            studentForm.action = `/students/${student_id.value}`;
            methodField.value = 'PUT';
            studentForm.submit();
        };

        // Delete
        deleteBtn.onclick = function() {
            if (!student_id.value) {
                showNotification('សូមជ្រើសរើសសិស្ស', 'error');
                return;
            }

            // Get student name for modal
            const studentName = name.value;
            const deleteTitle = document.getElementById('deleteStudentName');
            if (deleteTitle) {
                deleteTitle.innerHTML = `លុបសិស្ស <strong style="color: var(--danger);">${studentName}</strong> មែនទេ?`;
            }

            const modal = new bootstrap.Modal(document.getElementById('deleteStudentModal'));
            modal.show();
        };

        // Confirm Delete
        document.getElementById('confirmDeleteStudentBtn').onclick = function() {
            if (!student_id.value) return;
            studentForm.action = `/students/${student_id.value}`;
            methodField.value = 'DELETE';
            studentForm.submit();
        };

        // Clear
        clearBtn.onclick = function() {
            studentForm.reset();
            student_id.value = '';
            methodField.value = '';
            clearErrors();
            
            saveBtn.classList.remove('d-none');
            updateBtn.classList.add('d-none');
            deleteBtn.classList.add('d-none');
            
            document.querySelectorAll('#studentTable tr').forEach(tr => {
                tr.classList.remove('active-row');
            });
            
            // Reset gender icon
            const genderIcon = document.getElementById('genderIcon');
            if (genderIcon) {
                genderIcon.className = 'bi bi-gender-ambiguous input-icon';
                genderIcon.style.color = '#adb5bd';
            }
            
            showNotification('ទម្រង់ត្រូវបានសម្អាត', 'info');
        };

        // Select Student
        window.selectStudent = function(id, row) {
            document.querySelectorAll('#studentTable tr').forEach(tr => {
                tr.classList.remove('active-row');
            });
            row.classList.add('active-row');

            fetch(`/students/${id}`)
                .then(r => r.json())
                .then(s => {
                    student_id.value = s.id;
                    code.value = s.code;
                    name.value = s.name;
                    age.value = s.age;
                    sex.value = s.sex;
                    grade.value = s.grade;
                    section.value = s.section || '';

                    // Trigger gender icon change
                    const event = new Event('change');
                    sex.dispatchEvent(event);

                    saveBtn.classList.add('d-none');
                    updateBtn.classList.remove('d-none');
                    deleteBtn.classList.remove('d-none');
                    
                    showNotification('បានជ្រើសរើសសិស្ស: ' + s.name, 'success');
                })
                .catch(error => {
                    showNotification('មានបញ្ហាក្នុងការទាញទិន្នន័យ', 'error');
                });
        };

        // ===== FIXED SEARCH FUNCTION =====
        if (search) {
            search.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                let visibleCount = 0;
                
                document.querySelectorAll('#studentTable tr').forEach(tr => {
                    // Don't hide empty state row
                    if (tr.querySelector('.empty-state')) {
                        return;
                    }
                    
                    const text = tr.innerText.toLowerCase();
                    if (text.includes(query)) {
                        tr.style.display = '';
                        visibleCount++;
                    } else {
                        tr.style.display = 'none';
                    }
                });
                
                // Update visible count
                const countBadge = document.getElementById('studentCount');
                if (countBadge) {
                    countBadge.innerHTML = `${visibleCount} នាក់`;
                }
            });
            
            // Clear search on escape key
            search.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                    this.dispatchEvent(new Event('keyup'));
                }
            });
        }

        // Toast Auto Hide
        setTimeout(() => {
            document.querySelectorAll('.toast-modern').forEach(t => {
                t.style.opacity = '0';
                setTimeout(() => t.remove(), 500);
            });
        }, 3000);

        // Notification Function
        function showNotification(message, type = 'success') {
            const toastContainer = document.querySelector('.position-fixed.top-0.end-0') || (() => {
                const div = document.createElement('div');
                div.className = 'position-fixed top-0 end-0 p-3';
                div.style.zIndex = '9999';
                document.body.appendChild(div);
                return div;
            })();

            const toast = document.createElement('div');
            toast.className = 'toast-modern d-flex align-items-center mb-2';
            
            let icon = 'bi-check-circle-fill';
            let color = 'var(--success)';
            
            if (type === 'error') {
                icon = 'bi-exclamation-triangle-fill';
                color = 'var(--danger)';
                toast.classList.add('toast-error');
            } else if (type === 'info') {
                icon = 'bi-info-circle-fill';
                color = 'var(--primary)';
            }

            toast.style.borderLeft = `4px solid ${color}`;
            toast.innerHTML = `
                <div class="d-flex align-items-center gap-3">
                    <i class="bi ${icon}" style="color: ${color}; font-size: 20px;"></i>
                    <div class="fw-semibold" style="color: var(--dark);">${message}</div>
                    <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.toast-modern').remove()"></button>
                </div>
            `;

            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }
    });
</script>
@endsection