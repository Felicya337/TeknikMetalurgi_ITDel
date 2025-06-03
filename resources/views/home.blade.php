<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website Teknik Metalurgi Institut Teknologi Del">
    <meta name="author" content="Tim Pengembang Teknik Metalurgi IT Del">
    <title>Teknik Metalurgi | IT Del</title>
    <link rel="icon" type="image/png" href="{{ asset('aset/img/logo.png') }}">
    <link href="{{ asset('aset/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('aset/css/feli.css') }}" rel="stylesheet">
    <link href="{{ asset('aset/css/hero.css') }}" rel="stylesheet">
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
                <source src="{{ asset('aset/img/HEADER.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="content-overlay d-flex flex-column justify-content-center align-items-center text-center">
                <img class="img-fluid-head mb-3" src="{{ asset('aset/img/logo.png') }}" alt="Logo"
                    width="90">
                <h3 class="text-white fw-bold welcome-text">SELAMAT DATANG DI</h3>
                <h2 class="text-white fw-bold title-text">TEKNIK METALURGI</h2>
                <p class="text-white fw-semibold subtitle-text">INSTITUT TEKNOLOGI DEL</p>
                <p class="text-white slogan-text">Shaping the World Through Metals</p>
                <div class="image-logos-container">
                    <img class="logo-image" src="{{ asset('aset/img/kampus.png') }}" alt="Kampus" width="70">
                    <img class="logo-image" src="{{ asset('aset/img/akreditasi.png') }}" alt="Akreditasi"
                        width="70">
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Poster Section -->
    <section class="hero-section" id="hero-section">
        <div class="hero">
            <img src="{{ asset('aset/img/poster.png') }}" alt="Gedung Teknik Metalurgi IT Del"
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
            @if (isset($news) && $news->count() > 0)
                @foreach ($news as $item)
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="news-card">
                            <div class="news-image-container">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    class="news-image">
                            </div>
                            <div class="news-title">
                                <a href="{{ route('newsdetail', $item->id) }}"
                                    class="news-title-link">{{ $item->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Belum ada berita.</p>
            @endif
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('news') }}" class="btn btn-outline-primary">Semua Berita</a>
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
                        @foreach ($testimonials as $testimonial)
                            <div class="testimonial-card">
                                <div class="testimonial-image-wrapper">
                                    <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : 'https://via.placeholder.com/150' }}"
                                        alt="{{ $testimonial->name }}" class="testimonial-image">
                                </div>
                                <div class="testimonial-header text-center mt-3">
                                    <div class="testimonial-info">{{ $testimonial->name }}</div>
                                    <p class="job">({{ $testimonial->student }})</p>
                                </div>
                                <blockquote class="testimonial-content mt-3">{!! $testimonial->content !!}</blockquote>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Collaboration Section -->
    <section class="kerjasama-section" id="kerjasama-section">
        <h3 class="section-title"><strong>KERJA SAMA</strong></h3>

        @if (count($collaborates) > 0)
            <div class="slider-container">
                <!-- Navigation Arrows - OUTSIDE carousel container -->
                <button class="nav-arrow left" onclick="moveKerjasama(-1)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <polygon points="15,6 9,12 15,18" fill="#333" />
                    </svg>
                </button>
                <button class="nav-arrow right" onclick="moveKerjasama(1)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <polygon points="9,6 15,12 9,18" fill="#333" />
                    </svg>
                </button>

                <div class="kerjasama-container">
                    @php
                        // Split collaborations into chunks of 3 for each row
                        $chunkedCollaborations = $collaborates->chunk(3);
                    @endphp

                    @foreach ($chunkedCollaborations as $row)
                        <div class="kerjasama-row">
                            @foreach ($row as $data)
                                <div class="kerjasama-item" data-title="{{ addslashes($data->institution_name) }}"
                                    data-company-profile='{!! json_encode($data->company_profile, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!}'
                                    data-description='{!! json_encode($data->institution_description, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!}'
                                    onclick="showCollaborationModal(this.getAttribute('data-title'), this.getAttribute('data-company-profile'), this.getAttribute('data-description'))">
                                    @if ($data->logo)
                                        <img src="{{ asset('storage/' . $data->logo) }}"
                                            alt="logo {{ $data->institution_name }}" class="institution-logo"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Klik untuk detail">
                                    @endif
                                    <span class="tanggal">Tanggal Kerjasama:
                                        {{ \Carbon\Carbon::parse($data->date)->format('d F Y') }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="no-collaborations">
                <p>Tidak ada kerjasama </p>
            </div>
        @endif
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
