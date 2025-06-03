<div class="mb-3">
    <label class="form-label fw-bold">Jenis</label>
    <p>
        <span
            class="badge {{ $achievement->type == 'publikasi' ? 'bg-primary' : ($achievement->type == 'penelitian' ? 'bg-info' : 'bg-success') }}">
            {{ $achievement->type }}
        </span>
    </p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tipe</label>
    <p>
        @if ($achievement->subtype)
            <span class="badge bg-secondary">{{ $achievement->subtype }}</span>
        @else
            <span class="text-muted">-</span>
        @endif
    </p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Judul</label>
    <p>{{ $achievement->title ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        {!! $achievement->description ?? '-' !!}
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tanggal</label>
    <p>{{ $achievement->date ? $achievement->date->format('d-m-Y') : '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Penulis</label>
    <p>{{ $achievement->author ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        @if ($achievement->image)
            <img src="{{ asset('storage/' . $achievement->image) }}" class="img-fluid rounded" alt="Achievement Image"
                style="max-height: 300px;">
        @else
            <span class="text-muted">Tidak ada gambar</span>
        @endif
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">File</label>
    <div>
        @if ($achievement->file)
            <a href="{{ asset('storage/' . $achievement->file) }}" target="_blank">Lihat file</a>
        @else
            <span class="text-muted">Tidak ada file</span>
        @endif
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge {{ $achievement->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $achievement->is_active ? 'Aktif' : 'Tidak Aktif' }}
        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
