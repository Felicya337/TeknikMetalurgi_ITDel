<div>
    <div class="row">
        <div class="col-md-4 text-center">
            @if ($lecturer->image)
                <img src="{{ asset('storage/' . $lecturer->image) }}" class="img-fluid rounded-circle shadow-sm mb-3"
                    alt="Foto {{ $lecturer->name }}" style="max-width: 150px; max-height: 150px; object-fit: cover;">
            @else
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-muted"></i>
                    <p class="text-muted small">Tidak ada foto</p>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <dl class="row">
                <dt class="col-sm-4">ID Karyawan</dt>
                <dd class="col-sm-8">{{ $lecturer->employee_id }}</dd>

                <dt class="col-sm-4">Nama</dt>
                <dd class="col-sm-8">{{ $lecturer->name }}</dd>

                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8"><a href="mailto:{{ $lecturer->email }}">{{ $lecturer->email }}</a></dd>

                <dt class="col-sm-4">LinkedIn</dt>
                <dd class="col-sm-8">
                    @if ($lecturer->linkedIn_url)
                        {{-- Menggunakan accessor --}}
                        <a href="{{ $lecturer->linkedIn_url }}" target="_blank" rel="noopener noreferrer">
                            {{ $lecturer->linkedIn_username }} {{-- Menggunakan accessor --}}
                        </a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </dd>

                <dt class="col-sm-4">Ruangan</dt>
                <dd class="col-sm-8">{{ $lecturer->room ?? '-' }}</dd>

                <dt class="col-sm-4">Peran</dt>
                <dd class="col-sm-8">{{ ucfirst($lecturer->role) }}</dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
                    <span class="badge {{ $lecturer->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $lecturer->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </dd>
            </dl>
        </div>
    </div>
    <hr>
    <div class="mb-3">
        <h5 class="fw-bold">Riwayat Pendidikan</h5>
        <div class="p-3 border rounded bg-light">{!! $lecturer->education ?: '<span class="text-muted fst-italic">Tidak ada data.</span>' !!}</div>
    </div>
    <div class="mb-3">
        <h5 class="fw-bold">Bidang Penelitian & Publikasi</h5>
        <div class="p-3 border rounded bg-light">{!! $lecturer->research ?: '<span class="text-muted fst-italic">Tidak ada data.</span>' !!}</div>
    </div>
    @if ($lecturer->role == 'dosen')
        <div class="mb-3">
            <h5 class="fw-bold">Mata Kuliah yang Diampu</h5>
            <div class="p-3 border rounded bg-light">{!! $lecturer->courses ?: '<span class="text-muted fst-italic">Tidak ada data.</span>' !!}</div>
        </div>
    @endif
    <div class="text-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
</div>
