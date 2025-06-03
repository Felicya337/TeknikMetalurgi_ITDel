@extends('layouts.main')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="{{ url('/penelitian') }}" class="text-decoration-none">Prestasi</a>
            </li>
            <li class="breadcrumb-item current-page">Semua Prestasi</li>
        </ol>
    </nav>

    <div class="container">
        <h1 class="my-4 text-center fw-bold">PRESTASI</h1>

        {{-- Carousel --}}
        <div id="carouselExampleIndicators" class="carousel slide mb-5">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('aset/img/1.jpg') }}" class="d-block w-100" alt="Slide 1"
                        style="height: 500px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('aset/img/2.jpg') }}" class="d-block w-100" alt="Slide 2"
                        style="height: 500px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('aset/img/3.jpg') }}" class="d-block w-100" alt="Slide 3"
                        style="height: 500px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('aset/img/4.jpg') }}" class="d-block w-100" alt="Slide 4"
                        style="height: 500px; object-fit: cover;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        {{-- Prestasi Mahasiswa Section --}}
        <div class="mt-5 mb-5">
            <h2 class="text-center fw-bold mb-4">PRESTASI MAHASISWA</h2>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" class="text-primary fw-bold">Nama Kegiatan</th>
                            <th scope="col" class="text-primary fw-bold">Waktu Pelaksanaan</th>
                            <th scope="col" class="text-primary fw-bold">Tingkat</th>
                            <th scope="col" class="text-primary fw-bold">Prestasi yang dicapai</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data Manual Prestasi Mahasiswa --}}
                        <tr>
                            <td>Prestasi Potensi Cumlaude</td>
                            <td>08 November 2024</td>
                            <td>Kampus</td>
                            <td>Mewakili Program Studi atas prestasi Potensi Cumlaude</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Toggle Button --}}
        <div class="text-center mb-4">
            <button class="btn btn-outline-primary" onclick="toggleView()">
                <i class="bi bi-eye"></i> Toggle View
            </button>
        </div>

        {{-- Original Card Layout (Hidden by default, can be toggled) --}}
        <div class="mt-5 mb-5" id="cardLayout" style="display: none;">
            <h3 class="mb-4">Detail Prestasi</h3>
            {{-- Static card data for demonstration --}}
            <div class="card mb-4 shadow-sm">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-4">
                        <img src="{{ asset('aset/img/prestasi1.jpg') }}" class="img-fluid p-3" alt="Prestasi Cumlaude">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Prestasi Potensi Cumlaude</h5>
                            <p class="mb-1 text-muted">
                                <strong>By:</strong> Mahasiswa Teknik Informatika
                                <strong>Date:</strong> November 2024
                                <strong>Type:</strong> Akademik
                            </p>
                            <p class="card-text">Mewakili Program Studi atas prestasi Potensi Cumlaude dengan IPK yang
                                sangat memuaskan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-4">
                        <img src="{{ asset('aset/img/prestasi2.jpg') }}" class="img-fluid p-3"
                            alt="Kompetisi Programming">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Juara 1 Kompetisi Programming</h5>
                            <p class="mb-1 text-muted">
                                <strong>By:</strong> Tim Programming IT Del
                                <strong>Date:</strong> Oktober 2024
                                <strong>Type:</strong> Kompetisi
                            </p>
                            <p class="card-text">Meraih juara pertama dalam kompetisi programming tingkat regional Sumatera
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pagination (if needed for static data) --}}
        <div class="d-flex justify-content-center mb-5">
            <nav aria-label="Prestasi pagination">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table th {
            background-color: #ffffff !important;
            color: #ffffff !important;
            font-weight: 600;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>td {
            background-color: rgba(0, 0, 0, .05);
        }

        .table-hover>tbody>tr:hover>td {
            background-color: rgba(0, 0, 0, .075);
        }

        .carousel-item img {
            border-radius: 10px;
        }

        h1,
        h2 {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Ensure proper spacing for footer */
        .container {
            padding-bottom: 2rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function toggleView() {
            const cardLayout = document.getElementById('cardLayout');
            const tableLayout = document.querySelector('.table-responsive').parentElement;

            if (cardLayout.style.display === 'none') {
                cardLayout.style.display = 'block';
                tableLayout.style.display = 'none';
            } else {
                cardLayout.style.display = 'none';
                tableLayout.style.display = 'block';
            }
        }
    </script>
@endpush
