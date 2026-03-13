@extends('layouts.app')
@section('title','កែរប្រែព័ត៌មានសិស្ស '.$student->name)

@section('content')
<style>
    /* ============= STUDENT EDIT PAGE – SINGLE CARD ENHANCEMENTS ============= */

/* Center the card and give it a comfortable max-width */
.edit-container .modern-card {
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}

/* Add subtle extra padding on the sides for large screens */
@media (min-width: 992px) {
    .edit-container .modern-card .form-body {
        padding-left: 40px;
        padding-right: 40px;
    }
}

/* Improve spacing between form groups */
.edit-container .form-group-modern {
    margin-bottom: 28px;
}

/* Make the ID badge more prominent */
.student-id-badge {
    background: rgba(53, 89, 18, 0.06);  /* slightly lighter */
    border-width: 1.5px;
    margin-bottom: 32px;
    padding: 14px 20px;
}

/* Slightly larger icons in the ID badge */
.student-id-badge i {
    font-size: 22px;
}

/* Add a subtle divider between sections */
.edit-container hr {
    margin: 32px 0 28px;
    border-top: 2px dashed rgba(53, 89, 18, 0.15);
}

/* Improve the action buttons container */
.edit-container .action-buttons {
    display: flex;
    gap: 16px;
    margin-top: 10px;
}

/* Make buttons slightly larger and more balanced */
.edit-container .btn-glass-light-war,
.edit-container .btn-glass-light-pri,
.edit-container .btn-glass-light-sec {
    padding: 12px 20px;
    font-size: 14px;
    height: 46px;
}

/* Reset button – full width on mobile, auto on desktop */
.edit-container .btn-glass-light-sec {
    width: 100%;
    margin-top: 16px !important;
}
@media (min-width: 576px) {
    .edit-container .btn-glass-light-sec {
        width: auto;
        min-width: 200px;
    }
}

/* Better focus states for inputs */
.modern-input:focus,
.modern-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(53, 89, 18, 0.08);
}

/* Add a subtle hover effect to the card */
.modern-card:hover {
    box-shadow: var(--card-shadow-hover);
}

/* Improve the header spacing */
.card-header-glass-primary {
    padding: 24px 30px;
}
.card-header-glass-primary .header-icon {
    width: 56px;
    height: 56px;
    font-size: 26px;
}
.card-header-glass-primary .header-title h4 {
    font-size: 22px;
    margin-bottom: 6px;
}
.card-header-glass-primary .header-title p {
    font-size: 14px;
    opacity: 0.9;
}

