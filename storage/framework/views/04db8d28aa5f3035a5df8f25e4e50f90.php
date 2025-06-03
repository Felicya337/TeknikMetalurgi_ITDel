<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Club Mahasiswa</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
                line-height: 1.6;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            /* Header */
            .header {
                text-align: center;
                padding: 40px 0;
                background: #ffffff;
                margin-bottom: 40px;
            }

            .header h1 {
                font-size: 2.5rem;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 30px;
                letter-spacing: 1px;
            }

            .header p {
                font-size: 1rem;
                color: #6c757d;
                max-width: 900px;
                margin: 0 auto;
                line-height: 1.8;
                text-align: justify;
            }

            /* Club Grid - Horizontal Layout */
            .club-section {
                padding: 20px 0 60px 0;
            }

            .club-grid {
                display: flex;
                justify-content: center;
                gap: 30px;
                flex-wrap: wrap;
                margin-top: 20px;
            }

            .club-card {
                background: #ffffff;
                border-radius: 15px;
                padding: 40px 20px;
                text-align: center;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                cursor: pointer;
                position: relative;
                width: 280px;
                min-height: 160px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border: 1px solid #e9ecef;
            }

            .club-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
                border-color: #2196F3;
            }

            .club-title {
                font-size: 1.4rem;
                font-weight: 600;
                color: #2196F3;
                margin-bottom: 8px;
                line-height: 1.3;
                text-align: center;
            }

            .club-subtitle {
                font-size: 1.1rem;
                color: #2196F3;
                font-weight: 500;
                margin: 0;
                text-align: center;
            }

            /* Modern Modal Styles */
            .modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(15, 23, 42, 0.7);
                backdrop-filter: blur(8px);
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .modal-overlay.active {
                opacity: 1;
                visibility: visible;
            }

            .modal-container {
                background: white;
                border-radius: 24px;
                width: 100%;
                max-width: 680px;
                max-height: 85vh;
                overflow: hidden;
                box-shadow: 0 32px 64px rgba(0, 0, 0, 0.12),
                    0 16px 32px rgba(0, 0, 0, 0.08),
                    0 0 0 1px rgba(255, 255, 255, 0.05);
                transform: scale(0.9) translateY(20px);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                display: flex;
                flex-direction: column;
            }

            .modal-container.active {
                transform: scale(1) translateY(0);
            }

            .modal-header {
                padding: 32px 32px 24px 32px;
                border-bottom: 1px solid #f1f5f9;

                color: rgb(0, 0, 0);
                position: relative;
                overflow: hidden;
            }

            .modal-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.08"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.08"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                pointer-events: none;
            }

            .modal-close {
                position: absolute;
                top: 24px;
                right: 24px;
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                width: 44px;
                height: 44px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                font-size: 18px;
                color: rgb(0, 0, 0);
                z-index: 10;
            }

            .modal-close:hover {
                background: rgba(255, 255, 255, 0.3);
                transform: rotate(90deg) scale(1.1);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            }

            .modal-title {
                font-size: 2rem;
                font-weight: 700;
                margin: 0;
                padding-right: 60px;
                line-height: 1.2;
                position: relative;
                z-index: 5;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .modal-body {
                flex: 1;
                overflow-y: auto;
                padding: 0;
                background: #ffffff;
            }

            .modal-image {
                width: 100%;
                height: 280px;
                overflow: hidden;
                margin: 0;
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            .modal-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .modal-image:hover img {
                transform: scale(1.02);
            }

            .modal-content {
                padding: 32px;
            }

            .modal-content-text {
                font-size: 1.1rem;
                line-height: 1.8;
                color: #475569;
                text-align: justify;
            }

            .modal-content-text p {
                margin-bottom: 20px;
            }

            .modal-content-text p:last-child {
                margin-bottom: 0;
            }

            /* Enhanced Typography */
            .modal-content-text h1,
            .modal-content-text h2,
            .modal-content-text h3,
            .modal-content-text h4 {
                color: #1e293b;
                font-weight: 600;
                margin-top: 24px;
                margin-bottom: 16px;
                line-height: 1.3;
            }

            .modal-content-text ul,
            .modal-content-text ol {
                padding-left: 24px;
                margin-bottom: 20px;
            }

            .modal-content-text li {
                margin-bottom: 8px;
            }

            /* Custom Scrollbar */
            .modal-body::-webkit-scrollbar {
                width: 6px;
            }

            .modal-body::-webkit-scrollbar-track {
                background: #f1f5f9;
            }

            .modal-body::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }

            .modal-body::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            .no-clubs {
                text-align: center;
                padding: 60px 20px;
                color: #6c757d;
                background: white;
                border-radius: 15px;
                margin: 20px 0;
            }

            .no-clubs i {
                font-size: 4rem;
                margin-bottom: 20px;
                color: #dee2e6;
            }

            .no-clubs h3 {
                font-size: 1.5rem;
                margin-bottom: 10px;
                color: #495057;
            }

            .no-clubs p {
                font-size: 1rem;
            }

            /* Breadcrumb */
            .breadcrumbs {
                display: flex;
                list-style: none;
                padding: 0;
                margin: 20px 0;
                font-size: 0.9rem;
            }

            .breadcrumbs li {
                margin-right: 10px;
            }

            .breadcrumbs li:not(:last-child)::after {
                content: ' / ';
                margin-left: 10px;
                color: #6c757d;
            }

            .breadcrumbs a {
                color: #2196F3;
                text-decoration: none;
            }

            .breadcrumbs .current-page {
                color: #6c757d;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .header h1 {
                    font-size: 2rem;
                }

                .header p {
                    font-size: 0.9rem;
                    padding: 0 10px;
                }

                .club-grid {
                    flex-direction: column;
                    align-items: center;
                    gap: 20px;
                }

                .club-card {
                    width: 90%;
                    max-width: 350px;
                    padding: 30px 20px;
                    min-height: 120px;
                }

                .club-title {
                    font-size: 1.2rem;
                }

                .club-subtitle {
                    font-size: 1rem;
                }

                .modal-overlay {
                    padding: 10px;
                }

                .modal-container {
                    max-height: 90vh;
                    border-radius: 20px;
                }

                .modal-header {
                    padding: 24px 24px 20px 24px;
                }

                .modal-title {
                    font-size: 1.6rem;
                    padding-right: 50px;
                }

                .modal-close {
                    width: 40px;
                    height: 40px;
                    top: 20px;
                    right: 20px;
                }

                .modal-content {
                    padding: 24px;
                }

                .modal-image {
                    height: 220px;
                }

                .modal-content-text {
                    font-size: 1rem;
                }
            }

            @media (max-width: 480px) {
                .club-card {
                    width: 95%;
                }

                .container {
                    padding: 0 15px;
                }

                .modal-container {
                    border-radius: 16px;
                }

                .modal-header {
                    padding: 20px;
                }

                .modal-title {
                    font-size: 1.4rem;
                }

                .modal-content {
                    padding: 20px;
                }

                .modal-image {
                    height: 200px;
                }
            }

            /* Animation for cards appearing */
            .club-card {
                animation: fadeInUp 0.6s ease forwards;
                opacity: 0;
                transform: translateY(30px);
            }

            .club-card:nth-child(1) {
                animation-delay: 0.1s;
            }

            .club-card:nth-child(2) {
                animation-delay: 0.2s;
            }

            .club-card:nth-child(3) {
                animation-delay: 0.3s;
            }

            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Loading animation for modal */
            .modal-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                transform: translateX(-100%);
                animation: loading 2s infinite;
                z-index: 1000;
            }

            @keyframes loading {
                0% {
                    transform: translateX(-100%);
                }

                100% {
                    transform: translateX(100%);
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumbs">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(url('/')); ?>" class="text-decoration-none">beranda</a>
                    </li>
                    <li class="breadcrumb-item current-page">Kegiatan Mahasiswa,Kegiatan Prodi,Club Mahasiswa</li>
                </ol>
            </nav>
        </div>

        <!-- Header Section -->
        <div class="header">
            <div class="container">
                <h1>CLUB MAHASISWA</h1>
                <p>
                    Sebagai bagian dari upaya membentuk mahasiswa yang kreatif, adaptif, dan kolaboratif, program studi ini
                    menghadirkan berbagai klub mahasiswa yang dapat menjadi ruang tumbuh bersama di luar kegiatan akademik.
                    Klub-klub ini dirancang untuk mendorong pengembangan soft skills, memperluas jejaring, serta menyalurkan
                    minat dan bakat mahasiswa melalui aktivitas yang positif, inspiratif, dan penuh nilai pembelajaran.
                    Dengan bergabung dalam klub, mahasiswa tidak hanya belajar memimpin dan bekerja sama, tetapi juga
                    berkontribusi dalam membangun budaya kampus yang inklusif dan dinamis.
                </p>
            </div>
        </div>

        <!-- Club Section -->
        <div class="club-section">
            <div class="container">
                <?php if($studentactivities->count() > 0): ?>
                    <div class="club-grid">
                        <?php $__currentLoopData = $studentactivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="club-card" onclick="openModal('modal-<?php echo e($activity->id); ?>')">
                                <h3 class="club-title"><?php echo e($activity->title); ?></h3>
                                <?php if($activity->description): ?>
                                    <p class="club-subtitle"><?php echo Str::limit(strip_tags($activity->description), 50); ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Enhanced Modal for each activity -->
                            <div class="modal-overlay" id="modal-<?php echo e($activity->id); ?>"
                                onclick="closeModal('modal-<?php echo e($activity->id); ?>')">
                                <div class="modal-container" onclick="event.stopPropagation()">
                                    <div class="modal-header">
                                        <h2 class="modal-title"><?php echo e($activity->title); ?></h2>
                                        <button class="modal-close" onclick="closeModal('modal-<?php echo e($activity->id); ?>')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if($activity->image): ?>
                                            <div class="modal-image">
                                                <img src="<?php echo e(asset('storage/' . $activity->image)); ?>"
                                                    alt="<?php echo e($activity->title); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="modal-content">
                                            <div class="modal-content-text">
                                                <?php echo $activity->description; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="no-clubs">
                        <i class="fas fa-users"></i>
                        <h3>Belum Ada Club Mahasiswa</h3>
                        <p>Saat ini belum ada club mahasiswa yang tersedia. Silahkan cek kembali nanti.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <script>
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';

                    // Add active class to modal container with slight delay for animation
                    setTimeout(() => {
                        const container = modal.querySelector('.modal-container');
                        if (container) {
                            container.classList.add('active');
                        }
                    }, 50);
                }
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    const container = modal.querySelector('.modal-container');
                    if (container) {
                        container.classList.remove('active');
                    }

                    // Remove modal overlay after animation completes
                    setTimeout(() => {
                        modal.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }, 400);
                }
            }

            // Close modal when pressing Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const activeModal = document.querySelector('.modal-overlay.active');
                    if (activeModal) {
                        const modalId = activeModal.id;
                        closeModal(modalId);
                    }
                }
            });

            // Enhanced scroll handling
            document.addEventListener('DOMContentLoaded', function() {
                const modals = document.querySelectorAll('.modal-overlay');
                modals.forEach(modal => {
                    const container = modal.querySelector('.modal-container');
                    const body = container.querySelector('.modal-body');

                    // Prevent background scroll when modal is open
                    modal.addEventListener('wheel', function(e) {
                        if (modal.classList.contains('active')) {
                            const isAtTop = body.scrollTop === 0;
                            const isAtBottom = body.scrollTop >= (body.scrollHeight - body
                                .clientHeight);

                            if ((isAtTop && e.deltaY < 0) || (isAtBottom && e.deltaY > 0)) {
                                e.preventDefault();
                            }
                        }
                    }, {
                        passive: false
                    });

                    // Add smooth scroll behavior
                    body.style.scrollBehavior = 'smooth';
                });

                // Add focus trap for accessibility
                document.addEventListener('keydown', function(e) {
                    const activeModal = document.querySelector('.modal-overlay.active');
                    if (activeModal && e.key === 'Tab') {
                        const focusableElements = activeModal.querySelectorAll(
                            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
                        );
                        const firstElement = focusableElements[0];
                        const lastElement = focusableElements[focusableElements.length - 1];

                        if (e.shiftKey) {
                            if (document.activeElement === firstElement) {
                                e.preventDefault();
                                lastElement.focus();
                            }
                        } else {
                            if (document.activeElement === lastElement) {
                                e.preventDefault();
                                firstElement.focus();
                            }
                        }
                    }
                });
            });
        </script>
    </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/student_activity/club.blade.php ENDPATH**/ ?>