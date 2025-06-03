<div class="mb-3">
    <label class="form-label fw-bold">Judul</label>
    <p>{{ $news->title ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light" style="max-height: 500px; overflow-y: auto;">
        {!! $news->description ?? '-' !!}
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tanggal</label>
    <p>{{ $news->date ? $news->date->format('d-m-Y') : '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Penulis</label>
    <p>{{ $news->author ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        @if ($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid rounded" alt="News Image"
                style="max-height: 300px;">
        @else
            <span class="text-muted">Tidak ada gambar</span>
        @endif
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge {{ $news->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $news->is_active ? 'Aktif' : 'Tidak Aktif' }}
        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
