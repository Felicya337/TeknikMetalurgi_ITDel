<?php $__env->startSection('content'); ?>
    <style>
        /* Base Styles */
        .org-structure {
            font-family: 'Poppins', sans-serif;
            margin: 15px auto;
            max-width: 100%;
            width: 95%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            box-sizing: border-box;
        }

        /* Responsive Title */
        .org-structure h1 {
            font-size: clamp(1rem, 4vw, 1.6rem);
            font-weight: 600;
            color: #000000;
            line-height: 1.3;
            margin-bottom: clamp(1rem, 3vw, 2.5rem);
            text-align: center;
            max-width: 90%;
            padding: 0 10px;
            word-wrap: break-word;
            hyphens: auto;
        }

        /* Flexible Organization Levels */
        .org-level {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-bottom: clamp(20px, 4vw, 40px);
            flex-wrap: wrap;
            width: 100%;
            gap: clamp(10px, 2vw, 20px);
        }

        /* Responsive Organization Boxes */
        .org-box {
            background: #0078c3;
            color: white;
            padding: clamp(10px, 2.5vw, 20px);
            border-radius: clamp(6px, 1vw, 12px);
            text-align: center;
            width: clamp(180px, 20vw, 250px);
            min-width: 160px;
            max-width: 280px;
            position: relative;
            box-shadow: 0 4px 15px rgba(2, 117, 188, 0.2);
            transition: all 0.3s ease;
            flex: 1 1 auto;
            margin: 5px;
        }

        .org-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(2, 117, 188, 0.3);
        }

        /* Responsive Images */
        .org-box img {
            width: clamp(60px, 8vw, 150px);
            height: clamp(60px, 8vw, 150px);
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto clamp(8px, 1.5vw, 15px);
            display: block;
        }

        /* Responsive Text Elements */
        .org-title {
            font-weight: bold;
            margin-bottom: clamp(8px, 1.5vw, 12px);
            font-size: clamp(0.7rem, 1.8vw, 0.95rem);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .org-name {
            font-size: clamp(0.75rem, 1.6vw, 0.9rem);
            margin-top: clamp(6px, 1.2vw, 10px);
            font-weight: 700;
            /* Made name bold */
        }

        .org-degree {
            font-size: clamp(0.65rem, 1.4vw, 0.8rem);
            margin-top: clamp(4px, 0.8vw, 8px);
            opacity: 0.9;
            font-style: italic;
        }

        .org-multi-title {
            font-size: clamp(0.7rem, 1.5vw, 0.85rem);
            margin-top: clamp(8px, 1.5vw, 12px);
            padding-top: clamp(6px, 1.2vw, 10px);
            border-top: 1px dashed rgba(255, 255, 255, 0.4);
        }

        /* Responsive Connectors - Hide on small screens */
        .org-connector,
        .connector-line,
        .vertical-connector,
        .horizontal-connector-right,
        .horizontal-connector-left,
        .connector-vertical,
        .connector-horizontal {
            display: none;
        }

        /* Level-specific responsive adjustments */
        .top-level {
            margin-bottom: clamp(30px, 5vw, 60px);
        }

        .second-level {
            justify-content: space-around;
            width: 100%;
            margin-bottom: clamp(30px, 5vw, 60px);
        }

        .third-level {
            justify-content: space-around;
            width: 100%;
            margin-bottom: clamp(20px, 4vw, 40px);
        }

        .fourth-level {
            margin-top: clamp(20px, 4vw, 50px);
        }

        /* Desktop Styles (1024px and up) */
        @media (min-width: 1024px) {
            .org-structure {
                max-width: 1400px;
                padding: 30px;
            }

            .org-level {
                gap: 25px;
            }

            .org-box {
                width: 240px;
                padding: 20px;
            }

            /* Show connectors on desktop */
            .org-connector {
                background: #666;
                position: absolute;
                display: block;
            }

            .vertical-connector {
                width: 2px;
                height: 30px;
                top: -30px;
                left: 50%;
                transform: translateX(-50%);
                display: block;
            }

            .horizontal-connector-right {
                width: 50%;
                height: 2px;
                top: 50%;
                left: 100%;
                transform: translateY(-50%);
                display: block;
            }

            .horizontal-connector-left {
                width: 50%;
                height: 2px;
                top: 50%;
                right: 100%;
                transform: translateY(-50%);
                display: block;
            }
        }

        /* Tablet Styles (768px to 1023px) */
        @media (min-width: 768px) and (max-width: 1023px) {
            .org-structure {
                width: 90%;
                padding: 20px;
                max-width: 900px;
            }

            .org-level {
                gap: 15px;
            }

            .org-box {
                width: clamp(200px, 25vw, 220px);
                margin: 8px;
            }

            .second-level,
            .third-level {
                flex-wrap: wrap;
                justify-content: center;
            }

            .second-level .org-box,
            .third-level .org-box {
                flex: 0 1 calc(50% - 20px);
                min-width: 200px;
            }
        }

        /* Mobile Styles (480px to 767px) */
        @media (min-width: 480px) and (max-width: 767px) {
            .org-structure {
                width: 95%;
                padding: 15px;
            }

            .org-level {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .org-box {
                width: 100%;
                max-width: 300px;
                margin: 8px 0;
            }

            .second-level,
            .third-level,
            .fourth-level {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Small Mobile Styles (up to 479px) */
        @media (max-width: 479px) {
            .org-structure {
                width: 98%;
                padding: 10px;
                margin: 10px auto;
            }

            .org-structure h1 {
                font-size: 0.9rem;
                line-height: 1.4;
                margin-bottom: 1rem;
                padding: 0 5px;
            }

            .org-level {
                flex-direction: column;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
            }

            .org-box {
                width: 100%;
                max-width: 280px;
                padding: 15px 10px;
                margin: 5px 0;
            }

            .org-box img {
                width: 70px;
                height: 70px;
                margin-bottom: 10px;
            }

            .org-title {
                font-size: 0.75rem;
            }

            .org-name {
                font-size: 0.8rem;
            }

            .org-degree {
                font-size: 0.7rem;
            }
        }

        /* Ultra-wide screens (1600px and up) */
        @media (min-width: 1600px) {
            .org-structure {
                max-width: 1600px;
            }

            .org-box {
                width: 280px;
                padding: 25px;
            }

            .org-level {
                gap: 30px;
            }
        }

        /* Print Styles */
        @media print {
            .org-structure {
                width: 100%;
                max-width: none;
                margin: 0;
                padding: 10px;
            }

            .org-box {
                background: white !important;
                color: black !important;
                border: 2px solid #0275bc !important;
                box-shadow: none !important;
                page-break-inside: avoid;
            }

            .org-level {
                page-break-inside: avoid;
                margin-bottom: 20px;
            }

            .org-structure h1 {
                color: black !important;
                font-size: 1.2rem !important;
            }
        }

        /* Accessibility Improvements */
        @media (prefers-reduced-motion: reduce) {
            .org-box {
                transition: none;
            }

            .org-box:hover {
                transform: none;
            }
        }

        /* High contrast mode */
        @media (prefers-contrast: high) {
            .org-box {
                background: #000080;
                border: 2px solid white;
            }

            .org-structure h1 {
                color: #000;
                font-weight: 700;
            }
        }

        /* Landscape orientation adjustments for mobile */
        @media (max-width: 767px) and (orientation: landscape) {
            .org-level {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .org-box {
                width: calc(50% - 20px);
                min-width: 200px;
                margin: 10px;
            }
        }
    </style>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('/metaprofile')); ?>" class="text-decoration-none">Profil</a>
            </li>
            <li class="breadcrumb-item current-page"><b>struktur Organisasi</b></li>
        </ol>
    </nav>

    <div class="container org-structure">
        <h1 class="text-center mb-4">STRUKTUR ORGANISASI FAKULTAS TEKNOLOGI INDUSTRI <br>
            JURUSAN TEKNIK METALURGI INSTITUT TEKNOLOGI DEL</h1>

        <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $organizations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="org-level">
                <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="org-box">
                        <?php if($level > 0): ?>
                            <div class="org-connector vertical-connector"></div>
                        <?php endif; ?>
                        <?php if(!$loop->first): ?>
                            <div class="org-connector horizontal-connector"></div>
                        <?php endif; ?>

                        <?php if($org->image && file_exists(public_path('storage/' . $org->image))): ?>
                            <img src="<?php echo e(asset('storage/' . $org->image)); ?>" alt="<?php echo e($org->title); ?>">
                        <?php endif; ?>

                        <div class="org-title"><?php echo e($org->title); ?></div>
                        <?php if($org->name): ?>
                            <div class="org-name"><?php echo e($org->name); ?></div>
                        <?php endif; ?>
                        <?php if($org->degree): ?>
                            <div class="org-degree"><?php echo e($org->degree); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/structureorganization.blade.php ENDPATH**/ ?>