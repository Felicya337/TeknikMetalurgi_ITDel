@extends('layouts.main')

@section('content')
    <style>
        /* Publication Page Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .text-decoration-none {
            text-decoration: none !important;
        }

        .current-page {
            color: #6c757d;
            font-weight: 500;
        }

        /* Container Styles */
        .publication-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Heading Styles */
        .my-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1.5rem !important;
            text-align: center;
        }

        /* Publication Cards */
        .publication-card {
            background: white;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .publication-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-color: #ffffff;
        }

        .publication-body {
            padding: 20px;
        }

        .publication-row {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .publication-image {
            flex: 0 0 40%;
            max-width: 40%;
        }

        .publication-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            border-radius: 5px;
        }

        .publication-content {
            flex: 1;
        }

        .publication-title {
            font-size: 18px;
            font-weight: bold;
            color: #1976d2;
            margin: 0 0 15px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.3;
        }

        .publication-meta {
            margin-bottom: 15px;
            font-size: 14px;
            color: #6c757d;
            line-height: 1.5;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .publication-meta strong {
            color: #000000;
            margin-right: 5px;
        }

        .publication-meta-item {
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .publication-description {
            font-size: 14px;
            color: #000000;
            line-height: 1.6;
            text-align: justify;
            margin: 0;
        }

        .publication-description * {
            max-width: 100%;
            box-sizing: border-box;
        }

        .publication-description img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .publication-description p {
            margin: 0 0 10px 0;
        }

        .publication-description ul,
        .publication-description ol {
            padding-left: 20px;
            margin: 0 0 10px 0;
        }

        /* File Action Links Styles */
        .file-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .file-link {
            color: #1976d2;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .file-link:hover {
            background-color: #f0f7ff;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .download-link {
            color: #1976d2;
        }

        .download-link:hover {
            color: #0d47a1;
            background-color: #f0f7ff;
        }

        .view-link {
            color: #1976d2;
        }

        .view-link:hover {
            color: #0d47a1;
            background-color: #f0f7ff;
        }

        .bi-download,
        .bi-eye {
            font-size: 1.1rem;
        }

        /* Pagination Styles */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        /* No publications alert */
        .alert-info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #000000;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 30px 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .publication-container {
                padding: 15px;
            }

            .publication-row {
                flex-direction: column;
                gap: 15px;
            }

            .publication-image {
                flex: none;
                max-width: 100%;
            }

            .publication-image img {
                height: 200px;
            }

            .publication-title {
                font-size: 16px;
            }

            .publication-meta {
                font-size: 13px;
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .publication-description {
                font-size: 13px;
            }

            .file-actions {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .publication-container {
                padding: 10px;
            }

            .publication-body {
                padding: 15px;
            }

            .publication-image img {
                height: 180px;
            }

            .publication-title {
                font-size: 15px;
            }

            .publication-meta {
                font-size: 12px;
            }

            .publication-description {
                font-size: 12px;
            }

            .file-link {
                font-size: 13px;
                padding: 4px 8px;
            }
        }
    </style>

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="{{ url('/penelitian') }}" class="text-decoration-none">Prestasi</a>
            </li>
            <li class="breadcrumb-item current-page">Semua Publikasi</li>
        </ol>
    </nav>

    <div class="publication-container">
        <h1 class="my-4">Publikasi</h1>

        @if ($publications->isEmpty())
            <div class="alert alert-info">
                Tidak ada publikasi yang tersedia saat ini.
            </div>
        @else
            @foreach ($publications as $pub)
                <div class="publication-card">
                    <div class="publication-body">
                        <div class="publication-row">
                            <div class="publication-image">
                                @if ($pub->image)
                                    <img src="{{ asset('storage/' . $pub->image) }}" alt="{{ $pub->title }}">
                                @else
                                    <img src="{{ asset('images/placeholder.png') }}" alt="No Image Available">
                                @endif
                            </div>
                            <div class="publication-content">
                                <h5 class="publication-title">{{ $pub->title }}</h5>

                                <div class="publication-meta">
                                    <div class="publication-meta-item">
                                        <strong>By:</strong> {{ $pub->author ?? 'Anonim' }}
                                    </div>
                                    <div class="publication-meta-item">
                                        <strong>Date:</strong>
                                        {{ $pub->date ? \Carbon\Carbon::parse($pub->date)->translatedFormat('F Y') : '-' }}
                                    </div>
                                    @if ($pub->type)
                                        <div class="publication-meta-item">
                                            <strong>Type:</strong> {{ $pub->type }}
                                        </div>
                                    @endif
                                    @if ($pub->file)
                                        <div class="publication-meta-item">
                                            <div class="file-actions">
                                                <a href="{{ asset('storage/' . $pub->file) }}"
                                                    class="file-link download-link" download title="Download Document">
                                                    <i class="bi bi-download"></i>
                                                    Download
                                                </a>
                                                <a href="{{ asset('storage/' . $pub->file) }}" class="file-link view-link"
                                                    target="_blank" title="View Document">
                                                    <i class="bi bi-eye"></i>
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="publication-description">{!! $pub->description !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="pagination-wrapper">
            {{ $publications->links() }}
        </div>
    </div>
@endsection
