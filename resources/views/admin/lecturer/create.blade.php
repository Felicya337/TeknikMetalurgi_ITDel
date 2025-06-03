<form action="{{ route('admin.lecturer.store') }}" method="POST" enctype="multipart/form-data" id="lecturer-create-form">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="employee_id_create" class="form-label">ID Karyawan (NIDN/NIP) <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('employee_id') is-invalid @enderror"
                    id="employee_id_create" name="employee_id" value="{{ old('employee_id') }}" required>
                @error('employee_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name_create" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name_create"
                    name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email_create" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email_create"
                    name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="linkedIn_create" class="form-label">LinkedIn Username</label>
                <input type="text" class="form-control @error('linkedIn') is-invalid @enderror" id="linkedIn_create"
                    name="linkedIn" value="{{ old('linkedIn') }}" placeholder="cth: nama-pengguna-linkedin">
                <small class="form-text text-muted">Masukkan username LinkedIn (bagian akhir URL profil Anda) atau URL
                    lengkap.</small>
                @error('linkedIn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="room_create" class="form-label">Ruangan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('room') is-invalid @enderror" id="room_create"
                    name="room" value="{{ old('room') }}" required>
                @error('room')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="education-create" class="form-label">Riwayat Pendidikan</label>
                <textarea id="education-create" name="education"
                    class="form-control summernote-editor @error('education') is-invalid @enderror">{{ old('education') }}</textarea>
                @error('education')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="research-create" class="form-label">Riset</label>
                <textarea id="research-create" name="research"
                    class="form-control summernote-editor @error('research') is-invalid @enderror">{{ old('research') }}</textarea>
                @error('research')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="courses-create" class="form-label">Mata Kuliah yang Diampu (Untuk Dosen)</label>
                <textarea id="courses-create" name="courses"
                    class="form-control summernote-editor @error('courses') is-invalid @enderror">{{ old('courses') }}</textarea>
                @error('courses')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="image_create" class="form-label">Foto</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image_create"
                    name="image" accept="image/*">
                <small class="text-muted">Format: JPEG, PNG, JPG, GIF. Maks 2MB.</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role_create" class="form-label">Peran <span class="text-danger">*</span></label>
                <select class="form-select @error('role') is-invalid @enderror" id="role_create" name="role"
                    required>
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Peran...</option>
                    <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="staf" {{ old('role') == 'staf' ? 'selected' : '' }}>Staf</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3 form-check">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" class="form-check-input" id="is_active_create" name="is_active"
                    value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active_create">Aktifkan (Tampilkan di Halaman Publik)</label>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>
</form>
