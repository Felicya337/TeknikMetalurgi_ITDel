<form action="{{ route('admin.metaprofile.update', $metaProfile->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="metakey" class="form-label">Meta Key</label>
        <input type="text" class="form-control" id="metakey" name="metakey"
            value="{{ old('metakey', $metaProfile->metakey) }}" required>
        @error('metakey')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title"
            value="{{ old('title', $metaProfile->title) }}" required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <div id="editor-edit-{{ $metaProfile->id }}" style="height: 300px;"></div>
        <input type="hidden" id="description-edit-{{ $metaProfile->id }}" name="description"
            value="{!! old('description', $metaProfile->description) !!}">
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @if ($metaProfile->image)
            <img src="{{ asset('storage/' . $metaProfile->image) }}" class="img-thumbnail mt-2"
                alt="Current Meta Profile Image">
        @endif
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
            {{ old('is_active', $metaProfile->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
