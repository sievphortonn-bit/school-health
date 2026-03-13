<!-- ================= CREATE PATIENT MODAL ================= -->
<div class="modal fade modern-modal" id="createPatientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header-primary" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-heart-pulse me-2"></i>
                    បញ្ចូលអ្នកជំងឺថ្មី
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('patients.store') }}">
                @csrf

                <div class="modal-body">
                    <!-- ================= PATIENT TYPE ================= -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold mb-2" style="color: var(--dark);">
                            <i class="bi bi-tag-fill me-1" style="color: var(--primary);"></i> 
                            ប្រភេទអ្នកជំងឺ <span class="text-danger">*</span>
                        </label>
                        <select name="patient_type" id="create_patient_type" class="modern-select" required>
                            <option value="">— ជ្រើសរើសប្រភេទ —</option>
                            <option value="student">សិស្ស</option>
                            <option value="teacher">គ្រូបង្រៀន</option>
                            <option value="staff">បុគ្គលិក</option>
                        </select>
                    </div>

                    <!-- ================= FILTER SECTION (GRADE/LEVEL) ================= -->
                    <div id="create_filterBox" class="form-group mb-4 d-none">
                        <label class="form-label fw-semibold mb-2" style="color: var(--dark);" id="create_filterLabel">
                            <i class="bi bi-diagram-3 me-1" style="color: var(--primary);"></i> 
                            ជ្រើសរើសថ្នាក់
                        </label>
                        <div id="create_filterButtons" class="d-flex flex-wrap gap-2"></div>
                    </div>

                    <!-- ================= REFERENCE ID ================= -->
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold mb-2" style="color: var(--dark);">
                            <i class="bi bi-person-badge-fill me-1" style="color: var(--primary);"></i> 
                            ជ្រើសរើសឈ្មោះ <span class="text-danger">*</span>
                        </label>
                        <select name="ref_id" id="create_ref_id" class="modern-select" required>
                            <option value="">— ជ្រើសរើសឈ្មោះ —</option>
                        </select>
                        <div class="small text-muted mt-1">សូមជ្រើសរើសប្រភេទអ្នកជំងឺ និងតម្រងជាមុន</div>
                    </div>

                    <hr class="my-4" style="border-top: 2px dashed #e9ecef;">

                    <!-- ================= FIRST HISTORY ================= -->
                    <h6 class="fw-bold mb-3" style="color: var(--primary);">
                        <i class="bi bi-clipboard-plus me-2"></i> ប្រវត្តិជំងឺដំបូង
                    </h6>

                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold mb-2" style="color: var(--dark);">
                            <i class="bi bi-chat-fill me-1" style="color: var(--primary);"></i> 
                            អាការៈ <span class="text-danger">*</span>
                        </label>
                        <textarea name="complaint" class="modern-textarea" 
                                  placeholder="ពិពណ៌នាអំពីរោគសញ្ញា..." 
                                  rows="3" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold mb-2" style="color: var(--dark);">
                            <i class="bi bi-heart-pulse-fill me-1" style="color: var(--primary);"></i> 
                            ការអន្តរាគមន៍
                        </label>
                        <textarea name="intervention" class="modern-textarea" 
                                  placeholder="ការអន្តរាគមន៍ដំបូង..." 
                                  rows="2"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold mb-2" style="color: var(--dark);">
                            <i class="bi bi-capsule-fill me-1" style="color: var(--primary);"></i> 
                            ការព្យាបាល
                        </label>
                        <textarea name="treatment" class="modern-textarea" 
                                  placeholder="វេជ្ជបញ្ជា ឬការព្យាបាល..." 
                                  rows="2"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4 px-4">
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