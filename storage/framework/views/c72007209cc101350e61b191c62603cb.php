<?php $__env->startSection('content'); ?>
    <div class="breadcrumbs-custom">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('home')); ?>" class="text-decoration-none">
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
                        <?php echo csrf_field(); ?>
                        <input type="text" name="query" id="searchInput" class="form-control"
                            placeholder="Cari berita berdasarkan judul, konten, atau tanggal..."
                            value="<?php echo e($query ?? ''); ?>">
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
                <?php if($news->isEmpty()): ?>
                    <div class="no-news-message">
                        <?php if(isset($query) && $query): ?>
                            Maaf, berita tidak ditemukan untuk pencarian "<?php echo e($query); ?>".
                        <?php else: ?>
                            Tidak ada berita yang ditemukan.
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="main-layout">
                        <div class="news-list-area" id="newsList">
                            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="news-item" data-title="<?php echo e(strtolower($item->title)); ?>"
                                    data-description="<?php echo e(strtolower(strip_tags($item->description))); ?>"
                                    data-date="<?php echo e(\Carbon\Carbon::parse($item->date)->format('Y-m-d')); ?>"
                                    data-date-formatted="<?php echo e(\Carbon\Carbon::parse($item->date)->translatedFormat('d F Y')); ?>">
                                    <div class="news-item-image-container">
                                        <?php if($item->image): ?>
                                            <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="<?php echo e($item->title); ?>"
                                                class="news-item-image" loading="lazy">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/120x90/6c757d/ffffff?text=No+Image"
                                                alt="<?php echo e($item->title); ?>" class="news-item-image" loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                    <div class="news-item-details">
                                        <a href="<?php echo e(route('newsdetail', $item->id)); ?>" class="news-item-title">
                                            <?php echo e(Str::limit($item->title, 200)); ?>

                                        </a>
                                        <p class="news-item-excerpt"><?php echo e(Str::limit(strip_tags($item->description), 120)); ?>

                                        </p>
                                        <div class="news-item-meta">
                                            <span><i class="fas fa-calendar-alt"></i>
                                                <?php echo e(\Carbon\Carbon::parse($item->date)->translatedFormat('d F Y')); ?></span>
                                            <span><i class="fas fa-user"></i> <?php echo e($item->author); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php if($recentNews->isNotEmpty()): ?>
                            <aside class="sidebar-area">
                                <h3 class="sidebar-title">RILIS BERITA</h3>
                                <ul class="recent-news-list">
                                    <?php $__currentLoopData = $recentNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('newsdetail', $item->id)); ?>">
                                                <?php echo e($item->title); ?>

                                            </a>
                                            <div class="recent-news-meta">
                                                <span><i class="fas fa-calendar-alt"></i>
                                                    <?php echo e(\Carbon\Carbon::parse($item->date)->translatedFormat('d F Y')); ?></span>
                                                <span><i class="fas fa-user"></i> <?php echo e($item->author); ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </aside>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pagination-wrapper" id="paginationWrapper">
                <?php echo e($news->links()); ?>

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
                        url: "<?php echo e(route('news.search')); ?>",
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
                                            `<img src="<?php echo e(asset('storage/')); ?>/${item.image}" alt="${item.title}" class="news-item-image" loading="lazy">` :
                                            `<img src="https://via.placeholder.com/120x90/6c757d/ffffff?text=No+Image" alt="${item.title}" class="news-item-image" loading="lazy">`
                                        }
                                    </div>
                                    <div class="news-item-details">
                                        <a href="<?php echo e(url('newsdetail')); ?>/${item.id}" class="news-item-title">
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
                <?php if(isset($query) && $query): ?>
                    $searchResults.show();
                    $searchCount.text(`Hasil pencarian untuk "$<?php echo $query; ?>"`);
                <?php endif; ?>
            });
        </script>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/news.blade.php ENDPATH**/ ?>