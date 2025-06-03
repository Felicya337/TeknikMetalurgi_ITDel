<div class="mb-3">
    <label class="form-label fw-bold">Nama Laboratorium</label>
    <p>{{ $laboratory->name }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        {!! $laboratory->description ?? '-' !!}
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Hari Akademik</label>
    <p>{{ $laboratory->academic_days ? implode(', ', $laboratory->academic_days) : '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Jam Akademik</label>
    <p>{{ $laboratory->academic_hours ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Jam Kolaborasi</label>
    <p>{{ $laboratory->collaborative_hours ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        @if ($laboratory->images && count($laboratory->images) > 0)
            <div class="row">
                @foreach ($laboratory->images as $image)
                    <div class="col-md-4 mb-2">
                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" alt="Laboratory Image"
                            style="max-height: 300px; object-fit: cover;">
                    </div>
                @endforeach
            </div>
        @else
            <span class="text-muted">Tidak ada gambar</span>
        @endif
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge {{ $laboratory->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $laboratory->is_active ? 'Aktif' : 'Tidak Aktif' }}
        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
