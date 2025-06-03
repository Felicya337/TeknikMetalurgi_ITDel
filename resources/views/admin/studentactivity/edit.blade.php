<form action="{{ route('admin.studentactivity.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="type_edit_{{ $activity->id }}" class="form-label">Jenis Kegiatan</label>
        <select class="form-control" id="type_edit_{{ $activity->id }}" name="type" required>
            <option value="kegiatan_mahasiswa"
                {{ old('type', $activity->type) == 'kegiatan_mahasiswa' ? 'selected' : '' }}>
                Kegiatan Mahasiswa</option>
            <option value="kegiatan_prodi" {{ old('type', $activity->type) == 'kegiatan_prodi' ? 'selected' : '' }}>
                Kegiatan Prodi</option>
            <option value="club_mahasiswa" {{ old('type', $activity->type) == 'club_mahasiswa' ? 'selected' : '' }}>
                Club Mahasiswa</option>
        </select>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title_edit_{{ $activity->id }}" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title_edit_{{ $activity->id }}" name="title"
            value="{{ old('title', $activity->title) }}" required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description_edit_{{ $activity->id }}" class="form-label">Deskripsi</label>
        <div id="editor-edit-{{ $activity->id }}" style="height: 300px;"></div>
        <input type="hidden" id="description-edit-{{ $activity->id }}" name="description"
            value="{{ old('description', $activity->description) }}">
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image_edit_{{ $activity->id }}" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="image_edit_{{ $activity->id }}" name="image" accept="image/*">
        @if ($activity->image)
            <img src="{{ asset('storage/' . $activity->image) }}" class="img-thumbnail mt-2"
                alt="Current Activity Image">
        @endif
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active_edit_{{ $activity->id }}" name="is_active"
            value="1" {{ old('is_active', $activity->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active_edit_{{ $activity->id }}">Aktifkan (Tampil di Halaman
            User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
