<?php $__env->startSection('content'); ?>
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
                    <h2 class="mb-0 fw-bold text-dark">Laboratorium</h2>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#modal-laboratory">
                        <i class="fas fa-plus me-2"></i>Tambah Laboratorium
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" id="laboratoryTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;">Nomor</th>
                                        <th scope="col" style="width: 15%;">Nama</th>
                                        <th scope="col" style="width: 20%;">Deskripsi</th>
                                        <th scope="col" style="width: 15%;">Hari Akademik</th>
                                        <th scope="col" style="width: 10%;">Jam Akademik</th>
                                        <th scope="col" style="width: 10%;">Jam Kolaborasi</th>
                                        <th scope="col" style="width: 10%;">Gambar</th>
                                        <th scope="col" style="width: 10%;">Status</th>
                                        <th scope="col" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $laboratories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $laboratory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($laboratory->name); ?></td>
                                            <td>
                                                <?php if($laboratory->description): ?>
                                                    <?php echo Str::limit(strip_tags($laboratory->description), 100); ?>

                                                <?php else: ?>
                                                    <span class="text-muted">Tidak ada deskripsi</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e($laboratory->academic_days ? implode(', ', $laboratory->academic_days) : '-'); ?>

                                            </td>
                                            <td><?php echo e($laboratory->academic_hours ?? '-'); ?></td>
                                            <td><?php echo e($laboratory->collaborative_hours ?? '-'); ?></td>
                                            <td>
                                                <?php if($laboratory->images && count($laboratory->images) > 0): ?>
                                                    <img src="<?php echo e(asset('storage/' . $laboratory->images[0])); ?>"
                                                        class="img-thumbnail" alt="Laboratory Image">
                                                <?php else: ?>
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge <?php echo e($laboratory->is_active ? 'bg-success' : 'bg-danger'); ?>">
                                                    <?php echo e($laboratory->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-info btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-read-laboratory-<?php echo e($laboratory->id); ?>">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-laboratory-<?php echo e($laboratory->id); ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="<?php echo e(route('admin.laboratory.destroy', $laboratory->id)); ?>"
                                                        method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm mx-1 delete-btn">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- MODAL READ LABORATORY -->
                                        <div class="modal fade" id="modal-read-laboratory-<?php echo e($laboratory->id); ?>"
                                            tabindex="-1"
                                            aria-labelledby="modal-read-laboratoryLabel-<?php echo e($laboratory->id); ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Laboratorium</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $__env->make('admin.laboratory.read', [
                                                            'laboratory' => $laboratory,
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL EDIT LABORATORY -->
                                        <div class="modal fade" id="modal-edit-laboratory-<?php echo e($laboratory->id); ?>"
                                            tabindex="-1"
                                            aria-labelledby="modal-edit-laboratoryLabel-<?php echo e($laboratory->id); ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Laboratorium</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $__env->make('admin.laboratory.edit', [
                                                            'laboratory' => $laboratory,
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD LABORATORY -->
    <div class="modal fade" id="modal-laboratory" tabindex="-1" aria-labelledby="modal-laboratoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Laboratorium</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $__env->make('admin.laboratory.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // DataTables Initialization
            $('#laboratoryTable').DataTable({
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
                    targets: 0,
                    orderable: false,
                    searchable: false
                }, {
                    targets: 2,
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return data.length > 100 ? data.substr(0, 100) + '...' : data;
                        }
                        return data;
                    }
                }, {
                    targets: 8,
                    orderable: false,
                    searchable: false
                }],
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
                            onChange: function(contents, $editable) {
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
            $('#modal-laboratory').on('shown.bs.modal', function() {
                initCreateSummernote();
            });

            // Destroy summernote when create modal is hidden
            $('#modal-laboratory').on('hidden.bs.modal', function() {
                if ($('#editor-create').next('.note-editor').length) {
                    $('#editor-create').summernote('destroy');
                }
            });

            // Initialize Summernote for Edit Forms when modals are shown
            $('div[id^="modal-edit-laboratory-"]').on('shown.bs.modal', function() {
                var modalId = $(this).attr('id');
                var laboratoryId = modalId.replace('modal-edit-laboratory-', '');
                var editorId = 'editor-edit-' + laboratoryId;
                var hiddenInputId = 'description-edit-' + laboratoryId;

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
                            onChange: function(contents, $editable) {
                                $('#' + hiddenInputId).val(contents);
                            },
                            onInit: function() {
                                var existingDescription = $('#' + hiddenInputId).val();
                                if (existingDescription) {
                                    $('#' + editorId).summernote('code', existingDescription);
                                }
                            }
                        }
                    });
                }
            });

            // Destroy Summernote instances when edit modals are hidden
            $('div[id^="modal-edit-laboratory-"]').on('hidden.bs.modal', function() {
                var modalId = $(this).attr('id');
                var laboratoryId = modalId.replace('modal-edit-laboratory-', '');
                var editorId = 'editor-edit-' + laboratoryId;

                if ($('#' + editorId).next('.note-editor').length) {
                    $('#' + editorId).summernote('destroy');
                }
            });

            // SweetAlert2 for Notifications
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?php echo e(session('success')); ?>',
                    timer: 2500,
                    showConfirmButton: false
                });
            <?php endif; ?>

            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?php echo e(session('error')); ?>',
                    timer: 2500,
                    showConfirmButton: false
                });
            <?php endif; ?>

            // SweetAlert2 for Delete Confirmation
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Laboratorium?',
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/laboratory/index.blade.php ENDPATH**/ ?>