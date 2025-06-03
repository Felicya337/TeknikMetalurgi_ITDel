<div>
    <div class="row">
        <div class="col-md-4 text-center">
            <?php if($lecturer->image): ?>
                <img src="<?php echo e(asset('storage/' . $lecturer->image)); ?>" class="img-fluid rounded-circle shadow-sm mb-3"
                    alt="Foto <?php echo e($lecturer->name); ?>" style="max-width: 150px; max-height: 150px; object-fit: cover;">
            <?php else: ?>
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-muted"></i>
                    <p class="text-muted small">Tidak ada foto</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <dl class="row">
                <dt class="col-sm-4">ID Karyawan</dt>
                <dd class="col-sm-8"><?php echo e($lecturer->employee_id); ?></dd>

                <dt class="col-sm-4">Nama</dt>
                <dd class="col-sm-8"><?php echo e($lecturer->name); ?></dd>

                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8"><a href="mailto:<?php echo e($lecturer->email); ?>"><?php echo e($lecturer->email); ?></a></dd>

                <dt class="col-sm-4">LinkedIn</dt>
                <dd class="col-sm-8">
                    <?php if($lecturer->linkedIn_url): ?>
                        
                        <a href="<?php echo e($lecturer->linkedIn_url); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo e($lecturer->linkedIn_username); ?> 
                        </a>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </dd>

                <dt class="col-sm-4">Ruangan</dt>
                <dd class="col-sm-8"><?php echo e($lecturer->room ?? '-'); ?></dd>

                <dt class="col-sm-4">Peran</dt>
                <dd class="col-sm-8"><?php echo e(ucfirst($lecturer->role)); ?></dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
                    <span class="badge <?php echo e($lecturer->is_active ? 'bg-success' : 'bg-danger'); ?>">
                        <?php echo e($lecturer->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

                    </span>
                </dd>
            </dl>
        </div>
    </div>
    <hr>
    <div class="mb-3">
        <h5 class="fw-bold">Riwayat Pendidikan</h5>
        <div class="p-3 border rounded bg-light"><?php echo $lecturer->education ?: '<span class="text-muted fst-italic">Tidak ada data.</span>'; ?></div>
    </div>
    <div class="mb-3">
        <h5 class="fw-bold">Bidang Penelitian & Publikasi</h5>
        <div class="p-3 border rounded bg-light"><?php echo $lecturer->research ?: '<span class="text-muted fst-italic">Tidak ada data.</span>'; ?></div>
    </div>
    <?php if($lecturer->role == 'dosen'): ?>
        <div class="mb-3">
            <h5 class="fw-bold">Mata Kuliah yang Diampu</h5>
            <div class="p-3 border rounded bg-light"><?php echo $lecturer->courses ?: '<span class="text-muted fst-italic">Tidak ada data.</span>'; ?></div>
        </div>
    <?php endif; ?>
    <div class="text-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/lecturer/read.blade.php ENDPATH**/ ?>