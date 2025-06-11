<div class="mb-3">
    <label class="form-label fw-bold">Nama Kegiatan</label>
    <p><?php echo e($achievement->nama_kegiatan ?? '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Waktu Pelaksanaan</label>
    <p><?php echo e($achievement->waktu_pelaksanaan ? $achievement->waktu_pelaksanaan->format('d-m-Y') : '-'); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tingkat</label>
    <p><?php echo e(ucfirst($achievement->tingkat ?? '-')); ?></p>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Prestasi Yang Dicapai</label>
    <p><?php echo e($achievement->prestasi_yang_dicapai ?? '-'); ?></p>
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
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/student_achievement/read.blade.php ENDPATH**/ ?>