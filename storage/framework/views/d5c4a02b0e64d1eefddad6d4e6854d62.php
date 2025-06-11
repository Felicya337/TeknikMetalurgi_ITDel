<div class="mb-3">
    <label class="form-label fw-bold">Jenis</label>
    <p>
        <span
            class="badge <?php echo e($achievement->type == 'publikasi' ? 'bg-primary' : ($achievement->type == 'penelitian' ? 'bg-info' : 'bg-success')); ?>">
            <?php echo e($achievement->type); ?>

        </span>
    </p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tipe</label>
    <p>
        <?php if($achievement->subtype): ?>
            <span class="badge bg-secondary"><?php echo e($achievement->subtype); ?></span>
        <?php else: ?>
            <span class="text-muted">-</span>
        <?php endif; ?>
    </p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Judul</label>
    <p><?php echo e($achievement->title ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light">
        <?php echo $achievement->description ?? '-'; ?>

    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tanggal</label>
    <p><?php echo e($achievement->date ? $achievement->date->format('d-m-Y') : '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Penulis</label>
    <p><?php echo e($achievement->author ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        <?php if($achievement->image): ?>
            <img src="<?php echo e(asset('storage/' . $achievement->image)); ?>" class="img-fluid rounded" alt="Achievement Image"
                style="max-height: 300px;">
        <?php else: ?>
            <span class="text-muted">Tidak ada gambar</span>
        <?php endif; ?>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">File</label>
    <div>
        <?php if($achievement->file): ?>
            <a href="<?php echo e(asset('storage/' . $achievement->file)); ?>" target="_blank">Lihat file</a>
        <?php else: ?>
            <span class="text-muted">Tidak ada file</span>
        <?php endif; ?>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge <?php echo e($achievement->is_active ? 'bg-success' : 'bg-danger'); ?>">
            <?php echo e($achievement->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/achievement/read.blade.php ENDPATH**/ ?>