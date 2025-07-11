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
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mb-3">
                    <h2 class="mb-0 fw-bold text-dark">Fasilitas</h2>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#modal-facility">
                        <i class="fas fa-plus me-2"></i>Tambah Fasilitas
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" id="facilityTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;">Nomor</th>
                                        <th scope="col" style="width: 15%;">Tipe</th>
                                        <th scope="col" style="width: 20%;">Deskripsi</th>
                                        <th scope="col" style="width: 15%;">Hari Akademik</th>
                                        <th scope="col" style="width: 10%;">Jam Akademik</th>
                                        <th scope="col" style="width: 10%;">Jam Kolaborasi</th>
                                        <th scope="col" style="width: 10%;">Gambar</th>
                                        <th scope="col" style="width: 10%;">Aktif</th>
                                        <th scope="col" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facilities as $index => $facility)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $facility->type == 'classroom' ? 'bg-primary' : ($facility->type == 'smartclass' ? 'bg-info' : 'bg-success') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $facility->type)) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($facility->description)
                                                    {!! Str::limit(strip_tags($facility->description), 100) !!}
                                                @else
                                                    <span class="text-muted">Tidak ada deskripsi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($facility->academic_days && is_array($facility->academic_days))
                                                    @php
                                                        $dayTranslations = [
                                                            'Monday' => 'Senin',
                                                            'Tuesday' => 'Selasa',
                                                            'Wednesday' => 'Rabu',
                                                            'Thursday' => 'Kamis',
                                                            'Friday' => 'Jumat',
                                                            'Saturday' => 'Sabtu',
                                                            'Sunday' => 'Minggu',
                                                        ];
                                                        $translatedDays = array_map(function ($day) use (
                                                            $dayTranslations,
                                                        ) {
                                                            return $dayTranslations[$day] ?? $day;
                                                        }, $facility->academic_days);
                                                    @endphp
                                                    {{ implode(', ', $translatedDays) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $facility->academic_hours ?? '-' }}</td>
                                            <td>{{ $facility->collaborative_hours ?? '-' }}</td>
                                            <td>
                                                @if ($facility->images && is_array($facility->images) && count($facility->images) > 0)
                                                    <img src="{{ asset('storage/' . $facility->images[0]) }}"
                                                        class="img-thumbnail" alt="Facility Image">
                                                @else
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $facility->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $facility->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-info btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-read-facility-{{ $facility->id }}">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-facility-{{ $facility->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('admin.facility.destroy', $facility->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm mx-1 delete-btn">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- MODAL READ FACILITY -->
                                        <div class="modal fade" id="modal-read-facility-{{ $facility->id }}" tabindex="-1"
                                            aria-labelledby="modal-read-facilityLabel-{{ $facility->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Fasilitas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.facility.read', [
                                                            'facility' => $facility,
                                                        ])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL EDIT FACILITY -->
                                        <div class="modal fade" id="modal-edit-facility-{{ $facility->id }}" tabindex="-1"
                                            aria-labelledby="modal-edit-facilityLabel-{{ $facility->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Fasilitas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.facility.edit', [
                                                            'facility' => $facility,
                                                        ])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD FACILITY -->
    <div class="modal fade" id="modal-facility" tabindex="-1" aria-labelledby="modal-facilityLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('admin.facility.create')
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
            $('#facilityTable').DataTable({
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
                    }
                },
                dom: '<"top"<"float-left"l><"float-right"f>>rt<"bottom"<"float-left"i><"float-right"p>>',
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: 2,
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return data.length > 100 ? data.substr(0, 100) + '...' : data;
                            }
                            return data;
                        }
                    },
                    {
                        targets: 8,
                        orderable: false,
                        searchable: false
                    }
                ],
                initComplete: function() {
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

            // Initialize Summernote for CREATE form
            function initCreateSummernote() {
                if ($('#editor-create').length && !$('#editor-create').next('.note-editor').length) {
                    $('#editor-create').summernote({
                        height: 300,
                        fontNames: ['Inter', 'Arial', 'Helvetica', 'Times New Roman', 'Courier New'],
                        fontNamesIgnoreCheck: ['Inter'],
                        fontSizes: ['12', '14', '16', '20', '24', '32'],
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
                                var initialValue = $('#description-create').val();
                                if (initialValue) {
                                    $('#editor-create').summernote('code', initialValue);
                                }
                            }
                        }
                    });
                }
            }

            // Initialize create summernote when modal is shown
            $('#modal-facility').on('shown.bs.modal', function() {
                initCreateSummernote();
            });

            // Destroy summernote when create modal is hidden
            $('#modal-facility').on('hidden.bs.modal', function() {
                if ($('#editor-create').next('.note-editor').length) {
                    $('#editor-create').summernote('destroy');
                }
            });

            // Pastikan nilai tersimpan saat form submit
            $('form').on('submit', function(e) {
                if ($(this).find('#editor-create').length) {
                    var editorContent = $('#editor-create').summernote('code');
                    $('#description-create').val(editorContent);
                }

                $(this).find('[id^="editor-edit-"]').each(function() {
                    var editorId = $(this).attr('id');
                    var facilityId = editorId.replace('editor-edit-', '');
                    var hiddenInputId = 'description-edit-' + facilityId;

                    if ($(this).next('.note-editor').length) {
                        var content = $(this).summernote('code');
                        $('#' + hiddenInputId).val(content);
                    }
                });
            });

            // Initialize Summernote for Edit Forms
            $('div[id^="modal-edit-facility-"]').on('shown.bs.modal', function() {
                var modalId = $(this).attr('id');
                var facilityId = modalId.replace('modal-edit-facility-', '');
                var editorId = 'editor-edit-' + facilityId;
                var hiddenInputId = 'description-edit-' + facilityId;
                var existingDescription = $('#' + hiddenInputId).val();

                if (!$('#' + editorId).next('.note-editor').length) {
                    $('#' + editorId).summernote({
                        height: 300,
                        fontNames: ['Inter', 'Arial', 'Helvetica', 'Times New Roman',
                            'Courier New'
                        ],
                        fontNamesIgnoreCheck: ['Inter'],
                        fontSizes: ['12', '14', '16', '20', '24', '32'],
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
                                $('#' + hiddenInputId).val(contents);
                            },
                            onInit: function() {
                                if (existingDescription) {
                                    $('#' + editorId).summernote('code', existingDescription);
                                }
                            }
                        }
                    });
                }
            });

            // Destroy Summernote instances when edit modals are hidden
            $('div[id^="modal-edit-facility-"]').on('hidden.bs.modal', function() {
                var modalId = $(this).attr('id');
                var facilityId = modalId.replace('modal-edit-facility-', '');
                var editorId = 'editor-edit-' + facilityId;

                if ($('#' + editorId).next('.note-editor').length) {
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

            // SweetAlert2 for Delete Confirmation
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Fasilitas?',
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // File input validation
            $('input[type="file"]').on('change', function() {
                const files = this.files;
                const maxFiles = 5;
                const maxSize = 2 * 1024 * 1024; // 2MB
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

                if (files.length > maxFiles) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: `Maksimum ${maxFiles} gambar yang diizinkan!`
                    });
                    this.value = '';
                    return;
                }

                for (let i = 0; i < files.length; i++) {
                    if (!allowedTypes.includes(files[i].type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Hanya file gambar (JPEG, PNG, JPG, GIF) yang diizinkan!'
                        });
                        this.value = '';
                        return;
                    }

                    if (files[i].size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: `Ukuran file ${files[i].name} terlalu besar! Maksimum 2MB per file.`
                        });
                        this.value = '';
                        return;
                    }
                }
            });
        });
    </script>
@endpush
