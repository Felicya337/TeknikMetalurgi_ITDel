<form action="{{ route('admin.metaprofile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="metakey" class="form-label">Meta Key</label>
        <input type="text" class="form-control" id="metakey" name="metakey" value="{{ old('metakey', 'vm_') }}"
            required oninput="enforceMetaKeyPrefix()">
        <small class="form-text text-muted">Meta Key harus dimulai dengan 'vm_' (contoh: vm_institut_visi).</small>
        @error('metakey')
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
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <div id="editor-create" style="height: 300px;"></div>
        <input type="hidden" id="description-create" name="description" value="{{ old('description') }}">
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar (Opsional, hanya untuk header Visi dan Misi)</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <small class="form-text text-muted">Hanya unggah gambar jika ini adalah header Visi dan Misi (metakey:
            vm_header_image).</small>
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
            {{ old('is_active', 1) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script>
    function enforceMetaKeyPrefix() {
        const metakeyInput = document.getElementById('metakey');
        if (!metakeyInput.value.startsWith('vm_')) {
            metakeyInput.value = 'vm_' + metakeyInput.value.replace(/^vm_/, '');
        }
    }
</script>
