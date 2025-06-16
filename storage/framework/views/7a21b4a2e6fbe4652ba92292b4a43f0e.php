<?php
    $isEdit = isset($admin);
?>

<?php $__env->startSection('title', $isEdit ? 'Edit Admin' : 'Tambah Admin Baru'); ?>
<?php $__env->startSection('header', $isEdit ? 'Edit Admin' : 'Tambah Admin Baru'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Formulir Data Admin</h5>
                    </div>
                    <div class="card-body">

                        <?php if($isEdit): ?>
                            
                            <form action="<?php echo e(route('admin.management.update', ['admin' => $admin->id])); ?>" method="POST">
                                <?php echo method_field('PUT'); ?>
                            <?php else: ?>
                                
                                <form action="<?php echo e(route('admin.management.store')); ?>" method="POST">
                        <?php endif; ?>

                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name"
                                name="name" value="<?php echo e(old('name', $admin->name ?? '')); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email"
                                name="email" value="<?php echo e(old('email', $admin->email ?? '')); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="password" name="password" <?php echo e($isEdit ? '' : 'required'); ?>>
                                <?php if($isEdit): ?>
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                        password.</small>
                                <?php endif; ?>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Peran (Role)</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_superadmin"
                                        name="is_superadmin" value="1"
                                        <?php echo e(old('is_superadmin', $admin->is_superadmin ?? false) ? 'checked' : ''); ?>

                                         <?php if(isset($admin) && $admin->email === 'aitdel844@gmail.com'): ?> disabled <?php endif; ?>>
                                    <label class="form-check-label" for="is_superadmin">Jadikan Super Admin</label>
                                    <?php if(isset($admin) && $admin->email === 'aitdel844@gmail.com'): ?>
                                        <small class="d-block text-muted">Peran Super Admin utama tidak dapat
                                            diubah.</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Akun</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                        name="is_active" value="1"
                                        <?php echo e(old('is_active', $admin->is_active ?? true) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="is_active">Akun Aktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <a href="<?php echo e(route('admin.management.index')); ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit"
                                class="btn btn-primary"><?php echo e($isEdit ? 'Simpan Perubahan' : 'Buat Akun'); ?></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/management/form.blade.php ENDPATH**/ ?>