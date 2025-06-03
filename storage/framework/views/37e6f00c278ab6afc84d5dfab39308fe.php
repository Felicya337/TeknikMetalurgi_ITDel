<?php $__env->startSection('content'); ?>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('/penelitian')); ?>" class="text-decoration-none">Penelitian</a>
            </li>
            <li class="breadcrumb-item current-page">Semua Penelitian</li>
        </ol>
    </nav>

    <div class="container">
        <h1 class="my-4">Penelitian</h1>

        <?php $__currentLoopData = $researches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $research): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-4 shadow-sm">
                <div class="row no-gutters align-items-center">
                    <?php if($research->image): ?>
                        <div class="col-md-4">
                            <img src="<?php echo e(asset('storage/' . $research->image)); ?>" class="img-fluid p-3"
                                alt="<?php echo e($research->title); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($research->title); ?></h5>
                            <p class="mb-1 text-muted">
                                <strong>By:</strong> <?php echo e($research->author ?? 'Anonim'); ?>


                                <strong>Date:</strong>
                                <?php echo e($research->date ? \Carbon\Carbon::parse($research->date)->translatedFormat('F Y') : '-'); ?>

                                <?php if($research->type): ?>
                                    <strong>Type:</strong> <?php echo e(ucfirst($research->type)); ?>

                                <?php endif; ?>
                                <?php if($research->file): ?>
                                    <a href="<?php echo e(asset('storage/' . $research->file)); ?>" class="ms-2" download
                                        title="Download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                <?php endif; ?>
                            </p>
                            <p class="card-text"><?php echo e($research->description); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="d-flex justify-content-center">
            <?php echo e($researches->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/achievements/research.blade.php ENDPATH**/ ?>