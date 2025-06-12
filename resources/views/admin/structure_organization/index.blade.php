@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

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
                    <h2 class="mb-0 fw-bold text-dark">Struktur Organisasi</h2>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#modal-structure">
                        <i class="fas fa-plus me-2"></i>Tambah Struktur
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" id="structureTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 15%;">Jabatan 1</th>
                                        <th scope="col" style="width: 15%;">Jabatan 2</th>
                                        <th scope="col" style="width: 15%;">nama</th>
                                        <th scope="col" style="width: 10%;">Level</th>
                                        <th scope="col" style="width: 10%;">Status</th>
                                        <th scope="col" style="width: 15%;">Foto</th>
                                        <th scope="col" style="width: 25%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($structures as $structure)
                                        <tr data-structure-id="{{ $structure->id }}">
                                            <td>{{ $structure->name ?? '-' }}</td>
                                            <td>{{ $structure->title }}</td>
                                            <td>{{ $structure->degree ?? '-' }}</td>
                                            <td>{{ $structure->level }}</td>
                                            <td>
                                                <span
                                                    class="badge status-badge {{ $structure->is_active ? 'bg-success' : 'bg-danger' }}"
                                                    data-status="{{ $structure->is_active ? '1' : '0' }}">
                                                    {{ $structure->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($structure->image)
                                                    <img src="{{ asset('storage/' . $structure->image) }}"
                                                        class="img-thumbnail" alt="Structure Image">
                                                @else
                                                    <span class="text-muted">Tidak ada foto</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modal-read-structure-{{ $structure->id }}">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-structure-{{ $structure->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form
                                                    action="{{ route('admin.structure_organization.destroy', $structure->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD STRUCTURE -->
    <div class="modal fade" id="modal-structure" tabindex="-1" aria-labelledby="modal-structureLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Struktur Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('admin.structure_organization.create', [
                        'allStructures' => $allStructures,
                        'hasLevelZero' => $hasLevelZero,
                    ])
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL READ AND EDIT STRUCTURES -->
    @foreach ($structures as $structure)
        <!-- MODAL READ STRUCTURE -->
        <div class="modal fade" id="modal-read-structure-{{ $structure->id }}" tabindex="-1"
            aria-labelledby="modal-read-structureLabel-{{ $structure->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Struktur Organisasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.structure_organization.read', ['structure' => $structure])
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT STRUCTURE -->
        <div class="modal fade" id="modal-edit-structure-{{ $structure->id }}" tabindex="-1"
            aria-labelledby="modal-edit-structureLabel-{{ $structure->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Struktur Organisasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.structure_organization.edit', [
                            'structure' => $structure,
                            'allStructures' => $allStructures,
                            'hasLevelZero' => $hasLevelZero,
                        ])
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // DataTables Initialization for structureTable
            $('#structureTable').DataTable({
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
                columnDefs: [{
                        targets: 2, // Gelar
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        targets: 4, // Status - HAPUS RENDER CUSTOM INI
                        orderable: true,
                        searchable: true
                    },
                    {
                        targets: 5, // Foto
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: 6, // Aksi
                        orderable: false,
                        searchable: false
                    }
                ],
                initComplete: function() {
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

            // SweetAlert2 for Delete Confirmation
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Struktur Organisasi?',
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

            // Handle form submissions for edit modal
            $('form[action*="structure_organization.update"]').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const formData = new FormData(this);
                const actionUrl = form.attr('action');
                const structureId = actionUrl.split('/').pop();

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Close modal
                        $('#modal-edit-structure-' + structureId).modal('hide');

                        // Update status in table without refresh
                        const isActive = form.find('input[name="is_active"]').is(':checked');
                        const statusBadge = $('tr[data-structure-id="' + structureId +
                            '"] .status-badge');

                        statusBadge.removeClass('bg-success bg-danger')
                            .addClass(isActive ? 'bg-success' : 'bg-danger')
                            .text(isActive ? 'Aktif' : 'Tidak Aktif')
                            .attr('data-status', isActive ? '1' : '0');

                        // Update other fields if needed
                        const row = $('tr[data-structure-id="' + structureId + '"]');
                        row.find('td:eq(0)').text(form.find('input[name="name"]').val());
                        row.find('td:eq(1)').text(form.find('input[name="title"]').val());
                        row.find('td:eq(2)').text(form.find('input[name="degree"]').val() ||
                            '-');
                        row.find('td:eq(3)').text(form.find('select[name="level"]').val());

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data struktur organisasi berhasil diperbarui',
                            timer: 2500,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat memperbarui data',
                            timer: 2500,
                            showConfirmButton: false
                        });
                    }
                });
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
        });
    </script>
@endpush
