<div class="mb-3">
    <label class="form-label fw-bold">Nama Institusi</label>
    <p><?php echo e($collaborate->institution_name ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Profil Perusahaan</label>
    <div class="border p-3 rounded bg-light">
        <?php echo $collaborate->company_profile ?? '-'; ?>

    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        <?php echo $collaborate->institution_description ?? '-'; ?>

    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tanggal</label>
    <p><?php echo e($collaborate->date ? $collaborate->date->format('d-m-Y') : '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Logo</label>
    <div>
        <?php if($collaborate->logo): ?>
            <img src="<?php echo e(asset('storage/' . $collaborate->logo)); ?>" class="img-fluid rounded" alt="Collaborate Logo"
                style="max-height: 300px;">
        <?php else: ?>
            <span class="text-muted">Tidak ada logo</span>
        <?php endif; ?>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge <?php echo e($collaborate->is_active ? 'bg-success' : 'bg-danger'); ?>">
            <?php echo e($collaborate->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/collaborate/read.blade.php ENDPATH**/ ?>