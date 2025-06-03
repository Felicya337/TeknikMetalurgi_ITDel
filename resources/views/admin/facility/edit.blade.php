<form action="{{ route('admin.facility.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="type" class="form-label">Tipe</label>
        <select class="form-control" id="type" name="type" required>
            <option value="">Pilih Tipe Fasilitas</option>
            <option value="classroom" {{ old('type', $facility->type) == 'classroom' ? 'selected' : '' }}>Ruang Kelas
            </option>
            <option value="smartclass" {{ old('type', $facility->type) == 'smartclass' ? 'selected' : '' }}>Smartclass
            </option>
            <option value="reading_room" {{ old('type', $facility->type) == 'reading_room' ? 'selected' : '' }}>Ruang
                Baca</option>
        </select>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <div id="editor-edit-{{ $facility->id }}" style="height: 300px;"></div>
        <input type="hidden" id="description-edit-{{ $facility->id }}" name="description"
            value="{{ old('description', $facility->description) }}">
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="academic_days" class="form-label">Hari Akademik</label>
        @php
            $selectedDays = old('academic_days', $facility->academic_days ?? []);
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
                        <input class="form-check-input" type="checkbox" id="day_{{ $value }}_edit"
                            name="academic_days[]" value="{{ $value }}"
                            {{ in_array($value, $selectedDays) ? 'checked' : '' }}>
                        <label class="form-check-label" for="day_{{ $value }}_edit">{{ $label }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        @error('academic_days')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="academic_hours" class="form-label">Jam Akademik</label>
        <input type="text" class="form-control" id="academic_hours" name="academic_hours"
            value="{{ old('academic_hours', $facility->academic_hours) }}" placeholder="Contoh: 08:00-16:00">
        @error('academic_hours')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="collaborative_hours" class="form-label">Jam Kolaborasi</label>
        <input type="text" class="form-control" id="collaborative_hours" name="collaborative_hours"
            value="{{ old('collaborative_hours', $facility->collaborative_hours) }}" placeholder="Contoh: 16:00-18:00">
        @error('collaborative_hours')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="images" class="form-label">Gambar (Maksimum 5)</label>
        <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
        <small class="text-muted">Pilih hingga 5 gambar (JPEG/PNG/JPG/GIF, maks 2MB per gambar). Unggah baru untuk
            mengganti gambar lama.</small>
        @if ($facility->images && count($facility->images) > 0)
            <div class="mt-2">
                <p>Gambar saat ini:</p>
                @foreach ($facility->images as $image)
                    <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail"
                        style="max-width: 100px; margin-right: 10px;" alt="Facility Image">
                @endforeach
            </div>
        @endif
        @error('images')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
            {{ old('is_active', $facility->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
        @error('is_active')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