/* Toast notifications – ensure they appear above everything */
.toast-modern {
    z-index: 9999;
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

/* Responsive fine-tuning */
@media (max-width: 576px) {
    .edit-container .modern-card .form-body {
        padding: 20px;
    }
    .card-header-glass-primary {
        padding: 20px;
        flex-wrap: wrap;
    }
    .edit-container .action-buttons {
        flex-direction: column;
    }
    .edit-container .btn-glass-light-war,
    .edit-container .btn-glass-light-pri {
        width: 100%;
    }
}
</style>
<div class="edit-container">
    
    <!-- ================= SINGLE CARD – exactly like patient edit ================= -->
    <div class="modern-card">
        
        <!-- Header – Glass Primary (same as patient edit) -->
        <div class="card-header-gradient d-flex align-items-center">
            
            <div class="header-title">
                <h4>
                    <i class="bi bi-person-vcard"></i>
                    កែប្រែព័ត៌មានសិស្ស
                </h4>
            </div>
        </div>

        <!-- Form Body -->
        <div class="form-body">
            
            <!-- Student ID Badge – same style as patient badge -->
            <div class="student-id-badge">
                <i class="bi bi-upc-scan"></i>
                <div>
                    <small class="text-muted d-block">អត្តលេខសិស្ស</small>
                    <span>{{ $student->code }}</span>
                </div>
                <div class="ms-auto">
                    <span class="badge px-3 py-2 rounded-pill" 
                          style="background: rgba(53,89,18,0.1); color: var(--primary); border: 1px solid rgba(53,89,18,0.2);">
                        ID: ST{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('students.update', $student->id) }}" id="editStudentForm">
                @csrf
                @method('PUT')

                <input type="hidden" name="code" value="{{ $student->code }}">

                <!-- Full Name -->
                <div class="form-group-modern">
                    <div class="form-label-modern">
                        <i class="bi bi-person-circle"></i>
                        ឈ្មោះសិស្ស <span class="text-danger">*</span>
                    </div>
                    <div class="input-wrapper">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" 
                               name="name" 
                               class="modern-input @error('name') is-invalid @enderror" 
                               value="{{ old('name', $student->name) }}"
                               placeholder="ឧ. សុខ មករា"
                               required>
                    </div>
                    @error('name')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Age -->
                <div class="form-group-modern">
                    <div class="form-label-modern">
                        <i class="bi bi-calendar3"></i>
                        អាយុ <span class="text-danger">*</span>
                    </div>
                    <div class="input-wrapper">
                        <i class="bi bi-123 input-icon"></i>
                        <input type="number" 
                               name="age" 
                               class="modern-input @error('age') is-invalid @enderror" 
                               value="{{ old('age', $student->age) }}"
                               placeholder="១៨"
                               min="1" 
                               max="100"
                               required>
                    </div>
                    @error('age')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gender - Modern Radio Design -->
                <div class="form-group-modern">
                    <div class="form-label-modern">
                        <i class="bi bi-gender-ambiguous"></i>
                        ភេទ <span class="text-danger">*</span>
                    </div>
                    <div class="gender-group d-flex gap-4">
                        <div class="gender-option">
                            <input type="radio" 
                                   name="sex" 
                                   id="genderMale" 
                                   value="Male" 
                                   class="gender-radio"
                                   {{ $student->sex == 'Male' ? 'checked' : '' }}
                                   required>
                            <label for="genderMale" class="gender-label">
                                <i class="bi bi-gender-male" style="color: var(--primary);"></i>
                                ប្រុស
                            </label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" 
                                   name="sex" 
                                   id="genderFemale" 
                                   value="Female" 
                                   class="gender-radio"
                                   {{ $student->sex == 'Female' ? 'checked' : '' }}
                                   required>
                            <label for="genderFemale" class="gender-label">
                                <i class="bi bi-gender-female" style="color: var(--danger);"></i>
                                ស្រី
                            </label>
                        </div>
                    </div>
                    @error('sex')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Grade -->
                <div class="form-group-modern">
                    <div class="form-label-modern">
                        <i class="bi bi-bar-chart-steps"></i>
                        ថ្នាក់ទី <span class="text-danger">*</span>
                    </div>
                    <div class="grade-select-wrapper input-wrapper">
                        <i class="bi bi-mortarboard input-icon"></i>
                        <select name="grade" id="grade" class="modern-select @error('grade') is-invalid @enderror" required>
                            <option value="" disabled>— ជ្រើសរើសថ្នាក់ —</option>
                            @php
                                $gradeLevels = [
                                    'មតេយ្យ' => ['icon' => '', 'group' => 'មតេយ្យសិក្សា'],
                                    '១ ក' => ['icon' => '', 'group' => 'បឋមសិក្សា'], '១ ខ' => ['icon' => '', 'group' => 'បឋមសិក្សា'],
                                    '២ ក' => ['icon' => '', 'group' => 'បឋមសិក្សា'], '២ ខ' => ['icon' => '', 'group' => 'បឋមសិក្សា'],
                                    '៣ ក' => ['icon' => '', 'group' => 'បឋមសិក្សា'], '៣ ខ' => ['icon' => '', 'group' => 'បឋមសិក្សា'],
                                    '៤ ក' => ['icon' => '', 'group' => 'បឋមសិក្សា'], '៤ ខ' => ['icon' => '', 'group' => 'បឋមសិក្សា'],
                                    '៥ ក' => ['icon' => '', 'group' => 'បឋមសិក្សា'], '៥ ខ' => ['icon' => '', 'group' => 'បឋមសិក្សា'],
                                    '៦ ក' => ['icon' => '', 'group' => 'បឋមសិក្សា'], '៦ ខ' => ['icon' => '', 'group' => 'បឋមសិក្សា'],
                                    '៧ ក' => ['icon' => '', 'group' => 'អនុវិទ្យាល័យ'], '៧ ខ' => ['icon' => '', 'group' => 'អនុវិទ្យាល័យ'],
                                    '៨ ក' => ['icon' => '', 'group' => 'អនុវិទ្យាល័យ'], '៨ ខ' => ['icon' => '', 'group' => 'អនុវិទ្យាល័យ'],
                                    '៩ ក' => ['icon' => '', 'group' => 'អនុវិទ្យាល័យ'], '៩ ខ' => ['icon' => '', 'group' => 'អនុវិទ្យាល័យ'],
                                    '១០ ក' => ['icon' => '', 'group' => 'វិទ្យាល័យ'], '១០ ខ' => ['icon' => '', 'group' => 'វិទ្យាល័យ'],
                                    '១១ ក' => ['icon' => '', 'group' => 'វិទ្យាល័យ'], '១១ ខ' => ['icon' => '', 'group' => 'វិទ្យាល័យ'],
                                    '១២ ក' => ['icon' => '', 'group' => 'វិទ្យាល័យ'], '១២ ខ' => ['icon' => '', 'group' => 'វិទ្យាល័យ'],
                                ];
                                $currentGroup = '';
                            @endphp

                            @foreach($gradeLevels as $gradeValue => $gradeInfo)
                                @if($gradeInfo['group'] != $currentGroup)
                                    @if(!$loop->first)
                                        </optgroup>
                                    @endif
                                    @php $currentGroup = $gradeInfo['group']; @endphp
                                    <optgroup label="{{ $gradeInfo['group'] }}">
                                @endif
                                <option value="{{ $gradeValue }}" {{ $student->grade == $gradeValue ? 'selected' : '' }}>
                                    {{ $gradeInfo['icon'] }} ថ្នាក់ទី {{ $gradeValue }}
                                </option>
                                @if($loop->last)
                                    </optgroup>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('grade')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="form-group-modern">
                    <div class="form-label-modern">
                        <i class="bi bi-geo-alt"></i>
                        អាស័យដ្ឋាន
                    </div>
                    <div class="input-wrapper">
                        <i class="bi bi-pin-map input-icon"></i>
                        <input type="text" 
                               name="section" 
                               class="modern-input @error('section') is-invalid @enderror" 
                               value="{{ old('section', $student->section) }}"
                               placeholder="ឧ. ភ្នំពេញ, ផ្សារដើមថ្កូវ">
                    </div>
                    @error('section')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">

                <!-- Action Buttons – exactly like patient edit -->
                <div class="action-buttons">
                    <a href="{{ route('students.grade', $student->grade) }}" class="btn-glass-light-war" style="text-decoration: none;">
                        <i class="bi bi-arrow-left"></i>
                        ត្រឡប់ទៅថ្នាក់
                    </a>

                    <button type="submit" class="btn-glass-light-pri">
                        <i class="bi bi-check2-circle"></i>
                        រក្សាទុកការកែប្រែ
                    </button>
                </div>

            </form>
        </div>
    </div>
    <!-- ================= END SINGLE CARD ================= -->

