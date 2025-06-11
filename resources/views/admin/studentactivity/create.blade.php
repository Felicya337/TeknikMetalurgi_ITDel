<form action="{{ route('admin.studentactivity.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- Hidden field to identify form type for error handling --}}
    <input type="hidden" name="form_type" value="create">

    <div class="mb-3">
        <label for="type_create" class="form-label">Jenis Kegiatan</label>
        <select class="form-control @error('type') is-invalid @enderror" id="type_create" name="type" required>
            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Pilih Jenis Kegiatan</option>
            <option value="kegiatan_mahasiswa" {{ old('type') == 'kegiatan_mahasiswa' ? 'selected' : '' }}>
                Kegiatan Mahasiswa</option>
            <option value="kegiatan_prodi" {{ old('type') == 'kegiatan_prodi' ? 'selected' : '' }}>
                Kegiatan Prodi</option>
            <option value="club_mahasiswa" {{ old('type') == 'club_mahasiswa' ? 'selected' : '' }}>
                Club Mahasiswa</option>
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title_create" class="form-label">Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title_create" name="title"
            value="{{ old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="editor-create" class="form-label">Deskripsi</label>
        <div id="editor-create" style="height: 300px;"></div>
        <input type="hidden" id="description-create" name="description" value="{{ old('description') }}">
        @error('description')
            <div class="text-danger mt-1">{{ $message }}</div> {{-- Ensure this error is visible --}}
        @enderror
    </div>
    <div class="mb-3">
        <label for="image_create" class="form-label">Gambar</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image_create" name="image"
            accept="image/*">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active_create" name="is_active" value="1"
            {{ old('is_active', true) ? 'checked' : '' }}> {{-- Default to checked for new entries, or respect old value --}}
        <label class="form-check-label" for="is_active_create">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
