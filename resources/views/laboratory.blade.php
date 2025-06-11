@extends('layouts.main')

@section('title', 'Laboratorium')

@section('content')
    <style>
        .laboratory-section {
            padding: 2rem 0;
            background-color: #fff;
        }

        .laboratory-title {
            text-align: center;
            font-size: clamp(1.5rem, 5vw, 1.75rem);
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.025rem;
        }

        .laboratory-card {
            background: #fff;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 -4px 6px -1px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            margin-bottom: 3rem;
            overflow: hidden;
        }

        .laboratory-header {
            padding: 1.5rem;
        }

        .laboratory-name {
            color: #2b6cb0;
            font-size: 1.125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025rem;
        }

        .laboratory-content {
            display: flex;
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .laboratory-image {
            flex: 0 0 280px;
            height: 200px;
            border-radius: 4px;
            overflow: hidden;
        }

        .laboratory-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .laboratory-details {
            flex: 1;
        }

        .info-title {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 600;
            color: #2b6cb0;
            margin: 1.25rem 0 0.75rem;
            text-transform: uppercase;
        }

        .info-icon {
            width: 16px;
            height: 16px;
            margin-right: 0.5rem;
        }

        .laboratory-description {
            font-size: 0.875rem;
            line-height: 1.6;
            color: #4a5568;
            margin-bottom: 1rem;
            text-align: justify;
        }

        .schedule-list {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .schedule-item {
            font-size: 0.875rem;
            color: #4a5568;
            margin-bottom: 0.375rem;
        }

        .additional-images {
            display: flex;
            gap: 0.625rem;
            margin-top: 1.25rem;
            flex-wrap: wrap;
        }

        .additional-images img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .no-data {
            text-align: center;
            font-size: 1rem;
            color: #718096;
            font-style: italic;
            padding: 2.5rem 0;
        }

        @media (max-width: 992px) {
            .laboratory-content {
                flex-direction: column;
                gap: 1rem;
            }

            .laboratory-image {
                width: 100%;
                height: 200px;
            }
        }

        @media (max-width: 768px) {
            .laboratory-section {
                padding: 1.5rem 0;
            }

            .laboratory-card {
                margin-bottom: 2rem;
            }

            .laboratory-content {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .laboratory-title {
                font-size: 1.25rem;
            }

            .laboratory-name {
                font-size: 1rem;
            }

            .info-title,
            .laboratory-description,
            .schedule-item {
                font-size: 0.8125rem;
            }
        }
    </style>

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Laboratorium</a>
                </li>
            </ol>
        </div>
    </nav>

    <section class="laboratory-section">
        <div class="container">
            <h2 class="laboratory-title">Laboratorium Program Studi Teknik Metalurgi<br>Fakultas Teknologi Industri</h2>

            @if ($laboratories->isEmpty())
                <p class="no-data">Tidak ada laboratorium yang tersedia saat ini.</p>
            @else
                @foreach ($laboratories as $laboratory)
                    <article class="laboratory-card" aria-labelledby="lab-{{ $laboratory->id }}-title">
                        <header class="laboratory-header">
                            <h3 class="laboratory-name" id="lab-{{ $laboratory->id }}-title">
                                {{ strtoupper($laboratory->name) }}
                            </h3>
                        </header>

                        <div class="laboratory-content">
                            <div class="laboratory-image">
                                <img src="{{ $laboratory->images && count($laboratory->images) > 0 ? asset('storage/' . $laboratory->images[0]) : asset('aset/img/default-lab.jpg') }}"
                                    alt="{{ $laboratory->name }} laboratory image">
                            </div>

                            <div class="laboratory-details">
                                <h4 class="info-title">
                                    <img src="{{ asset('aset/img/logo1.png') }}" alt="Information icon" class="info-icon">
                                    Informasi Umum
                                </h4>
                                <p class="laboratory-description">
                                    {!! $laboratory->description ?? 'Tidak ada deskripsi yang tersedia.' !!}
                                </p>

                                <h4 class="info-title">
                                    <img src="{{ asset('aset/img/logo2.png') }}" alt="Clock icon" class="info-icon">
                                    Jam Kerja
                                </h4>

                                <ul class="schedule-list">
                                    <li class="schedule-item">
                                        <strong>Hari Akademik:</strong>
                                        {{ $laboratory->academic_days ? implode(', ', $laboratory->academic_days) : 'Senin - Jumat' }}
                                    </li>
                                    <li class="schedule-item">
                                        <strong>Jam Akademik:</strong>
                                        {{ $laboratory->academic_hours ?? '07:00 - 17:00' }}
                                    </li>
                                    <li class="schedule-item">
                                        <strong>Jam Kolaboratif:</strong>
                                        {{ $laboratory->collaborative_hours ?? '19:00 - 22:00' }}
                                    </li>
                                </ul>

                                @if ($laboratory->images && count($laboratory->images) > 1)
                                    <div class="additional-images">
                                        @foreach (array_slice($laboratory->images, 1) as $image)
                                            <img src="{{ asset('storage/' . $image) }}"
                                                alt="Additional image of {{ $laboratory->name }} laboratory">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            @endif
        </div>
    </section>
@endsection
