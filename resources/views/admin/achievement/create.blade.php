<form action="{{ route('admin.achievement.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="type" class="form-label">Jenis</label>
        <select class="form-control" id="type" name="type" required>
            <option value="publikasi" {{ old('type') == 'publikasi' ? 'selected' : '' }}>Publikasi</option>
            <option value="penelitian" {{ old('type') == 'penelitian' ? 'selected' : '' }}>Penelitian</option>
            <option value="pencapaian" {{ old('type') == 'pencapaian' ? 'selected' : '' }}>Pencapaian</option>
        </select>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="subtype" class="form-label">Tipe</label>
        <input type="text" class="form-control" id="subtype" name="subtype" value="{{ old('subtype') }}"
            placeholder="Contoh: Q2, Penelitian Dosen, dll">
        <small class="form-text text-muted">Opsional - Masukkan tipe seperti Q2, Q1, Penelitian Dosen, dsb.</small>
        @error('subtype')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <!-- Pastikan ini ada di form tambah -->
    <div class="mb-3">
        <label for="editor-create" class="form-label">Deskripsi</label>
        <div id="editor-create" style="height: 300px;"></div>
        <input type="hidden" id="description-create" name="description" value="{{ old('description') }}">
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
        @error('date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Penulis</label>
        <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
        @error('author')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">File (PDF/DOC/DOCX)</label>
        <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx">
        @error('file')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
        <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
