<div class="mb-3">
    <label class="form-label fw-bold">Tipe</label>
    <p>
        <span
            class="badge {{ $facility->type == 'classroom' ? 'bg-primary' : ($facility->type == 'smartclass' ? 'bg-info' : 'bg-success') }}">
            {{ ucfirst(str_replace('_', ' ', $facility->type)) }}
        </span>
    </p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        {!! $facility->description ?? '-' !!}
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Hari Akademik</label>
    <p>{{ $facility->academic_days ? implode(', ', $facility->academic_days) : '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Jam Akademik</label>
    <p>{{ $facility->academic_hours ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Jam Kolaborasi</label>
    <p>{{ $facility->collaborative_hours ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        @if ($facility->images && count($facility->images) > 0)
            <div class="row">
                @foreach ($facility->images as $image)
                    <div class="col-md-4 mb-2">
                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" alt="Facility Image"
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
        <span class="badge {{ $facility->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $facility->is_active ? 'Aktif' : 'Tidak Aktif' }}
        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
