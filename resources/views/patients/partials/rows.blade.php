@forelse($patients as $p)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td class="fw-semibold">{{ $p->name }}</td>
    <td>{{ $p->patient_type }}</td>
    <td>{{ $p->age ?? '-' }}</td>
    <td>{{ $p->grade_or_level ?? '-' }}</td>
    <td>
        <a href="{{ route('patients.show',$p->id) }}" class="btn btn-sm btn-info">
            <i class="bi bi-eye"></i>
        </a>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center text-muted py-3">
        គ្មានទិន្នន័យ
    </td>
</tr>
@endforelse
