<form action="{{ route('admin.curriculum.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="course_code" class="form-label">Kode Mata Kuliah</label>
        <input type="text" class="form-control" id="course_code" name="course_code" value="{{ old('course_code') }}"
            required>
        @error('course_code')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="course_name" class="form-label">Nama Mata Kuliah</label>
        <input type="text" class="form-control" id="course_name" name="course_name" value="{{ old('course_name') }}"
            required>
        @error('course_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="semester" class="form-label">Semester</label>
        <select class="form-select" id="semester" name="semester" required>
            <option value="" disabled {{ old('semester') ? '' : 'selected' }}>Pilih Semester</option>
            @for ($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester
                    {{ $i }}</option>
            @endfor
        </select>
        @error('semester')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="credits" class="form-label">Credits (SKS)</label>
        <input type="number" class="form-control" id="credits" name="credits" value="{{ old('credits') }}" required
            min="1">
        @error('credits')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_active_create" name="is_active" value="1"
                {{ old('is_active') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active_create">Aktifkan (Tampil di Halaman User)</label>
        </div>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
