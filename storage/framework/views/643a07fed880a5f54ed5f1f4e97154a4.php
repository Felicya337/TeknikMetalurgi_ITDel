<div class="mb-3">
    <label class="form-label fw-bold">Jenis Kegiatan</label>
    <p>
        <span class="badge badge-<?php echo e($activity->type); ?>">
            <?php echo e($activity->getTypeLabel()); ?>

        </span>
    </p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Judul</label>
    <p><?php echo e($activity->title ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        <?php echo $activity->description ?? '-'; ?>

    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        <?php if($activity->image): ?>
            <img src="<?php echo e(asset('storage/' . $activity->image)); ?>" class="img-fluid rounded" alt="Activity Image"
                style="max-height: 300px;">
        <?php else: ?>
            <span class="text-muted">Tidak ada gambar</span>
        <?php endif; ?>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge <?php echo e($activity->is_active ? 'bg-success' : 'bg-danger'); ?>">
            <?php echo e($activity->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

        </span>
    </p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Dibuat Oleh</label>
    <p><?php echo e($activity->createdBy?->name ?? 'Tidak ada'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Diperbarui Oleh</label>
    <p><?php echo e($activity->updatedBy?->name ?? 'Tidak ada'); ?></p>
</div>
<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/studentactivity/read.blade.php ENDPATH**/ ?>