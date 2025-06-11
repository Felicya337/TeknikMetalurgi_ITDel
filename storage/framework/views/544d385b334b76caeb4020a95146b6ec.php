<?php $__env->startSection('content'); ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

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
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mb-3">
                    <h2 class="mb-0 fw-bold text-dark">Prestasi Mahasiswa</h2>
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#modal-student-achievement">
                        <i class="fas fa-plus me-2"></i>Tambah Prestasi
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" id="studentAchievementTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 25%;">Nama Kegiatan</th>
                                        <th scope="col" style="width: 20%;">Waktu Pelaksanaan</th>
                                        <th scope="col" style="width: 20%;">Tingkat</th>
                                        <th scope="col" style="width: 25%;">Prestasi</th>
                                        <th scope="col" style="width: 10%;">Aktif</th>
                                        <th scope="col" style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-start"><?php echo e($achievement->nama_kegiatan); ?></td>
                                            <td><?php echo e($achievement->waktu_pelaksanaan ? \Carbon\Carbon::parse($achievement->waktu_pelaksanaan)->format('d-m-Y') : '-'); ?>

                                            </td>
                                            <td><?php echo e(ucfirst($achievement->tingkat ?? '-')); ?></td>
                                            <td class="text-start"><?php echo e($achievement->prestasi_yang_dicapai ?? '-'); ?></td>
                                            <td>
                                                <span
                                                    class="badge <?php echo e($achievement->is_active ? 'bg-success' : 'bg-danger'); ?>">
                                                    <?php echo e($achievement->is_active ? 'Aktif' : 'Nonaktif'); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-info btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-read-student-achievement-<?php echo e($achievement->id); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm mx-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-student-achievement-<?php echo e($achievement->id); ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form
                                                        action="<?php echo e(route('admin.student_achievement.destroy', $achievement->id)); ?>"
                                                        method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm mx-1 delete-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- MODAL READ STUDENT ACHIEVEMENT -->
                                        <div class="modal fade" id="modal-read-student-achievement-<?php echo e($achievement->id); ?>"
                                            tabindex="-1"
                                            aria-labelledby="modal-read-student-achievementLabel-<?php echo e($achievement->id); ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Prestasi:
                                                            <?php echo e($achievement->nama_kegiatan); ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $__env->make('admin.student_achievement.read', [
                                                            'achievement' => $achievement,
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL EDIT STUDENT ACHIEVEMENT -->
                                        <div class="modal fade" id="modal-edit-student-achievement-<?php echo e($achievement->id); ?>"
                                            tabindex="-1"
                                            aria-labelledby="modal-edit-student-achievementLabel-<?php echo e($achievement->id); ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Prestasi:
                                                            <?php echo e($achievement->nama_kegiatan); ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $__env->make('admin.student_achievement.edit', [
                                                            'achievement' => $achievement,
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <?php echo e($achievements->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD STUDENT ACHIEVEMENT -->
    <div class="modal fade" id="modal-student-achievement" tabindex="-1" aria-labelledby="modal-student-achievementLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $__env->make('admin.student_achievement.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#studentAchievementTable').DataTable({
                responsive: true,
                pageLength: 10,
                searching: true,
                lengthChange: true,
                processing: true,
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
                    processing: "Memuat..."
                },
                dom: '<"top"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>>rt<"bottom"<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                columns: [
                    null, // Nama Kegiatan
                    null, // Waktu Pelaksanaan
                    null, // Tingkat
                    null, // Prestasi
                    {
                        orderable: false
                    }, // Aktif
                    {
                        orderable: false,
                        searchable: false
                    } // Aksi
                ],
                order: [],
                initComplete: function() {
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

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

            <?php if($errors->any()): ?>
                let errorMessages = '';
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    errorMessages += `<li><?php echo e($error); ?></li>`;
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops, terjadi kesalahan!',
                    html: `<ul class="text-start">${errorMessages}</ul>`,
                });

                <?php if(old('form_type') == 'create_student_achievement'): ?>
                    $('#modal-student-achievement').modal('show');
                <?php endif; ?>

                <?php if(old('form_type') == 'edit_student_achievement'): ?>
                    var achievementIdError = "<?php echo e(old('achievement_id_error')); ?>";
                    if (achievementIdError) {
                        $('#modal-edit-student-achievement-' + achievementIdError).modal('show');
                    }
                <?php endif; ?>
            <?php endif; ?>

            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Prestasi?',
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/student_achievement/index.blade.php ENDPATH**/ ?>