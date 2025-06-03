<div>
    <div class="mb-3">
        <label class="form-label fw-bold">Kode Mata Kuliah</label>
        <p>{{ $curriculum->course_code }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Nama Mata Kuliah</label>
        <p>{{ $curriculum->course_name }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Semester</label>
        <p>Semester {{ $curriculum->semester }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Credits (SKS)</label>
        <p>{{ $curriculum->credits }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Status</label>
        <p>
            <span class="badge {{ $curriculum->is_active ? 'bg-success' : 'bg-danger' }}">
                {{ $curriculum->is_active ? 'Aktif' : 'Tidak Aktif' }}
            </span>
        </p>
    </div>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>
