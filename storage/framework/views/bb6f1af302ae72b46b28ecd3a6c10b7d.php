<form action="<?php echo e(route('admin.facility.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label for="type-create" class="form-label">Tipe <span class="text-danger">*</span></label>
        <select class="form-control" id="type-create" name="type" required>
            <option value="">Pilih Tipe Fasilitas</option>
            <option value="classroom" <?php echo e(old('type') == 'classroom' ? 'selected' : ''); ?>>Ruang Kelas</option>
            <option value="smartclass" <?php echo e(old('type') == 'smartclass' ? 'selected' : ''); ?>>Smart Class</option>
            <option value="reading_room" <?php echo e(old('type') == 'reading_room' ? 'selected' : ''); ?>>Ruang Baca</option>
        </select>
        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger mt-1"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <label for="description-create" class="form-label">Deskripsi <span class="text-danger">*</span></label>
        <div id="editor-create" style="height: 300px;"></div>
        <input type="hidden" id="description-create" name="description" value="<?php echo e(old('description')); ?>">
        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger mt-1"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <label for="academic_days" class="form-label">Hari Akademik</label>
        <?php
            $selectedDays = old('academic_days', []);
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
                        <input class="form-check-input" type="checkbox" id="day_<?php echo e($value); ?>_create"
                            name="academic_days[]" value="<?php echo e($value); ?>"
                            <?php echo e(in_array($value, $selectedDays) ? 'checked' : ''); ?>>
                        <label class="form-check-label"
                            for="day_<?php echo e($value); ?>_create"><?php echo e($label); ?></label>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php $__errorArgs = ['academic_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger mt-1"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <label for="academic_hours-create" class="form-label">Jam Akademik</label>
        <input type="text" class="form-control" id="academic_hours-create" name="academic_hours"
            value="<?php echo e(old('academic_hours')); ?>" placeholder="Contoh: 08:00-16:00">
        <small class="text-muted">Format: HH:MM-HH:MM</small>
        <?php $__errorArgs = ['academic_hours'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger mt-1"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <label for="collaborative_hours-create" class="form-label">Jam Kolaborasi</label>
        <input type="text" class="form-control" id="collaborative_hours-create" name="collaborative_hours"
            value="<?php echo e(old('collaborative_hours')); ?>" placeholder="Contoh: 16:00-18:00">
        <small class="text-muted">Format: HH:MM-HH:MM</small>
        <?php $__errorArgs = ['collaborative_hours'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger mt-1"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <label for="images-create" class="form-label">Gambar (Maksimum 5)</label>
        <input type="file" class="form-control" id="images-create" name="images[]"
            accept="image/jpeg,image/png,image/jpg,image/gif" multiple>
        <small class="text-muted">Pilih hingga 5 gambar (JPEG/PNG/JPG/GIF, maks 2MB per gambar).</small>
        <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger mt-1"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_active-create" name="is_active" value="1"
                <?php echo e(old('is_active', '1') ? 'checked' : ''); ?>>
            <label class="form-check-label" for="is_active-create">Aktifkan (Tampil di Halaman User)</label>
        </div>
        <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger mt-1"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i>Simpan
        </button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/facility/create.blade.php ENDPATH**/ ?>