<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Teknik Metalurgi IT Del</title>
    <link rel="icon" type="image/png" href="{{ asset('aset/img/logo.png') }}">
    <link href="{{ asset('aset/css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar sederhana -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('aset/img/logo.png') }}" alt="Logo Del" height="40" class="me-2">
                <span>Teknik Metalurgi IT Del</span>
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">
                    <i class="bi bi-search"></i>
                    Hasil Pencarian untuk: <span class="text-primary">"{{ $query }}"</span>
                </h2>

                @if ($pageResult)
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Halaman Ditemukan!</h5>
                        <p>Kami menemukan halaman yang sesuai dengan pencarian Anda:</p>
                        <a href="{{ $pageResult['url'] }}" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Pergi ke {{ $pageResult['name'] }}
                        </a>
                    </div>
                @endif

                @if ($newsResults->count() > 0)
                    <div class="mb-5">
                        <h4 class="border-bottom pb-2">
                            <i class="bi bi-newspaper"></i> Berita ({{ $newsResults->count() }} hasil)
                        </h4>
                        <div class="row">
                            @foreach ($newsResults as $news)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        @if ($news->image)
                                            <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top"
                                                alt="{{ $news->title }}" style="height: 200px; object-fit: cover;">
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $news->title }}</h5>
                                            <p class="card-text flex-grow-1">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($news->content), 150) }}
                                            </p>
                                            <a href="{{ route('newsdetail', $news->id) }}"
                                                class="btn btn-primary mt-auto">
                                                <i class="bi bi-arrow-right"></i> Baca Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($testimonialResults->count() > 0)
                    <div class="mb-5">
                        <h4 class="border-bottom pb-2">
                            <i class="bi bi-chat-quote"></i> Testimoni ({{ $testimonialResults->count() }} hasil)
                        </h4>
                        <div class="row">
                            @foreach ($testimonialResults as $testimonial)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        @if ($testimonial->image)
                                            <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                class="card-img-top rounded-circle mx-auto mt-3"
                                                alt="{{ $testimonial->name }}"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        @endif
                                        <div class="card-body text-center d-flex flex-column">
                                            <h5 class="card-title">{{ $testimonial->name }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $testimonial->student }}</h6>
                                            <p class="card-text flex-grow-1">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($testimonial->content), 150) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($collaborateResults->count() > 0)
                    <div class="mb-5">
                        <h4 class="border-bottom pb-2">
                            <i class="bi bi-building"></i> Kerjasama ({{ $collaborateResults->count() }} hasil)
                        </h4>
                        <div class="row">
                            @foreach ($collaborateResults as $collaborate)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        @if ($collaborate->logo)
                                            <img src="{{ asset('storage/' . $collaborate->logo) }}"
                                                class="card-img-top mx-auto mt-3"
                                                alt="{{ $collaborate->institution_name }}"
                                                style="width: 100px; height: 100px; object-fit: contain;">
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $collaborate->institution_name }}</h5>
                                            <p class="card-text flex-grow-1">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($collaborate->company_profile), 100) }}
                                            </p>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i>
                                                Tanggal:
                                                {{ \Carbon\Carbon::parse($collaborate->date)->format('d F Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (
                    !$pageResult &&
                        $newsResults->count() == 0 &&
                        $testimonialResults->count() == 0 &&
                        $collaborateResults->count() == 0)
                    <div class="text-center mt-5">
                        <div class="mb-4">
                            <i class="bi bi-search display-1 text-muted"></i>
                        </div>
                        <h3>Tidak Ada Hasil Ditemukan</h3>
                        <p class="lead">Maaf, kami tidak dapat menemukan hasil untuk kata kunci:
                            <strong>"{{ $query }}"</strong></p>
                        <p>Coba gunakan kata kunci yang berbeda atau lebih spesifik.</p>

                        <div class="mt-4">
                            <h5>Saran Pencarian:</h5>
                            <ul class="list-unstyled">
                                <li><span class="badge bg-secondary me-1">beranda</span> untuk halaman utama</li>
                                <li><span class="badge bg-secondary me-1">profil</span> untuk informasi umum</li>
                                <li><span class="badge bg-secondary me-1">dosen</span> untuk informasi staff pengajar
                                </li>
                                <li><span class="badge bg-secondary me-1">fasilitas</span> untuk sarana dan prasarana
                                </li>
                                <li><span class="badge bg-secondary me-1">berita</span> untuk artikel terbaru</li>
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="text-center mt-5">
                    <a href="/" class="btn btn-secondary me-2">
                        <i class="bi bi-house"></i> Kembali ke Beranda
                    </a>
                    <button class="btn btn-primary" onclick="history.back()">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer sederhana -->
    <footer class="bg-dark text-light mt-5 py-4">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Teknik Metalurgi Institut Teknologi Del. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
