<form action="<?php echo e(route('admin.curriculum.update', $curriculum->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="mb-4">
        <label for="course_code_<?php echo e($curriculum->id); ?>" class="form-label">Kode Mata Kuliah</label>
        <input type="text" class="form-control" id="course_code_<?php echo e($curriculum->id); ?>" name="course_code"
            value="<?php echo e(old('course_code', $curriculum->course_code)); ?>" required>
        <?php $__errorArgs = ['course_code'];
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
    <div class="mb-4">
        <label for="course_name_<?php echo e($curriculum->id); ?>" class="form-label">Nama Mata Kuliah</label>
        <input type="text" class="form-control" id="course_name_<?php echo e($curriculum->id); ?>" name="course_name"
            value="<?php echo e(old('course_name', $curriculum->course_name)); ?>" required>
        <?php $__errorArgs = ['course_name'];
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
    <div class="mb-4">
        <label for="semester_<?php echo e($curriculum->id); ?>" class="form-label">Semester</label>
        <select class="form-select" id="semester_<?php echo e($curriculum->id); ?>" name="semester" required>
            <option value="" disabled>Pilih Semester</option>
            <?php for($i = 1; $i <= 8; $i++): ?>
                <option value="<?php echo e($i); ?>"
                    <?php echo e(old('semester', $curriculum->semester) == $i ? 'selected' : ''); ?>>Semester <?php echo e($i); ?>

                </option>
            <?php endfor; ?>
        </select>
        <?php $__errorArgs = ['semester'];
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
    <div class="mb-4">
        <label for="credits_<?php echo e($curriculum->id); ?>" class="form-label">Credits (SKS)</label>
        <input type="number" class="form-control" id="credits_<?php echo e($curriculum->id); ?>" name="credits"
            value="<?php echo e(old('credits', $curriculum->credits)); ?>" required min="1">
        <?php $__errorArgs = ['credits'];
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
    <div class="mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_active_edit_<?php echo e($curriculum->id); ?>" name="is_active"
                value="1" <?php echo e(old('is_active', $curriculum->is_active) ? 'checked' : ''); ?>>
            <label class="form-check-label" for="is_active_edit_<?php echo e($curriculum->id); ?>">Aktifkan (Tampil di Halaman
                User)</label>
        </div>
    </div>
    <div class="d-flex justify-content-end gap-2">

        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/curriculum/edit.blade.php ENDPATH**/ ?>