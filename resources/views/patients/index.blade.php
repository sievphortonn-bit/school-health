@extends('layouts.app')
@section('title', 'បញ្ជីអ្នកជំងឺ')


@section('content')

    {{-- ================= STYLES ================= --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" />

    {{-- ================= TOAST NOTIFICATIONS ================= --}}
    @if (session('success'))
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

    @if (session('error'))
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

    {{-- ================= MODERN FILTER SECTION ================= --}}
    <div class="filter-section animate-fade-in">
        <div class="filter-title">
            <i class="bi bi-funnel"></i>
            <span>តម្រងអ្នកជំងឺ</span>
        </div>

        <div class="type-group">
            <button type="button" class="type-btn active" onclick="setType('', this)">
                <i class="bi bi-grid-3x3-gap-fill"></i> ទាំងអស់
            </button>
            <button type="button" class="type-btn" onclick="setType('student', this)">
                <i class="bi bi-backpack"></i> សិស្ស
            </button>
            <button type="button" class="type-btn" onclick="setType('teacher', this)">
                <i class="bi bi-person-video3"></i> គ្រូ
            </button>
            <button type="button" class="type-btn" onclick="setType('staff', this)">
                <i class="bi bi-briefcase"></i> បុគ្គលិក
            </button>
        </div>

        <div id="subFilterBox" class="sub-filter-box d-none">
            <div class="sub-filter-label">
                <i class="bi bi-diagram-3" id="subFilterIcon"></i>
                <span id="subFilterLabel"></span>
            </div>
            <div class="sub-filter-buttons" id="subFilterButtons"></div>
        </div>
    </div>

    {{-- ================= MODERN TABLE CARD ================= --}}
    <div class="modern-card animate-fade-in">
        {{-- Header with dark gradient --}}
        <div class="card-header-gradient d-flex align-items-center justify-content-between">
            <div class="header-title">
                <i class="bi bi-heart-pulse"></i>
                <span>បញ្ជីអ្នកជំងឺ</span>
                {{-- <span class="badge px-3 py-2 rounded-pill" id="patientCount"
                      style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.1);">
                    {{ $patients->total() }} នាក់
                </span> --}}
            </div>
            <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input id="search" class="modern-search-light" type="text" placeholder="ស្វែងរកអ្នកជំងឺ...">
                </div>
            <div class="header-actions d-flex align-items-center gap-2">
                {{-- Search box – dark version --}}
                

                <button class="btn-glass-light btn-primary" data-bs-toggle="modal" data-bs-target="#createPatientModal">
                    <i class="bi bi-plus-lg"></i> បន្ថែមថ្មី
                </button>

                <a href="{{ route('patients.report') }}" class="btn-glass-light" style="text-decoration: none;">
                    <i class="bi bi-bar-chart-line"></i> របាយការណ៍
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-container">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th style="width:140px;">កាលបរិច្ឆេទ / ម៉ោង</th>
                            <th>ឈ្មោះ</th>
                            <th style="width:130px;">ប្រភេទ</th>
                            <th style="width:80px;">អាយុ</th>
                            <th style="width:120px;">កម្រិត / ថ្នាក់</th>
                            <th style="width:140px;">សកម្មភាព</th>
                        </tr>
                    </thead>

                    <tbody id="patientTable">
                        @forelse ($patients as $patient)
                            <tr onclick="goToPatient({{ $patient->id }})" style="cursor:pointer">
                                <td>
                                    <span class="fw-semibold" style="color: var(--primary);">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="date-cell">
                                        <span class="date-day">{{ $patient->created_at->format('M d, Y') }}</span>
                                        <span class="date-time">{{ $patient->created_at->format('h:i A') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- <div class="patient-avatar">
                                            {{ strtoupper(substr($patient->name, 0, 1)) }}
                                        </div> --}}
                                        <div class="text-start">
                                            <div class="fw-semibold">{{ $patient->name }}</div>
                                            <small class="text-muted">ID: PT{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $typeClass = $patient->patient_type === 'student' ? 'type-student' : 
                                                     ($patient->patient_type === 'teacher' ? 'type-teacher' : 'type-staff');
                                        $typeIcon = $patient->patient_type === 'student' ? 'bi-backpack' : 
                                                    ($patient->patient_type === 'teacher' ? 'bi-person-video3' : 'bi-briefcase');
                                        $typeText = $patient->patient_type === 'student' ? 'សិស្ស' : 
                                                    ($patient->patient_type === 'teacher' ? 'គ្រូបង្រៀន' : 'បុគ្គលិក');
                                    @endphp
                                    <span class="type-badge {{ $typeClass }}">
                                        <i class="bi {{ $typeIcon }} me-1"></i>
                                        {{ $typeText }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $patient->age ?? '-' }}</span>
                                    <small class="text-muted">ឆ្នាំ</small>
                                </td>
                                <td>
                                    @if($patient->grade_or_level)
                                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                            <i class="bi bi-mortarboard me-1" style="color: var(--primary);"></i>
                                            {{ $patient->grade_or_level }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('patients.show', $patient->id) }}" 
                                           class="action-icon-btn btn-view no-row-click" 
                                           title="មើលលម្អិត">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('patients.edit', $patient->id) }}" 
                                           class="action-icon-btn btn-edit no-row-click" 
                                           title="កែប្រែ">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button type="button" 
                                                class="action-icon-btn btn-delete no-row-click" 
                                                title="លុប"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deletePatientModal"
                                                data-id="{{ $patient->id }}"
                                                data-name="{{ $patient->name }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="bi bi-heart-pulse"></i>
                                    <p>មិនទាន់មានអ្នកជំងឺនៅឡើយទេ</p>
                                    <small class="text-muted">សូមបន្ថែមអ្នកជំងឺថ្មីតាមរយៈប៊ូតុង "បន្ថែមថ្មី"</small>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 py-3 px-4" id="pagination">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-muted small">
                    <i class="bi bi-info-circle me-1"></i>
                    បង្ហាញ 
                    <span class="fw-bold" style="color: var(--primary);">{{ $patients->firstItem() ?? 0 }}</span> - 
                    <span class="fw-bold" style="color: var(--primary);">{{ $patients->lastItem() ?? 0 }}</span> 
                    នៃ 
                    <span class="fw-bold" style="color: var(--primary);">{{ $patients->total() }}</span> 
                    អ្នកជំងឺ
                </div>
                <div class="pagination-modern">
                    {{ $patients->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    
    {{-- ================= MODERN DELETE MODAL ================= --}}
    <div class="modal fade modern-modal" id="deletePatientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-danger">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        បញ្ជាក់ការលុបអ្នកជំងឺ
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body-warning">
                    <div class="warning-icon">
                        <i class="bi bi-person-dash-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: var(--dark);" id="deletePatientName">
                        តើអ្នកពិតជាចង់លុបអ្នកជំងឺនេះមែនទេ?
                    </h5>
                    <p class="text-muted mb-0">
                        ការលុបអ្នកជំងឺនេះនឹងមិនអាចត្រឡប់វិញបានទេ។<br>
                        រាល់ទិន្នន័យដែលពាក់ព័ន្ធនឹងត្រូវបានលុបចេញពីប្រព័ន្ធ។
                    </p>
                </div>

                <div class="modal-footer border-0 pb-4">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> បោះបង់
                    </button>

                    <form method="POST" id="deletePatientForm">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger px-4 py-2">
                            <i class="bi bi-trash3 me-1"></i> បញ្ជាក់ការលុប
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= CREATE PATIENT MODAL ================= --}}
    <div class="modal fade modern-modal" id="createPatientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header-primary d-flex align-items-center gap-2 justify-content-between">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-heart-pulse me-2"></i>
                        បញ្ចូលអ្នកជំងឺថ្មី
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" action="{{ route('patients.store') }}">
                    @csrf

                    <div class="modal-body">
                        <!-- PATIENT TYPE -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-tag-fill" style="color: var(--primary);"></i>
                                ប្រភេទអ្នកជំងឺ <span class="text-danger">*</span>
                            </label>
                            <select name="patient_type" id="create_patient_type" class="modern-select" required>
                                <option value="">— ជ្រើសរើសប្រភេទ —</option>
                                <option value="student">សិស្ស</option>
                                <option value="teacher">គ្រូបង្រៀន</option>
                                <option value="staff">បុគ្គលិក</option>
                            </select>
                        </div>

                        <!-- FILTER SECTION (GRADE/LEVEL) -->
                        <div id="create_filterBox" class="form-group mb-4 d-none">
                            <label class="form-label fw-semibold mb-2" id="create_filterLabel">
                                <i class="bi bi-diagram-3" style="color: var(--primary);"></i>
                                ជ្រើសរើសថ្នាក់ <span class="text-danger">*</span>
                            </label>
                            <div id="create_filterButtons" class="d-flex flex-wrap gap-2"></div>
                        </div>

                        <!-- REFERENCE ID -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-person-badge-fill" style="color: var(--primary);"></i>
                                ជ្រើសរើសឈ្មោះ <span class="text-danger">*</span>
                            </label>
                            <select name="ref_id" id="create_ref_id" class="" required>
                                <option value="">— ជ្រើសរើសឈ្មោះ —</option>
                            </select>
                            <div class="small text-muted mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                សូមជ្រើសរើសប្រភេទអ្នកជំងឺ និងតម្រងជាមុន
                            </div>
                        </div>

                        <hr>

                        <!-- FIRST HISTORY -->
                        <h6 class="fw-bold mb-3" style="color: var(--primary);">
                            <i class="bi bi-clipboard-plus me-2"></i>
                            ប្រវត្តិជំងឺដំបូង
                        </h6>

                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-chat-fill" style="color: var(--primary);"></i>
                                អាការៈ <span class="text-danger">*</span>
                            </label>
                            <textarea name="complaint" class="modern-textarea" 
                                      placeholder="ពិពណ៌នាអំពីរោគសញ្ញា..." 
                                      rows="3" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-heart-pulse-fill" style="color: var(--primary);"></i>
                                ការអន្តរាគមន៍
                            </label>
                            <textarea name="intervention" class="modern-textarea" 
                                      placeholder="ការអន្តរាគមន៍ដំបូង..." 
                                      rows="2"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold mb-2">
                                <i class="bi bi-capsule-fill" style="color: var(--primary);"></i>
                                ការព្យាបាល
                            </label>
                            <textarea name="treatment" class="modern-textarea" 
                                      placeholder="វេជ្ជបញ្ជា ឬការព្យាបាល..." 
                                      rows="2"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
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

    {{-- ================= SCRIPTS ================= --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    
    <script>
    // ================ GLOBAL DATA ================
    const grades = @json($grades);
    const levels = @json($levels);
    const students = @json($students);
    const teachers = @json($teachers);
    const staffs = @json($staffs);

    // ================ CREATE MODAL - SELECTIZE ================
    let createSelectize = null;
    
    $(document).ready(function() {
        $('#createPatientModal').on('shown.bs.modal', function() {
            if (!createSelectize) {
                setTimeout(function() {
                    createSelectize = $('#create_ref_id').selectize({
                        valueField: 'id',
                        labelField: 'label',
                        searchField: 'label',
                        placeholder: '— ស្វែងរកឈ្មោះ —',
                        loadingClass: 'loading',
                        create: false,
                        render: {
                            option: function(item, escape) {
                                return `<div class="option">${escape(item.label)}</div>`;
                            }
                        }
                    })[0].selectize;
                    
                    if (createSelectize) {
                        createSelectize.clear();
                        createSelectize.clearOptions();
                    }
                }, 100);
            }
        });

        $('#createPatientModal').on('hidden.bs.modal', function() {
            $('#create_patient_type').val('');
            $('#create_filterBox').addClass('d-none');
            $('#create_filterButtons').empty();
            
            if (createSelectize) {
                createSelectize.clear();
                createSelectize.clearOptions();
                createSelectize.refreshOptions();
            }
            $('.sub-filter-btn').removeClass('active');
        });

        $('#create_patient_type').on('change', function() {
            const filterBox = document.getElementById('create_filterBox');
            const filterLabel = document.getElementById('create_filterLabel');
            const filterButtons = document.getElementById('create_filterButtons');
            
            filterBox.classList.add('d-none');
            filterButtons.innerHTML = '';
            
            if (createSelectize) {
                createSelectize.clear();
                createSelectize.clearOptions();
                createSelectize.refreshOptions();
            }

            const type = this.value;
            
            if (type === 'student') {
                filterBox.classList.remove('d-none');
                filterLabel.innerHTML = '<i class="bi bi-diagram-3 me-1" style="color: var(--primary);"></i> ជ្រើសរើសថ្នាក់ <span class="text-danger">*</span>';
                
                const uniqueGrades = [...new Set(students.map(s => s.grade))].filter(g => g);
                
                uniqueGrades.forEach(g => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'sub-filter-btn';
                    btn.innerHTML = `<i class="bi bi-mortarboard me-1"></i> ${g}`;
                    
                    btn.onclick = function() {
                        document.querySelectorAll('#create_filterButtons .sub-filter-btn').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        const filtered = students.filter(s => s.grade === g);
                        loadCreatePersons(filtered, s => `${s.code} | ${s.name} (ថ្នាក់ទី ${s.grade})`);
                    };
                    
                    filterButtons.appendChild(btn);
                });
            }
            
            else if (type === 'teacher') {
                filterBox.classList.remove('d-none');
                filterLabel.innerHTML = '<i class="bi bi-bar-chart-steps me-1" style="color: var(--primary);"></i> ជ្រើសរើសកម្រិត <span class="text-danger">*</span>';
                
                const uniqueLevels = [...new Set(teachers.map(t => t.level))].filter(l => l);
                
                uniqueLevels.forEach(l => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'sub-filter-btn';
                    btn.innerHTML = `<i class="bi bi-person-video3 me-1"></i> ${l}`;
                    
                    btn.onclick = function() {
                        document.querySelectorAll('#create_filterButtons .sub-filter-btn').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        const filtered = teachers.filter(t => t.level === l);
                        loadCreatePersons(filtered, t => `${t.name} (${t.level})`);
                    };
                    
                    filterButtons.appendChild(btn);
                });
            }
            
            else if (type === 'staff') {
                filterBox.classList.add('d-none');
                loadCreatePersons(staffs, st => {
                    const role = st.role_kh || st.role || 'បុគ្គលិក';
                    return `${st.code} | ${st.name} | ${role}`;
                });
            }
        });
    });

    function loadCreatePersons(list, labelFn) {
        if (!createSelectize) {
            setTimeout(function() { loadCreatePersons(list, labelFn); }, 200);
            return;
        }
        createSelectize.clear();
        createSelectize.clearOptions();
        if (list && list.length > 0) {
            const options = list.map(x => ({ id: x.id, label: labelFn(x) }));
            createSelectize.addOption(options);
            createSelectize.refreshOptions(false);
        }
    }

    // ================ PREVENT ROW CLICK ON BUTTONS ================
    document.addEventListener('click', function (e) {
        if (e.target.closest('.no-row-click')) e.stopPropagation();
    });

    // ================ FILTER STATE ================
    let filters = { type: '', grade: '' };

    function loadPatients(page = 1) {
        const params = new URLSearchParams({ page });
        if (filters.type)  params.append('type', filters.type);
        if (filters.grade) params.append('grade', filters.grade);

        fetch("{{ route('patients.ajax') }}?" + params)
            .then(res => res.json())
            .then(data => {
                document.getElementById('patientTable').innerHTML = data.tbody;
                document.getElementById('pagination').innerHTML = data.pagination;
                const countBadge = document.getElementById('patientCount');
                if (countBadge) {
                    const match = data.pagination.match(/<span class="fw-bold" style="color: var\(--primary\);">(\d+)<\/span>/);
                    countBadge.innerHTML = (match && match[1]) ? `${match[1]} នាក់` : '0 នាក់';
                }
            })
            .catch(err => console.error('AJAX ERROR:', err));
    }

    function setType(type, btn) {
        filters.type = type;
        filters.grade = '';

        document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const box = document.getElementById('subFilterBox');
        const label = document.getElementById('subFilterLabel');
        const icon = document.getElementById('subFilterIcon');
        const btns = document.getElementById('subFilterButtons');

        box.classList.add('d-none');
        btns.innerHTML = '';

        if (type === 'student') {
            box.classList.remove('d-none');
            label.innerText = 'ជ្រើសរើសថ្នាក់';
            icon.className = 'bi bi-diagram-3';
            grades.forEach(g => {
                const b = document.createElement('button');
                b.className = 'sub-filter-btn';
                b.innerHTML = `<i class="bi bi-mortarboard me-1"></i> ${g}`;
                b.onclick = () => setSubFilter(g, b);
                btns.appendChild(b);
            });
        } else if (type === 'teacher') {
            box.classList.remove('d-none');
            label.innerText = 'ជ្រើសរើសកម្រិត';
            icon.className = 'bi bi-bar-chart-steps';
            levels.forEach(l => {
                const b = document.createElement('button');
                b.className = 'sub-filter-btn';
                b.innerHTML = `<i class="bi bi-person-video3 me-1"></i> ${l}`;
                b.onclick = () => setSubFilter(l, b);
                btns.appendChild(b);
            });
        }
        loadPatients();
    }

    function setSubFilter(value, btn) {
        filters.grade = value;
        document.querySelectorAll('#subFilterButtons .sub-filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        loadPatients();
    }

    document.addEventListener('click', e => {
        const link = e.target.closest('.pagination a');
        if (link) {
            e.preventDefault();
            const page = new URL(link.href).searchParams.get('page');
            loadPatients(page);
        }
    });

    function goToPatient(id) {
        window.location.href = `/patients/${id}`;
    }

    // ================ SEARCH ================
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const v = this.value.toLowerCase();
            let visibleCount = 0;
            document.querySelectorAll('#patientTable tr').forEach(tr => {
                if (tr.querySelector('.empty-state')) return;
                if (tr.innerText.toLowerCase().includes(v)) {
                    tr.style.display = '';
                    visibleCount++;
                } else {
                    tr.style.display = 'none';
                }
            });
            const countBadge = document.getElementById('patientCount');
            if (countBadge) countBadge.innerHTML = `${visibleCount} នាក់`;
        });
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                this.dispatchEvent(new Event('keyup'));
            }
        });
    }

    // ================ DELETE MODAL ================
    const deleteModal = document.getElementById('deletePatientModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const btn = event.relatedTarget;
        const patientId = btn.getAttribute('data-id');
        const patientName = btn.getAttribute('data-name');
        document.getElementById('deletePatientForm').action = `/patients/${patientId}`;
        const deleteTitle = document.getElementById('deletePatientName');
        if (deleteTitle && patientName) {
            deleteTitle.innerHTML = `លុបអ្នកជំងឺ <strong style="color: var(--danger);">${patientName}</strong> មែនទេ?`;
        }
    });

    // ================ TOAST AUTO HIDE ================
    setTimeout(() => {
        document.querySelectorAll('.toast-modern').forEach(t => {
            t.style.opacity = '0';
            setTimeout(() => t.remove(), 500);
        });
    }, 3000);

    // ================ INITIAL LOAD ================
    loadPatients();
    </script>
@endsection