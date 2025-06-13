<form action="<?php echo e(route('admin.collaborate.update', $collaborate->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="mb-3">
        <label for="institution_name" class="form-label">Nama Institusi</label>
        <input type="text" class="form-control" id="institution_name" name="institution_name"
            value="<?php echo e(old('institution_name', $collaborate->institution_name)); ?>" required>
        <?php $__errorArgs = ['institution_name'];
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
        <label for="company_profile" class="form-label">Profil Perusahaan</label>
        <div id="editor-company-profile-edit-<?php echo e($collaborate->id); ?>" style="height: 300px;"></div>
        <input type="hidden" id="company-profile-edit-<?php echo e($collaborate->id); ?>" name="company_profile"
            value="<?php echo old('company_profile', $collaborate->company_profile); ?>">
        <?php $__errorArgs = ['company_profile'];
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
        <label for="institution_description" class="form-label">Deskripsi</label>
        <div id="editor-institution-description-edit-<?php echo e($collaborate->id); ?>" style="height: 300px;"></div>
        <input type="hidden" id="institution-description-edit-<?php echo e($collaborate->id); ?>" name="institution_description"
            value="<?php echo old('institution_description', $collaborate->institution_description); ?>">
        <?php $__errorArgs = ['institution_description'];
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
            value="<?php echo e(old('date', $collaborate->date ? $collaborate->date->format('Y-m-d') : '')); ?>" required>
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
        <label for="logo" class="form-label">Logo</label>
        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
        <?php if($collaborate->logo): ?>
            <img src="<?php echo e(asset('storage/' . $collaborate->logo)); ?>" class="img-thumbnail mt-2" alt="Current Logo">
        <?php endif; ?>
        <?php $__errorArgs = ['logo'];
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
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
            <?php echo e(old('is_active', $collaborate->is_active) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="is_active">Aktifkan (Tampil di Halaman User)</label>
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
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/collaborate/edit.blade.php ENDPATH**/ ?>