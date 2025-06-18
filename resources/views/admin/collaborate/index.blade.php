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
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mb-3">
                    <h2 class="mb-0 fw-bold text-dark">Kerjasama</h2>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#modal-collaborate">
                        <i class="fas fa-plus me-2"></i>Tambah Kerjasama
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" id="collaborateTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;">Nomor</th>
                                        <th scope="col" style="width: 20%;">Nama Institusi</th>
                                        <th scope="col" style="width: 20%;">Profil Perusahaan</th>
                                        <th scope="col" style="width: 20%;">Deskripsi</th>
                                        <th scope="col" style="width: 15%;">Tanggal</th>
                                        <th scope="col" style="width: 10%;">Logo</th>
                                        <th scope="col" style="width: 10%;">Aktif</th>
                                        <th scope="col" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($collaborates as $collaborate)
                                        <tr>
                                            <td></td> <!-- Placeholder for row number -->
                                            <td>{{ $collaborate->institution_name }}</td>
                                            <td>{!! $collaborate->company_profile !!}</td>
                                            <td>{!! $collaborate->institution_description !!}</td>
                                            <td>{{ $collaborate->date ? $collaborate->date->format('d-m-Y') : '-' }}</td>
                                            <td>
                                                @if ($collaborate->logo)
                                                    <img src="{{ asset('storage/' . $collaborate->logo) }}"
                                                        class="img-thumbnail" alt="Collaborate Logo">
                                                @else
                                                    <span class="text-muted">Tidak ada logo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $collaborate->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $collaborate->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-info btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-read-collaborate-{{ $collaborate->id }}">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-collaborate-{{ $collaborate->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form
                                                        action="{{ route('admin.collaborate.destroy', $collaborate->id) }}"
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

                                        <div class="modal fade" id="modal-read-collaborate-{{ $collaborate->id }}"
                                            tabindex="-1"
                                            aria-labelledby="modal-read-collaborateLabel-{{ $collaborate->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Kerjasama</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.collaborate.read', [
                                                            'collaborate' => $collaborate,
                                                        ])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modal-edit-collaborate-{{ $collaborate->id }}"
                                            tabindex="-1"
                                            aria-labelledby="modal-edit-collaborateLabel-{{ $collaborate->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Kerjasama</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.collaborate.edit', [
                                                            'collaborate' => $collaborate,
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

    <div class="modal fade" id="modal-collaborate" tabindex="-1" aria-labelledby="modal-collaborateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kerjasama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('admin.collaborate.create')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    {{-- Pastikan Summernote CSS sudah diload di @section('content') atau di sini jika belum --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // DataTables Initialization
            $('#collaborateTable').DataTable({
                responsive: true,
                pageLength: 10,
                searching: true,
                lengthChange: true,
                language: {
                    /* ... Konfigurasi bahasa Anda ... */ },
                dom: '<"top"<"float-left"l><"float-right"f>>rt<"bottom"<"float-left"i><"float-right"p>>',
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // Row number starts from 1
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'institution_name',
                        name: 'institution_name'
                    }, // Tambahkan name untuk server-side jika perlu
                    {
                        data: 'company_profile',
                        name: 'company_profile'
                    },
                    {
                        data: 'institution_description',
                        name: 'institution_description'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    targets: [2, 3], // Kolom Profil Perusahaan dan Deskripsi
                    render: function(data, type, row) {
                        if (type === 'display') {
                            if (!data) return '';
                            let plainText = $('<div/>').html(data).text();
                            let limitedText = plainText.length > 100 ? plainText.substring(0,
                                100) + '...' : plainText;
                            let fullContentLink = '';
                            if (plainText.length > 100) {
                                // Asumsi row memiliki 'id' untuk membuat data-bs-target
                                // Jika 'id' tidak ada di data row, Anda perlu cara lain untuk mendapatkan ID collaborate
                                let collaborateId = row
                                .id; // GANTI 'id' DENGAN NAMA PROPERTI ID YANG BENAR DARI DATA ROW ANDA
                                if (row.action && typeof row.action ===
                                    'string') { // Mencoba ekstrak ID dari tombol jika ada
                                    const match = row.action.match(
                                        /modal-read-collaborate-(\d+)/);
                                    if (match && match[1]) {
                                        collaborateId = match[1];
                                    }
                                }
                                if (collaborateId) {
                                    fullContentLink = ` <a href="#" class="text-primary" data-bs-toggle="modal"
                                                              data-bs-target="#modal-read-collaborate-${collaborateId}">
                                                              Lihat Selengkapnya
                                                          </a>`;
                                }
                            }
                            return limitedText + fullContentLink;
                        }
                        return data; // Untuk sorting, filter, dll.
                    }
                }],
                initComplete: function() {
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

            // Fungsi helper untuk inisialisasi Summernote
            function initializeSummernote(editorDivId, hiddenInputId, collaborateIdForLog = '') {
                var $editor = $('#' + editorDivId);
                var $hiddenInput = $('#' + hiddenInputId);

                if ($editor.length && !$editor.data('summernote')) {
                    var initialContent = $hiddenInput.val() || '';
                    // console.log(`Initializing Summernote for ${editorDivId} (Collaborate ID: ${collaborateIdForLog}) with content:`, initialContent);

                    $editor.summernote({
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
                            onInit: function() {
                                // Ambil ulang nilai karena kadang DOM update butuh waktu
                                var contentToSet = $hiddenInput.val() || '';
                                $editor.summernote('code', contentToSet);
                                // console.log(`Summernote onInit for ${editorDivId}: Set code to:`, contentToSet);
                            },
                            onChange: function(contents) {
                                $hiddenInput.val(contents);
                            },
                            onImageUpload: function(files) {
                                let file = files[0];
                                let data = new FormData();
                                data.append("file", file);
                                $.ajax({
                                    url: '/upload-image', // SESUAIKAN URL INI
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: data,
                                    type: "POST",
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    success: function(url) {
                                        $editor.summernote('insertImage', url);
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.error('Image upload failed:', textStatus,
                                            errorThrown, jqXHR.responseText);
                                        alert('Gagal mengunggah gambar: ' + (jqXHR
                                            .responseJSON ? jqXHR.responseJSON
                                            .message : errorThrown));
                                    }
                                });
                            }
                        }
                    });
                    // Panggil 'code' lagi setelah inisialisasi untuk memastikan, kadang onInit terlalu cepat
                    var finalContent = $hiddenInput.val() || '';
                    $editor.summernote('code', finalContent);

                } else if ($editor.length && $editor.data('summernote')) {
                    // Jika sudah diinisialisasi, cukup update kontennya
                    var currentContent = $hiddenInput.val() || '';
                    $editor.summernote('code', currentContent);
                    // console.log(`Summernote for ${editorDivId} already initialized. Updating code to:`, currentContent);
                }
            }

            // Fungsi helper untuk destroy Summernote
            function destroySummernote(editorDivId) {
                var $editor = $('#' + editorDivId);
                if ($editor.length && $editor.data('summernote')) {
                    $editor.summernote('destroy');
                    // console.log(`Summernote destroyed for ${editorDivId}`);
                }
            }

            // Initialize Summernote for Create Form
            initializeSummernote('editor-company-profile-create', 'company-profile-create');
            initializeSummernote('editor-institution-description-create', 'institution-description-create');


            // Initialize Summernote for Edit Forms when modals are shown
            $('div[id^="modal-edit-collaborate-"]').on('shown.bs.modal', function() {
                var modal = $(this);
                var collaborateId = modal.attr('id').replace('modal-edit-collaborate-', '');

                // console.log(`Modal shown for editing collaborate ID: ${collaborateId}`);

                initializeSummernote('editor-company-profile-edit-' + collaborateId,
                    'company-profile-edit-' + collaborateId, collaborateId);
                initializeSummernote('editor-institution-description-edit-' + collaborateId,
                    'institution-description-edit-' + collaborateId, collaborateId);
            });

            // Destroy Summernote instances when edit modals are hidden
            $('div[id^="modal-edit-collaborate-"]').on('hidden.bs.modal', function() {
                var modalId = $(this).attr('id');
                var collaborateId = modalId.replace('modal-edit-collaborate-', '');

                // console.log(`Modal hidden for editing collaborate ID: ${collaborateId}`);

                destroySummernote('editor-company-profile-edit-' + collaborateId);
                destroySummernote('editor-institution-description-edit-' + collaborateId);
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
            $('#collaborateTable').on('click', '.delete-btn', function(e) { // Event delegation
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Kerjasama?',
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
        });
    </script>
@endpush
