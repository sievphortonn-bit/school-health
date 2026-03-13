@extends('layouts.app')
@section('title','ប្រវត្តិអ្នកជំងឺ​ - ' . $patient->name)
@section('content')

<style>
    /* ============= FIX TOAST WIDTH ============= */
    .position-fixed.top-0.end-0 .toast-modern {
        max-width: 400px;
        width: auto;
        min-width: 280px;
        white-space: normal;
        word-wrap: break-word;
        margin-top: 70px; /* Add margin to clear the navbar */
    }
    .toast-modern .btn-close {
        flex-shrink: 0;
    }
    /* ============= FIX MODAL HEADER FLEX ============= */
    .modal-header-primary,
    .modal-header-danger {
        display: flex;
        align-items: center;
        justify-content: space-between !important;
        padding: 16px 20px;
    }
    .modal-header-primary .btn-close,
    .modal-header-danger .btn-close {
        margin: 0;
    }
</style>

<div class="row g-4">

    

    <!-- ================= MODERN PATIENT PROFILE ================= -->
    <div class="col-12">

        @if(session('success'))

            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>

            {{-- <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideInRight 0.3s ease;">
                <div class="toast-modern d-flex align-items-center">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <i class="bi bi-check-circle-fill flex-shrink-0" style="color: var(--success); font-size: 20px;"></i>
                        <div class="fw-semibold" style="color: var(--dark); word-break: break-word;">{{ session('success') }}</div>
                        <button type="button" class="btn-close btn-sm ms-auto flex-shrink-0" onclick="this.closest('.toast-modern').remove()"></button>
                    </div>
                </div>
            </div> --}}
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
            </div>
            {{-- <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideInRight 0.3s ease;">
                <div class="toast-modern toast-error d-flex align-items-center">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0" style="color: var(--danger); font-size: 20px;"></i>
                        <div class="fw-semibold" style="color: var(--dark); word-break: break-word;">{{ session('error') }}</div>
                        <button type="button" class="btn-close btn-sm ms-auto flex-shrink-0" onclick="this.closest('.toast-modern').remove()"></button>
                    </div>
                </div>
            </div> --}}
        @endif
        <div class="patient-profile-card">
            <div class="profile-header">
                <div class="d-flex align-items-center">
                    <div class="patient-title">
                        <div class="patient-name">
                            <i class="bi bi-person-heart"></i>
                            <strong>{{ $patient->name }}</strong>
                        </div>
                        <div class="d-flex gap-2">
                            @php
                                $typeClass = '';
                                $typeIcon = '';
                                $typeText = '';
                                
                                if ($patient->patient_type === 'student') {
                                    $typeClass = 'primary';
                                    $typeIcon = 'bi-backpack';
                                    $typeText = 'សិស្ស';
                                } elseif ($patient->patient_type === 'teacher') {
                                    $typeClass = 'secondary';
                                    $typeIcon = 'bi-person-video3';
                                    $typeText = 'គ្រូបង្រៀន';
                                } else {
                                    $typeClass = 'success';
                                    $typeIcon = 'bi-briefcase';
                                    $typeText = 'បុគ្គលិក';
                                }
                            @endphp
                            <span class="patient-badge">
                                <i class="bi {{ $typeIcon }}"></i> {{ $typeText }}
                            </span>
                            <span class="patient-badge">
                                <i class="bi bi-shield"></i> ID: PT{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('patients.index') }}" class="back-btn" style="text-decoration: none;">
                    <i class="bi bi-arrow-left"></i>
                    ត្រឡប់ក្រោយ
                </a>
            </div>

            <div class="patient-info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-calendar3"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">អាយុ</div>
                        <div class="info-value">{{ $patient->age ?? '-' }} ឆ្នាំ</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon" style="color: {{ $patient->sex == 'Male' ? 'var(--primary)' : 'var(--danger)' }};">
                        <i class="bi {{ $patient->sex == 'Male' ? 'bi-gender-male' : 'bi-gender-female' }}"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">ភេទ</div>
                        <div class="info-value">{{ $patient->sex == 'Male' ? 'ប្រុស' : 'ស្រី' }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">ថ្នាក់ / កម្រិត</div>
                        <div class="info-value">{{ $patient->grade_or_level ?? '-' }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">ប្រវត្តិសរុប</div>
                        <div class="info-value">{{ count($histories) }} ដង</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODERN ADD HISTORY FORM ================= -->
    <div class="col-lg-4" style="margin-top: -10px;">
        <div class="modern-form-card">
            <div class="form-card-header">
                <i class="bi bi-clipboard-plus"></i>
                <h6 class="mb-0 fw-bold">បន្ថែមប្រវត្តិជំងឺថ្មី</h6>
            </div>

            <div class="form-body">
                <form method="POST" action="{{ route('patients.history.store', $patient->id) }}">
                    @csrf

                    <div class="form-group">
                        <div class="form-label">
                            <i class="bi bi-chat"></i>
                            អាការៈ
                        </div>
                        <textarea name="complaint" class="modern-textarea" placeholder="ពិពណ៌នាអំពីរោគសញ្ញា..." required></textarea>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <i class="bi bi-heart-pulse"></i>
                            ការអន្តរាគមន៍
                        </div>
                        <textarea name="intervention" class="modern-textarea" placeholder="ការអន្តរាគមន៍ដំបូង..."></textarea>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <i class="bi bi-capsule"></i>
                            ការព្យាបាល
                        </div>
                        <textarea name="treatment" class="modern-textarea" placeholder="វេជ្ជបញ្ជា ឬការព្យាបាល..."></textarea>
                    </div>

                    <button class="btn-modern btn-primary-modern mt-3">
                        <i class="bi bi-save2"></i>
                        រក្សាទុកប្រវត្តិជំងឺ
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= MODERN HISTORY LIST ================= -->
    <div class="col-lg-8" style="margin-top: -10px;">
        <div class="history-table-container">
            <div class="table-header-modern">
                <h6 class="mb-0 d-flex align-items-center">
                    <i class="bi bi-clock-history"></i>
                    ប្រវត្តិជំងឺទាំងអស់
                    <span class="badge bg-white bg-opacity-20 text-white ms-3 px-3 py-2 rounded-pill">
                        {{ count($histories) }} ដង
                    </span>
                </h6>
                
                <a href="{{ route('patients.print', $patient->id) }}"
                    target="_blank"
                    class="print-all-btn">
                    <i class="bi bi-printer"></i>
                    បោះពុម្ពប្រវត្តិទាំងអស់
                </a>
            </div>

            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width:100px;">កាលបរិច្ឆេទ</th>
                            <th style="width:100px;">ម៉ោង</th>
                            <th>អាការៈ</th>
                            <th>ការព្យាបាល</th>
                            <th style="width:140px;">កត់ត្រាដោយ</th>
                            <th style="width:140px;">សកម្មភាព</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($histories as $h)
                        <tr>
                            <td>
                                <div class="date-badge">
                                    <span class="date-day">{{ $h->created_at->format('d') }}</span>
                                    <span class="date-month">{{ $h->created_at->format('M Y') }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="time-badge" style="text-align: center;">
                                    {{ $h->created_at->format('h:i A') }}
                                </span>
                            </td>
                            <td>
                                <div style="max-width: 200px; word-wrap: break-word;">
                                    {{ \Illuminate\Support\Str::limit($h->complaint, 50) }}
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 200px; word-wrap: break-word;">
                                    {{ \Illuminate\Support\Str::limit($h->treatment ?? '-', 50) }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" 
                                         style="width: 30px; height: 30px; background: rgba(58, 134, 255, 0.1);">
                                        <i class="bi bi-person" style="color: var(--primary);"></i>
                                    </div>
                                    <span>{{ $h->administered_by }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="action-icon-btn-sm btn-print-sm" onclick="printHistory({{ $h->id }})" title="បោះពុម្ព">
                                        <i class="bi bi-printer"></i>
                                    </button>

                                    <button class="action-icon-btn-sm btn-edit-sm"
                                            title="កែប្រែ"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editHistoryModal"
                                            data-id="{{ $h->id }}"
                                            data-complaint="{{ $h->complaint }}"
                                            data-intervention="{{ $h->intervention }}"
                                            data-treatment="{{ $h->treatment }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    
                                    <button class="action-icon-btn-sm btn-delete-sm"
                                            title="លុប"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteHistoryModal"
                                            data-id="{{ $h->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="empty-state-history">
                                <i class="bi bi-clock-history"></i>
                                <p>មិនទាន់មានប្រវត្តិជំងឺនៅឡើយទេ</p>
                                <small class="text-muted">សូមបន្ថែមប្រវត្តិជំងឺថ្មីតាមរយៈទម្រង់ខាងឆ្វេងដៃ</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- ================= MODERN DELETE HISTORY MODAL ================= -->
<div class="modal fade modern-modal" id="deleteHistoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-danger">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    បញ្ជាក់ការលុបប្រវត្តិជំងឺ
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" id="deleteHistoryForm">
                @csrf
                @method('DELETE')

                <div class="modal-body-warning">
                    <div class="warning-icon">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: var(--dark);">
                        តើអ្នកពិតជាចង់លុបប្រវត្តិជំងឺនេះមែនទេ?
                    </h5>
                    <p class="text-muted mb-0">
                        ការលុបប្រវត្តិជំងឺនេះនឹងមិនអាចត្រឡប់វិញបានទេ។<br>
                        ទិន្នន័យទាំងអស់នឹងត្រូវបានលុបចេញពីប្រព័ន្ធ។
                    </p>
                </div>

                <div class="modal-footer border-0 pb-4">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> បោះបង់
                    </button>
                    <button type="submit" class="btn btn-danger px-4 py-2">
                        <i class="bi bi-trash3 me-1"></i> បញ្ជាក់ការលុប
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODERN EDIT HISTORY MODAL ================= -->
<div class="modal fade modern-modal" id="editHistoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-primary">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>
                    កែប្រែប្រវត្តិជំងឺ
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" id="editHistoryForm">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group mb-3">
                        <div class="form-label">
                            <i class="bi bi-chat"></i>
                            អាការៈ
                        </div>
                        <textarea name="complaint" id="edit_complaint" class="modern-textarea" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-label">
                            <i class="bi bi-heart-pulse"></i>
                            ការអន្តរាគមន៍
                        </div>
                        <textarea name="intervention" id="edit_intervention" class="modern-textarea"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-label">
                            <i class="bi bi-capsule"></i>
                            ការព្យាបាល
                        </div>
                        <textarea name="treatment" id="edit_treatment" class="modern-textarea"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> បោះបង់
                    </button>
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="bi bi-save2 me-1"></i> រក្សាទុក
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= JAVASCRIPT ================= -->
<script>
    // ================ PRINT HISTORY ================
    function printHistory(id) {
        const w = window.open(
            `/history/${id}/print`,
            '_blank',
            'width=900,height=650'
        );

        if (!w) {
            alert('សូមអនុញ្ញាត popup ដើម្បីបោះពុម្ព');
        }
    }

    // ================ EDIT MODAL ================
    const editModal = document.getElementById('editHistoryModal');

    editModal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;

        const id = btn.getAttribute('data-id');
        const complaint = btn.getAttribute('data-complaint');
        const intervention = btn.getAttribute('data-intervention');
        const treatment = btn.getAttribute('data-treatment');

        document.getElementById('editHistoryForm').action = `/history/${id}`;
        document.getElementById('edit_complaint').value = complaint;
        document.getElementById('edit_intervention').value = intervention;
        document.getElementById('edit_treatment').value = treatment;
    });

    // ================ DELETE MODAL ================
    const deleteModal = document.getElementById('deleteHistoryModal');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const historyId = button.getAttribute('data-id');

        document.getElementById('deleteHistoryForm').action = `/history/${historyId}`;
    });

    // ================ TOAST AUTO HIDE ================
    setTimeout(() => {
        document.querySelectorAll('.toast-modern').forEach(t => {
            t.style.opacity = '0';
            setTimeout(() => t.remove(), 500);
        });
    }, 3000);
</script>

@endsection