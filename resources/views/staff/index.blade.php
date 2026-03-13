@extends('layouts.app')

@section('title','បុគ្គលិក')
@section('content')




{{-- MODERN TOAST NOTIFICATIONS --}}
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideIn 0.3s ease;">
    <div class="modern-toast success d-flex align-items-center" role="alert">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 20px;"></i>
            <div class="fw-semibold">{{ session('success') }}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.modern-toast').remove()"></button>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideIn 0.3s ease;">
    <div class="modern-toast error d-flex align-items-center" role="alert">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 20px;"></i>
            <div class="fw-semibold">{{ session('error') }}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.modern-toast').remove()"></button>
        </div>
    </div>
</div>
@endif

<div class="row g-4 animate-fade-in">

<!-- ================= MODERN FORM CARD ================= -->
<div class="col-lg-4">
    <div class="modern-card">
        <div class="card-header-gradient d-flex align-items-center">
            <i class="bi bi-person-badge fs-5"></i>
            <h5 class="mb-0 fw-bold">ទម្រង់ព័ត៌មានបុគ្គលិក</h5>
        </div>
        
        <div class="form-container">
            <form id="staffForm" method="POST" action="{{ route('staff.store') }}">
                @csrf
                <input type="hidden" id="staff_id">
                <input type="hidden" name="_method" id="methodField">
                
                {{-- Staff ID --}}
                <div class="form-label">
                    <i class="bi bi-upc-scan"></i> អត្តលេខ
                </div>
                <div class="position-relative">
                    <input id="code" name="code" class="modern-input w-100" placeholder="ឧ. STF-001">
                    <div class="invalid-feedback">សូមបញ្ចូលអត្តលេខ</div>
                </div>
                
                {{-- Full Name --}}
                <div class="form-label mt-3">
                    <i class="bi bi-person-circle"></i> ឈ្មោះ
                </div>
                <div class="position-relative">
                    <input id="name" name="name" class="modern-input w-100" placeholder="ឧ. សុខ មករា">
                    <div class="invalid-feedback">សូមបញ្ចូលឈ្មោះ</div>
                </div>
                
                {{-- Age & Gender Row --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-label mt-3">
                            <i class="bi bi-calendar"></i> អាយុ
                        </div>
                        <div class="position-relative">
                            <input id="age" name="age" class="modern-input w-100" placeholder="១៨-៦០">
                            <div class="invalid-feedback">សូមបញ្ចូលអាយុ (១-១២០)</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label mt-3">
                            <i class="bi bi-gender-ambiguous"></i> ភេទ
                        </div>
                        <div class="position-relative">
                            <select id="sex" name="sex" class="modern-select w-100">
                                <option value="">— ជ្រើសរើស —</option>
                                <option value="Male">ប្រុស</option>
                                <option value="Female">ស្រី</option>
                            </select>
                            <div class="invalid-feedback">សូមជ្រើសរើសភេទ</div>
                        </div>
                    </div>
                </div>
                
                {{-- Role --}}
                <div class="form-label mt-3">
                    <i class="bi bi-briefcase"></i> តួនាទី
                </div>
                <div class="position-relative">
                    <select id="role" name="role" class="modern-select w-100">
                        <option value="">— ជ្រើសរើសតួនាទី —</option>
                        <option value="admin">អ្នកគ្រប់គ្រង</option>
                        <option value="nurse">គិលានុបដ្ឋាយិកា</option>
                        <option value="teacher">គ្រូបង្រៀន</option>
                        <option value="staff">បុគ្គលិក</option>
                        <option value="security">សន្តិសុខ</option>
                        <option value="hr">មន្ត្រីធនធានមនុស្ស</option>
                        <option value="office">បុគ្គលិកការិយាល័យ</option>
                        <option value="secretary">លេខាធិការ</option>
                        <option value="cleaner">អ្នកសម្អាត</option>
                        <option value="it_officer">អ្នកគ្រប់គ្រងប្រព័ន្ធ IT</option>
                        <option value="gardener">អ្នកថែសួន</option>
                        <option value="other">ផ្សេងៗ</option>
                    </select>
                    <div class="invalid-feedback">សូមជ្រើសរើសតួនាទី</div>
                </div>
                
                {{-- Action Buttons --}}
                <div class="mt-4">
                    <button class="btn-glass-light-pri mb-2" id="saveBtn">
                        <i class="bi bi-save"></i> រក្សាទុក
                    </button>
                    
                    <button type="button" class="btn-glass-light-pri w-100 mb-2 d-none" id="updateBtn">
                        <i class="bi bi-pencil-square"></i> កែប្រែ
                    </button>
                    
                    <button type="button" class="btn-glass-light-dan w-100 mb-2 d-none" id="deleteBtn">
                        <i class="bi bi-trash3"></i> លុប
                    </button>
                    
                    <button type="button" class="btn-glass-light-war w-100 mb-2 " id="clearBtn">
                        <i class="bi bi-arrow-repeat"></i> សម្អាតទម្រង់
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODERN TABLE CARD ================= -->
<div class="col-lg-8">
    <div class="modern-card">
        <div class="card-header-gradient d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="bi bi-people fs-5 me-2"></i>
                <h5 class="mb-0 fw-bold">បញ្ជីបុគ្គលិក</h5>
            </div>
            
            {{-- Search Box --}}
            <div class="search-container">
                <i class="bi bi-search search-icon"></i>
                <input id="search" class="modern-search-light" placeholder="ស្វែងរកតាមឈ្មោះ ឬអត្តលេខ...">
            </div>
        </div>
        
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th><i class="bi bi-upc-scan me-1"></i> អត្តលេខ</th>
                        <th><i class="bi bi-person me-1"></i> ឈ្មោះ</th>
                        <th><i class="bi bi-gender-ambiguous me-1"></i> ភេទ</th>
                        <th><i class="bi bi-briefcase me-1"></i> តួនាទី</th>
                    </tr>
                </thead>
                <tbody id="staffTable">
                    @forelse($staffs as $s)
                    <tr onclick="selectStaff({{ $s->id }}, this)" style="cursor:pointer">
                        <td><span class="fw-semibold">{{ $s->code }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" 
                                     style="width: 32px; height: 32px; font-size: 12px; font-weight: bold;">
                                    {{ strtoupper(substr($s->name, 0, 1)) }}
                                </div>
                                {{ $s->name }}
                            </div>
                        </td>
                        <td>
                            <span class="gender-badge {{ $s->sex == 'Male' ? 'gender-male' : 'gender-female' }}">
                                {{ $s->sex_kh }}
                            </span>
                        </td>
                        <td>
                            @php
                                $roles = [
                                    'admin' => ['name' => 'អ្នកគ្រប់គ្រង', 'class' => 'role-admin'],
                                    'nurse' => ['name' => 'គិលានុបដ្ឋាយិកា', 'class' => 'role-nurse'],
                                    'teacher' => ['name' => 'គ្រូបង្រៀន', 'class' => 'role-teacher'],
                                    'staff' => ['name' => 'បុគ្គលិក', 'class' => ''],
                                    'security' => ['name' => 'សន្តិសុខ', 'class' => 'role-security'],
                                    'hr' => ['name' => 'មន្ត្រីធនធានមនុស្ស', 'class' => 'role-hr'],
                                    'office' => ['name' => 'បុគ្គលិកការិយាល័យ', 'class' => ''],
                                    'secretary' => ['name' => 'លេខាធិការ', 'class' => ''],
                                    'cleaner' => ['name' => 'អ្នកសម្អាត', 'class' => ''],
                                    'it_officer' => ['name' => 'អ្នកគ្រប់គ្រងប្រព័ន្ធ IT', 'class' => 'role-it'],
                                    'gardener' => ['name' => 'អ្នកថែសួន', 'class' => ''],
                                    'other' => ['name' => 'ផ្សេងៗ', 'class' => ''],
                                ];
                                $roleData = $roles[$s->role] ?? ['name' => '-', 'class' => ''];
                            @endphp
                            <span class="role-badge {{ $roleData['class'] }}">
                                {{ $roleData['name'] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 d-block text-muted mb-3"></i>
                            <span class="text-muted">មិនមានទិន្នន័យបុគ្គលិក</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($staffs, 'links'))
        <div class="card-footer bg-white border-0 py-3" style="margin-left: 15px;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    <i class="bi bi-info-circle me-1"></i>
                    បង្ហាញ {{ $staffs->firstItem() ?? 0 }} - {{ $staffs->lastItem() ?? 0 }} នៃ {{ $staffs->total() }} បុគ្គលិក
                </div>
                <div class="pagination-modern">
                    {{ $staffs->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

</div>

<!-- ================= MODERN DELETE CONFIRMATION MODAL ================= -->
<div class="modal fade modern-modal" id="deleteStaffModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-danger">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    បញ្ជាក់ការលុប
                </h5>
                {{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button> --}}
            </div>
            
            <div class="modal-body-warning">
                <div class="warning-icon">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
                <h5 class="fw-bold mb-3">តើអ្នកពិតជាចង់លុបមែនទេ?</h5>
                <p class="text-muted mb-0">
                    ការលុបបុគ្គលិកនេះនឹងមិនអាចត្រឡប់វិញបានទេ។<br>
                    ទិន្នន័យទាំងអស់ដែលពាក់ព័ន្ធនឹងត្រូវបានលុបចោល។
                </p>
            </div>
            
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i> បោះបង់
                </button>
                <button type="button" class="btn btn-danger px-4 py-2" id="confirmDeleteStaffBtn">
                    <i class="bi bi-trash3 me-1"></i> បញ្ជាក់ការលុប
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODERN JAVASCRIPT ================= -->
<script>
let hasSubmitted = false;

const staffForm = document.getElementById('staffForm');
const staffId = document.getElementById('staff_id');
const methodField = document.getElementById('methodField');

const saveBtn = document.getElementById('saveBtn');
const updateBtn = document.getElementById('updateBtn');
const deleteBtn = document.getElementById('deleteBtn');
const clearBtn = document.getElementById('clearBtn');

const code = document.getElementById('code');
const name = document.getElementById('name');
const age  = document.getElementById('age');
const sex  = document.getElementById('sex');
const role = document.getElementById('role');

/* ================= SELECT STAFF ================= */
function selectStaff(id, row) {
    hasSubmitted = false;
    
    document.querySelectorAll('#staffTable tr').forEach(tr => {
        tr.classList.remove('active-row');
    });
    row.classList.add('active-row');
    
    fetch(`/staff/${id}`)
        .then(r => r.json())
        .then(s => {
            staffId.value = s.id;
            code.value = s.code;
            name.value = s.name;
            age.value = s.age;
            sex.value = s.sex;
            role.value = s.role;
            
            clearValidation();
            
            saveBtn.classList.add('d-none');
            updateBtn.classList.remove('d-none');
            deleteBtn.classList.remove('d-none');
            
            staffForm.action = `/staff/${id}`;
            methodField.value = 'PUT';
            
            // Show success toast
            showToast('ជ្រើសរើសបុគ្គលិក ' + s.name, 'success');
        })
        .catch(error => {
            showToast('មានបញ្ហាក្នុងការទាញទិន្នន័យ', 'error');
        });
}

/* ================= VALIDATION ================= */
function clearValidation() {
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');
}

function validateField(field) {
    if (!hasSubmitted) return true;
    
    let valid = true;
    const feedback = field.nextElementSibling?.classList.contains('invalid-feedback') 
        ? field.nextElementSibling 
        : field.parentElement?.querySelector('.invalid-feedback');
    
    if (field === code || field === name) {
        valid = field.value.trim() !== '';
    }
    else if (field === age) {
        const v = field.value.trim();
        valid = v !== '' && !isNaN(v) && Number(v) > 0 && Number(v) <= 120;
    }
    else if (field === sex || field === role) {
        valid = field.value !== '';
    }
    
    if (!valid) {
        field.classList.add('is-invalid');
        if (feedback) feedback.style.display = 'block';
    } else {
        field.classList.remove('is-invalid');
        if (feedback) feedback.style.display = 'none';
    }
    
    return valid;
}

function validateStaffForm() {
    let ok = true;
    [code, name, age, sex, role].forEach(f => {
        if (!validateField(f)) ok = false;
    });
    return ok;
}

/* ================= EVENT LISTENERS ================= */
[code, name, age].forEach(i => i.addEventListener('input', () => validateField(i)));
[sex, role].forEach(s => s.addEventListener('change', () => validateField(s)));

/* ================= SAVE (CREATE) ================= */
saveBtn.onclick = (e) => {
    e.preventDefault();
    hasSubmitted = true;
    
    if (!validateStaffForm()) {
        showToast('សូមបំពេញព័ត៌មានឲ្យបានត្រឹមត្រូវ', 'error');
        return;
    }
    
    staffForm.action = "{{ route('staff.store') }}";
    methodField.value = '';
    staffForm.submit();
};

/* ================= UPDATE ================= */
updateBtn.onclick = (e) => {
    e.preventDefault();
    hasSubmitted = true;
    
    if (!validateStaffForm()) {
        showToast('សូមបំពេញព័ត៌មានឲ្យបានត្រឹមត្រូវ', 'error');
        return;
    }
    
    staffForm.submit();
};

/* ================= DELETE ================= */
deleteBtn.onclick = () => {
    if (!staffId.value) return;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteStaffModal'));
    modal.show();
};

/* ================= CONFIRM DELETE ================= */
document.getElementById('confirmDeleteStaffBtn').onclick = () => {
    staffForm.action = `/staff/${staffId.value}`;
    methodField.value = 'DELETE';
    staffForm.submit();
};

/* ================= CLEAR ================= */
clearBtn.onclick = () => {
    hasSubmitted = false;
    staffForm.reset();
    staffId.value = '';
    methodField.value = '';
    clearValidation();
    
    saveBtn.classList.remove('d-none');
    updateBtn.classList.add('d-none');
    deleteBtn.classList.add('d-none');
    
    document.querySelectorAll('#staffTable tr').forEach(tr => {
        tr.classList.remove('active-row');
    });
    
    staffForm.action = "{{ route('staff.store') }}";
    
    showToast('ទម្រង់ត្រូវបានសម្អាត', 'info');
};

/* ================= SEARCH ================= */
document.getElementById('search').addEventListener('keyup', function() {
    let q = this.value.toLowerCase();
    document.querySelectorAll('#staffTable tr').forEach(tr => {
        const text = tr.innerText.toLowerCase();
        tr.style.display = text.includes(q) ? '' : 'none';
    });
});

/* ================= TOAST NOTIFICATION ================= */
function showToast(message, type = 'success') {
    const toastContainer = document.querySelector('.position-fixed.top-0.end-0') || (() => {
        const div = document.createElement('div');
        div.className = 'position-fixed top-0 end-0 p-3';
        div.style.zIndex = '9999';
        document.body.appendChild(div);
        return div;
    })();
    
    const toast = document.createElement('div');
    toast.className = `modern-toast ${type} d-flex align-items-center mb-2`;
    toast.style.animation = 'slideIn 0.3s ease';
    
    const icon = type === 'success' ? 'bi-check-circle-fill text-success' : 
                 type === 'error' ? 'bi-exclamation-triangle-fill text-danger' : 
                 'bi-info-circle-fill text-info';
    
    toast.innerHTML = `
        <div class="d-flex align-items-center gap-3">
            <i class="bi ${icon}" style="font-size: 20px;"></i>
            <div class="fw-semibold">${message}</div>
            <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.modern-toast').remove()"></button>
        </div>
    `;
    
    toastContainer.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

/* ================= AUTO HIDE TOASTS ================= */
setTimeout(() => {
    document.querySelectorAll('.modern-toast').forEach(t => {
        t.style.opacity = '0';
        setTimeout(() => t.remove(), 500);
    });
}, 3000);
</script>

@endsection