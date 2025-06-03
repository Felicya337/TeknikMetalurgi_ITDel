<form action="{{ route('admin.collaborate.update', $collaborate->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="institution_name" class="form-label">Nama Institusi</label>
        <input type="text" class="form-control" id="institution_name" name="institution_name"
            value="{{ old('institution_name', $collaborate->institution_name) }}" required>
        @error('institution_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="company_profile" class="form-label">Profil Perusahaan</label>
        <div id="editor-company-profile-edit-{{ $collaborate->id }}" style="height: 300px;"></div>
        <input type="hidden" id="company-profile-edit-{{ $collaborate->id }}" name="company_profile"
            value="{!! old('company_profile', $collaborate->company_profile) !!}">
        @error('company_profile')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="institution_description" class="form-label">Deskripsi</label>
        <div id="editor-institution-description-edit-{{ $collaborate->id }}" style="height: 300px;"></div>
        <input type="hidden" id="institution-description-edit-{{ $collaborate->id }}" name="institution_description"
            value="{!! old('institution_description', $collaborate->institution_description) !!}">
        @error('institution_description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="date" name="date"
            value="{{ old('date', $collaborate->date ? $collaborate->date->format('Y-m-d') : '') }}" required>
        @error('date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="logo" class="form-label">Logo</label>
        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
        @if ($collaborate->logo)
            <img src="{{ asset('storage/' . $collaborate->logo) }}" class="img-thumbnail mt-2" alt="Current Logo">
        @endif
        @error('logo')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
            {{ old('is_active', $collaborate->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
