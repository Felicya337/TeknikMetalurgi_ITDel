<div class="mb-3">
    <label class="form-label fw-bold">Judul</label>
    <p><?php echo e($news->title ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <div class="border p-3 rounded bg-light" style="max-height: 500px; overflow-y: auto;">
        <?php echo $news->description ?? '-'; ?>

    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tanggal</label>
    <p><?php echo e($news->date ? $news->date->format('d-m-Y') : '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Penulis</label>
    <p><?php echo e($news->author ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <div>
        <?php if($news->image): ?>
            <img src="<?php echo e(asset('storage/' . $news->image)); ?>" class="img-fluid rounded" alt="News Image"
                style="max-height: 300px;">
        <?php else: ?>
            <span class="text-muted">Tidak ada gambar</span>
        <?php endif; ?>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Status</label>
    <p>
        <span class="badge <?php echo e($news->is_active ? 'bg-success' : 'bg-danger'); ?>">
            <?php echo e($news->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

        </span>
    </p>
</div>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/news/read.blade.php ENDPATH**/ ?>