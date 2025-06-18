<?php $__env->startSection('title', 'Selamat Datang Admin!'); ?>

<?php $__env->startSection('header', 'Selamat Datang, Admin!'); ?>

<?php $__env->startSection('subtitle', 'Kumpulan Data'); ?>

<?php $__env->startSection('content'); ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #e0e7ff;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --success: #10b981;
            --info: #06b6d4;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #1e293b;
            --gray: #64748b;
            --card-bg: #ffffff;
            --body-bg: #f1f5f9;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            color: var(--dark);
            line-height: 1.6;
        }

        .container-fluid {
            max-width: 1400px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 2rem;
            background-color: var(--card-bg);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: var(--card-bg);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem 2rem;
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--dark);
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 12px;
            color: var(--primary);
        }

        .card-body {
            padding: 2rem;
        }

        .data-card {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, var(--card-gradient-1) 0%, var(--card-gradient-2) 100%);
            color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            text-decoration: none;
        }

        .data-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            text-decoration: none;
            color: white;
        }

        .data-card .card-content {
            padding: 1.75rem;
            flex: 1;
            position: relative;
        }

        .data-card .card-title {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .data-card .card-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 2.5rem;
            opacity: 0.15;
            transition: opacity 0.3s ease;
        }

        .data-card:hover .card-icon {
            opacity: 0.2;
        }

        .data-card .card-footer {
            background: rgba(255, 255, 255, 0.15);
            padding: 0.75rem 1rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .data-card .card-footer i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .data-card:hover .card-footer {
            background: rgba(255, 255, 255, 0.25);
        }

        .data-card:hover .card-footer i {
            transform: translateX(3px);
        }

        .data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        @media (max-width: 992px) {
            .data-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .card-header {
                padding: 1.25rem;
                font-size: 1.1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .data-card .card-content {
                padding: 1.25rem;
            }

            .data-card .card-icon {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .data-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-database"></i>
                        Kumpulan Data
                    </div>
                    <div class="card-body">
                        <div class="data-grid">
                            <a href="<?php echo e(route('admin.news.index')); ?>" class="data-card"
                                style="--card-gradient-1: #6366f1; --card-gradient-2: #8b5cf6;">
                                <div class="card-content">
                                    <div class="card-title">Berita</div>
                                    <i class="fas fa-newspaper card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.testimonial.index')); ?>" class="data-card"
                                style="--card-gradient-1: #ec4899; --card-gradient-2: #f43f5e;">
                                <div class="card-content">
                                    <div class="card-title">Testimoni</div>
                                    <i class="fas fa-comment-alt card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.collaborate.index')); ?>" class="data-card"
                                style="--card-gradient-1: #10b981; --card-gradient-2: #059669;">
                                <div class="card-content">
                                    <div class="card-title">Kerjasama</div>
                                    <i class="fas fa-handshake card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.metaprofile.index')); ?>" class="data-card"
                                style="--card-gradient-1: #06b6d4; --card-gradient-2: #0ea5e9;">
                                <div class="card-content">
                                    <div class="card-title">Meta Profile</div>
                                    <i class="fas fa-plane card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.curriculum.index')); ?>" class="data-card"
                                style="--card-gradient-1: #f59e0b; --card-gradient-2: #f97316;">
                                <div class="card-content">
                                    <div class="card-title">Kurikulum</div>
                                    <i class="fas fa-calendar-alt card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.achievement.index')); ?>" class="data-card"
                                style="--card-gradient-1: #8b5cf6; --card-gradient-2: #a855f7;">
                                <div class="card-content">
                                    <div class="card-title">Publikasi dan Penelitian</div>
                                    <i class="fas fa-star card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.facility.index')); ?>" class="data-card"
                                style="--card-gradient-1: #3b82f6; --card-gradient-2: #2563eb;">
                                <div class="card-content">
                                    <div class="card-title">Fasilitas</div>
                                    <i class="fas fa-building card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.laboratory.index')); ?>" class="data-card"
                                style="--card-gradient-1: #84cc16; --card-gradient-2: #65a30d;">
                                <div class="card-content">
                                    <div class="card-title">Laboratorium</div>
                                    <i class="fas fa-flask card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.lecturer.index')); ?>" class="data-card"
                                style="--card-gradient-1: #64748b; --card-gradient-2: #475569;">
                                <div class="card-content">
                                    <div class="card-title">Dosen</div>
                                    <i class="fas fa-user-tie card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.structure_organization.index')); ?>" class="data-card"
                                style="--card-gradient-1: #6b7280; --card-gradient-2: #4b5563;">
                                <div class="card-content">
                                    <div class="card-title">Struktur Dosen</div>
                                    <i class="fas fa-sitemap card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.studentactivity.index')); ?>" class="data-card"
                                style="--card-gradient-1: #d946ef; --card-gradient-2: #c026d3;">
                                <div class="card-content">
                                    <div class="card-title">Kegiatan Mahasiswa</div>
                                    <i class="fas fa-users card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.inquiries.index')); ?>" class="data-card"
                                style="--card-gradient-1: #ef4444; --card-gradient-2: #dc2626;">
                                <div class="card-content">
                                    <div class="card-title">Pertanyaan & Ulasan</div>
                                    <i class="fas fa-envelope card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo e(route('admin.student_achievement.index')); ?>" class="data-card"
                                style="--card-gradient-1: #8b5cf6; --card-gradient-2: #a855f7;">
                                <div class="card-content">
                                    <div class="card-title">Prestasi Mahasiswa</div>
                                    <i class="fas fa-star card-icon"></i>
                                </div>
                                <div class="card-footer">
                                    Kelola <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="adminNotificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notifikasi Baru</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Ada <span id="notificationType"></span> baru dari <span id="notificationEmail"></span>!
                <a href="<?php echo e(route('admin.inquiries.index')); ?>" class="btn btn-sm btn-primary mt-2">Lihat</a>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>