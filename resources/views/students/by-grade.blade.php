@extends('layouts.app')

@section('title','សិស្សថ្នាក់ទី '. $grade)

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Battambang:wght@300;400;500;600;700&family=Koulen&display=swap">

<div class="container-fluid px-4 py-4">

    {{-- ================= MODERN PAGE HEADER ================= --}}
    {{-- Replaced .page-header-modern with .page-header (glass success) --}}
    <div class="page-header d-flex flex-wrap align-items-center justify-content-between">
        <div class="page-title">
            <h4>
                <i class="bi bi-people-fill"></i>
                សិស្សថ្នាក់ទី {{ $grade }}
            </h4>
            {{-- Replaced .grade-badge with .grade-badge (from master CSS) --}}
            <span class="">
                {{-- <i class="bi bi-door-open-fill"></i> --}}
                @php
                    $studentCount = $students->total();
                    $maleCount = $students->where('sex', 'Male')->count();
                    $femaleCount = $students->where('sex', 'Female')->count();
                @endphp
                {{-- <span>សិស្សសរុប <strong>{{ $studentCount }}</strong> នាក់</span> --}}
            </span>
        </div>
        
        <div class="d-flex gap-3 align-items-center">
            {{-- Replaced .search-box-modern with .search-wrapper + .modern-search-light --}}
            <div class="search-container d-none d-md-block">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="studentSearch" class="modern-search-light" placeholder="ស្វែងរកសិស្ស...">
            </div>
            
            {{-- .back-btn already exists in master CSS --}}
            <a href="{{ route('students.all') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                ត្រឡប់ក្រោយ
            </a>
        </div>
    </div>

    {{-- ================= STATISTICS CARDS ================= --}}
    {{-- Replaced .stats-grid with .summary-stats, .stat-card-modern with .stat-card, etc. --}}
    <div class="summary-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-info">
                <h6>សិស្សសរុប</h6>
                <span>{{ $studentCount }}</span>
                <small>នាក់</small>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: var(--primary);">
                <i class="bi bi-gender-male"></i>
            </div>
            <div class="stat-info">
                <h6>សិស្សប្រុស</h6>
                <span>{{ $maleCount }}</span>
                <small>នាក់</small>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: var(--danger);">
                <i class="bi bi-gender-female"></i>
            </div>
            <div class="stat-info">
                <h6>សិស្សស្រី</h6>
                <span>{{ $femaleCount }}</span>
                <small>នាក់</small>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: var(--success);">
                <i class="bi bi-door-open-fill"></i>
            </div>
            <div class="stat-info">
                <h6>ថ្នាក់ទី</h6>
                <span>{{ $grade }}</span>
            </div>
        </div>
    </div>

    {{-- ================= TOAST NOTIFICATIONS ================= --}}
    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; animation: slideInRight 0.3s ease;">
        <div class="toast-modern d-flex align-items-center" role="alert">
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
        <div class="toast-modern toast-error d-flex align-items-center" role="alert">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-exclamation-triangle-fill" style="color: var(--danger); font-size: 20px;"></i>
                <div class="fw-semibold" style="color: var(--dark);">{{ session('error') }}</div>
                <button type="button" class="btn-close btn-sm ms-3" onclick="this.closest('.toast-modern').remove()"></button>
            </div>
        </div>
    </div>
    @endif


    <div class="modern-card">
        <div class="">
            {{-- ================= STUDENT TABLE ================= --}}
    
        <div class="table-container">
            <div class="table-responsive">
                <table class="modern-table" id="studentTable">
                    <thead>
                        <tr>
                            <th style="width: 120px;"><i class="bi bi-upc-scan me-1"></i> អត្តលេខ</th>
                            <th><i class="bi bi-person-circle me-1"></i> ឈ្មោះ</th>
                            <th style="width: 100px;"><i class="bi bi-gender-ambiguous me-1"></i> ភេទ</th>
                            <th><i class="bi bi-geo-alt me-1"></i> អាស័យដ្ឋាន</th>
                            <th style="width: 120px;" class="text-center"><i class="bi bi-tools me-1"></i> សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        @forelse($students as $s)
                        <tr class="student-row">
                            <td style="text-align: center; font-weight: 600; color: var(--primary);">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                    {{ $s->code }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    {{-- .student-avatar already exists --}}
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($s->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $s->name }}</div>
                                        <small class="text-muted">ID: ST{{ str_pad($s->id, 5, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                {{-- Replaced .gender-badge-modern with .gender-badge, etc. --}}
                                <span class="gender-badge {{ $s->sex == 'Male' ? 'gender-male' : 'gender-female' }}">
                                    {{ $s->sex == 'Male' ? 'ប្រុស' : 'ស្រី' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-pin-map-fill me-2" style="color: var(--secondary);"></i>
                                    {{ $s->section ?? 'មិនមានទិន្នន័យ' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Replaced .action-btn with .action-icon-btn --}}
                                    <a href="{{ route('students.edit', $s->id) }}"
                                    class="action-icon-btn btn-edit"
                                    title="កែប្រែ">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button class="action-icon-btn btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteStudentModal"
                                            data-id="{{ $s->id }}"
                                            data-name="{{ $s->name }}"
                                            title="លុប">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            {{-- Replaced .empty-state-modern with .empty-state --}}
                            <td colspan="5" class="empty-state">
                                <i class="bi bi-people"></i>
                                <h5>មិនទាន់មានសិស្សនៅឡើយទេ</h5>
                                <p class="text-muted">សូមបន្ថែមសិស្សថ្មីដើម្បីបង្ហាញនៅទីនេះ</p>
                                {{-- Replaced .btn-primary with .btn-glass-light-pri --}}
                                <a href="{{ route('students.create') }}" class="btn-glass-light-pri mt-3" style="text-decoration: none;">
                                    <i class="bi bi-plus-circle me-1"></i> បន្ថែមសិស្ស
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($students, 'links') && $students->total() > 0)
            <div class="card-footer bg-white border-0 py-4 px-4">
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
                    {{-- .pagination-modern already exists --}}
                    <div class="pagination-modern">
                        {{ $students->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
        </div>
    </div>
    

</div>

{{-- ================= MODERN DELETE CONFIRMATION MODAL ================= --}}
{{-- Replaced .modal-modern with .modern-modal, .modal-header-modern with .modal-header-danger, .modal-body-modern with .modal-body-warning, .modal-icon with .warning-icon, .btn-outline-modal with .btn-outline-secondary --}}
<div class="modal fade modern-modal" id="deleteStudentModal" tabindex="-1" aria-hidden="true">
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
                <h5 class="fw-bold mb-3" style="color: var(--dark);" id="deleteStudentName">តើអ្នកពិតជាចង់លុបមែនទេ?</h5>
                <p class="text-muted mb-0">
                    ការលុបសិស្សនេះនឹងមិនអាចត្រឡប់វិញបានទេ។<br>
                    រាល់ទិន្នន័យដែលពាក់ព័ន្ធនឹងត្រូវបានលុបចេញពីប្រព័ន្ធ។
                </p>
            </div>
            
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>
                    បោះបង់
                </button>

                <form method="POST" id="deleteStudentForm" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 py-2" style="border-radius: 12px;">
                        <i class="bi bi-trash3 me-1"></i>
                        បញ្ជាក់ការលុប
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ================= JAVASCRIPT ================= --}}
<script>
    // Auto hide toasts
    setTimeout(() => {
        document.querySelectorAll('.toast-modern').forEach(t => {
            t.style.opacity = '0';
            setTimeout(() => t.remove(), 500);
        });
    }, 3000);

    // Delete modal - set student data
    const deleteModal = document.getElementById('deleteStudentModal');
    
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const studentId = button.getAttribute('data-id');
        const studentName = button.getAttribute('data-name');
        
        document.getElementById('deleteStudentForm').action = `/students/${studentId}`;
        
        const deleteTitle = document.getElementById('deleteStudentName');
        if (deleteTitle && studentName) {
            deleteTitle.innerHTML = `លុបសិស្ស <strong style="color: var(--danger);">${studentName}</strong> មែនទេ?`;
        }
    });

    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('studentSearch');
        
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                const rows = document.querySelectorAll('#studentTableBody .student-row');
                
                rows.forEach(row => {
                    const name = row.querySelector('.fw-semibold')?.textContent.toLowerCase() || '';
                    const code = row.querySelector('.badge')?.textContent.toLowerCase() || '';
                    
                    if (name.includes(query) || code.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });

    // Add animation to table rows
    document.querySelectorAll('.modern-table tbody tr').forEach((row, index) => {
        row.style.animation = `fadeInUp 0.5s ease backwards ${index * 0.05}s`;
    });

    // Define fadeInUp animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
</script>

@endsection