<?php $__env->startSection('content'); ?>
    <div class="breadcrumbs-custom">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('home')); ?>" class="text-decoration-none">
                        Beranda
                    </a>
                </li>
                <li class="breadcrumb-item current-page"><b>Semua Berita</b></li>
            </ol>
        </nav>

        <div class="all-news-page">
            <div class="news-search-form">
                <div class="search-container">
                    <form id="searchForm" onsubmit="return false;">
                        <input type="text" name="query" id="searchInput" class="form-control"
                            placeholder="Cari berita berdasarkan judul, konten, atau tanggal...">
                        <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                        <button type="button" id="clearSearch" class="clear-btn" style="display: none;"><i
                                class="fas fa-times"></i></button>
                    </form>
                </div>
            </div>

            <div id="searchResultsInfo" style="display: none;" class="mb-3">
                <span id="searchCount"></span>
            </div>

            <div id="newsContainer">
                <?php if($news->isEmpty() && !(isset($query) && $query)): ?>
                    <div class="no-news-message" id="initialNoNewsMessage">
                        Tidak ada berita yang ditemukan.
                    </div>
                <?php else: ?>
                    <div class="main-layout">
                        <div class="news-list-area" id="newsList">
                            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="news-item" data-title="<?php echo e(strtolower($item->title)); ?>"
                                    data-description="<?php echo e(strtolower(strip_tags($item->description))); ?>"
                                    data-date="<?php echo e(\Carbon\Carbon::parse($item->date)->format('Y-m-d')); ?>"
                                    data-date-formatted="<?php echo e(strtolower(\Carbon\Carbon::parse($item->date)->translatedFormat('d F Y'))); ?>">
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
                                        <a href="<?php echo e(route('newsdetail', $item->id)); ?>" class="news-item-title-link">
                                            <span class="original-title"><?php echo e(Str::limit($item->title, 200)); ?></span>
                                        </a>
                                        <p class="news-item-excerpt">
                                            <span
                                                class="original-excerpt"><?php echo e(Str::limit(strip_tags($item->description), 120)); ?></span>
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
                            <aside class="sidebar-area" id="sidebarArea">
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

            <div id="clientSideNoResultsMessage" class="no-news-message" style="display: none;">
                Maaf, berita tidak ditemukan untuk pencarian Anda.
            </div>

            <div class="pagination-wrapper" id="paginationWrapper">
                <?php if(!$news->isEmpty() && $news->hasPages()): ?>
                    
                    <?php echo e($news->links()); ?>

                <?php endif; ?>
            </div>
        </div>

        
        
        

        <script>
            $(document).ready(function() {
                let searchTimeout;
                const $searchInput = $('#searchInput');
                const $clearSearch = $('#clearSearch');
                const $newsList = $('#newsList');
                const $allNewsItems = $newsList.find('.news-item');
                const $paginationWrapper = $('#paginationWrapper');
                const $searchResultsInfo = $('#searchResultsInfo');
                const $searchCount = $('#searchCount');
                const $sidebarArea = $('#sidebarArea');
                const $clientSideNoResultsMessage = $('#clientSideNoResultsMessage');
                const $initialNoNewsMessage = $('#initialNoNewsMessage');

                function toggleClearButton() {
                    if ($searchInput.val().trim()) {
                        $clearSearch.show();
                    } else {
                        $clearSearch.hide();
                    }
                }

                function escapeRegExp(string) {
                    return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                }

                function highlightText(text, searchTerm) {
                    if (!searchTerm || !text) return text;
                    try {
                        const regex = new RegExp(`(${escapeRegExp(searchTerm)})`, 'gi');
                        return text.replace(regex, '<span class="highlight">$1</span>');
                    } catch (e) {
                        console.warn("Error creating regex for highlight:", e);
                        return text;
                    }
                }

                function performClientSearch(query) {
                    const normalizedQuery = query.toLowerCase().trim();
                    let itemsFound = 0;

                    $clientSideNoResultsMessage.hide();
                    $paginationWrapper.hide();
                    $searchResultsInfo.hide();
                    if ($sidebarArea.length) $sidebarArea.show(); // Tampilkan sidebar jika ada

                    if (!normalizedQuery) {
                        resetSearch();
                        return;
                    }

                    $allNewsItems.each(function() {
                        const $item = $(this);
                        const title = $item.data('title') || "";
                        const description = $item.data('description') || "";
                        const dateFormatted = $item.data('date-formatted') || "";
                        const dateRaw = $item.data('date') || "";

                        const $titleLink = $item.find('.news-item-title-link');
                        const $originalTitleSpan = $titleLink.find('.original-title');
                        if ($originalTitleSpan.length) {
                            $titleLink.html($originalTitleSpan.clone().html()); // Ambil HTML dalamnya
                        }

                        const $excerptP = $item.find('.news-item-excerpt');
                        const $originalExcerptSpan = $excerptP.find('.original-excerpt');
                        if ($originalExcerptSpan.length) {
                            $excerptP.html($originalExcerptSpan.clone().html()); // Ambil HTML dalamnya
                        }

                        if (title.includes(normalizedQuery) || description.includes(normalizedQuery) ||
                            dateFormatted.includes(normalizedQuery) || dateRaw.includes(normalizedQuery)) {
                            if ($originalTitleSpan.length) {
                                $titleLink.html(highlightText($originalTitleSpan.html(), normalizedQuery));
                            }
                            if ($originalExcerptSpan.length) {
                                $excerptP.html(highlightText($originalExcerptSpan.html(), normalizedQuery));
                            }

                            $item.show();
                            itemsFound++;
                        } else {
                            $item.hide();
                        }
                    });

                    if (itemsFound > 0) {
                        $searchCount.text(`Ditemukan ${itemsFound} berita untuk pencarian "${query.trim()}"`);
                        $searchResultsInfo.show();
                        if ($initialNoNewsMessage.length) $initialNoNewsMessage.hide();
                    } else {
                        $clientSideNoResultsMessage.html(
                            `Maaf, berita tidak ditemukan untuk pencarian "${query.trim()}".`).show();
                        if ($sidebarArea.length) $sidebarArea.hide();
                        if ($initialNoNewsMessage.length) $initialNoNewsMessage.hide();
                    }
                }

                function resetSearch() {
                    $searchInput.val('');
                    toggleClearButton();
                    $allNewsItems.each(function() {
                        const $item = $(this);
                        const $titleLink = $item.find('.news-item-title-link');
                        const $originalTitleSpan = $titleLink.find('.original-title');
                        if ($originalTitleSpan.length) {
                            $titleLink.html($originalTitleSpan.clone().html());
                        }

                        const $excerptP = $item.find('.news-item-excerpt');
                        const $originalExcerptSpan = $excerptP.find('.original-excerpt');
                        if ($originalExcerptSpan.length) {
                            $excerptP.html($originalExcerptSpan.clone().html());
                        }
                        $item.show();
                    });

                    // Hanya tampilkan pagination jika ada item berita dan ada halaman pagination
                    if ($allNewsItems.length > 0 && $paginationWrapper.find('.pagination').length > 0) {
                        $paginationWrapper.show();
                    } else {
                        $paginationWrapper.hide();
                    }

                    $searchResultsInfo.hide();
                    $clientSideNoResultsMessage.hide();
                    if ($sidebarArea.length) $sidebarArea.show();

                    if ($initialNoNewsMessage.length && $allNewsItems.length === 0) {
                        $initialNoNewsMessage.show();
                    } else if ($initialNoNewsMessage.length) {
                        $initialNoNewsMessage.hide();
                    }
                }

                $searchInput.on('input', function() {
                    const currentQuery = $(this).val();
                    toggleClearButton();
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function() {
                        performClientSearch(currentQuery);
                    }, 300);
                });

                $('#searchForm').on('submit', function(e) {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    performClientSearch($searchInput.val());
                });

                $clearSearch.on('click', function() {
                    resetSearch();
                });

                // Inisialisasi awal
                toggleClearButton();
                if ($allNewsItems.length === 0) {
                    if ($initialNoNewsMessage.length) $initialNoNewsMessage.show();
                    $paginationWrapper.hide();
                } else {
                    if ($initialNoNewsMessage.length) $initialNoNewsMessage.hide();
                    // Tampilkan pagination jika ada item dan pagination links
                    if ($paginationWrapper.find('.pagination').length === 0) {
                        $paginationWrapper.hide();
                    }
                }
            });
        </script>

        
        <style>
            .highlight {
                background-color: yellow;
                font-weight: bold;
                /* Tambahkan padding jika perlu agar tidak terlalu mepet */
                /* padding: 0 2px; */
            }

            .news-search-form .search-container {
                display: flex;
                align-items: center;
                border: 1px solid #ced4da;
                /* Sesuaikan dengan style Anda */
                border-radius: .25rem;
                /* Sesuaikan dengan style Anda */
                overflow: hidden;
                /* Agar tombol tidak keluar dari border */
            }

            .news-search-form .search-container input[type="text"] {
                flex-grow: 1;
                border: none;
                /* Hapus border input karena sudah ada di container */
                padding: .375rem .75rem;
                /* Sesuaikan padding */
            }

            .news-search-form .search-container input[type="text"]:focus {
                outline: none;
                /* Hapus outline saat fokus */
                box-shadow: none;
                /* Hapus box-shadow saat fokus */
            }

            .news-search-form .search-container .search-btn,
            .news-search-form .search-container .clear-btn {
                background-color: #f8f9fa;
                /* Sesuaikan dengan style Anda */
                border: none;
                border-left: 1px solid #ced4da;
                /* Garis pemisah */
                padding: .375rem .75rem;
                cursor: pointer;
                color: #495057;
                /* Warna ikon */
            }

            .news-search-form .search-container .search-btn:hover,
            .news-search-form .search-container .clear-btn:hover {
                background-color: #e9ecef;
                /* Warna hover */
            }

            .news-search-form .search-container .clear-btn {
                border-left: 1px solid #ced4da;
                /* Pemisah untuk clear button juga */
            }

            /* Style untuk no-news-message jika Anda belum punya */
            .no-news-message {
                text-align: center;
                padding: 20px;
                background-color: #f8f9fa;
                /* Warna latar belakang yang lembut */
                border: 1px solid #e9ecef;
                /* Border yang lembut */
                border-radius: 5px;
                /* Sudut yang membulat */
                margin-top: 20px;
                color: #6c757d;
                /* Warna teks yang sedikit abu-abu */
            }
        </style>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/news.blade.php ENDPATH**/ ?>