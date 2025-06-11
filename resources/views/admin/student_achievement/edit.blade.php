<form action="{{ route('admin.student_achievement.update', $achievement->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="form_type" value="edit_student_achievement">
    <input type="hidden" name="achievement_id_error" value="{{ $achievement->id }}">
    <div class="mb-3">
        <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
            value="{{ old('nama_kegiatan', $achievement->nama_kegiatan) }}" required>
        @error('nama_kegiatan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="waktu_pelaksanaan" class="form-label">Waktu Pelaksanaan</label>
        <input type="date" class="form-control" id="waktu_pelaksanaan" name="waktu_pelaksanaan"
            value="{{ old('waktu_pelaksanaan', $achievement->waktu_pelaksanaan ? $achievement->waktu_pelaksanaan->format('Y-m-d') : '') }}">
        @error('waktu_pelaksanaan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="tingkat" class="form-label">Tingkat</label>
        <input type="text" class="form-control" id="tingkat" name="tingkat"
            value="{{ old('tingkat', $achievement->tingkat) }}"
            placeholder="Masukkan tingkat (contoh: Lokal, Regional, Nasional)">
        @error('tingkat')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="prestasi_yang_dicapai" class="form-label">Prestasi Yang Dicapai</label>
        <input type="text" class="form-control" id="prestasi_yang_dicapai" name="prestasi_yang_dicapai"
            value="{{ old('prestasi_yang_dicapai', $achievement->prestasi_yang_dicapai) }}">
        @error('prestasi_yang_dicapai')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
            {{ old('is_active', $achievement->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
