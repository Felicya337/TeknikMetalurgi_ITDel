<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website Teknik Metalurgi Institut Teknologi Del">
    <meta name="author" content="Tim Pengembang Teknik Metalurgi IT Del">
    <title>Teknik Metalurgi | IT Del</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('aset/img/logo.png')); ?>">
    <link href="<?php echo e(asset('aset/css/styles.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('aset/css/feli.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('aset/css/hero.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body id="top">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar-top fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/aset/img/logo.png" alt="Logo Del" class="logo-img">
                <div class="divider"></div>
                <div class="brand-text">
                    <div class="brand-title">TEKNIK METALURGI</div>
                    <div class="brand-subtitle">INSTITUT TEKNOLOGI DEL</div>
                </div>
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavPrimaryAndSecondary" aria-controls="navbarNavPrimaryAndSecondary"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavPrimaryAndSecondary">
                <ul class="navbar-nav nav-links-custom">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfil" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Profil</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownProfil">
                            <li><a class="dropdown-item" href="/metaprofile">Profil Umum</a></li>
                            <li><a class="dropdown-item" href="/curriculum">Kurikulum</a></li>
                            <li><a class="dropdown-item" href="/structureorganization">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="/lecturer">Dosen Staff</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPrestasi" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Prestasi</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownPrestasi">
                            <li><a class="dropdown-item" href="/achievements/publication">Publikasi</a></li>
                            <li><a class="dropdown-item" href="/achievements/research">Penelitian</a></li>
                            <li><a class="dropdown-item" href="/achievements/achievement">Pencapaian</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="/facility">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/laboratory">Laboratorium</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownKegiatan" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Kegiatan</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownKegiatan">
                            <li><a class="dropdown-item" href="/student_activity/activity">Kegiatan Mahasiswa</a></li>
                            <li><a class="dropdown-item" href="/student_activity/program">Kegiatan Prodi</a></li>
                            <li><a class="dropdown-item" href="/student_activity/club">Club Mahasiswa</a></li>
                        </ul>
                    </li>
                </ul>

                <form class="d-flex ms-auto mt-2 mt-lg-0 search-bar" role="search" id="searchForm">
                    <input class="form-control search-input" type="search" placeholder="Cari Informasi"
                        aria-label="Search" name="query" id="searchInput">
                    <button class="btn search-button" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Header / Hero -->
    <header id="header-section">
        <div class="image-container position-relative">
            <video class="bg-video" autoplay muted loop playsinline>
                <source src="<?php echo e(asset('aset/img/HEADER.mp4')); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="content-overlay d-flex flex-column justify-content-center align-items-center text-center">
                <img class="img-fluid-head mb-3" src="<?php echo e(asset('aset/img/logo.png')); ?>" alt="Logo"
                    width="90">
                <h3 class="text-white fw-bold welcome-text">SELAMAT DATANG DI</h3>
                <h2 class="text-white fw-bold title-text">TEKNIK METALURGI</h2>
                <p class="text-white fw-semibold subtitle-text">INSTITUT TEKNOLOGI DEL</p>
                <p class="text-white slogan-text">Shaping the World Through Metals</p>
                <div class="image-logos-container">
                    <img class="logo-image" src="<?php echo e(asset('aset/img/kampus.png')); ?>" alt="Kampus" width="70">
                    <img class="logo-image" src="<?php echo e(asset('aset/img/akreditasi.png')); ?>" alt="Akreditasi"
                        width="70">
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Poster Section -->
    <section class="hero-section" id="hero-section">
        <div class="hero">
            <img src="<?php echo e(asset('aset/img/poster.png')); ?>" alt="Gedung Teknik Metalurgi IT Del"
                class="background-img">
            <div class="overlay"></div>
            <div class="container">
                <div class="hero-content text-center">
                    <div class="title-container mb-4">
                        <h1>TEKNIK METALURGI IT DEL</h1>
                    </div>

                    <div class="content-box description-box mx-auto mb-4">
                        <p class="description-text">
                            Teknik Metalurgi adalah bidang ilmu teknik yang mempelajari proses ekstraksi, pengolahan,
                            karakterisasi, dan rekayasa material logam agar dapat dimanfaatkan secara optimal dalam
                            berbagai sektor industri. Teknik Metalurgi IT Del dikembangkan untuk menjawab tantangan
                            industri modern dengan pendekatan yang terintegrasi antara teori, praktik laboratorium, dan
                            pemanfaatan teknologi terkini. Fokus utamanya mencakup metalurgi ekstraktif, fisik, dan
                            mekanik, serta
                            pengembangan material yang ramah lingkungan dan berkelanjutan. Melalui program ini,
                            mahasiswa dibekali dengan kompetensi teknis, analitis, serta etika profesi yang kuat,
                            sehingga mampu
                            berkontribusi dalam inovasi teknologi material dan mendukung pembangunan industri nasional.
                        </p>
                    </div>

                    <div class="separator-line mx-auto mb-4"></div>

                    <div class="content-box inform-box mx-auto mb-4">
                        <h2 class="animated-text">INGIN TAU LEBIH BANYAK TENTANG TEKNIK METALURGI IT DEL?</h2>
                    </div>

                    <div class="button-container">
                        <a href="https://semat.del.ac.id/beasiswa" class="btn btn-custom-white">INFORMASI BEASISWA</a>
                        <a href="https://semat.del.ac.id/admisi" class="btn btn-custom-white">PENERIMAAN MAHASISWA
                            BARU</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <div class="news-container" id="news-section">
        <h3 class="my-4 mb-5 text-center"><strong>BERITA TERBARU</strong></h3>
        <div class="row justify-content-center">
            <?php if(isset($news) && $news->count() > 0): ?>
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="news-card">
                            <div class="news-image-container">
                                <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="<?php echo e($item->title); ?>"
                                    class="news-image">
                            </div>
                            <div class="news-title">
                                <a href="<?php echo e(route('newsdetail', $item->id)); ?>"
                                    class="news-title-link"><?php echo e($item->title); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p class="text-center">Belum ada berita.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo e(route('news')); ?>" class="btn btn-outline-primary">Semua Berita</a>
        </div>
    </div>

    <!-- Testimonials Section -->
    <section class="testimonial-section py-5" id="testimonial-section">
        <div class="container">
            <h3 class="text-center mb-5 fw-bold">TESTIMONI</h3>
            <div class="testimonial-wrapper">
                <!-- Navigation Arrows - OUTSIDE carousel container -->
                <button class="nav-arrow left" onclick="moveTestimonial(-1)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <polygon points="15,6 9,12 15,18" fill="#333" />
                    </svg>
                </button>
                <button class="nav-arrow right" onclick="moveTestimonial(1)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <polygon points="9,6 15,12 9,18" fill="#333" />
                    </svg>
                </button>

                <div class="testimonial-carousel-container">
                    <div class="testimonial-carousel" id="testimonialCarousel">
                        <!-- Testimonial cards will be populated by PHP/Laravel -->
                        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="testimonial-card">
                                <div class="testimonial-image-wrapper">
                                    <img src="<?php echo e($testimonial->image ? asset('storage/' . $testimonial->image) : 'https://via.placeholder.com/150'); ?>"
                                        alt="<?php echo e($testimonial->name); ?>" class="testimonial-image">
                                </div>
                                <div class="testimonial-header text-center mt-3">
                                    <div class="testimonial-info"><?php echo e($testimonial->name); ?></div>
                                    <p class="job">(<?php echo e($testimonial->student); ?>)</p>
                                </div>
                                <blockquote class="testimonial-content mt-3"><?php echo $testimonial->content; ?></blockquote>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Collaboration Section -->
    <section class="kerjasama-section" id="kerjasama-section">
        <h3 class="section-title"><strong>KERJA SAMA</strong></h3>

        <?php if(count($collaborates) > 0): ?>
            <div class="slider-container">
                <!-- Navigation Arrows - OUTSIDE carousel container -->
                <button class="nav-arrow left" onclick="moveKerjasama(-1)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <polygon points="15,6 9,12 15,18" fill="#000000" />
                    </svg>
                </button>
                <button class="nav-arrow right" onclick="moveKerjasama(1)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <polygon points="9,6 15,12 9,18" fill="#000000" />
                    </svg>
                </button>
                <div class="kerjasama-container">
                    <?php
                        // Split collaborations into chunks of 3 for each row
                        $chunkedCollaborations = $collaborates->chunk(3);
                    ?>

                    <?php $__currentLoopData = $chunkedCollaborations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="kerjasama-row">
                            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="kerjasama-item" data-title="<?php echo e(addslashes($data->institution_name)); ?>"
                                    data-company-profile="<?php echo e(json_encode($data->company_profile)); ?>"
                                    data-description="<?php echo e(json_encode($data->institution_description)); ?>"
                                    onclick="showCollaborationModal(this.getAttribute('data-title'), this.getAttribute('data-company-profile'), this.getAttribute('data-description'))">
                                    <?php if($data->logo): ?>
                                        <img src="<?php echo e(asset('storage/' . $data->logo)); ?>"
                                            alt="logo <?php echo e($data->institution_name); ?>" class="institution-logo"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Klik untuk detail">
                                    <?php endif; ?>
                                    <span class="tanggal">Tanggal Kerjasama:
                                        <?php echo e(\Carbon\Carbon::parse($data->date)->format('d F Y')); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="no-collaborations">
                <p>Tidak ada kerjasama</p>
            </div>
        <?php endif; ?>
    </section>

    <!-- Modal for Collaboration Details -->
    <div class="modal fade" id="collaborationModal" tabindex="-1" aria-labelledby="collaborationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="collaborationModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <h6 class="section-subtitle">Profil Perusahaan</h6>
                        <div id="modalCompanyProfile" class="profil-content"></div>
                    </div>
                    <div>
                        <h6 class="section-subtitle">Deskripsi Kerjasama</h6>
                        <div id="modalInstitutionDescription" class="profil-content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer id="footer-section">
        <div class="footer-top">
            <div class="footer-info">
                <div class="footer-item" data-bs-toggle="modal" data-bs-target="#chatModal">
                    <div class="img-container">
                        <img src="<?php echo e(asset('aset/img/help circle.PNG')); ?>" alt="Chat Box Icon">
                    </div>
                    <div>
                        <h4>Chat Box</h4>
                        <p>Jika ingin bertanya lebih lanjut,<br>dapat menghubungi</p>
                    </div>
                </div>
                <div class="footer-item">
                    <div class="img-container">
                        <img src="<?php echo e(asset('aset/img/Clock.PNG')); ?>" alt="Hours Icon">
                    </div>
                    <div>
                        <h4>Hours</h4>
                        <p>08.00 am – 05.00 pm</p>
                    </div>
                </div>
                <div class="footer-item" data-bs-toggle="modal" data-bs-target="#chatModal" data-bs-tab="review">
                    <div class="img-container">
                        <img src="<?php echo e(asset('aset/img/Pen tool.PNG')); ?>" alt="Review Icon">
                    </div>
                    <div>
                        <h4>Review</h4>
                        <p>Kami membutuhkan tanggapan anda<br>terhadap website kami</p>
                    </div>

                    <div class="footer-item arrow-up" id="arrowUp">
                        <div class="img-container">
                            <img src="<?php echo e(asset('aset/img/Icon.png')); ?>" alt="Arrow Up Icon" onclick="scrollToTop()">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-container">
                <!-- Kiri: Logo + Nama Fakultas -->
                <div class="footer-left">
                    <img src="<?php echo e(asset('aset/img/logo.png')); ?>" alt="Logo Del" class="logo-original">
                    <div class="fakultas-title">
                        <div class="baris-1">FAKULTAS TEKNOLOGI INDUSTRI</div>
                        <div class="baris-2">TEKNIK METALURGI</div>
                        <div class="baris-2">INSTITUT TEKNOLOGI DEL</div>
                    </div>
                </div>

                <!-- Tengah: Tentang Kami -->
                <div class="footer-middle">
                    <h3>TENTANG KAMI</h3>
                    <p><a href="<?php echo e(url('/metaprofile')); ?>">Sejarah</a></p>
                    <p><a href="<?php echo e(url('/metaprofile#visi-misi')); ?>">Visi dan Misi dan Tujuan</a></p>
                    <p><a class="dropdown-item" href="<?php echo e(route('structureorganization')); ?>">Struktur Organisasi</a>
                    </p>
                    <p><a href="https://maps.app.goo.gl/tc8HA3Ce9GvYimVF9" target="_blank">Lokasi kampus</a></p>
                </div>

                <!-- Kanan: Kontak -->
                <div class="footer-right">
                    <h3>KONTAK KAMI</h3>
                    <p><i class="fas fa-phone-alt"></i> +62 632 331234</p>
                    <p>
                        <a href="https://www.instagram.com/metalurgidel?igsh=Y2Y4M3pqancxdHdn" target="_blank"
                            class="social-link">
                            <i class="fab fa-instagram"></i> metalurgidel
                        </a>
                    </p>
                    <p><i class="fas fa-map-marker-alt"></i> Institut Teknologi Del Jl. Sisingamangaraja, Sitoluama
                        Laguboti, Toba Samosir Sumatera Utara, Indonesia</p>
                    <p>
                        <a href="mailto:info@del.ac.id" class="social-link">
                            <i class="fas fa-envelope"></i> info@del.ac.id
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-credits">
            Dibuat oleh: Felicya, Joy, Kesia, Ellysabeth dan Nathaly (Mahasiswa D3TI 2024 & S1 MR 2021)
        </div>
    </footer>


    <!-- Chat Modal (Sekaligus untuk Review) -->
    <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatModalLabel">
                        <i class="fas fa-comments me-2"></i>
                        Layanan Pengguna
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="chatTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="question-tab" data-bs-toggle="tab"
                                data-bs-target="#question-pane" type="button" role="tab">
                                <i class="fas fa-question-circle me-1"></i>
                                PERTANYAAN
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                data-bs-target="#review-pane" type="button" role="tab">
                                <i class="fas fa-star me-1"></i>
                                REVIEW
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="chatTabContent">
                        <!-- Question Tab -->
                        <div class="tab-pane fade show active" id="question-pane" role="tabpanel">
                            <div class="description-text">
                                <strong>PERTANYAAN PENGGUNA WEBSITE PRODI TEKNIK METALURGI IT DEL</strong><br>
                                Layanan ini disediakan untuk mengumpulkan informasi tentang permasalahan-permasalahan
                                dan pertanyaan seputar informasi Program Studi Teknik Metalurgi IT Del.
                            </div>

                            <form id="questionForm">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="Masukkan email Anda" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Anda adalah:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="userType"
                                            id="internal" value="internal" required>
                                        <label class="form-check-label" for="internal">
                                            Mahasiswa/Dosen/Staff IT Del
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="userType"
                                            id="masyarakat" value="masyarakat" required>
                                        <label class="form-check-label" for="masyarakat">
                                            Masyarakat Umum
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="question" class="form-label">Pertanyaan</label>
                                    <textarea class="form-control" id="question"
                                        placeholder="Mohon tulis pertanyaan dengan lengkap beserta data tambahan yang diperlukan." required></textarea>
                                </div>

                                <div class="d-flex gap-2 justify-content-end">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-1"></i>
                                        KIRIM
                                    </button>
                                </div>
                            </form>

                            <!-- Confirmation Message -->
                            <div id="questionConfirmation" class="confirmation-message text-center d-none"
                                role="alert">
                                <h4 class="text-primary">TERIMA KASIH ATAS PERTANYAAN ANDA!</h4>
                                <p class="description-text">Pertanyaan Anda akan segera diproses oleh admin.</p>
                                <p class="description-text">Jawaban akan dikirim melalui email yang Anda masukkan.</p>
                                <button type="button" class="btn btn-primary mt-3"
                                    data-bs-dismiss="modal">TUTUP</button>
                            </div>
                        </div>

                        <!-- Review Tab -->
                        <div class="tab-pane fade" id="review-pane" role="tabpanel">
                            <div class="description-text">
                                <strong>REVIEW WEBSITE PRODI TEKNIK METALURGI IT DEL</strong><br>
                                Berikan review dan masukan Anda untuk membantu kami meningkatkan layanan website.
                            </div>

                            <form id="reviewForm">
                                <div class="mb-3">
                                    <label for="reviewEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="reviewEmail"
                                        placeholder="Masukkan email Anda" required>
                                </div>

                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating Website</label>
                                    <select class="form-select" id="rating" required>
                                        <option value="">Pilih rating...</option>
                                        <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                        <option value="4">⭐⭐⭐⭐ Baik</option>
                                        <option value="3">⭐⭐⭐ Cukup</option>
                                        <option value="2">⭐⭐ Kurang</option>
                                        <option value="1">⭐ Sangat Kurang</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="reviewText" class="form-label">Review & Saran</label>
                                    <textarea class="form-control" id="reviewText"
                                        placeholder="Berikan review dan saran Anda untuk perbaikan website ini..." required></textarea>
                                </div>

                                <div class="d-flex gap-2 justify-content-end">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-star me-1"></i>
                                        KIRIM REVIEW
                                    </button>
                                </div>
                            </form>

                            <!-- Confirmation Message -->
                            <div id="reviewConfirmation" class="confirmation-message text-center d-none"
                                role="alert">
                                <h4 class="text-primary">TERIMA KASIH ATAS REVIEW ANDA!</h4>
                                <p class="description-text">Masukan Anda sangat berharga bagi kami.</p>
                                <button type="button" class="btn btn-primary mt-3"
                                    data-bs-dismiss="modal">TUTUP</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notifikasi</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Formulir berhasil dikirim! Terima kasih atas masukan Anda.
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('aset/js/feli.js')); ?>"></script>
    <script src="<?php echo e(asset('aset/js/scripts.js')); ?>"></script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/home.blade.php ENDPATH**/ ?>