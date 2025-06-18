<div>
    <div class="mb-3">
        <label class="form-label fw-bold">Kode Mata Kuliah</label>
        <p><?php echo e($curriculum->course_code); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Nama Mata Kuliah</label>
        <p><?php echo e($curriculum->course_name); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Semester</label>
        <p>Semester <?php echo e($curriculum->semester); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Credits (SKS)</label>
        <p><?php echo e($curriculum->credits); ?></p>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Status</label>
        <p>
            <span class="badge <?php echo e($curriculum->is_active ? 'bg-success' : 'bg-danger'); ?>">
                <?php echo e($curriculum->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

            </span>
        </p>
    </div>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/curriculum/read.blade.php ENDPATH**/ ?>