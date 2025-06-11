<form action="{{ route('admin.studentactivity.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    {{-- Hidden fields to identify form type and ID for error handling --}}
    <input type="hidden" name="form_type" value="edit">
    <input type="hidden" name="activity_id" value="{{ $activity->id }}">

    <div class="mb-3">
        <label for="type_edit_{{ $activity->id }}" class="form-label">Jenis Kegiatan</label>
        <select class="form-control @error('type') is-invalid @enderror" id="type_edit_{{ $activity->id }}"
            name="type" required>
            <option value="kegiatan_mahasiswa"
                {{ old('type', $activity->type) == 'kegiatan_mahasiswa' ? 'selected' : '' }}>
                Kegiatan Mahasiswa</option>
            <option value="kegiatan_prodi" {{ old('type', $activity->type) == 'kegiatan_prodi' ? 'selected' : '' }}>
                Kegiatan Prodi</option>
            <option value="club_mahasiswa" {{ old('type', $activity->type) == 'club_mahasiswa' ? 'selected' : '' }}>
                Club Mahasiswa</option>
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title_edit_{{ $activity->id }}" class="form-label">Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror"
            id="title_edit_{{ $activity->id }}" name="title" value="{{ old('title', $activity->title) }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="editor-edit-{{ $activity->id }}" class="form-label">Deskripsi</label>
        <div id="editor-edit-{{ $activity->id }}" style="height: 300px;"></div>
        {{-- The value is populated by Summernote JS. Ensure old() value is correctly used for re-population on error --}}
        <input type="hidden" id="description-edit-{{ $activity->id }}" name="description"
            value="{{ old('description', $activity->description) }}">
        @error('description')
            <div class="text-danger mt-1">{{ $message }}</div> {{-- Ensure this error is visible --}}
        @enderror
    </div>
    <div class="mb-3">
        <label for="image_edit_{{ $activity->id }}" class="form-label">Gambar</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror"
            id="image_edit_{{ $activity->id }}" name="image" accept="image/*">
        @if ($activity->image)
            <div class="mt-2">
                <small>Gambar Saat Ini:</small><br>
                <img src="{{ asset('storage/' . $activity->image) }}" class="img-thumbnail mt-1"
                    alt="Current Activity Image" style="max-width: 200px; max-height: 150px;">
            </div>
        @endif
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
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
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>
