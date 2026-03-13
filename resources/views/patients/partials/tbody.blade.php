@php
    $khmerDays = ['អាទិត្យ', 'ច័ន្ទ', 'អង្គារ', 'ពុធ', 'ព្រហស្បតិ៍', 'សុក្រ', 'សៅរ៍'];
    $khmerMonths = [
        'មករា',
        'កុម្ភៈ',
        'មីនា',
        'មេសា',
        'ឧសភា',
        'មិថុនា',
        'កក្កដា',
        'សីហា',
        'កញ្ញា',
        'តុលា',
        'វិច្ឆិកា',
        'ធ្នូ',
    ];
    $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
@endphp
@forelse ($patients as $patient)
    <tr>
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
            <a href="{{ route('patients.show', $patient->id) }}" class="text-decoration-none" style="color: inherit;">
                <div class="d-flex align-items-center">
                    <div class="" style="width: 32px; height: 32px; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: var(--primary); color: white; font-weight: bold; border-radius: 50%; margin-right: 10px;">
                        {{-- Use actual avatar if available, otherwise fallback to generated avatar with initials --}}
                        {{-- {{ strtoupper(substr($patient->name, 0, 1)) }} --}}
                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($patient->name) }}" class="rounded-circle" width="32" height="32" alt="User">
                    </div>
                    <div class="text-start">
                        <div class="fw-semibold">{{ $patient->name }}</div>
                        <small class="text-muted">ID: PT{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}</small>
                    </div>
                </div>
            </a>
            
        </td>
        <td>
            @php
                $typeClass =
                    $patient->patient_type === 'student'
                        ? 'type-student'
                        : ($patient->patient_type === 'teacher'
                            ? 'type-teacher'
                            : 'type-staff');
                $typeIcon =
                    $patient->patient_type === 'student'
                        ? 'bi-backpack'
                        : ($patient->patient_type === 'teacher'
                            ? 'bi-person-video3'
                            : 'bi-briefcase');
                $typeText =
                    $patient->patient_type === 'student'
                        ? 'សិស្ស'
                        : ($patient->patient_type === 'teacher'
                            ? 'គ្រូបង្រៀន'
                            : 'បុគ្គលិក');
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
            @if ($patient->grade_or_level)
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
                <a href="{{ route('patients.show', $patient->id) }}" class="action-icon-btn btn-view no-row-click"
                    title="មើលលម្អិត">
                    <i class="bi bi-eye"></i>
                </a>

                <a href="{{ route('patients.edit', $patient->id) }}" class="action-icon-btn btn-edit no-row-click"
                    title="កែប្រែ">
                    <i class="bi bi-pencil"></i>
                </a>

                <button type="button" class="action-icon-btn btn-delete no-row-click" title="លុប"
                    data-bs-toggle="modal" data-bs-target="#deletePatientModal" data-id="{{ $patient->id }}"
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