</div>

<!-- ================= JAVASCRIPT ================= -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editStudentForm');
        const inputs = form.querySelectorAll('input[required], select[required]');
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    
                    let feedback = input.parentElement.nextElementSibling;
                    if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        feedback.style.display = 'block';
                        feedback.textContent = 'សូមបំពេញព័ត៌មាននេះ';
                        input.parentElement.after(feedback);
                    }
                    
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                    const feedback = input.parentElement.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.style.display = 'none';
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showNotification('សូមបំពេញព័ត៌មានឲ្យបានត្រឹមត្រូវ', 'error');
            }
        });
        
        document.getElementById('resetBtn').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('តើអ្នកពិតជាចង់កំណត់តម្លៃឡើងវិញមែនទេ?')) {
                form.reset();
                showNotification('បានកំណត់តម្លៃឡើងវិញ', 'info');
            }
        });
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    });

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
</script>

<!-- ================= TOAST NOTIFICATIONS ================= -->
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideInRight 0.3s ease;">
    <div class="toast-modern d-flex align-items-center" style="border-left: 4px solid var(--success);">
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
    <div class="toast-modern toast-error d-flex align-items-center" style="border-left: 4px solid var(--danger);">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-exclamation-triangle-fill" style="color: var(--danger); font-size: 20px;"></i>
            <div class="fw-semibold" style="color: var(--dark);">{{ session('error') }}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.toast-modern').remove()"></button>
        </div>
    </div>
</div>
@endif

<!-- Auto hide toasts -->
<script>
    setTimeout(() => {
        document.querySelectorAll('.toast-modern').forEach(t => {
            t.style.opacity = '0';
            setTimeout(() => t.remove(), 500);
        });
    }, 3000);
</script>

<style>
/* ============= STUDENT ID BADGE ============= */
.student-id-badge {
    background: rgba(53, 89, 18, 0.08);
    padding: 12px 18px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
    border: 1px solid rgba(53, 89, 18, 0.15);
}
.student-id-badge i {
    font-size: 20px;
    color: var(--primary);
}
.student-id-badge span {
    font-weight: 700;
    color: var(--primary);
    font-size: 16px;
}
</style>

@endsection