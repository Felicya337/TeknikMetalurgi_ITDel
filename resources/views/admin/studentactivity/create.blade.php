<form action="{{ route('admin.studentactivity.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="type_create" class="form-label">Jenis Kegiatan</label>
        <select class="form-control" id="type_create" name="type" required>
            <option value="kegiatan_mahasiswa" {{ old('type') == 'kegiatan_mahasiswa' ? 'selected' : '' }}>
                Kegiatan Mahasiswa</option>
            <option value="kegiatan_prodi" {{ old('type') == 'kegiatan_prodi' ? 'selected' : '' }}>
                Kegiatan Prodi</option>
            <option value="club_mahasiswa" {{ old('type') == 'club_mahasiswa' ? 'selected' : '' }}>
                Club Mahasiswa</option>
        </select>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title_create" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title_create" name="title" value="{{ old('title') }}"
            required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description_create" class="form-label">Deskripsi</label>
        <div id="editor-create" style="height: 300px;"></div>
        <input type="hidden" id="description-create" name="description" value="{{ old('description') }}">
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image_create" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="image_create" name="image" accept="image/*">
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active_create" name="is_active" value="1"
            {{ old('is_active', true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active_create">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
