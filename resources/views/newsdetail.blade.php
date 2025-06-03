@extends('layouts.main')

@section('content')
    <!-- Breadcrumbs -->
    <nav class="breadcrumbs">
        <a href="{{ route('news') }}">Berita</a>
        <span class="separator">/</span>
        <span class="current-page"><b>{{ Str::limit($newsItem->title, 1000) }}</b></span>
    </nav>

    <!-- Main Container -->
    <div class="main-layout">
        <!-- Article Area -->
        <article class="news-detail-article-area">
            <header class="news-header-image-container with-bg">
                @if ($newsItem->image)
                    <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" loading="lazy">
                @else
                    <img src="https://via.placeholder.com/800x300/667eea/ffffff?text=News+Image"
                        alt="{{ $newsItem->title }}" loading="lazy">
                @endif
                <div class="news-title-overlay">
                    <h1>{{ $newsItem->title }}</h1>
                </div>
            </header>

            <div class="article-content-wrapper">
                <div class="news-content-prose">
                    {!! $newsItem->description !!}
                </div>
            </div>
        </article>

        <!-- Sidebar -->
        @if ($recentNews->isNotEmpty())
            <aside class="sidebar-area">
                <h3 class="sidebar-title">RILIS BERITA</h3>
                <ul class="recent-news-list">
                    @foreach ($recentNews as $item)
                        <li>
                            <a href="{{ route('newsdetail', $item->id) }}">{{ $item->title }}</a>
                            <div class="recent-news-meta">
                                <span><i class="fas fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</span>
                                <span><i class="fas fa-user"></i> {{ $item->author }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </aside>
        @endif
    </div>
@endsection
