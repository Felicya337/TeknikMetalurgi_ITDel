<form action="<?php echo e(route('admin.facility.update', $facility->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="mb-3">
        <label for="type" class="form-label">Tipe</label>
        <select class="form-control" id="type" name="type" required>
            <option value="">Pilih Tipe Fasilitas</option>
            <option value="classroom" <?php echo e(old('type', $facility->type) == 'classroom' ? 'selected' : ''); ?>>Ruang Kelas
            </option>
            <option value="smartclass" <?php echo e(old('type', $facility->type) == 'smartclass' ? 'selected' : ''); ?>>Smartclass
            </option>
            <option value="reading_room" <?php echo e(old('type', $facility->type) == 'reading_room' ? 'selected' : ''); ?>>Ruang
                Baca</option>
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
        <label for="description" class="form-label">Deskripsi</label>
        <div id="editor-edit-<?php echo e($facility->id); ?>" style="height: 300px;"></div>
        <input type="hidden" id="description-edit-<?php echo e($facility->id); ?>" name="description"
            value="<?php echo e(old('description', $facility->description)); ?>">
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
        <label for="academic_days" class="form-label">Hari Akademik</label>
        <?php
            $selectedDays = old('academic_days', $facility->academic_days ?? []);
            $days = [
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
                'Sunday' => 'Minggu',
            ];
        ?>
        <div class="row">
            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="day_<?php echo e($value); ?>_edit"
                            name="academic_days[]" value="<?php echo e($value); ?>"
                            <?php echo e(in_array($value, $selectedDays) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="day_<?php echo e($value); ?>_edit"><?php echo e($label); ?></label>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php $__errorArgs = ['academic_days'];
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
        <label for="academic_hours" class="form-label">Jam Akademik</label>
        <input type="text" class="form-control" id="academic_hours" name="academic_hours"
            value="<?php echo e(old('academic_hours', $facility->academic_hours)); ?>" placeholder="Contoh: 08:00-16:00">
        <?php $__errorArgs = ['academic_hours'];
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
        <label for="collaborative_hours" class="form-label">Jam Kolaborasi</label>
        <input type="text" class="form-control" id="collaborative_hours" name="collaborative_hours"
            value="<?php echo e(old('collaborative_hours', $facility->collaborative_hours)); ?>" placeholder="Contoh: 16:00-18:00">
        <?php $__errorArgs = ['collaborative_hours'];
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
        <label for="images" class="form-label">Gambar (Maksimum 5)</label>
        <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
        <small class="text-muted">Pilih hingga 5 gambar (JPEG/PNG/JPG/GIF, maks 2MB per gambar). Unggah baru untuk
            mengganti gambar lama.</small>
        <?php if($facility->images && count($facility->images) > 0): ?>
            <div class="mt-2">
                <p>Gambar saat ini:</p>
                <?php $__currentLoopData = $facility->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(asset('storage/' . $image)); ?>" class="img-thumbnail"
                        style="max-width: 100px; margin-right: 10px;" alt="Facility Image">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <?php $__errorArgs = ['images'];
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
            <?php echo e(old('is_active', $facility->is_active) ? 'checked' : ''); ?>>
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
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/facility/edit.blade.php ENDPATH**/ ?>