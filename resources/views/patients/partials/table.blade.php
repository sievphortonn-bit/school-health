<table class="table table-bordered table-hover align-middle mb-0">
<thead class="table-dark">
<tr>
    <th>#</th>
    <th>ឈ្មោះ</th>
    <th>ប្រភេទ</th>
    <th>កម្រិត / ថ្នាក់</th>
    <th class="text-center">សកម្មភាព</th>
</tr>
</thead>

<tbody>
@forelse($patients as $p)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td class="fw-semibold">{{ $p->name }}</td>
    <td>{{ ucfirst($p->patient_type) }}</td>
    <td>{{ $p->grade_or_level ?? '-' }}</td>
    <td class="text-center">
        <a href="{{ route('patients.show',$p->id) }}"
           class="btn btn-sm btn-info">
            <i class="bi bi-eye"></i>
        </a>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center text-muted">No data</td>
</tr>
@endforelse
</tbody>
</table>
