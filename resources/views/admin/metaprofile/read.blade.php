<div class="mb-3">
    <label class="form-label fw-bold">Meta Key</label>
    <p>{{ $metaProfile->metakey ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Judul</label>
    <p>{{ $metaProfile->title ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        {!! $metaProfile->description ?? '-' !!}
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        @if ($metaProfile->image)
            <img src="{{ asset('storage/' . $metaProfile->image) }}" class="img-fluid rounded" alt="Meta Profile Image"
                style="max-height: 300px;">
        @else
            <span class="text-muted">Tidak ada gambar</span>
        @endif
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge {{ $metaProfile->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $metaProfile->is_active ? 'Aktif' : 'Tidak Aktif' }}
        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
