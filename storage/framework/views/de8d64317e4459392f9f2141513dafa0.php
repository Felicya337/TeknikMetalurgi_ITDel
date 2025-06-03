<div class="mb-3">
    <label class="form-label fw-bold">Nama</label>
    <p><?php echo e($testimonial->name ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p><?php echo e($testimonial->student ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        <?php echo $testimonial->content ?? '-'; ?>

    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        <?php if($testimonial->image): ?>
            <img src="<?php echo e(asset('storage/' . $testimonial->image)); ?>" class="img-fluid rounded" alt="Testimonial Image"
                style="max-height: 300px;">
        <?php else: ?>
            <span class="text-muted">Tidak ada gambar</span>
        <?php endif; ?>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge <?php echo e($testimonial->is_active ? 'bg-success' : 'bg-danger'); ?>">
            <?php echo e($testimonial->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/testimonial/read.blade.php ENDPATH**/ ?>