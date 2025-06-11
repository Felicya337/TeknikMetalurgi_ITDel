<form action="<?php echo e(route('admin.structure_organization.update', $structure->id)); ?>" method="POST"
    enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
        <label for="title_edit_<?php echo e($structure->id); ?>" class="form-label">Jabatan 1</label>
        <input type="text" class="form-control" id="title_edit_<?php echo e($structure->id); ?>" name="title"
            value="<?php echo e(old('title', $structure->title)); ?>" required>
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
        <label for="degree_edit_<?php echo e($structure->id); ?>" class="form-label">Jabatan 2</label>
        <input type="text" class="form-control" id="degree_edit_<?php echo e($structure->id); ?>" name="degree"
            value="<?php echo e(old('degree', $structure->degree)); ?>">
        <?php $__errorArgs = ['degree'];
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
        <label for="name_edit_<?php echo e($structure->id); ?>" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name_edit_<?php echo e($structure->id); ?>" name="name"
            value="<?php echo e(old('name', $structure->name)); ?>"> <!-- Removed required -->
        <?php $__errorArgs = ['name'];
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
        <label for="level_edit_<?php echo e($structure->id); ?>" class="form-label">Level</label>
        <select class="form-control" id="level_edit_<?php echo e($structure->id); ?>" name="level" required>
            <option value="0" <?php echo e(old('level', $structure->level) == 0 ? 'selected' : ''); ?>

                <?php echo e($hasLevelZero && $structure->level != 0 ? 'disabled' : ''); ?>>Level 0</option>
            <option value="1" <?php echo e(old('level', $structure->level) == 1 ? 'selected' : ''); ?>>Level 1</option>
            <option value="2" <?php echo e(old('level', $structure->level) == 2 ? 'selected' : ''); ?>>Level 2</option>
            <option value="3" <?php echo e(old('level', $structure->level) == 3 ? 'selected' : ''); ?>>Level 3</option>
            <option value="4" <?php echo e(old('level', $structure->level) == 4 ? 'selected' : ''); ?>>Level 4</option>
        </select>
        <?php $__errorArgs = ['level'];
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
        <label for="parent_id_edit_<?php echo e($structure->id); ?>" class="form-label">Induk</label>
        <select class="form-control" id="parent_id_edit_<?php echo e($structure->id); ?>" name="parent_id">
            <option value="">Tidak ada induk</option>
            <?php $__currentLoopData = $allStructures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($parent->id != $structure->id): ?>
                    <option value="<?php echo e($parent->id); ?>"
                        <?php echo e(old('parent_id', $structure->parent_id) == $parent->id ? 'selected' : ''); ?>

                        data-level="<?php echo e($parent->level); ?>">
                        <?php echo e($parent->name); ?> (<?php echo e($parent->title); ?>) - Level <?php echo e($parent->level); ?>

                    </option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['parent_id'];
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
        <label for="image_edit_<?php echo e($structure->id); ?>" class="form-label">Foto</label>
        <input type="file" class="form-control" id="image_edit_<?php echo e($structure->id); ?>" name="image"
            accept="image/*">
        <small class="text-muted">Pilih gambar (JPEG/PNG/JPG/GIF, maks 2MB). Biarkan kosong jika tidak ingin
            mengubah.</small>
        <?php if($structure->image): ?>
            <div class="mt-2">
                <img src="<?php echo e(asset('storage/' . $structure->image)); ?>" class="img-thumbnail" style="max-width: 150px;"
                    alt="Current Image">
            </div>
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
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_active" id="is_active_edit_<?php echo e($structure->id); ?>"
            value="1" <?php echo e(old('is_active', $structure->is_active) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="is_active_edit_<?php echo e($structure->id); ?>">
            Aktifkan (Tampil di Halaman User)
        </label>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    document.getElementById('level_edit_<?php echo e($structure->id); ?>').addEventListener('change', function() {
        const selectedLevel = parseInt(this.value);
        const parentSelect = document.getElementById('parent_id_edit_<?php echo e($structure->id); ?>');
        const options = parentSelect.querySelectorAll('option[data-level]');
        const noParentOption = parentSelect.querySelector('option[value=""]');

        // Reset parent selection
        parentSelect.value = '';

        // Show "Tidak ada induk" for level 0, hide for others
        noParentOption.style.display = selectedLevel === 0 ? 'block' : 'none';
        if (selectedLevel !== 0) {
            noParentOption.removeAttribute('selected');
        }

        // Filter parent options based on selected level
        options.forEach(option => {
            const parentLevel = parseInt(option.getAttribute('data-level'));
            option.style.display = parentLevel < selectedLevel ? 'block' : 'none';
            if (parentLevel >= selectedLevel) {
                option.removeAttribute('selected');
            }
        });
    });

    // Trigger change event on page load to set initial parent options
    document.getElementById('level_edit_<?php echo e($structure->id); ?>').dispatchEvent(new Event('change'));
</script>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/structure_organization/edit.blade.php ENDPATH**/ ?>