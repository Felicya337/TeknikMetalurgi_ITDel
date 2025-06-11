<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #343A40;">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link d-flex align-items-center p-3"
        style="text-decoration: none;">
        <img src="<?php echo e(asset('adminlte/dist/img/AdminLTELogo.png')); ?>" alt="IT Del Logo" class="brand-image elevation-3"
            style="opacity: .8; width: 40px; height: auto; border-radius: 0;">
        <span class="brand-text font-weight-light ml-2" style="font-size: 1.2rem; font-weight: bold; color: white;">IT
            Del</span>
    </a>

    <!-- Sidebar Search -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo e(route('admin.inquiries.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.inquiries.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>Pertanyaan & Review</p>
                </a>
            </li>


            <!-- Berita -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.news.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.news.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>Berita</p>
                </a>
            </li>

            <!-- Testimoni -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.testimonial.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.testimonial.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-comment-alt"></i>
                    <p>Testimoni</p>
                </a>
            </li>

            <!-- Kerjasama -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.collaborate.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.collaborate.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>Kerjasama</p>
                </a>
            </li>

            <!-- Meta Profile -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.metaprofile.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.metaprofile.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-plane"></i>
                    <p>Meta Profile</p>
                </a>
            </li>

            <!-- Kurikulum -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.curriculum.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.curriculum.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>Kurikulum</p>
                </a>
            </li>

            <!-- Prestasi -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.achievement.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.achievement.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-star"></i>
                    <p>Prestasi</p>
                </a>
            </li>

            <!-- Fasilitas -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.facility.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.facility.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-building"></i>
                    <p>Fasilitas</p>
                </a>
            </li>

            <!-- Laboratorium -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.laboratory.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.laboratory.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-flask"></i>
                    <p>Laboratorium</p>
                </a>
            </li>

            <!-- Dosen -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.lecturer.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.lecturer.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>Dosen & Staff</p>
                </a>
            </li>

            <!-- Struktur Dosen -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.structure_organization.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.structure_organization.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>Struktur Dosen</p>
                </a>
            </li>

            <!-- Kegiatan Mahasiswa -->
            <li class="nav-item">
                <a href="<?php echo e(route('admin.studentactivity.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('admin.studentactivity.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Kegiatan Mahasiswa</p>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>