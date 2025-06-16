 <!-- Sesuaikan dengan nama layout utama Anda -->

<?php $__env->startSection('title', 'Manajemen Admin'); ?>
<?php $__env->startSection('header', 'Manajemen Akun Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-users-cog me-2"></i>Daftar Akun Admin</h5>
                <a href="<?php echo e(route('admin.management.create')); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Admin Baru
                </a>
            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <?php if(session('new_password')): ?>
                            <strong class="d-block mt-2 user-select-all"
                                style="font-size: 1.2em; background-color: #d1e7dd; padding: 5px 10px; border-radius: 4px; color: #0f5132;"><?php echo e(session('new_password')); ?></strong>
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Peran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($admin->name); ?></td>
                                    <td><?php echo e($admin->email); ?></td>
                                    <td>
                                        <?php if($admin->is_active): ?>
                                            <span class="badge bg-light text-success border border-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-danger border border-danger">Non-Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($admin->is_superadmin): ?>
                                            <span class="badge bg-primary">Super Admin</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Admin</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('admin.management.edit', $admin->id)); ?>"
                                                class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form action="<?php echo e(route('admin.management.resetPassword', $admin->id)); ?>"
                                                        method="POST"
                                                        onsubmit="return confirm('Reset password untuk <?php echo e($admin->name); ?>?');">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="dropdown-item text-warning">
                                                            <i class="fas fa-key fa-fw me-2"></i>Reset Password
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="<?php echo e(route('admin.management.destroy', $admin->id)); ?>"
                                                        method="POST"
                                                        onsubmit="return confirm('Hapus permanen akun <?php echo e($admin->name); ?>?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt fa-fw me-2"></i>Hapus Akun
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada data admin lain.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <?php echo e($admins->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/management/index.blade.php ENDPATH**/ ?>