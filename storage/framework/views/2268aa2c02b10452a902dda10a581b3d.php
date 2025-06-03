<?php $__env->startSection('content'); ?>
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
                    <h2 class="mb-3 fw-bold text-dark">Kegiatan Mahasiswa</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-studentactivity">
                        <i class="fas fa-plus me-2"></i>Tambah Kegiatan
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center" id="studentActivityTable">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">Nomor</th>
                            <th scope="col" style="width: 15%;">Jenis Kegiatan</th>
                            <th scope="col" style="width: 20%;">Judul</th>
                            <th scope="col" style="width: 25%;">Deskripsi</th>
                            <th scope="col" style="width: 15%;">Gambar</th>
                            <th scope="col" style="width: 10%;">Status</th>
                            <th scope="col" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td> <!-- Placeholder for row number -->
                                <td>
                                    <span class="badge badge-<?php echo e($activity->type); ?>">
                                        <?php echo e($activity->getTypeLabel()); ?>

                                    </span>
                                </td>
                                <td><?php echo e($activity->title); ?></td>
                                <td><?php echo Str::limit($activity->description, 100); ?></td>
                                <td>
                                    <?php if($activity->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $activity->image)); ?>" class="img-thumbnail"
                                            alt="Activity Image">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada gambar</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge <?php echo e($activity->is_active ? 'bg-success' : 'bg-danger'); ?>">
                                        <?php echo e($activity->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-info btn-sm mx-1" data-bs-toggle="modal"
                                            data-bs-target="#modal-read-studentactivity-<?php echo e($activity->id); ?>">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm mx-1" data-bs-toggle="modal"
                                            data-bs-target="#modal-edit-studentactivity-<?php echo e($activity->id); ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="<?php echo e(route('admin.studentactivity.destroy', $activity->id)); ?>"
                                            method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm mx-1 delete-btn">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL READ STUDENT ACTIVITY -->
                            <div class="modal fade" id="modal-read-studentactivity-<?php echo e($activity->id); ?>" tabindex="-1"
                                aria-labelledby="modal-read-studentactivityLabel-<?php echo e($activity->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Kegiatan Mahasiswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo $__env->make('admin.studentactivity.read', [
                                                'activity' => $activity,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL EDIT STUDENT ACTIVITY -->
                            <div class="modal fade" id="modal-edit-studentactivity-<?php echo e($activity->id); ?>" tabindex="-1"
                                aria-labelledby="modal-edit-studentactivityLabel-<?php echo e($activity->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kegiatan Mahasiswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo $__env->make('admin.studentactivity.edit', [
                                                'activity' => $activity,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($activities->links()); ?>

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
                    <?php echo $__env->make('admin.studentactivity.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        data: 'type'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'description'
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
                    targets: 3, // Description column
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
                height: 300,
                fontNames: ['Poppins', 'Arial', 'Helvetica', 'Times New Roman', 'Courier New'],
                fontNamesIgnoreCheck: ['Poppins'],
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
                        $('#editor-create').summernote('code', $('#description-create').val());
                    }
                }
            });

            // Initialize Summernote for Edit Forms when modals are shown
            $('div[id^="modal-edit-studentactivity-"]').on('shown.bs.modal', function() {
                var modalId = $(this).attr('id');
                var activityId = modalId.replace('modal-edit-studentactivity-', '');
                var editorId = 'editor-edit-' + activityId;

                if (!$('#' + editorId).hasClass('note-editor')) {
                    $('#' + editorId).summernote({
                        height: 300,
                        fontNames: ['Poppins', 'Arial', 'Helvetica', 'Times New Roman',
                            'Courier New'
                        ],
                        fontNamesIgnoreCheck: ['Poppins'],
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
                                $('#description-edit-' + activityId).val(contents);
                            }
                        }
                    });

                    var description = $('#description-edit-' + activityId).val();
                    $('#' + editorId).summernote('code', description);
                }
            });

            // Destroy Summernote instances when edit modals are hidden
            $('div[id^="modal-edit-studentactivity-"]').on('hidden.bs.modal', function() {
                var modalId = $(this).attr('id');
                var activityId = modalId.replace('modal-edit-studentactivity-', '');
                var editorId = 'editor-edit-' + activityId;

                if ($('#' + editorId).hasClass('note-editor')) {
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
                    title: 'Hapus Kegiatan Mahasiswa?',
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/studentactivity/index.blade.php ENDPATH**/ ?>