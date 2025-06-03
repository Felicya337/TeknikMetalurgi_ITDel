@extends('layouts.main')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="{{ url('/penelitian') }}" class="text-decoration-none">Penelitian</a>
            </li>
            <li class="breadcrumb-item current-page">Semua Penelitian</li>
        </ol>
    </nav>

    <div class="container">
        <h1 class="my-4">Penelitian</h1>

        @foreach ($researches as $research)
            <div class="card mb-4 shadow-sm">
                <div class="row no-gutters align-items-center">
                    @if ($research->image)
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $research->image) }}" class="img-fluid p-3"
                                alt="{{ $research->title }}">
                        </div>
                    @endif

                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $research->title }}</h5>
                            <p class="mb-1 text-muted">
                                <strong>By:</strong> {{ $research->author ?? 'Anonim' }}

                                <strong>Date:</strong>
                                {{ $research->date ? \Carbon\Carbon::parse($research->date)->translatedFormat('F Y') : '-' }}
                                @if ($research->type)
                                    <strong>Type:</strong> {{ ucfirst($research->type) }}
                                @endif
                                @if ($research->file)
                                    <a href="{{ asset('storage/' . $research->file) }}" class="ms-2" download
                                        title="Download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                @endif
                            </p>
                            <p class="card-text">{{ $research->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $researches->links() }}
        </div>
    </div>
@endsection
