@extends('layouts.main')

@section('content')
    <div class="breadcrumbs-custom">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <i class="bi bi-house-door icon"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item current-page"><b>Semua Berita</b></li>
            </ol>
        </nav>

        <div class="all-news-page">
            <div class="news-search-form">
                <div class="search-container">
                    <form id="searchForm">
                        @csrf
                        <input type="text" name="query" id="searchInput" class="form-control"
                            placeholder="Cari berita berdasarkan judul, konten, atau tanggal..."
                            value="{{ $query ?? '' }}">
                        <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                        <button type="button" id="clearSearch" class="clear-btn" style="display: none;"><i
                                class="fas fa-times"></i></button>
                    </form>
                    <div id="loadingSpinner" style="display: none;" class="text-center mt-2">
                        <i class="fas fa-spinner fa-spin"></i> Mencari...
                    </div>
                </div>
            </div>

            <div id="searchResults" style="display: none;">
                <div class="search-info">
                    <span id="searchCount"></span>
                </div>
            </div>

            <div id="newsContainer">
                @if ($news->isEmpty())
                    <div class="no-news-message">
                        @if (isset($query) && $query)
                            Maaf, berita tidak ditemukan untuk pencarian "{{ $query }}".
                        @else
                            Tidak ada berita yang ditemukan.
                        @endif
                    </div>
                @else
                    <div class="main-layout">
                        <div class="news-list-area" id="newsList">
                            @foreach ($news as $item)
                                <div class="news-item" data-title="{{ strtolower($item->title) }}"
                                    data-description="{{ strtolower(strip_tags($item->description)) }}"
                                    data-date="{{ \Carbon\Carbon::parse($item->date)->format('Y-m-d') }}"
                                    data-date-formatted="{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}">
                                    <div class="news-item-image-container">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                                class="news-item-image" loading="lazy">
                                        @else
                                            <img src="https://via.placeholder.com/120x90/6c757d/ffffff?text=No+Image"
                                                alt="{{ $item->title }}" class="news-item-image" loading="lazy">
                                        @endif
                                    </div>
                                    <div class="news-item-details">
                                        <a href="{{ route('newsdetail', $item->id) }}" class="news-item-title">
                                            {{ Str::limit($item->title, 200) }}
                                        </a>
                                        <p class="news-item-excerpt">{{ Str::limit(strip_tags($item->description), 120) }}
                                        </p>
                                        <div class="news-item-meta">
                                            <span><i class="fas fa-calendar-alt"></i>
                                                {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</span>
                                            <span><i class="fas fa-user"></i> {{ $item->author }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($recentNews->isNotEmpty())
                            <aside class="sidebar-area">
                                <h3 class="sidebar-title">RILIS BERITA</h3>
                                <ul class="recent-news-list">
                                    @foreach ($recentNews as $item)
                                        <li>
                                            <a href="{{ route('newsdetail', $item->id) }}">
                                                {{ $item->title }}
                                            </a>
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
                @endif
            </div>

            <div class="pagination-wrapper" id="paginationWrapper">
                {{ $news->links() }}
            </div>
        </div>

        <style>
            .search-container {
                position: relative;
            }

            .clear-btn {
                position: absolute;
                right: 50px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #6c757d;
                cursor: pointer;
                padding: 5px;
            }

            .clear-btn:hover {
                color: #dc3545;
            }

            .search-info {
                margin: 15px 0;
                font-style: italic;
                color: #6c757d;
            }

            .highlight {
                background-color: #fff3cd;
                padding: 2px 4px;
                border-radius: 3px;
            }

            .no-news-message {
                text-align: center;
                padding: 40px 20px;
                color: #6c757d;
                font-size: 16px;
                background: #f8f9fa;
                border-radius: 8px;
                margin: 20px 0;
            }
        </style>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                let searchTimeout;
                const $searchInput = $('#searchInput');
                const $searchForm = $('#searchForm');
                const $clearSearch = $('#clearSearch');
                const $loadingSpinner = $('#loadingSpinner');
                const $newsContainer = $('#newsContainer');
                const $paginationWrapper = $('#paginationWrapper');
                const $searchResults = $('#searchResults');
                const $searchCount = $('#searchCount');

                // Store original content
                const originalContent = $newsContainer.html();
                const originalPagination = $paginationWrapper.html();

                // Show/hide clear button
                function toggleClearButton() {
                    if ($searchInput.val().trim()) {
                        $clearSearch.show();
                    } else {
                        $clearSearch.hide();
                    }
                }

                // Highlight search terms in text
                function highlightText(text, searchTerm) {
                    if (!searchTerm) return text;
                    const regex = new RegExp(`(${searchTerm})`, 'gi');
                    return text.replace(regex, '<span class="highlight">$1</span>');
                }

                // Perform AJAX search
                function performSearch(query) {
                    if (!query.trim()) {
                        resetToOriginal();
                        return;
                    }

                    $loadingSpinner.show();
                    $paginationWrapper.hide();

                    $.ajax({
                        url: "{{ route('news.search') }}",
                        method: 'GET',
                        data: {
                            query: query,
                            ajax: true
                        },
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            $loadingSpinner.hide();
                            displaySearchResults(response, query);
                        },
                        error: function() {
                            $loadingSpinner.hide();
                            $newsContainer.html(`
                                <div class="no-news-message">
                                    Terjadi kesalahan saat mencari berita. Silakan coba lagi.
                                </div>
                            `);
                        }
                    });
                }

                // Display search results
                function displaySearchResults(response, query) {
                    if (response.news && response.news.length > 0) {
                        let newsHtml = '<div class="main-layout"><div class="news-list-area">';

                        response.news.forEach(function(item) {
                            const highlightedTitle = highlightText(item.title, query);
                            const highlightedDescription = highlightText(item.description ? item.description
                                .substring(0, 120) : '', query);
                            const formattedDate = new Date(item.date).toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            });

                            newsHtml += `
                                <div class="news-item">
                                    <div class="news-item-image-container">
                                        ${item.image ?
                                            `<img src="{{ asset('storage/') }}/${item.image}" alt="${item.title}" class="news-item-image" loading="lazy">` :
                                            `<img src="https://via.placeholder.com/120x90/6c757d/ffffff?text=No+Image" alt="${item.title}" class="news-item-image" loading="lazy">`
                                        }
                                    </div>
                                    <div class="news-item-details">
                                        <a href="{{ url('newsdetail') }}/${item.id}" class="news-item-title">
                                            ${highlightedTitle}
                                        </a>
                                        <p class="news-item-excerpt">${highlightedDescription}</p>
                                        <div class="news-item-meta">
                                            <span><i class="fas fa-calendar-alt"></i> ${formattedDate}</span>
                                            <span><i class="fas fa-user"></i> ${item.author || 'Admin'}</span>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });

                        newsHtml += '</div></div>';
                        $newsContainer.html(newsHtml);

                        $searchResults.show();
                        $searchCount.text(`Ditemukan ${response.count} berita untuk pencarian "${query}"`);
                    } else {
                        $newsContainer.html(`
                            <div class="no-news-message">
                                Maaf, berita tidak ditemukan untuk pencarian "${query}".
                            </div>
                        `);
                        $searchResults.show();
                        $searchCount.text(`Tidak ada hasil untuk pencarian "${query}"`);
                    }
                }

                // Reset to original content
                function resetToOriginal() {
                    $newsContainer.html(originalContent);
                    $paginationWrapper.html(originalPagination).show();
                    $searchResults.hide();
                    $clearSearch.hide();
                }

                // Real-time search with debounce
                $searchInput.on('input', function() {
                    const query = $(this).val().trim();
                    toggleClearButton();

                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function() {
                        performSearch(query);
                    }, 500); // 500ms delay
                });

                // Form submit
                $searchForm.on('submit', function(e) {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    performSearch($searchInput.val().trim());
                });

                // Clear search
                $clearSearch.on('click', function() {
                    $searchInput.val('');
                    resetToOriginal();
                });

                // Initialize
                toggleClearButton();

                // If there's an initial query, show search results info
                @if (isset($query) && $query)
                    $searchResults.show();
                    $searchCount.text(`Hasil pencarian untuk "${!! $query !!}"`);
                @endif
            });
        </script>
    </div>
@endsection
