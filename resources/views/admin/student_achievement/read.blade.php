<div class="mb-3">
    <label class="form-label fw-bold">Nama Kegiatan</label>
    <p>{{ $achievement->nama_kegiatan ?? '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Waktu Pelaksanaan</label>
    <p>{{ $achievement->waktu_pelaksanaan ? $achievement->waktu_pelaksanaan->format('d-m-Y') : '-' }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tingkat</label>
    <p>{{ ucfirst($achievement->tingkat ?? '-') }}</p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Prestasi Yang Dicapai</label>
    <p>{{ $achievement->prestasi_yang_dicapai ?? '-' }}</p>
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
