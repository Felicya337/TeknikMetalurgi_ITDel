<form action="{{ route('admin.lecturer.update', $lecturer->id) }}" method="POST" enctype="multipart/form-data"
    id="lecturer-edit-form-{{ $lecturer->id }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="employee_id_edit_{{ $lecturer->id }}" class="form-label">ID Karyawan (NIDN/NIP) <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('employee_id') is-invalid @enderror"
                    id="employee_id_edit_{{ $lecturer->id }}" name="employee_id"
                    value="{{ old('employee_id', $lecturer->employee_id) }}" required>
                @error('employee_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name_edit_{{ $lecturer->id }}" class="form-label">Nama Lengkap <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name_edit_{{ $lecturer->id }}" name="name" value="{{ old('name', $lecturer->name) }}"
                    required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email_edit_{{ $lecturer->id }}" class="form-label">Email <span
                        class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email_edit_{{ $lecturer->id }}" name="email" value="{{ old('email', $lecturer->email) }}"
                    required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="linkedIn_edit_{{ $lecturer->id }}" class="form-label">LinkedIn Username</label>
                <input type="text" class="form-control @error('linkedIn') is-invalid @enderror"
                    id="linkedIn_edit_{{ $lecturer->id }}" name="linkedIn"
                    value="{{ old('linkedIn', $lecturer->linkedIn_username) }}"
                    placeholder="cth: nama-pengguna-linkedin">
                <small class="form-text text-muted">Masukkan username LinkedIn (bagian akhir URL profil Anda) atau URL
                    lengkap.</small>
                @error('linkedIn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="room_edit_{{ $lecturer->id }}" class="form-label">Ruangan <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('room') is-invalid @enderror"
                    id="room_edit_{{ $lecturer->id }}" name="room" value="{{ old('room', $lecturer->room) }}"
                    required>
                @error('room')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="education-edit-{{ $lecturer->id }}" class="form-label">Riwayat Pendidikan</label>
                <textarea id="education-edit-{{ $lecturer->id }}" name="education"
                    class="form-control summernote-editor @error('education') is-invalid @enderror">{{ old('education', $lecturer->education) }}</textarea>
                <input type="hidden" id="education-edit-input-{{ $lecturer->id }}" name="education_hidden_for_js_init"
                    value="{{ old('education', $lecturer->education) }}"> {{-- Helper untuk JS --}}
                @error('education')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="research-edit-{{ $lecturer->id }}" class="form-label">Bidang Penelitian & Publikasi</label>
                <textarea id="research-edit-{{ $lecturer->id }}" name="research"
                    class="form-control summernote-editor @error('research') is-invalid @enderror">{{ old('research', $lecturer->research) }}</textarea>
                <input type="hidden" id="research-edit-input-{{ $lecturer->id }}" name="research_hidden_for_js_init"
                    value="{{ old('research', $lecturer->research) }}">
                @error('research')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="courses-edit-{{ $lecturer->id }}" class="form-label">Mata Kuliah yang Diampu (Untuk
                    Dosen)</label>
                <textarea id="courses-edit-{{ $lecturer->id }}" name="courses"
                    class="form-control summernote-editor @error('courses') is-invalid @enderror">{{ old('courses', $lecturer->courses) }}</textarea>
                <input type="hidden" id="courses-edit-input-{{ $lecturer->id }}" name="courses_hidden_for_js_init"
                    value="{{ old('courses', $lecturer->courses) }}">
                @error('courses')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="image_edit_{{ $lecturer->id }}" class="form-label">Foto</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror"
                    id="image_edit_{{ $lecturer->id }}" name="image" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto. Format: JPEG, PNG, JPG, GIF. Maks
                    2MB.</small>
                @if ($lecturer->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $lecturer->image) }}" class="img-thumbnail"
                            alt="Foto saat ini" style="max-width: 100px;">
                    </div>
                @endif
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="role_edit_{{ $lecturer->id }}" class="form-label">Peran <span
                        class="text-danger">*</span></label>
                <select class="form-select @error('role') is-invalid @enderror" id="role_edit_{{ $lecturer->id }}"
                    name="role" required>
                    <option value="dosen" {{ old('role', $lecturer->role) == 'dosen' ? 'selected' : '' }}>Dosen
                    </option>
                    <option value="staf" {{ old('role', $lecturer->role) == 'staf' ? 'selected' : '' }}>Staf
                    </option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3 form-check">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" class="form-check-input" id="is_active_edit_{{ $lecturer->id }}"
                    name="is_active" value="1" {{ old('is_active', $lecturer->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active_edit_{{ $lecturer->id }}">Aktifkan (Tampilkan di
                    Halaman
                    Publik)</label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>
