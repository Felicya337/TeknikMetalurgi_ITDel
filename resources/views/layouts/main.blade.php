<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website Teknik Metalurgi Institut Teknologi Del">
    <meta name="author" content="Tim Pengembang Teknik Metalurgi IT Del">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Teknik Metalurgi | IT Del</title>
    <link rel="icon" type="image/png" href="{{ asset('aset/img/logo.png') }}">
    <link href="{{ asset('aset/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('aset/css/feli.css') }}" rel="stylesheet">
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

    <!-- Content Section -->
    @yield('content')

    <!-- Footer -->
    <footer id="footer-section">
        <div class="footer-top">
            <div class="footer-info">
                <div class="footer-item">
                    <div class="img-container">
                        <img src="{{ asset('aset/img/help circle.PNG') }}" alt="Chat Box Icon">
                    </div>
                    <div>
                        <h4>Chat Box</h4>
                        <p>Jika ingin bertanya lebih lanjut,<br>dapat menghubungi</p>
                    </div>
                </div>
                <div class="footer-item">
                    <div class="img-container">
                        <img src="{{ asset('aset/img/Clock.PNG') }}" alt="Hours Icon">
                    </div>
                    <div>
                        <h4>Hours</h4>
                        <p>08.00 am – 05.00 pm</p>
                    </div>
                </div>
                <div class="footer-item">
                    <div class="img-container">
                        <img src="{{ asset('aset/img/Pen tool.PNG') }}" alt="Review Icon">
                    </div>
                    <div>
                        <h4>Review</h4>
                        <p>Kami membutuhkan tanggapan anda<br>terhadap website kami</p>
                    </div>
                </div>
                <div class="footer-item arrow-up" id="arrowUp">
                    <div class="img-container">
                        <img src="{{ asset('aset/img/Icon.png') }}" alt="Arrow Up Icon" onclick="scrollToTop()">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-container">
                <!-- Kiri: Logo + Nama Fakultas -->
                <div class="footer-left">
                    <img src="{{ asset('aset/img/logo.png') }}" alt="Logo Del" class="logo-original">
                    <div class="fakultas-title">
                        <div class="baris-1">FAKULTAS TEKNOLOGI INDUSTRI</div>
                        <div class="baris-2">TEKNIK METALURGI</div>
                        <div class="baris-2">INSTITUT TEKNOLOGI DEL</div>
                    </div>
                </div>

                <!-- Tengah: Tentang Kami -->
                <div class="footer-middle">
                    <h3>TENTANG KAMI</h3>
                    <p><a href="{{ url('/metaprofile') }}">Sejarah</a></p>
                    <p><a href="{{ url('/metaprofile#visi-misi') }}">Visi dan Misi dan Tujuan</a></p>
                    <p><a class="dropdown-item" href="{{ route('structureorganization') }}">Struktur Organisasi</a>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('aset/js/feli.js') }}"></script>
    <script src="{{ asset('aset/js/scripts.js') }}"></script>

</body>

</html>
