<?php $__env->startSection('content'); ?>
    <!-- Breadcrumbs -->
    <nav class="breadcrumbs">
        <a href="<?php echo e(route('news')); ?>">Berita</a>
        <span class="separator">/</span>
        <span class="current-page"><b><?php echo e(Str::limit($newsItem->title, 1000)); ?></b></span>
    </nav>

    <!-- Main Container -->
    <div class="main-layout">
        <!-- Article Area -->
        <article class="news-detail-article-area">
            <header class="news-header-image-container with-bg">
                <?php if($newsItem->image): ?>
                    <img src="<?php echo e(asset('storage/' . $newsItem->image)); ?>" alt="<?php echo e($newsItem->title); ?>" loading="lazy">
                <?php else: ?>
                    <img src="https://via.placeholder.com/800x300/667eea/ffffff?text=News+Image"
                        alt="<?php echo e($newsItem->title); ?>" loading="lazy">
                <?php endif; ?>
                <div class="news-title-overlay">
                    <h1><?php echo e($newsItem->title); ?></h1>
                </div>
            </header>

            <div class="article-content-wrapper">
                <div class="news-content-prose">
                    <?php echo $newsItem->description; ?>

                </div>
            </div>
        </article>

        <!-- Sidebar -->
        <?php if($recentNews->isNotEmpty()): ?>
            <aside class="sidebar-area">
                <h3 class="sidebar-title">RILIS BERITA</h3>
                <ul class="recent-news-list">
                    <?php $__currentLoopData = $recentNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('newsdetail', $item->id)); ?>"><?php echo e($item->title); ?></a>
                            <div class="recent-news-meta">
                                <span><i class="fas fa-calendar-alt"></i>
                                    <?php echo e(\Carbon\Carbon::parse($item->date)->translatedFormat('d F Y')); ?></span>
                                <span><i class="fas fa-user"></i> <?php echo e($item->author); ?></span>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </aside>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/newsdetail.blade.php ENDPATH**/ ?>