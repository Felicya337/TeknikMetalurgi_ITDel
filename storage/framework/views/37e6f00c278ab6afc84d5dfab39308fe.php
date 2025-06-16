<?php $__env->startSection('content'); ?>
    <style>
        /* Research Page Styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .text-decoration-none {
            text-decoration: none !important;
        }

        .current-page {
            color: #6c757d;
            font-weight: 500;
        }

        /* Container Styles */
        .research-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Heading Styles */
        .my-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1.5rem !important;
            text-align: center;
        }

        /* Research Cards */
        .research-card {
            background: white;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .research-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-color: #ffffff;
        }

        .research-body {
            padding: 20px;
        }

        .research-row {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .research-image {
            flex: 0 0 40%;
            max-width: 40%;
        }

        .research-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            border-radius: 5px;
        }

        .research-content {
            flex: 1;
        }

        .research-title {
            font-size: 18px;
            font-weight: bold;
            color: #1976d2;
            margin: 0 0 15px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.3;
        }

        .research-meta {
            margin-bottom: 15px;
            font-size: 14px;
            color: #6c757d;
            line-height: 1.5;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .research-meta strong {
            color: #000000;
            margin-right: 5px;
        }

        .research-meta-item {
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .research-description {
            font-size: 14px;
            color: #000000;
            line-height: 1.6;
            text-align: justify;
            margin: 0;
        }

        .research-description * {
            max-width: 100%;
            box-sizing: border-box;
        }

        .research-description img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .research-description p {
            margin: 0 0 10px 0;
        }

        .research-description ul,
        .research-description ol {
            padding-left: 20px;
            margin: 0 0 10px 0;
        }

        /* File Action Links Styles */
        .file-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .file-link {
            color: #1976d2;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .file-link:hover {
            background-color: #f0f7ff;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .download-link {
            color: #1976d2;
        }

        .download-link:hover {
            color: #0d47a1;
            background-color: #f0f7ff;
        }

        .view-link {
            color: #1976d2;
        }

        .view-link:hover {
            color: #0d47a1;
            background-color: #f0f7ff;
        }

        .bi-download,
        .bi-eye {
            font-size: 1.1rem;
        }

        /* Pagination Styles */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        /* No research alert */
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
            .research-container {
                padding: 15px;
            }

            .research-row {
                flex-direction: column;
                gap: 15px;
            }

            .research-image {
                flex: none;
                max-width: 100%;
            }

            .research-image img {
                height: 200px;
            }

            .research-title {
                font-size: 16px;
            }

            .research-meta {
                font-size: 13px;
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .research-description {
                font-size: 13px;
            }

            .file-actions {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .research-container {
                padding: 10px;
            }

            .research-body {
                padding: 15px;
            }

            .research-image img {
                height: 180px;
            }

            .research-title {
                font-size: 15px;
            }

            .research-meta {
                font-size: 12px;
            }

            .research-description {
                font-size: 12px;
            }

            .file-link {
                font-size: 13px;
                padding: 4px 8px;
            }
        }
    </style>

    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('/penelitian')); ?>" class="text-decoration-none">Penelitian</a>
            </li>
            <li class="breadcrumb-item current-page">Semua Penelitian</li>
        </ol>
    </nav>

    <div class="research-container">
        <h3 class="text-center mb-5 fw-bold">PENELITIAN</h3>


        <?php if($researches->isEmpty()): ?>
            <div class="alert alert-info">
                Tidak ada penelitian yang tersedia saat ini.
            </div>
        <?php else: ?>
            <?php $__currentLoopData = $researches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $research): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="research-card">
                    <div class="research-body">
                        <div class="research-row">
                            <div class="research-image">
                                <?php if($research->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $research->image)); ?>" alt="<?php echo e($research->title); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/placeholder.png')); ?>" alt="No Image Available">
                                <?php endif; ?>
                            </div>
                            <div class="research-content">
                                <h5 class="research-title"><?php echo e($research->title); ?></h5>

                                <div class="research-meta">
                                    <div class="research-meta-item">
                                        <strong>By:</strong> <?php echo e($research->author ?? 'Anonim'); ?>

                                    </div>
                                    <div class="research-meta-item">
                                        <strong>Date:</strong>
                                        <?php echo e($research->date ? \Carbon\Carbon::parse($research->date)->translatedFormat('F Y') : '-'); ?>

                                    </div>
                                    <?php if($research->type): ?>
                                        <div class="research-meta-item">
                                            <strong>Type:</strong> <?php echo e(ucfirst($research->type)); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if($research->file): ?>
                                        <div class="research-meta-item">
                                            <div class="file-actions">
                                                <a href="<?php echo e(asset('storage/' . $research->file)); ?>"
                                                    class="file-link download-link" download title="Download Document">
                                                    <i class="bi bi-download"></i>
                                                    Download
                                                </a>
                                                <a href="<?php echo e(asset('storage/' . $research->file)); ?>"
                                                    class="file-link view-link" target="_blank" title="View Document">
                                                    <i class="bi bi-eye"></i>
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="research-description"><?php echo $research->description; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <div class="pagination-wrapper">
            <?php echo e($researches->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/achievements/research.blade.php ENDPATH**/ ?>