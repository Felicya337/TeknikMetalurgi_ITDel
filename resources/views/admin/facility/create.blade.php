<form action="{{ route('admin.facility.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="type-create" class="form-label">Tipe <span class="text-danger">*</span></label>
        <select class="form-control" id="type-create" name="type" required>
            <option value="">Pilih Tipe Fasilitas</option>
            <option value="classroom" {{ old('type') == 'classroom' ? 'selected' : '' }}>Ruang Kelas</option>
            <option value="smartclass" {{ old('type') == 'smartclass' ? 'selected' : '' }}>Smart Class</option>
            <option value="reading_room" {{ old('type') == 'reading_room' ? 'selected' : '' }}>Ruang Baca</option>
        </select>
        @error('type')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description-create" class="form-label">Deskripsi <span class="text-danger">*</span></label>
        <div id="editor-create" style="height: 300px;"></div>
        <input type="hidden" id="description-create" name="description" value="{{ old('description') }}">
        @error('description')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="academic_days" class="form-label">Hari Akademik</label>
        @php
            $selectedDays = old('academic_days', []);
            $days = [
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
                'Sunday' => 'Minggu',
            ];
        @endphp
        <div class="row">
            @foreach ($days as $value => $label)
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="day_{{ $value }}_create"
                            name="academic_days[]" value="{{ $value }}"
                            {{ in_array($value, $selectedDays) ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="day_{{ $value }}_create">{{ $label }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        @error('academic_days')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="academic_hours-create" class="form-label">Jam Akademik</label>
        <input type="text" class="form-control" id="academic_hours-create" name="academic_hours"
            value="{{ old('academic_hours') }}" placeholder="Contoh: 08:00-16:00">
        <small class="text-muted">Format: HH:MM-HH:MM</small>
        @error('academic_hours')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="collaborative_hours-create" class="form-label">Jam Kolaborasi</label>
        <input type="text" class="form-control" id="collaborative_hours-create" name="collaborative_hours"
            value="{{ old('collaborative_hours') }}" placeholder="Contoh: 16:00-18:00">
        <small class="text-muted">Format: HH:MM-HH:MM</small>
        @error('collaborative_hours')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="images-create" class="form-label">Gambar (Maksimum 5)</label>
        <input type="file" class="form-control" id="images-create" name="images[]"
            accept="image/jpeg,image/png,image/jpg,image/gif" multiple>
        <small class="text-muted">Pilih hingga 5 gambar (JPEG/PNG/JPG/GIF, maks 2MB per gambar).</small>
        @error('images')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_active-create" name="is_active" value="1"
                {{ old('is_active', '1') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active-create">Aktifkan (Tampil di Halaman User)</label>
        </div>
        @error('is_active')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i>Simpan
        </button>
    </div>
</form>
