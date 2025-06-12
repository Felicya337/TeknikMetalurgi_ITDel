@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
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
            max-width: 60px;
            /* Disesuaikan agar tidak terlalu besar */
            max-height: 45px;
            /* Disesuaikan agar tidak terlalu besar */
            object-fit: cover;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: 500;
        }

        .badge-kegiatan_mahasiswa {
            background-color: #007bff;
            color: white;
        }

        .badge-kegiatan_prodi {
            background-color: #28a745;
            color: white;
        }

        .badge-club_mahasiswa {
            background-color: #ffc107;
            color: black;
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
                max-width: 50px;
                max-height: 35px;
            }
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mb-3">
                    <h2 class="mb-0 fw-bold text-dark"> Kegiatan Mahasiswa</h2>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#modal-studentactivity">
                        <i class="fas fa-plus me-2"></i>Tambah Kegiatan
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" id="studentActivityTable">
                                <thead>
                                    <tr>
                                        {{-- KOLOM NOMOR DIHAPUS --}}
                                        <th scope="col" style="width: 20%;">Jenis Kegiatan</th> {{-- Lebar disesuaikan --}}
                                        <th scope="col" style="width: 20%;">Judul</th>
                                        <th scope="col" style="width: 25%;">Deskripsi</th>
                                        <th scope="col" style="width: 10%;">Gambar</th> {{-- Lebar disesuaikan --}}
                                        <th scope="col" style="width: 10%;">Status</th>
                                        <th scope="col" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $activity)
                                        <tr>
                                            {{-- KOLOM NOMOR DIHAPUS --}}
                                            <td>
                                                <span class="badge badge-{{ $activity->type }}">
                                                    {{ $activity->getTypeLabel() }}
                                                </span>
                                            </td>
                                            <td class="text-start">{{ $activity->title }}</td>
                                            <td class="text-start">{!! Str::limit(strip_tags($activity->description), 70) !!}</td>
                                            <td>
                                                @if ($activity->image)
                                                    <img src="{{ asset('storage/' . $activity->image) }}"
                                                        class="img-thumbnail" alt="Activity Image">
                                                @else
                                                    <span class="text-muted small">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $activity->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $activity->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-info btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-read-studentactivity-{{ $activity->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-studentactivity-{{ $activity->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form
                                                        action="{{ route('admin.studentactivity.destroy', $activity->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm mx-1 delete-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- MODAL READ STUDENT ACTIVITY -->
                                        <div class="modal fade" id="modal-read-studentactivity-{{ $activity->id }}"
                                            tabindex="-1"
                                            aria-labelledby="modal-read-studentactivityLabel-{{ $activity->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Kegiatan: {{ $activity->title }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.studentactivity.read', [
                                                            'activity' => $activity,
                                                        ])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL EDIT STUDENT ACTIVITY -->
                                        <div class="modal fade" id="modal-edit-studentactivity-{{ $activity->id }}"
                                            tabindex="-1"
                                            aria-labelledby="modal-edit-studentactivityLabel-{{ $activity->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Kegiatan: {{ $activity->title }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.studentactivity.edit', [
                                                            'activity' => $activity,
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
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD STUDENT ACTIVITY -->
    <div class="modal fade" id="modal-studentactivity" tabindex="-1" aria-labelledby="modal-studentactivityLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kegiatan Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('admin.studentactivity.create')
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
            $('#studentActivityTable').DataTable({
                responsive: true,
                pageLength: 10,
                searching: true,
                lengthChange: true,
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
                    aria: {
                        sortAscending: ": aktifkan untuk mengurutkan kolom naik",
                        sortDescending: ": aktifkan untuk mengurutkan kolom turun"
                    }
                },
                dom: '<"top"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>>rt<"bottom"<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                // --- AWAL PERUBAHAN PADA COLUMNS ---
                // Karena kolom "No" dihilangkan, konfigurasi columns disesuaikan. Sekarang ada 6 kolom.
                columns: [
                    null, // Kolom 0: Jenis Kegiatan (sebelumnya indeks 1)
                    null, // Kolom 1: Judul
                    { // Kolom 2: Deskripsi
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return data; // Data sudah HTML dari Blade
                            }
                            // Untuk sorting/filtering, ambil teksnya
                            var tempDiv = document.createElement("div");
                            tempDiv.innerHTML = data;
                            return tempDiv.textContent || tempDiv.innerText || "";
                        }
                    },
                    {
                        orderable: false,
                        searchable: false
                    }, // Kolom 3: Gambar
                    {
                        orderable: false
                    }, // Kolom 4: Status
                    {
                        orderable: false,
                        searchable: false
                    } // Kolom 5: Aksi
                ],
                // columnDefs bisa disesuaikan atau dikosongkan jika pengaturan default sudah cukup
                columnDefs: [
                    // Contoh: jika ingin kolom Jenis Kegiatan juga tidak bisa di-sort
                    // { targets: 0, orderable: false },
                    {
                        targets: [3, 5],
                        orderable: false,
                        searchable: false
                    }, // Gambar, Aksi
                    {
                        targets: [4],
                        orderable: false
                    } // Status
                ],
                order: [], // Tidak ada pengurutan awal default
                // --- AKHIR PERUBAHAN PADA COLUMNS ---
                initComplete: function() {
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

            // Initialize Summernote for Create Form in Modal
            $('#modal-studentactivity').on('shown.bs.modal', function() {
                // Pastikan elemen #editor-create ada sebelum inisialisasi
                if ($('#editor-create').length && !$('#editor-create').data('summernote')) {
                    $('#editor-create').summernote({
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
                                $('#description-create').val(contents);
                            },
                            onInit: function() {
                                var oldDescription = $('#description-create').val();
                                if (oldDescription) {
                                    $('#editor-create').summernote('code', oldDescription);
                                }
                            }
                        }
                    });
                }
            }).on('hidden.bs.modal', function() {
                if ($('#editor-create').length && $('#editor-create').data('summernote')) {
                    $('#editor-create').summernote('destroy');
                }
            });


            // Initialize Summernote for Edit Forms when modals are shown
            $('div[id^="modal-edit-studentactivity-"]').on('shown.bs.modal', function() {
                var modalId = $(this).attr('id');
                var activityId = modalId.replace('modal-edit-studentactivity-', '');
                var editorId = 'editor-edit-' + activityId;
                var descriptionInputId = 'description-edit-' + activityId;

                if ($('#' + editorId).length && !$('#' + editorId).data('summernote')) {
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
                    var description = $('#' + descriptionInputId).val();
                    $('#' + editorId).summernote('code', description);
                }
            }).on('hidden.bs.modal', function() {
                var modalId = $(this).attr('id');
                var activityId = modalId.replace('modal-edit-studentactivity-', '');
                var editorId = 'editor-edit-' + activityId;
                if ($('#' + editorId).length && $('#' + editorId).data('summernote')) {
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

            @if ($errors->any())
                let errorMsg = "<ul class='text-start'>"; // text-start untuk alignment
                @foreach ($errors->all() as $error)
                    errorMsg += "<li>{{ $error }}</li>";
                @endforeach
                errorMsg += "</ul>";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops, terjadi kesalahan!',
                    html: errorMsg
                });

                // Jika error terjadi pada form tambah, buka modal tambah
                @if (old('form_type') == 'create_student_activity' || (isset($errors) && $errors->hasBag('createStudentActivity')))
                    $('#modal-studentactivity').modal('show');
                @endif

                // Jika error terjadi pada form edit, buka modal edit yang sesuai
                @if (old('form_type') == 'edit_student_activity' ||
                        (isset($errors) && $errors->hasBag('editStudentActivity' . old('activity_id_error'))))
                    var activityIdError = "{{ old('activity_id_error') }}";
                    if (activityIdError) {
                        $('#modal-edit-studentactivity-' + activityIdError).modal('show');
                    }
                @endif
            @endif

            // SweetAlert2 for Delete Confirmation
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Kegiatan Mahasiswa?',
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
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
