@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .table tr:hover {
            background-color: #f1f3f5;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-info,
        .btn-warning,
        .btn-danger {
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .img-thumbnail {
            border-radius: 8px;
            max-width: 80px;
            /* Disesuaikan agar tidak terlalu besar */
            max-height: 60px;
            /* Disesuaikan agar tidak terlalu besar */
            object-fit: cover;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: 500;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: none;
            padding: 20px 24px;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .modal-body {
            padding: 24px;
        }

        .title-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .note-editor.note-frame {
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }

            .btn-sm {
                padding: 4px 8px;
                font-size: 0.8rem;
            }

            .img-thumbnail {
                max-width: 60px;
                max-height: 45px;
            }
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mb-3">
                    <h2 class="mb-0 fw-bold text-dark">Publikasi dan Penelitian</h2>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#modal-achievement">
                        <i class="fas fa-plus me-2"></i>Tambah
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" id="achievementTable">
                                <thead>
                                    <tr>
                                        {{-- NOMOR DIHAPUS --}}
                                        <th scope="col" style="width: 10%;">Jenis</th>
                                        <th scope="col" style="width: 10%;">Tipe</th>
                                        <th scope="col" style="width: 15%;">Judul</th>
                                        <th scope="col" style="width: 20%;">Deskripsi</th>
                                        <th scope="col" style="width: 10%;">Tanggal</th>
                                        <th scope="col" style="width: 10%;">Gambar</th>
                                        <th scope="col" style="width: 10%;">File</th>
                                        <th scope="col" style="width: 10%;">Aktif</th>
                                        <th scope="col" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($achievements as $achievement)
                                        <tr>
                                            {{-- NOMOR DIHAPUS --}}
                                            <td>
                                                <span
                                                    class="badge {{ $achievement->type == 'publikasi' ? 'bg-primary' : ($achievement->type == 'penelitian' ? 'bg-info' : 'bg-success') }}">
                                                    {{ ucfirst($achievement->type) }} {{-- ucfirst untuk kapitalisasi --}}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($achievement->subtype)
                                                    <span class="badge bg-secondary">{{ $achievement->subtype }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-start">{{ $achievement->title }}</td>
                                            <td class="text-start">{!! Str::limit(strip_tags($achievement->description), 70) !!}</td> {{-- strip_tags ditambahkan --}}
                                            <td>{{ $achievement->date ? \Carbon\Carbon::parse($achievement->date)->format('d-m-Y') : '-' }}
                                            </td>
                                            <td>
                                                @if ($achievement->image)
                                                    <img src="{{ asset('storage/' . $achievement->image) }}"
                                                        class="img-thumbnail" alt="Achievement Image">
                                                @else
                                                    <span class="text-muted small">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($achievement->file)
                                                    <a href="{{ asset('storage/' . $achievement->file) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-file-alt"></i> {{-- Icon diubah --}}
                                                    </a>
                                                @else
                                                    <span class="text-muted small">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $achievement->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $achievement->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-info btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-read-achievement-{{ $achievement->id }}">
                                                        <i class="fas fa-eye"></i>Lihat
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-achievement-{{ $achievement->id }}">
                                                        <i class="fas fa-edit"></i>Edit
                                                    </button>
                                                    <form
                                                        action="{{ route('admin.achievement.destroy', $achievement->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm mx-1 delete-btn">
                                                            <i class="fas fa-trash"></i>Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- MODAL READ ACHIEVEMENT -->
                                        <div class="modal fade" id="modal-read-achievement-{{ $achievement->id }}"
                                            tabindex="-1"
                                            aria-labelledby="modal-read-achievementLabel-{{ $achievement->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Prestasi: {{ $achievement->title }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.achievement.read', [
                                                            'achievement' => $achievement,
                                                        ])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL EDIT ACHIEVEMENT -->
                                        <div class="modal fade" id="modal-edit-achievement-{{ $achievement->id }}"
                                            tabindex="-1"
                                            aria-labelledby="modal-edit-achievementLabel-{{ $achievement->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Prestasi: {{ $achievement->title }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.achievement.edit', [
                                                            'achievement' => $achievement,
                                                        ])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $achievements->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD ACHIEVEMENT -->
    <div class="modal fade" id="modal-achievement" tabindex="-1" aria-labelledby="modal-achievementLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('admin.achievement.create')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // DataTables Initialization
            $('#achievementTable').DataTable({
                responsive: true,
                pageLength: 10,
                searching: true,
                lengthChange: true,
                processing: true, // Tambahkan ini jika ada proses loading data
                // serverSide: true, // Aktifkan jika Anda menggunakan server-side processing
                // ajax: "{{-- route('admin.achievements.data') --}}", // Contoh jika pakai server-side
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    processing: "Memuat..." // Pesan saat loading
                },
                dom: '<"top"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>>rt<"bottom"<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>', // Dom yang lebih standar
                // --- AWAL PERUBAHAN ---
                // Karena kolom nomor dihilangkan dari HTML, konfigurasi 'columns' juga disesuaikan
                // Sekarang ada 9 kolom yang terlihat di HTML
                columns: [
                    null, // Kolom 0: Jenis (Indeks asli 1, sekarang 0)
                    null, // Kolom 1: Tipe
                    null, // Kolom 2: Judul
                    { // Kolom 3: Deskripsi
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return data;
                            }
                            var tempDiv = document.createElement("div");
                            tempDiv.innerHTML = data;
                            return tempDiv.textContent || tempDiv.innerText || "";
                        }
                    },
                    null, // Kolom 4: Tanggal
                    {
                        orderable: false,
                        searchable: false
                    }, // Kolom 5: Gambar
                    {
                        orderable: false,
                        searchable: false
                    }, // Kolom 6: File
                    {
                        orderable: false
                    }, // Kolom 7: Aktif
                    {
                        orderable: false,
                        searchable: false
                    } // Kolom 8: Aksi
                ],
                // columnDefs tidak lagi diperlukan untuk render deskripsi karena sudah di 'columns'
                // Anda bisa menambahkan columnDefs lain jika perlu
                // Contoh:
                columnDefs: [{
                        targets: [5, 6, 8],
                        orderable: false,
                        searchable: false
                    }, // Gambar, File, Aksi
                    {
                        targets: [7],
                        orderable: false
                    } // Status Aktif mungkin tidak perlu searchable
                ],
                // --- AKHIR PERUBAHAN ---
                order: [], // Tidak ada pengurutan awal default
                initComplete: function() {
                    // Menyesuaikan kelas form control Bootstrap pada elemen DataTables
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

            // Initialize Summernote for Create Form in Modal
            $('#modal-achievement').on('shown.bs.modal', function() {
                if (!$('#editor-create').data('summernote')) { // Cek apakah sudah diinisialisasi
                    $('#editor-create').summernote({
                        height: 250, // Tinggi disesuaikan
                        fontNames: ['Inter', 'Arial', 'Helvetica', 'Times New Roman',
                            'Courier New'
                        ],
                        fontNamesIgnoreCheck: ['Inter'],
                        fontSizes: ['10', '12', '14', '16', '18', '20', '24'],
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'video']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ],
                        callbacks: {
                            onChange: function(contents) {
                                $('#description-create').val(contents);
                            },
                            onInit: function() {
                                // Set initial content if any (e.g. from old input after validation error)
                                var oldDescription = $('#description-create').val();
                                if (oldDescription) {
                                    $('#editor-create').summernote('code', oldDescription);
                                }
                            }
                        }
                    });
                }
            }).on('hidden.bs.modal', function() {
                // Opsional: Hancurkan instance Summernote saat modal ditutup untuk menghindari masalah
                if ($('#editor-create').data('summernote')) {
                    $('#editor-create').summernote('destroy');
                }
            });


            // Initialize Summernote for Edit Forms when modals are shown
            $('div[id^="modal-edit-achievement-"]').on('shown.bs.modal', function() {
                var modalId = $(this).attr('id');
                var achievementId = modalId.replace('modal-edit-achievement-', '');
                var editorId = 'editor-edit-' + achievementId;
                var descriptionInputId = 'description-edit-' + achievementId;

                if (!$('#' + editorId).data('summernote')) { // Cek apakah sudah diinisialisasi
                    $('#' + editorId).summernote({
                        height: 250,
                        fontNames: ['Inter', 'Arial', 'Helvetica', 'Times New Roman',
                            'Courier New'
                        ],
                        fontNamesIgnoreCheck: ['Inter'],
                        fontSizes: ['10', '12', '14', '16', '18', '20', '24'],
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'video']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ],
                        callbacks: {
                            onChange: function(contents) {
                                $('#' + descriptionInputId).val(contents);
                            }
                        }
                    });
                    // Set initial content from hidden input
                    var description = $('#' + descriptionInputId).val();
                    $('#' + editorId).summernote('code', description);
                }
            }).on('hidden.bs.modal', function() {
                var modalId = $(this).attr('id');
                var achievementId = modalId.replace('modal-edit-achievement-', '');
                var editorId = 'editor-edit-' + achievementId;
                // Opsional: Hancurkan instance Summernote saat modal ditutup
                if ($('#' + editorId).data('summernote')) {
                    $('#' + editorId).summernote('destroy');
                }
            });

            // SweetAlert2 for Notifications
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            // SweetAlert2 for Validation Errors (jika ada dari $errors)
            @if ($errors->any())
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += `<li>{{ $error }}</li>`;
                @endforeach
                Swal.fire({
                    icon: 'error',
                    title: 'Oops, terjadi kesalahan!',
                    html: `<ul class="text-start">${errorMessages}</ul>`,
                });

                // Jika error terjadi pada form tambah, buka modal tambah
                @if (old('form_type') == 'create_achievement' || (isset($errors) && $errors->hasBag('createAchievement')))
                    $('#modal-achievement').modal('show');
                @endif

                // Jika error terjadi pada form edit, buka modal edit yang sesuai
                @if (old('form_type') == 'edit_achievement' ||
                        (isset($errors) && $errors->hasBag('editAchievement' . old('achievement_id_error'))))
                    var achievementIdError = "{{ old('achievement_id_error') }}";
                    if (achievementIdError) {
                        $('#modal-edit-achievement-' + achievementIdError).modal('show');
                    }
                @endif
            @endif


            // SweetAlert2 for Delete Confirmation
            $(document).on('click', '.delete-btn', function(e) { // Gunakan event delegation
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Prestasi?',
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d', // Warna cancel diubah
                    confirmButtonText: '<i class="fas fa-trash-alt"></i> Ya, Hapus!',
                    cancelButtonText: '<i class="fas fa-times"></i> Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
