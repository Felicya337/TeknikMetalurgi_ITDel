<?php $__env->startSection('content'); ?>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('/penelitian')); ?>" class="text-decoration-none">Prestasi</a>
            </li>
            <li class="breadcrumb-item current-page">Semua Prestasi</li>
        </ol>
    </nav>

    <div class="container">
        <h3 class="text-center mb-5 fw-bold">PRESTASI</h3>


        
        <div id="carouselExampleIndicators" class="carousel slide mb-5">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo e(asset('aset/img/1.jpg')); ?>" class="d-block w-100" alt="Slide 1"
                        style="height: 500px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo e(asset('aset/img/2.jpg')); ?>" class="d-block w-100" alt="Slide 2"
                        style="height: 500px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo e(asset('aset/img/3.jpg')); ?>" class="d-block w-100" alt="Slide 3"
                        style="height: 500px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo e(asset('aset/img/4.jpg')); ?>" class="d-block w-100" alt="Slide 4"
                        style="height: 500px; object-fit: cover;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        
        <div class="mt-5 mb-5">
            <h2 class="text-center fw-bold mb-4">PRESTASI MAHASISWA</h2>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" class="text-primary fw-bold">Nama Kegiatan</th>
                            <th scope="col" class="text-primary fw-bold">Waktu Pelaksanaan</th>
                            <th scope="col" class="text-primary fw-bold">Tingkat</th>
                            <th scope="col" class="text-primary fw-bold">Prestasi yang dicapai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($achievement->nama_kegiatan); ?></td>
                                <td><?php echo e($achievement->waktu_pelaksanaan ? \Carbon\Carbon::parse($achievement->waktu_pelaksanaan)->format('d M Y') : '-'); ?>

                                </td>
                                <td><?php echo e(ucfirst($achievement->tingkat ?? 'Kampus')); ?></td>
                                <td><?php echo e($achievement->prestasi_yang_dicapai ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada data prestasi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="text-center mb-4">
            <button class="btn btn-outline-primary" onclick="toggleView()">
                <i class="bi bi-eye"></i> Toggle View
            </button>
        </div>

        
        <div class="mt-5 mb-5" id="cardLayout" style="display: none;">
            <h3 class="mb-4">Detail Prestasi</h3>

            <?php $__empty_1 = true; $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($achievement->nama_kegiatan); ?></h5>
                        <p class="mb-1 text-muted">
                            <strong>Date:</strong>
                            <?php echo e($achievement->waktu_pelaksanaan ? \Carbon\Carbon::parse($achievement->waktu_pelaksanaan)->format('F Y') : 'N/A'); ?>

                            <strong>Type:</strong>
                            <?php echo e(ucfirst($achievement->tingkat ?? 'Akademik')); ?>

                        </p>
                        <p class="card-text">
                            <?php echo e($achievement->prestasi_yang_dicapai ?? 'Prestasi akademik yang membanggakan'); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Belum ada data prestasi yang tersedia.
                </div>
            <?php endif; ?>
        </div>

        
        <?php if($achievements->hasPages()): ?>
            <div class="d-flex justify-content-center mb-5">
                <?php echo e($achievements->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .table th {
            background-color: #ffffff !important;
            color: #ffffff !important;
            font-weight: 600;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>td {
            background-color: rgba(0, 0, 0, .05);
        }

        .table-hover>tbody>tr:hover>td {
            background-color: rgba(0, 0, 0, .075);
        }

        .carousel-item img {
            border-radius: 10px;
        }

        h1,
        h2 {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .container {
            padding-bottom: 2rem;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function toggleView() {
            const cardLayout = document.getElementById('cardLayout');
            const tableLayout = document.querySelector('.table-responsive').parentElement;

            if (cardLayout.style.display === 'none') {
                cardLayout.style.display = 'block';
                tableLayout.style.display = 'none';
            } else {
                cardLayout.style.display = 'none';
                tableLayout.style.display = 'block';
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/achievements/achievement.blade.php ENDPATH**/ ?>