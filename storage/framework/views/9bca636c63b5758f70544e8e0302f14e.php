<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumbs">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none">Fasilitas</a>
                </li>
                <li class="breadcrumb-item current-page"><b>Ruang Kelas, Smart Class, Ruang Baca</b></li>
            </ol>
        </div>
    </nav>

    <!-- Facility Section -->
    <section class="facility-section">
        <div class="container">
            <h2 class="facility-title">Fasilitas Program Studi Teknik Metalurgi Fakultas Teknologi Industri</h2>
            <div class="accordion" id="facilityAccordion">
                <?php
                    $facilityTypes = [
                        'classroom' => 'Ruang Kelas',
                        'smartclass' => 'Smart Class',
                        'reading_room' => 'Ruang Baca',
                    ];
                ?>

                <?php $__currentLoopData = $facilityTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $typeName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo e(ucfirst($type)); ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse<?php echo e(ucfirst($type)); ?>" aria-expanded="false"
                                aria-controls="collapse<?php echo e(ucfirst($type)); ?>">
                                <?php echo e($typeName); ?>

                                <span class="custom-arrow"></span>
                            </button>
                        </h2>
                        <div id="collapse<?php echo e(ucfirst($type)); ?>" class="accordion-collapse collapse"
                            aria-labelledby="heading<?php echo e(ucfirst($type)); ?>" data-bs-parent="#facilityAccordion">
                            <div class="accordion-body">
                                <?php if(isset($facilities[$type]) && $facilities[$type]->isNotEmpty()): ?>
                                    <?php
                                        $completeFacilities = [];
                                        $imageOnlyFacilities = [];
                                        $allImages = [];

                                        foreach ($facilities[$type] as $facility) {
                                            $hasCompleteData = !empty($facility->description) ||
                                                              !empty($facility->academic_days) ||
                                                              !empty($facility->academic_hours) ||
                                                              !empty($facility->collaborative_hours);

                                            if ($hasCompleteData) {
                                                $completeFacilities[] = $facility;
                                            } else {
                                                if ($facility->images && count($facility->images) > 0) {
                                                    $allImages = array_merge($allImages, $facility->images);
                                                }
                                            }
                                        }

                                        if (!empty($completeFacilities)) {
                                            foreach ($completeFacilities as $facility) {
                                                $facilityImages = $facility->images ? $facility->images : [];
                                                $allFacilityImages = array_merge($facilityImages, $allImages);
                                                $allFacilityImages = array_unique($allFacilityImages);
                                    ?>
                                                <div class="facility-details">
                                                    <h4 class="info-title">
                                                        <img src="<?php echo e(asset('aset/img/logo1.png')); ?>" alt="Info Icon" class="icon-img">
                                                        INFORMASI UMUM
                                                    </h4>
                                                    <p class="facility-description">
                                                        <?php echo $facility->description ?? 'Tidak ada deskripsi yang tersedia.'; ?>

                                                    </p>

                                                    <h4 class="info-title">
                                                        <img src="<?php echo e(asset('aset/img/logo2.png')); ?>" alt="Clock Icon" class="icon-img">
                                                        JAM KERJA
                                                    </h4>
                                                    <div class="schedule-item">
                                                        <span class="schedule-text">Hari Akademik:
                                                            <?php echo e($facility->academic_days ? implode(', ', $facility->academic_days) : 'Senin - Jumat'); ?></span>
                                                    </div>
                                                    <div class="schedule-item">
                                                        <span class="schedule-text">Jam Akademik:
                                                            <?php echo e($facility->academic_hours ?? '07:00 - 17:00'); ?></span>
                                                    </div>
                                                    <div class="schedule-item">
                                                        <span class="schedule-text">Jam Kolaboratif:
                                                            <?php echo e($facility->collaborative_hours ?? '19:00 - 22:00'); ?></span>
                                                    </div>

                                                    <?php if(count($allFacilityImages) > 0): ?>
                                                        <div class="facility-images">
                                                            <?php $__currentLoopData = $allFacilityImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <img src="<?php echo e(asset('storage/' . $image)); ?>" alt="Facility Image"
                                                                    class="facility-image">
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <p class="text-muted">Tidak ada gambar tersedia.</p>
                                                    <?php endif; ?>
                                                </div>
                                    <?php
                                            }
                                            $allImages = [];
                                        } else {
                                            if (!empty($allImages)) {
                                    ?>
                                                <div class="facility-details">
                                                    <h4 class="info-title">
                                                        <img src="<?php echo e(asset('aset/img/logo1.png')); ?>" alt="Info Icon" class="icon-img">
                                                        INFORMASI UMUM
                                                    </h4>
                                                    <p class="facility-description">
                                                        Tidak ada deskripsi yang tersedia.
                                                    </p>

                                                    <h4 class="info-title">
                                                        <img src="<?php echo e(asset('aset/img/logo2.png')); ?>" alt="Clock Icon" class="icon-img">
                                                        JAM KERJA
                                                    </h4>
                                                    <div class="schedule-item">
                                                        <span class="schedule-text">Hari Akademik: Senin - Jumat</span>
                                                    </div>
                                                    <div class="schedule-item">
                                                        <span class="schedule-text">Jam Akademik: 07:00 - 17:00</span>
                                                    </div>
                                                    <div class="schedule-item">
                                                        <span class="schedule-text">Jam Kolaboratif: 19:00 - 22:00</span>
                                                    </div>

                                                    <div class="facility-images">
                                                        <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <img src="<?php echo e(asset('storage/' . $image)); ?>" alt="Facility Image"
                                                                class="facility-image">
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                <?php else: ?>
                                    <p class="text-muted">Belum ada data untuk <?php echo e($typeName); ?>.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <style>
       .facility-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
    background-color: #ffffff;
    font-family: Arial, sans-serif;
}
.facility-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #212529;
    margin-bottom: 2rem;
    text-align: center;
}

