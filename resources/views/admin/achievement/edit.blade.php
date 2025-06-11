<form action="{{ route('admin.achievement.update', $achievement->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="type" class="form-label">Jenis</label>
        <select class="form-control" id="type" name="type" required>
            <option value="publikasi" {{ old('type', $achievement->type) == 'publikasi' ? 'selected' : '' }}>Publikasi
            </option>
            <option value="penelitian" {{ old('type', $achievement->type) == 'penelitian' ? 'selected' : '' }}>
                Penelitian</option>
            <option value="pencapaian" {{ old('type', $achievement->type) == 'pencapaian' ? 'selected' : '' }}>
                Pencapaian</option>
        </select>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="subtype" class="form-label">Tipe</label>
        <input type="text" class="form-control" id="subtype" name="subtype"
            value="{{ old('subtype', $achievement->subtype) }}" placeholder="Contoh: Q2, Penelitian Dosen, dll">
        <small class="form-text text-muted">Opsional - Masukkan tipe seperti Q2, Q1, Penelitian Dosen, dsb.</small>
        @error('subtype')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title"
            value="{{ old('title', $achievement->title) }}" required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <!-- Pastikan ini ada di form edit -->
    <div class="mb-3">
        <label for="editor-edit-{{ $achievement->id }}" class="form-label">Deskripsi</label>
        <div id="editor-edit-{{ $achievement->id }}" style="height: 300px;"></div>
        <input type="hidden" id="description-edit-{{ $achievement->id }}" name="description"
            value="{{ old('description', $achievement->description) }}">
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="date" name="date"
            value="{{ old('date', $achievement->date ? $achievement->date->format('Y-m-d') : '') }}" required>
        @error('date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Penulis</label>
        <input type="text" class="form-control" id="author" name="author"
            value="{{ old('author', $achievement->author) }}" required>
        @error('author')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @if ($achievement->image)
            <img src="{{ asset('storage/' . $achievement->image) }}" class="img-thumbnail mt-2"
                alt="Current Achievement Image">
        @endif
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">File (PDF/DOC/DOCX)</label>
        <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx">
        @if ($achievement->file)
            <a href="{{ asset('storage/' . $achievement->file) }}" class="mt-2 d-block" target="_blank">Lihat file saat
                ini</a>
        @endif
        @error('file')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
            {{ old('is_active', $achievement->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">
            Aktifkan (Tampil di Halaman User)
        </label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
