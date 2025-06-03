<div>
    <div class="mb-3">
        <label class="form-label fw-bold">Nama</label>
        <p>{{ $structure->name }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Jabatan</label>
        <p>{{ $structure->title }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Gelar</label>
        <p>{{ $structure->degree ?? '-' }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Level</label>
        <p>{{ $structure->level }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Induk</label>
        <p>{{ $structure->parent ? $structure->parent->name . ' (' . $structure->parent->title . ')' : 'Tidak ada induk' }}
        </p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Status</label>
        <p>{{ $structure->is_active ? 'Aktif' : 'Nonaktif' }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Foto</label>
        <div>
            @if ($structure->image)
                <img src="{{ asset('storage/' . $structure->image) }}" class="img-thumbnail" alt="Structure Image"
                    style="max-width: 150px;">
            @else
                <span class="text-muted">Tidak ada foto</span>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
</div>
