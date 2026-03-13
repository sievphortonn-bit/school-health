@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    body, .navbar, .sidebar, .card , .form-control, .form-select {
        font-family: 'Inter', Battambang, sans-serif;
    }

</style>
<!-- jQuery + Selectize -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"/>

<div class="card shadow-sm col-md-7">
<div class="card-header fw-bold">
    <i class="bi bi-heart-pulse me-1"></i>
    បញ្ចូលអ្នកជំងឺថ្មី
</div>

<div class="card-body">

<form method="POST" action="{{ route('patients.store') }}">
@csrf

<!-- PATIENT TYPE -->
<label class="small fw-semibold">ប្រភេទអ្នកជំងឺ</label>
<select name="patient_type" id="patient_type" class="form-select mb-3" required>
    <option value="">— ជ្រើសរើសប្រភេទអ្នកជំងឺ —</option>
    <option value="student">សិស្ស</option>
    <option value="teacher">គ្រូបង្រៀន</option>
    <option value="staff">បុគ្គលិកផ្សេងៗ</option>
</select>

<!-- SELECT PERSON -->
<label class="small fw-semibold">ស្វែងរក & ជ្រើសរើស</label>
<select name="ref_id" id="ref_id" required>
    <option value="">ស្វែងរក & ជ្រើសរើស</option>
</select>

<hr>

<!-- FIRST HISTORY -->
<h6 class="fw-bold mb-2">
    <i class="bi bi-clipboard-plus"></i> ប្រវត្តិជំងឺដំបូង (First History)
</h6>

<textarea name="complaint"
          class="form-control mb-2"
          placeholder="អាករៈបញ្ហា (Complaint)"
          required></textarea>

<textarea name="intervention"
          class="form-control mb-2"
          placeholder="ការអន្តរាគមន៍ (Intervention)"></textarea>

<textarea name="treatment"
          class="form-control mb-3"
          placeholder="ការព្យាបាល (Treatment)"></textarea>

<button class="btn btn-primary w-100">
    <i class="bi bi-save me-1"></i>
    បញ្ចូលអ្នកជំងឺ & រក្សាទុកប្រវត្តិជំងឺដំបូង
</button>

</form>

</div>
</div>

<!-- ================= JAVASCRIPT ================= -->
<script>
let students = @json($students);
let teachers = @json($teachers);
let staffs   = @json($staffs);

/* INIT SELECTIZE */
let select = $('#ref_id').selectize({
    valueField: 'id',
    labelField: 'label',
    searchField: 'label',
    create: false,
    placeholder: 'Search & Select Person'
});

let control = select[0].selectize;

/* PATIENT TYPE CHANGE */
$('#patient_type').on('change', function () {

    control.clear();
    control.clearOptions();

    let type = this.value;
    let data = [];

    if (type === 'student') {
        data = students.map(s => ({
            id: s.id,
            label: s.code + ' | ' + s.name + ' | Grade ' + s.grade
        }));
    }

    if (type === 'teacher') {
        data = teachers.map(t => ({
            id: t.id,
            label: t.name + ' | ' + t.level
        }));
    }

    if (type === 'staff') {
        data = staffs.map(st => ({
            id: st.id,
            label: st.code + ' | ' + st.name + ' | ' + st.role
        }));
    }

    control.addOption(data);
    control.refreshOptions(false);
});
</script>

@endsection
