<div class="mb-3">
    <label class="form-label fw-bold">Nama Laboratorium</label>
    <p><?php echo e($laboratory->name); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        <?php echo $laboratory->description ?? '-'; ?>

    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Hari Akademik</label>
    <p><?php echo e($laboratory->academic_days ? implode(', ', $laboratory->academic_days) : '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Jam Akademik</label>
    <p><?php echo e($laboratory->academic_hours ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Jam Kolaborasi</label>
    <p><?php echo e($laboratory->collaborative_hours ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        <?php if($laboratory->images && count($laboratory->images) > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $laboratory->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-2">
                        <img src="<?php echo e(asset('storage/' . $image)); ?>" class="img-fluid rounded" alt="Laboratory Image"
                            style="max-height: 300px; object-fit: cover;">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <span class="text-muted">Tidak ada gambar</span>
        <?php endif; ?>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge <?php echo e($laboratory->is_active ? 'bg-success' : 'bg-danger'); ?>">
            <?php echo e($laboratory->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/laboratory/read.blade.php ENDPATH**/ ?>