<form action="<?php echo e(route('admin.achievement.update', $achievement->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="mb-3">
        <label for="type" class="form-label">Jenis</label>
        <select class="form-control" id="type" name="type" required>
            <option value="publikasi" <?php echo e(old('type', $achievement->type) == 'publikasi' ? 'selected' : ''); ?>>Publikasi
            </option>
            <option value="penelitian" <?php echo e(old('type', $achievement->type) == 'penelitian' ? 'selected' : ''); ?>>
                Penelitian</option>
            <option value="pencapaian" <?php echo e(old('type', $achievement->type) == 'pencapaian' ? 'selected' : ''); ?>>
                Pencapaian</option>
        </select>
        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
        <label for="subtype" class="form-label">Tipe</label>
        <input type="text" class="form-control" id="subtype" name="subtype"
            value="<?php echo e(old('subtype', $achievement->subtype)); ?>" placeholder="Contoh: Q2, Penelitian Dosen, dll">
        <small class="form-text text-muted">Opsional - Masukkan tipe seperti Q2, Q1, Penelitian Dosen, dsb.</small>
        <?php $__errorArgs = ['subtype'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title"
            value="<?php echo e(old('title', $achievement->title)); ?>" required>
        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <!-- Pastikan ini ada di form edit -->
    <div class="mb-3">
        <label for="editor-edit-<?php echo e($achievement->id); ?>" class="form-label">Deskripsi</label>
        <div id="editor-edit-<?php echo e($achievement->id); ?>" style="height: 300px;"></div>
        <input type="hidden" id="description-edit-<?php echo e($achievement->id); ?>" name="description"
            value="<?php echo e(old('description', $achievement->description)); ?>">
        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="date" name="date"
            value="<?php echo e(old('date', $achievement->date ? $achievement->date->format('Y-m-d') : '')); ?>" required>
        <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Penulis</label>
        <input type="text" class="form-control" id="author" name="author"
            value="<?php echo e(old('author', $achievement->author)); ?>" required>
        <?php $__errorArgs = ['author'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <?php if($achievement->image): ?>
            <img src="<?php echo e(asset('storage/' . $achievement->image)); ?>" class="img-thumbnail mt-2"
                alt="Current Achievement Image">
        <?php endif; ?>
        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">File (PDF/DOC/DOCX)</label>
        <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx">
        <?php if($achievement->file): ?>
            <a href="<?php echo e(asset('storage/' . $achievement->file)); ?>" class="mt-2 d-block" target="_blank">Lihat file saat
                ini</a>
        <?php endif; ?>
        <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
            <?php echo e(old('is_active', $achievement->is_active) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="is_active">
            Aktifkan (Tampil di Halaman User)
        </label>
        <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/achievement/edit.blade.php ENDPATH**/ ?>