<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website Teknik Metalurgi Institut Teknologi Del">
    <meta name="author" content="Tim Pengembang Teknik Metalurgi IT Del">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Teknik Metalurgi | IT Del</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('aset/img/logo.png')); ?>">
    <link href="<?php echo e(asset('aset/css/styles.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('aset/css/feli.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                            <li><a class="dropdown-item" href="/achievements/achievement">Prestasi</a></li>
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

    <!-- Content Section -->
    <?php echo $__env->yieldContent('content'); ?>

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
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/layouts/main.blade.php ENDPATH**/ ?>