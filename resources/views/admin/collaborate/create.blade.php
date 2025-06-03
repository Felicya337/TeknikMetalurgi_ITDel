<form action="{{ route('admin.collaborate.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="institution_name" class="form-label">Nama Institusi</label>
        <input type="text" class="form-control" id="institution_name" name="institution_name"
            value="{{ old('institution_name') }}" required>
        @error('institution_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="company_profile" class="form-label">Profil Perusahaan</label>
        <div id="editor-company-profile-create" style="height: 300px;"></div>
        <input type="hidden" id="company-profile-create" name="company_profile" value="{{ old('company_profile') }}">
        @error('company_profile')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="institution_description" class="form-label">Deskripsi</label>
        <div id="editor-institution-description-create" style="height: 300px;"></div>
        <input type="hidden" id="institution-description-create" name="institution_description"
            value="{{ old('institution_description') }}">
        @error('institution_description')
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
        <label for="logo" class="form-label">Logo</label>
        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
        @error('logo')
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
