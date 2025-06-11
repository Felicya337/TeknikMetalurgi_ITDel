<form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $news->title) }}"
            required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description-edit-{{ $news->id }}" class="form-label">Deskripsi</label>
        <div id="editor-edit-{{ $news->id }}"></div>
        <input type="hidden" id="description-edit-{{ $news->id }}" name="description"
            value="{!! old('description', $news->description) !!}">
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="date" name="date"
            value="{{ old('date', $news->date->format('Y-m-d')) }}" required>
        @error('date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Penulis</label>
        <input type="text" class="form-control" id="author" name="author"
            value="{{ old('author', $news->author) }}" required>
        @error('author')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @if ($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" class="img-thumbnail mt-2" alt="Current News Image">
        @endif
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
            {{ old('is_active', $news->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
