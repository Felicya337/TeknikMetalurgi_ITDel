<?php $__env->startSection('content'); ?>
    <style>
        /* Program Activities Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .program-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Section */
        .program-header {
            margin-bottom: 30px;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .header-logo {
            width: 120px;
            height: 120px;
            flex-shrink: 0;
        }

        .header-text {
            flex: 1;
            padding-top: 0;
        }

        .main-title {
            font-size: 24px;
            font-weight: bold;
            color: #000000;
            margin: 0 0 10px 0;
            letter-spacing: 1px;
        }

        .sub-title {
            font-size: 16px;
            color: #141414;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .description {
            font-size: 14px;
            color: #202020;
            line-height: 1.6;
            text-align: justify;
            margin: 0;
        }

        /* Activity Cards */
        .activity-card {
            background: white;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            width: 100%;
        }

        .activity-title {
            background: white;
            color: #2ea3f1;
            font-size: 16px;
            text-transform: uppercase;
            padding: 12px 20px;
            margin: 0;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #ffffff;
        }

        .activity-body {
            padding: 20px;
        }

        .activity-row {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .activity-image {
            flex: 0 0 40%;
            max-width: 40%;
        }

        .activity-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            border-radius: 5px;
        }

        .activity-content {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .activity-description {
            font-size: 14px;
            color: #000000;
            line-height: 1.6;
            text-align: justify;
            margin: 0;
        }

        /* No activities alert */
        .alert-info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #000000;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 30px 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .program-container {
                padding: 15px;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-logo {
                width: 100px;
                height: 100px;
                align-self: center;
            }

            .header-text {
                padding-top: 0;
            }

            .main-title {
                font-size: 20px;
            }

            .sub-title {
                font-size: 14px;
            }

            .description {
                font-size: 13px;
            }

            .activity-row {
                flex-direction: column;
                gap: 15px;
            }

            .activity-image {
                flex: none;
                max-width: 100%;
            }

            .activity-image img {
                height: 200px;
            }

            .activity-title {
                font-size: 14px;
                padding: 10px 15px;
            }

            .activity-description {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .program-container {
                padding: 10px;
            }

            .header-logo {
                width: 80px;
                height: 80px;
            }

            .main-title {
                font-size: 18px;
            }

            .sub-title {
                font-size: 13px;
            }

            .description {
                font-size: 12px;
            }

            .activity-body {
                padding: 15px;
            }

            .activity-image img {
                height: 180px;
            }
        }
    </style>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('/')); ?>" class="text-decoration-none">Beranda</a>
            </li>
            <li class="breadcrumb-item current-page">Kegiatan Prodi</li>
        </ol>
    </nav>

    <div class="program-container my-5">
        <div class="program-header">
            <div class="header-content">
                <img src="<?php echo e(asset('aset/img/logohima.jpg')); ?>" alt="Logo HIMAMETAL" class="header-logo">
                <div class="header-text">
                    <h2 class="main-title">KEGIATAN PRODI</h2>
                    <h4 class="sub-title">TEKNIK METALURGI</h4>
                    <p class="description">
                        Kegiatan Prodi Teknik Metalurgi di Institut Teknologi Del, Fakultas Teknologi Industri,
                        dirancang untuk meningkatkan pemahaman mahasiswa terhadap ilmu metalurgi dan aplikasinya
                        di industri. Melalui seminar, lokakarya, kunjungan industri, dan kegiatan akademik lainnya,
                        prodi ini bertujuan untuk memperkaya pengalaman akademik dan profesional mahasiswa, serta
                        memperkuat hubungan dengan dunia industri.
                    </p>
                </div>
            </div>
        </div>

        <?php if($studentactivities->isEmpty()): ?>
            <div class="alert alert-info">
                Tidak ada kegiatan prodi yang tersedia saat ini.
            </div>
        <?php else: ?>
            <?php $__currentLoopData = $studentactivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="activity-card">
                    <h5 class="activity-title"><?php echo e($activity->title); ?></h5>
                    <div class="activity-body">
                        <div class="activity-row">
                            <div class="activity-image">
                                <?php if($activity->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $activity->image)); ?>" alt="<?php echo e($activity->title); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/placeholder.png')); ?>" alt="No Image Available">
                                <?php endif; ?>
                            </div>
                            <div class="activity-content">
                                <p class="activity-description"><?php echo $activity->description; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/student_activity/program.blade.php ENDPATH**/ ?>