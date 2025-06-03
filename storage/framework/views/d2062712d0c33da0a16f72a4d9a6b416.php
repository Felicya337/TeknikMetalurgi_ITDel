<form action="<?php echo e(route('admin.studentactivity.update', $activity->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="mb-3">
        <label for="type_edit_<?php echo e($activity->id); ?>" class="form-label">Jenis Kegiatan</label>
        <select class="form-control" id="type_edit_<?php echo e($activity->id); ?>" name="type" required>
            <option value="kegiatan_mahasiswa"
                <?php echo e(old('type', $activity->type) == 'kegiatan_mahasiswa' ? 'selected' : ''); ?>>
                Kegiatan Mahasiswa</option>
            <option value="kegiatan_prodi" <?php echo e(old('type', $activity->type) == 'kegiatan_prodi' ? 'selected' : ''); ?>>
                Kegiatan Prodi</option>
            <option value="club_mahasiswa" <?php echo e(old('type', $activity->type) == 'club_mahasiswa' ? 'selected' : ''); ?>>
                Club Mahasiswa</option>
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
        <label for="title_edit_<?php echo e($activity->id); ?>" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title_edit_<?php echo e($activity->id); ?>" name="title"
            value="<?php echo e(old('title', $activity->title)); ?>" required>
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
    <div class="mb-3">
        <label for="description_edit_<?php echo e($activity->id); ?>" class="form-label">Deskripsi</label>
        <div id="editor-edit-<?php echo e($activity->id); ?>" style="height: 300px;"></div>
        <input type="hidden" id="description-edit-<?php echo e($activity->id); ?>" name="description"
            value="<?php echo e(old('description', $activity->description)); ?>">
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
        <label for="image_edit_<?php echo e($activity->id); ?>" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="image_edit_<?php echo e($activity->id); ?>" name="image" accept="image/*">
        <?php if($activity->image): ?>
            <img src="<?php echo e(asset('storage/' . $activity->image)); ?>" class="img-thumbnail mt-2"
                alt="Current Activity Image">
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
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active_edit_<?php echo e($activity->id); ?>" name="is_active"
            value="1" <?php echo e(old('is_active', $activity->is_active) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="is_active_edit_<?php echo e($activity->id); ?>">Aktifkan (Tampil di Halaman
            User)</label>
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
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/studentactivity/edit.blade.php ENDPATH**/ ?>