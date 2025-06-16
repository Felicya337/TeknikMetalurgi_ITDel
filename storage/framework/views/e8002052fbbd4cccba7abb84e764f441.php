<?php $__env->startSection('title', 'Laboratorium'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .laboratory-section {
            padding: 2rem 0;
            background-color: #fff;
        }

        .laboratory-title {
            text-align: center;
            font-size: clamp(1.5rem, 5vw, 1.75rem);
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.025rem;
        }

        .laboratory-card {
            background: #fff;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 -4px 6px -1px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            margin-bottom: 3rem;
            overflow: hidden;
        }

        .laboratory-header {
            padding: 1.5rem;
        }

        .laboratory-name {
            color: #2b6cb0;
            font-size: 1.125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025rem;
        }

        .laboratory-content {
            display: flex;
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .laboratory-image {
            flex: 0 0 280px;
            height: 200px;
            border-radius: 4px;
            overflow: hidden;
        }

        .laboratory-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .laboratory-details {
            flex: 1;
        }

        .info-title {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 600;
            color: #2b6cb0;
            margin: 1.25rem 0 0.75rem;
            text-transform: uppercase;
        }

        .info-icon {
            width: 16px;
            height: 16px;
            margin-right: 0.5rem;
        }

        .laboratory-description {
            font-size: 0.875rem;
            line-height: 1.6;
            color: #4a5568;
            margin-bottom: 1rem;
            text-align: justify;
        }

        .schedule-list {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .schedule-item {
            font-size: 0.875rem;
            color: #4a5568;
            margin-bottom: 0.375rem;
        }

        .additional-images {
            display: flex;
            gap: 0.625rem;
            margin-top: 1.25rem;
            flex-wrap: wrap;
        }

        .additional-images img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .no-data {
            text-align: center;
            font-size: 1rem;
            color: #718096;
            font-style: italic;
            padding: 2.5rem 0;
        }

        @media (max-width: 992px) {
            .laboratory-content {
                flex-direction: column;
                gap: 1rem;
            }

            .laboratory-image {
                width: 100%;
                height: 200px;
            }
        }

        @media (max-width: 768px) {
            .laboratory-section {
                padding: 1.5rem 0;
            }

            .laboratory-card {
                margin-bottom: 2rem;
            }

            .laboratory-content {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .laboratory-title {
                font-size: 1.25rem;
            }

            .laboratory-name {
                font-size: 1rem;
            }

            .info-title,
            .laboratory-description,
            .schedule-item {
                font-size: 0.8125rem;
            }
        }
    </style>

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(url('/')); ?>">Laboratorium</a>
                </li>
            </ol>
        </div>
    </nav>

    <section class="laboratory-section">
        <div class="container">
            <h3 class="text-center mb-5 fw-bold">Laboratorium Program Studi Teknik Metalurgi<br>Fakultas Teknologi Industri
            </h3>

            <?php if($laboratories->isEmpty()): ?>
                <p class="no-data">Tidak ada laboratorium yang tersedia saat ini.</p>
            <?php else: ?>
                <?php $__currentLoopData = $laboratories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laboratory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="laboratory-card" aria-labelledby="lab-<?php echo e($laboratory->id); ?>-title">
                        <header class="laboratory-header">
                            <h3 class="laboratory-name" id="lab-<?php echo e($laboratory->id); ?>-title">
                                <?php echo e(strtoupper($laboratory->name)); ?>

                            </h3>
                        </header>

                        <div class="laboratory-content">
                            <div class="laboratory-image">
                                <img src="<?php echo e($laboratory->images && count($laboratory->images) > 0 ? asset('storage/' . $laboratory->images[0]) : asset('aset/img/default-lab.jpg')); ?>"
                                    alt="<?php echo e($laboratory->name); ?> laboratory image">
                            </div>

                            <div class="laboratory-details">
                                <h4 class="info-title">
                                    <img src="<?php echo e(asset('aset/img/logo1.png')); ?>" alt="Information icon" class="info-icon">
                                    Informasi Umum
                                </h4>
                                <p class="laboratory-description">
                                    <?php echo $laboratory->description ?? 'Tidak ada deskripsi yang tersedia.'; ?>

                                </p>

                                <h4 class="info-title">
                                    <img src="<?php echo e(asset('aset/img/logo2.png')); ?>" alt="Clock icon" class="info-icon">
                                    Jam Kerja
                                </h4>

                                <ul class="schedule-list">
                                    <li class="schedule-item">
                                        <strong>Hari Akademik:</strong>
                                        <?php echo e($laboratory->academic_days ? implode(', ', $laboratory->academic_days) : 'Senin - Jumat'); ?>

                                    </li>
                                    <li class="schedule-item">
                                        <strong>Jam Akademik:</strong>
                                        <?php echo e($laboratory->academic_hours ?? '07:00 - 17:00'); ?>

                                    </li>
                                    <li class="schedule-item">
                                        <strong>Jam Kolaboratif:</strong>
                                        <?php echo e($laboratory->collaborative_hours ?? '19:00 - 22:00'); ?>

                                    </li>
                                </ul>

                                <?php if($laboratory->images && count($laboratory->images) > 1): ?>
                                    <div class="additional-images">
                                        <?php $__currentLoopData = array_slice($laboratory->images, 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img src="<?php echo e(asset('storage/' . $image)); ?>"
                                                alt="Additional image of <?php echo e($laboratory->name); ?> laboratory">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/laboratory.blade.php ENDPATH**/ ?>