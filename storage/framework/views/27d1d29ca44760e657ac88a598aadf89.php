<?php $__env->startSection('title', 'Detail Inquiry'); ?>

<?php $__env->startSection('header', 'Detail Pertanyaan/Review'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-comment-alt"></i> Detail
                    </div>
                    <div class="card-body">
                        <p><strong>Email:</strong> <?php echo e($inquiry->email); ?></p>
                        <p><strong>Tipe:</strong> <?php echo e(ucfirst($inquiry->type)); ?></p>
                        <?php if($inquiry->type === 'question'): ?>
                            <p><strong>User:</strong> <?php echo e($inquiry->user_type ? ucfirst($inquiry->user_type) : '-'); ?></p>
                        <?php endif; ?>
                        <p><strong>Isi:</strong> <?php echo nl2br(e($inquiry->content)); ?></p>
                        <?php if($inquiry->rating): ?>
                            <p><strong>Rating:</strong> <?php echo e(str_repeat('⭐', $inquiry->rating)); ?></p>
                        <?php endif; ?>
                        <?php if($inquiry->is_responded): ?>
                            <p><strong>Tanggapan:</strong> <?php echo nl2br(e($inquiry->admin_response)); ?></p>
                            <p><strong>Ditanggapi pada:</strong> <?php echo e($inquiry->responded_at->format('d M Y H:i')); ?></p>
                            <p><strong>Ditanggapi oleh:</strong> <?php echo e($inquiry->admin ? $inquiry->admin->name : 'Unknown'); ?>

                            </p>
                        <?php else: ?>
                            <form action="<?php echo e(route('admin.inquiries.respond', $inquiry)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="response" class="form-label">Tanggapan</label>
                                    <textarea name="response" id="response" class="form-control" rows="5" required></textarea>
                                    <?php $__errorArgs = ['response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/inquiries/show.blade.php ENDPATH**/ ?>