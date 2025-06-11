@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

        .title-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .note-editor.note-frame {
            border-radius: 8px;
        }

        .description-preview {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .see-more {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }

        .see-more:hover {
            color: #0056b3;
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
                    <h2 class="mb-0 fw-bold text-dark">Berita</h2>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#modal-news">
                        <i class="fas fa-plus me-2"></i>Tambah Berita
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" id="newsTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;">Nomor</th>
                                        <th scope="col" style="width: 20%;">Judul</th>
                                        <th scope="col" style="width: 20%;">Deskripsi</th>
                                        <th scope="col" style="width: 15%;">Tanggal</th>
                                        <th scope="col" style="width: 15%;">Penulis</th>
                                        <th scope="col" style="width: 10%;">Gambar</th>
                                        <th scope="col" style="width: 10%;">Aktif</th>
                                        <th scope="col" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                <div class="description-preview">
                                                    {!! Str::words(strip_tags($item->description), 100, '...') !!}
                                                </div>
                                                <span class="see-more" data-bs-toggle="modal"
                                                    data-bs-target="#modal-read-news-{{ $item->id }}">Selengkapnya</span>
                                            </td>
                                            <td>{{ $item->date->format('d-m-Y') }}</td>
                                            <td>{{ $item->author }}</td>
                                            <td>
                                                @if ($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail"
                                                        alt="News Image">
                                                @else
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-info btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-read-news-{{ $item->id }}">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-news-{{ $item->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('admin.news.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm mx-1 delete-btn">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Read Modal -->
                                        <div class="modal fade" id="modal-read-news-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="modal-read-newsLabel-{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Berita</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>{{ $item->title }}</h4>
                                                        <p><strong>Tanggal:</strong> {{ $item->date->format('d-m-Y') }}</p>
                                                        <p><strong>Penulis:</strong> {{ $item->author }}</p>
                                                        <div>{!! $item->description !!}</div>
                                                        @if ($item->image)
                                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                                class="img-thumbnail mt-3" alt="News Image"
                                                                style="max-width: 300px;">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="modal-edit-news-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="modal-edit-newsLabel-{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Berita</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.news.update', $item->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Judul</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="title"
                                                                    value="{{ old('title', $item->title) }}" required>
                                                                @error('title')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description-edit-{{ $item->id }}"
                                                                    class="form-label">Deskripsi</label>
                                                                <div id="editor-edit-{{ $item->id }}"></div>
                                                                <input type="hidden"
                                                                    id="description-edit-{{ $item->id }}"
                                                                    name="description"
                                                                    value="{{ old('description', $item->description) }}">
                                                                @error('description')
                                                                    <div class="text-danger">{{ $message }}</div>
                                        @endif
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ old('date', $item->date->format('Y-m-d')) }}" required>
                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Penulis</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        value="{{ old('author', $item->author) }}" required>
                                    @error('author')
                                        <div class="text-danger">{{ $message }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail mt-2"
                                                alt="Current News Image">
                                        @endif
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @endif
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                                value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
                                            @error('is_active')
                                                <div class="text-danger">{{ $message }}</div>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
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

                        <!-- Create Modal -->
                        <div class="modal fade" id="modal-news" tabindex="-1" aria-labelledby="modal-newsLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Berita</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Judul</label>
                                                <input type="text" class="form-control" id="title" name="title" required
                                                    value="{{ old('title') }}">
                                                @error('title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description-create" class="form-label">Deskripsi</label>
                                                    <div id="editor-create"></div>
                                                    <input type="hidden" id="description-create" name="description"
                                                        value="{{ old('description') }}">
                                                    @error('description')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date" class="form-label">Tanggal</label>
                                                        <input type="date" class="form-control" id="date" name="date" required
                                                            value="{{ old('date') }}">
                                                        @error('date')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="author" class="form-label">Penulis</label>
                                                            <input type="text" class="form-control" id="author" name="author" required
                                                                value="{{ old('author') }}">
                                                            @error('author')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Gambar</label>
                                                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                                @error('image')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3 form-check">
                                                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                                                        value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
                                                                    @error('is_active')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                        @endif
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </form>
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
                                                <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

                                                <script>
                                                    $(document).ready(function() {
                                                        // DataTables Initialization
                                                        $('#newsTable').DataTable({
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
                                                            dom: '<"top"<"float-left"l><"float-right"f>>rt<"bottom"<"float-left"i><"float-right"p>>',
                                                            columns: [{
                                                                    data: null,
                                                                    render: function(data, type, row, meta) {
                                                                        return meta.row + 1;
                                                                    },
                                                                    orderable: false,
                                                                    searchable: false
                                                                },
                                                                {
                                                                    data: 'title'
                                                                },
                                                                {
                                                                    data: 'description'
                                                                },
                                                                {
                                                                    data: 'date'
                                                                },
                                                                {
                                                                    data: 'author'
                                                                },
                                                                {
                                                                    data: 'image'
                                                                },
                                                                {
                                                                    data: 'is_active'
                                                                },
                                                                {
                                                                    data: 'action'
                                                                }
                                                            ],
                                                            columnDefs: [{
                                                                targets: 2,
                                                                render: function(data, type, row) {
                                                                    return type === 'display' ? data : $('<div/>').html(data).text();
                                                                }
                                                            }],
                                                            initComplete: function() {
                                                                $('.dataTables_length select').addClass('form-select form-select-sm');
                                                                $('.dataTables_filter input').addClass('form-control form-control-sm');
                                                            }
                                                        });

                                                        // Initialize Summernote for Create Form
                                                        $('#editor-create').summernote({
                                                            height: 400,
                                                            minHeight: 300,
                                                            maxHeight: 600,
                                                            fontNames: ['Poppins', 'Arial', 'Helvetica', 'Times New Roman', 'Courier New'],
                                                            fontNamesIgnoreCheck: ['Poppins'],
                                                            fontSizes: ['12', '14', '16', '20', '24', '32'],
                                                            disableResizeEditor: true,
                                                            toolbar: [
                                                                ['style', ['style']],
                                                                ['font', ['bold', 'italic', 'underline', 'clear']],
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
                                                                    $('#editor-create').summernote('code', $('#description-create').val() || '');
                                                                }
                                                            }
                                                        });

                                                        // Initialize Summernote for Edit Forms
                                                        $('div[id^="modal-edit-news-"]').on('shown.bs.modal', function() {
                                                            var modalId = $(this).attr('id');
                                                            var newsId = modalId.replace('modal-edit-news-', '');
                                                            var editorId = 'editor-edit-' + newsId;
                                                            var descriptionId = 'description-edit-' + newsId;

                                                            if (!$('#' + editorId).hasClass('note-editor')) {
                                                                $('#' + editorId).summernote({
                                                                    height: 400,
                                                                    minHeight: 300,
                                                                    maxHeight: 600,
                                                                    fontNames: ['Poppins', 'Arial', 'Helvetica', 'Times New Roman',
                                                                        'Courier New'
                                                                    ],
                                                                    fontNamesIgnoreCheck: ['Poppins'],
                                                                    fontSizes: ['12', '14', '16', '20', '24', '32'],
                                                                    disableResizeEditor: true,
                                                                    toolbar: [
                                                                        ['style', ['style']],
                                                                        ['font', ['bold', 'italic', 'underline', 'clear']],
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
                                                                            $('#' + descriptionId).val(contents);
                                                                        },
                                                                        onInit: function() {
                                                                            var description = $('#' + descriptionId).val() || '';
                                                                            $('#' + editorId).summernote('code', description);
                                                                        }
                                                                    }
                                                                });
                                                            } else {
                                                                var description = $('#' + descriptionId).val() || '';
                                                                $('#' + editorId).summernote('code', description);
                                                            }
                                                        });

                                                        // Destroy Summernote instances when modals are hidden
                                                        $('div[id^="modal-edit-news-"]').on('hidden.bs.modal', function() {
                                                            var modalId = $(this).attr('id');
                                                            var newsId = modalId.replace('modal-edit-news-', '');
                                                            var editorId = 'editor-edit-' + newsId;

                                                            if ($('#' + editorId).hasClass('note-editor')) {
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
                                                                title: 'Hapus Berita?',
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
