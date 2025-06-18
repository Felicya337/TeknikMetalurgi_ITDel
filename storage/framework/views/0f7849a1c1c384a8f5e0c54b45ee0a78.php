<?php $__env->startSection('content'); ?>
    <style>
        /* Program Activities Styling */
        body {
            font-family: 'Inter', sans-serif;
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
            text-align: center;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .header-logo {
            width: 120px;
            height: 120px;
            flex-shrink: 0;
            margin-right: 20px;
            transition: transform 0.3s ease;
        }

        .header-logo:hover {
            transform: scale(1.05);
        }

        .header-text {
            flex: 1;
            padding-top: 0;
            text-align: center;
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
            text-align: center;
            margin: 0;
        }

        /* Activity Cards with Enhanced Hover Effects */
        .activity-card {
            background: white;
            margin-bottom: 30px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            cursor: pointer;
            position: relative;
        }

        .activity-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        }

        .activity-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .activity-card:hover::before {
            transform: scaleX(1);
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
            text-align: start;
            transition: all 0.3s ease;
        }

        .activity-card:hover .activity-title {
            color: #1a73e8;
            background: linear-gradient(135deg, #f8faff, #ffffff);
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
            overflow: hidden;
            border-radius: 8px;
        }

        .activity-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .activity-card:hover .activity-image img {
            transform: scale(1.05);
        }

        .activity-content {
            flex: 1;
        }

        .activity-description {
            font-size: 14px;
            color: #000000;
            line-height: 1.6;
            text-align: justify;
            margin: 0;
        }

        .activity-card:hover .activity-description {
            color: #333333;
        }

        /* Breadcrumb hover effect */
        .breadcrumbs a {
            transition: color 0.3s ease;
        }

        .breadcrumbs a:hover {
            color: #ffffff;
        }

        /* No activities alert */
        .alert-info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #000000;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin: 30px 0;
            transition: all 0.3s ease;
        }

        .alert-info:hover {
            background-color: #c3e6f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 163, 241, 0.1);
        }

        /* Enhanced button/link hover effects */
        .text-decoration-none:hover {
            text-decoration: underline !important;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
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
                margin-right: 0;
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

            /* Reduce hover effects on mobile for better touch experience */
            .activity-card:hover {
                transform: translateY(-4px);
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

            /* Minimal hover effects on small screens */
            .activity-card:hover {
                transform: translateY(-2px);
            }
        }

        /* Active/Click state for better interaction feedback */
        .activity-card:active {
            transform: translateY(-4px);
            transition: transform 0.1s ease;
        }

        /* Loading animation for images */
        .activity-image {
            position: relative;
        }

        .activity-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
            border-radius: 8px;
        }

        .activity-card:hover .activity-image::before {
            transform: translateX(100%);
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
            <h3 class="text-center mb-5 fw-bold">KEGIATAN PRODI</h3>
            <div class="header-content">
                <img src="<?php echo e(asset('aset/img/Prodi.jpg')); ?>" alt="Logo HIMAMETAL" class="header-logo">
                <div class="header-text">
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