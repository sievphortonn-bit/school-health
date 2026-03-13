<div class="modal fade" id="editPatientModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">

{{-- ================= HEADER ================= --}}
<div class="modal-header">
    <h5 class="modal-title fw-bold">
        <i class="bi bi-person-gear me-1"></i>
        កែប្រែព័ត៌មានអ្នកជំងឺ
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form method="POST" id="editPatientForm">
@csrf
@method('PUT')

<div class="modal-body">

    {{-- ================= PATIENT TYPE ================= --}}
    <label class="small fw-semibold">ប្រភេទអ្នកជំងឺ</label>
    <select name="patient_type"
            id="edit_patient_type"
            class="form-select mb-3"
            required>
        <option value="">— ជ្រើសរើសប្រភេទ —</option>
        <option value="student">សិស្ស</option>
        <option value="teacher">គ្រូបង្រៀន</option>
        <option value="staff">បុគ្គលិក</option>
    </select>

    {{-- ================= FILTER (CLASS / LEVEL) ================= --}}
    <div id="edit_filter_box" class="mb-3 d-none">
        <label id="edit_filter_label" class="small fw-semibold mb-2"></label>

        <div id="edit_filter_buttons"
             class="d-flex flex-wrap gap-2">
            {{-- buttons injected by JS --}}
        </div>
    </div>

    {{-- ================= PERSON ================= --}}
    <label class="small fw-semibold">ស្វែងរក & ជ្រើសរើសឈ្មោះ</label>
    <select name="ref_id" id="edit_ref_id" required>
        <option value="">ស្វែងរក & ជ្រើសរើស</option>
    </select>

</div>

{{-- ================= FOOTER ================= --}}
<div class="modal-footer">
    <button type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
        បោះបង់
    </button>

    <button class="btn btn-primary">
        <i class="bi bi-save me-1"></i> រក្សាទុកការកែប្រែ
    </button>
</div>

</form>

</div>
</div>
</div>
