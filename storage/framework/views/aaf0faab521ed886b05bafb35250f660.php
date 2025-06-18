<div>
    <div class="mb-3">
        <label class="form-label fw-bold">Nama</label>
        <p><?php echo e($structure->name); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Jabatan</label>
        <p><?php echo e($structure->title); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Gelar</label>
        <p><?php echo e($structure->degree ?? '-'); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Level</label>
        <p><?php echo e($structure->level); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Induk</label>
        <p><?php echo e($structure->parent ? $structure->parent->name . ' (' . $structure->parent->title . ')' : 'Tidak ada induk'); ?>

        </p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Status</label>
        <p><?php echo e($structure->is_active ? 'Aktif' : 'Nonaktif'); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Foto</label>
        <div>
            <?php if($structure->image): ?>
                <img src="<?php echo e(asset('storage/' . $structure->image)); ?>" class="img-thumbnail" alt="Structure Image"
                    style="max-width: 150px;">
            <?php else: ?>
                <span class="text-muted">Tidak ada foto</span>
            <?php endif; ?>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/structure_organization/read.blade.php ENDPATH**/ ?>