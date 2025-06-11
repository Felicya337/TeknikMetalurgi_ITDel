<?php $__env->startSection('title', __('Kelola Inquiries')); ?>

<?php $__env->startSection('header', __('Kelola Pertanyaan & Review')); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-comments"></i> <?php echo e(__('Daftar Pertanyaan')); ?>

                    </div>
                    <div class="card-body table-responsive">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('User')); ?></th>
                                    <th><?php echo e(__('Isi')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Aksi')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($inquiry->email); ?></td>
                                        <td><?php echo e($inquiry->user_type ? ucfirst($inquiry->user_type) : '-'); ?></td>
                                        <td><?php echo e(Str::limit($inquiry->content, 50)); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($inquiry->is_responded ? 'success' : 'warning'); ?>">
                                                <?php echo e($inquiry->is_responded ? __('Sudah Ditanggapi') : __('Belum Ditanggapi')); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.inquiries.show', $inquiry)); ?>"
                                                class="btn btn-sm btn-primary"><?php echo e(__('Lihat')); ?></a>
                                            <form action="<?php echo e(route('admin.inquiries.destroy', $inquiry)); ?>" method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('<?php echo e(__('Are you sure you want to delete?')); ?>')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger"><?php echo e(__('Hapus')); ?></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center"><?php echo e(__('No questions found.')); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php echo e($questions->links()); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-star"></i> <?php echo e(__('Daftar Review')); ?>

                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Isi')); ?></th>
                                    <th><?php echo e(__('Rating')); ?></th>
                                    <th><?php echo e(__('Aksi')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($inquiry->email); ?></td>
                                        <td><?php echo e(Str::limit($inquiry->content, 50)); ?></td>
                                        <td><?php echo e(str_repeat('⭐', $inquiry->rating)); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.inquiries.show', $inquiry)); ?>"
                                                class="btn btn-sm btn-primary"><?php echo e(__('Lihat')); ?></a>
                                            <form action="<?php echo e(route('admin.inquiries.destroy', $inquiry)); ?>" method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('<?php echo e(__('Are you sure you want to delete?')); ?>')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger"><?php echo e(__('Hapus')); ?></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center"><?php echo e(__('No reviews found.')); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php echo e($reviews->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/inquiries/index.blade.php ENDPATH**/ ?>