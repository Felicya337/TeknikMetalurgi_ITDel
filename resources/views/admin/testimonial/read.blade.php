<div class="mb-3">
    <label class="form-label fw-bold">Nama</label>
    <p>{{ $testimonial->name ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>{{ $testimonial->student ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        {!! $testimonial->content ?? '-' !!}
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        @if ($testimonial->image)
            <img src="{{ asset('storage/' . $testimonial->image) }}" class="img-fluid rounded" alt="Testimonial Image"
                style="max-height: 300px;">
        @else
            <span class="text-muted">Tidak ada gambar</span>
        @endif
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge {{ $testimonial->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $testimonial->is_active ? 'Aktif' : 'Tidak Aktif' }}
        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
