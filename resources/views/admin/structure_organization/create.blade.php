<form action="{{ route('admin.structure_organization.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Jabatan 1</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="degree" class="form-label">Jabatan 2</label>
        <input type="text" class="form-control" id="degree" name="degree" value="{{ old('degree') }}">
        @error('degree')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        <!-- Removed required -->
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="level" class="form-label">Level</label>
        <select class="form-control" id="level" name="level" required>
            <option value="0" {{ old('level') == 0 ? 'selected' : '' }} {{ $hasLevelZero ? 'disabled' : '' }}>Level
                0 (Paling Atas)</option>
            <option value="1" {{ old('level') == 1 ? 'selected' : '' }}>Level 1</option>
            <option value="2" {{ old('level') == 2 ? 'selected' : '' }}>Level 2</option>
            <option value="3" {{ old('level') == 3 ? 'selected' : '' }}>Level 3</option>
            <option value="4" {{ old('level') == 4 ? 'selected' : '' }}>Level 4 (Paling Bawah)</option>
        </select>
        @error('level')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="parent_id" class="form-label">Induk</label>
        <select class="form-control" id="parent_id" name="parent_id">
            <option value="">Tidak ada induk</option>
            @foreach ($allStructures as $parent)
                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}
                    data-level="{{ $parent->level }}">
                    {{ $parent->name }} ({{ $parent->title }}) - Level {{ $parent->level }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Foto</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <small class="text-muted">Pilih gambar (JPEG/PNG/JPG/GIF, maks 2MB).</small>
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
            {{ old('is_active', true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">
            Aktifkan (Tampil di Halaman User)
        </label>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    document.getElementById('level').addEventListener('change', function() {
        const selectedLevel = parseInt(this.value);
        const parentSelect = document.getElementById('parent_id');
        const options = parentSelect.querySelectorAll('option[data-level]');
        const noParentOption = parentSelect.querySelector('option[value=""]');

        // Reset parent selection
        parentSelect.value = '';

        // Show "Tidak ada induk" for level 0, hide for others
        noParentOption.style.display = selectedLevel === 0 ? 'block' : 'none';
        if (selectedLevel !== 0) {
            noParentOption.removeAttribute('selected');
        }

        // Filter parent options based on selected level
        options.forEach(option => {
            const parentLevel = parseInt(option.getAttribute('data-level'));
            option.style.display = parentLevel < selectedLevel ? 'block' : 'none';
            if (parentLevel >= selectedLevel) {
                option.removeAttribute('selected');
            }
        });
    });

    // Trigger change event on page load to set initial parent options
    document.getElementById('level').dispatchEvent(new Event('change'));
</script>