.accordion-item {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 1rem;
}
.accordion-button {
    font-size: 1.1rem;
    font-weight: 500;
    color: #212529 !important;
    padding: 1rem;
    border: none;
    border-radius: 0.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    background-color: #fff !important;
    transition: background-color 0.3s ease;
}
.accordion-button:hover {
    background-color: #f8f9fa !important;
    color: #212529 !important;
    box-shadow: none !important;
}
.accordion-button:not(.collapsed) {
    color: #212529 !important;
    background-color: #f8f9fa !important;
    box-shadow: none !important;
}
.accordion-button:focus {
    box-shadow: none !important;
    border-color: transparent !important;
    outline: none !important;
    background-color: #f8f9fa !important;
    color: #212529 !important;
}
.accordion-button::after {
    display: none;
}
.custom-arrow {
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-bottom: 6px solid #000;
    transition: transform 0.3s ease;
}
.accordion-button:not(.collapsed) .custom-arrow {
    transform: rotate(180deg);
}
.accordion-body {
    padding: 1.5rem;
    background-color: #fff;
    border-top: 1px solid #dee2e6;
    border-radius: 0 0 0.5rem 0.5rem;
}
.facility-details {
    padding: 15px;
    background-color: #ffffff;
    border-radius: 5px;
    margin-bottom: 15px;
}
.info-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #0A76BC;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    text-transform: uppercase;
}
.icon-img {
    width: 24px;
    height: 24px;
    margin-right: 0.5rem;
    object-fit: contain;
}
.facility-description {
    font-size: 1rem;
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1rem;
}
.schedule-item {
    margin-bottom: 0.4rem;
}
.schedule-text {
    font-size: 1rem;
    color: #212529;
}
.facility-images {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 1.5rem; /* Added gap between images */
    margin-top: 1rem;
    justify-items: center;
    align-items: center;
}
.facility-image {
    width: 100%;
    max-width: 450px;
    height: 350px;
    border-radius: 8px;
    border: 8px solid #ffffff;
    object-fit: cover;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    filter: brightness(1.2) contrast(1.1) saturate(0.9);
    position: relative;
    margin-bottom: 1.5rem; /* Added bottom margin for extra spacing */
}
.facility-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 5px;
    pointer-events: none;
}
.facility-image:hover {
    transform: scale(1.02);
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}
.text-muted {
    color: #6c757d;
    font-style: italic;
}
@media (max-width: 768px) {
    .facility-title {
        font-size: 1.5rem;
    }
    .accordion-button {
        font-size: 1rem;
        padding: 10px 15px;
    }
    .info-title {
        font-size: 1rem;
    }
    .facility-images {
        gap: 1rem; /* Reduced gap for mobile */
    }
    .facility-image {
        max-width: 150px;
        height: 100px;
        filter: brightness(1.15) contrast(1.05) saturate(0.9);
        margin-bottom: 1rem; /* Reduced bottom margin for mobile */
    }
    .icon-img {
        width: 20px;
        height: 20px;
    }
}
    </style>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/facility.blade.php ENDPATH**/ ?>