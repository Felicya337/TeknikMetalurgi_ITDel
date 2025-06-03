<form action="{{ route('admin.structure_organization.update', $structure->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name_edit_{{ $structure->id }}" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name_edit_{{ $structure->id }}" name="name"
            value="{{ old('name', $structure->name) }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title_edit_{{ $structure->id }}" class="form-label">Jabatan</label>
        <input type="text" class="form-control" id="title_edit_{{ $structure->id }}" name="title"
            value="{{ old('title', $structure->title) }}" required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="degree_edit_{{ $structure->id }}" class="form-label">Gelar</label>
        <input type="text" class="form-control" id="degree_edit_{{ $structure->id }}" name="degree"
            value="{{ old('degree', $structure->degree) }}">
        @error('degree')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="level_edit_{{ $structure->id }}" class="form-label">Level</label>
        <select class="form-control" id="level_edit_{{ $structure->id }}" name="level" required>
            <option value="0" {{ old('level', $structure->level) == 0 ? 'selected' : '' }}
                {{ $hasLevelZero && $structure->level != 0 ? 'disabled' : '' }}>Level 0</option>
            <option value="1" {{ old('level', $structure->level) == 1 ? 'selected' : '' }}>Level 1</option>
            <option value="2" {{ old('level', $structure->level) == 2 ? 'selected' : '' }}>Level 2</option>
            <option value="3" {{ old('level', $structure->level) == 3 ? 'selected' : '' }}>Level 3</option>
            <option value="4" {{ old('level', $structure->level) == 4 ? 'selected' : '' }}>Level 4</option>
        </select>
        @error('level')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="parent_id_edit_{{ $structure->id }}" class="form-label">Induk</label>
        <select class="form-control" id="parent_id_edit_{{ $structure->id }}" name="parent_id">
            <option value="">Tidak ada induk</option>
            @foreach ($allStructures as $parent)
                @if ($parent->id != $structure->id)
                    <option value="{{ $parent->id }}"
                        {{ old('parent_id', $structure->parent_id) == $parent->id ? 'selected' : '' }}
                        data-level="{{ $parent->level }}">
                        {{ $parent->name }} ({{ $parent->title }}) - Level {{ $parent->level }}
                    </option>
                @endif
            @endforeach
        </select>
        @error('parent_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image_edit_{{ $structure->id }}" class="form-label">Foto</label>
        <input type="file" class="form-control" id="image_edit_{{ $structure->id }}" name="image"
            accept="image/*">
        <small class="text-muted">Pilih gambar (JPEG/PNG/JPG/GIF, maks 2MB). Biarkan kosong jika tidak ingin
            mengubah.</small>
        @if ($structure->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $structure->image) }}" class="img-thumbnail" style="max-width: 150px;"
                    alt="Current Image">
            </div>
        @endif
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_active" id="is_active_edit_{{ $structure->id }}"
            value="1" {{ old('is_active', $structure->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active_edit_{{ $structure->id }}">
            Aktifkan (Tampil di Halaman User)
        </label>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    document.getElementById('level_edit_{{ $structure->id }}').addEventListener('change', function() {
        const selectedLevel = parseInt(this.value);
        const parentSelect = document.getElementById('parent_id_edit_{{ $structure->id }}');
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
    document.getElementById('level_edit_{{ $structure->id }}').dispatchEvent(new Event('change'));
</script>
