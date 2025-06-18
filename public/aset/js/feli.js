/**
 * Main application script for Teknik Metalurgi IT Del website
 * Handles scrolling, modals, carousels, search, and form submissions
 */

// =============================================================================
// CONSTANTS AND CONFIGURATION
// =============================================================================

const DOM = {
    arrowUp: document.getElementById('arrowUp'),
    searchForm: document.getElementById('searchForm'),
    searchInput: document.getElementById('searchInput'),
    questionForm: document.getElementById('questionForm'),
    reviewForm: document.getElementById('reviewForm'),
    questionConfirmation: document.getElementById('questionConfirmation'),
    reviewConfirmation: document.getElementById('reviewConfirmation'),
    successToast: document.getElementById('successToast'),
    chatModal: document.getElementById('chatModal'),
    testimonialCarousel: document.getElementById('testimonialCarousel'),
    testimonialContainer: document.querySelector('.testimonial-carousel-container'),
    kerjasamaSlider: document.querySelector('.kerjasama-slider')
};

const SCROLL_CONFIG = {
    debounceTime: 1000,
    scrollThreshold: 100,
    touchThreshold: 50,
    scrollYThreshold: 300
};

const SECTIONS = [
    'header-section',
    'hero-section',
    'news-section',
    'testimonial-section',
    'kerjasama-section',
    'footer-section'
];

// =============================================================================
// DEVICE DETECTION
// =============================================================================

const DeviceDetector = {
    // Detect if device is mobile based on screen size and user agent
    isMobile() {
        const mobileUserAgents = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i;
        const screenWidth = window.innerWidth;
        const screenHeight = window.innerHeight;

        // Check user agent for mobile devices
        const isMobileUserAgent = mobileUserAgents.test(navigator.userAgent);

        // Check screen dimensions (mobile typically < 768px width)
        const isMobileScreen = screenWidth < 768;

        // Check if it's a touch device
        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

        return isMobileUserAgent || (isMobileScreen && isTouchDevice);
    },

    // Detect if device is tablet
    isTablet() {
        const screenWidth = window.innerWidth;
        const screenHeight = window.innerHeight;
        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

        // Tablet detection: touch device with medium screen size
        return isTouchDevice && screenWidth >= 768 && screenWidth <= 1024;
    },

    // Check if snap scrolling should be enabled
    shouldEnableSnapScroll() {
        const screenWidth = window.innerWidth;
        const screenHeight = window.innerHeight;

        // Enable snap scroll only for desktop/laptop
        // Disable for mobile phones and small tablets
        if (this.isMobile()) {
            return false;
        }

        // Enable for larger screens (desktop/laptop)
        if (screenWidth >= 1024) {
            return true;
        }

        // For medium screens (tablets), enable only if in landscape mode
        if (screenWidth >= 768 && screenWidth < 1024) {
            // Check if it's likely a laptop with small screen or tablet in landscape
            const aspectRatio = screenWidth / screenHeight;
            return aspectRatio > 1.2; // Landscape mode
        }

        return false;
    },

    // Check if current viewport suggests split screen
    isSplitScreen() {
        const screenWidth = window.innerWidth;
        const screenHeight = window.innerHeight;
        const aspectRatio = screenWidth / screenHeight;

        // Split screen detection heuristics
        // Very narrow aspect ratio might indicate split screen
        if (screenWidth < 800 && aspectRatio < 1.5) {
            return true;
        }

        // Check if screen is unusually narrow for a typical desktop
        if (screenWidth < 1200 && screenHeight > 600 && aspectRatio < 1.3) {
            return true;
        }

        return false;
    }
};

// =============================================================================
// STATE MANAGEMENT
// =============================================================================

let isScrolling = false;
let currentTestimonialIndex = 0;
let currentKerjasamaIndex = 0;
let touchStartY = 0;
let touchEndY = 0;
let snapScrollEnabled = false;

// =============================================================================
// UTILITY FUNCTIONS
// =============================================================================

const getCsrfToken = () => {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta?.content ?? '';
};

const isHomePage = () => {
    const { pathname } = window.location;
    return pathname === '/' || pathname === '/home' || pathname.endsWith('index');
};

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

const getScrollableSections = () => {
    if (!isHomePage()) return [];

    return SECTIONS
        .map(id => document.getElementById(id))
        .filter(section => section !== null);
};

const debounce = (func, wait) => {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

const updateSnapScrollState = () => {
    const shouldEnable = DeviceDetector.shouldEnableSnapScroll();

    if (snapScrollEnabled !== shouldEnable) {
        snapScrollEnabled = shouldEnable;
        console.log(`Snap scroll ${snapScrollEnabled ? 'enabled' : 'disabled'} for current device/viewport`);
    }
};

// =============================================================================
// SCROLL HANDLING
// =============================================================================

const scrollToNearestSection = (direction) => {
    if (!isHomePage() || isScrolling || !snapScrollEnabled) return;

    const sections = getScrollableSections();
    const currentScrollY = window.scrollY;
    const threshold = SCROLL_CONFIG.scrollThreshold;

    const targetSection = direction > 0
        ? sections.find(section => section.offsetTop > currentScrollY + threshold)
        : sections.slice().reverse().find(section => section.offsetTop < currentScrollY - threshold);

    if (targetSection) {
        isScrolling = true;
        targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        setTimeout(() => {
            isScrolling = false;
        }, SCROLL_CONFIG.debounceTime);
    }
};

const handleWheelScroll = (event) => {
    if (!isHomePage() || document.querySelector('.modal.show') || !snapScrollEnabled) {
        return;
    }

    event.preventDefault();
    if (!isScrolling) {
        scrollToNearestSection(event.deltaY > 0 ? 1 : -1);
    }
};

const handleTouchStart = (event) => {
    if (!isHomePage() || document.querySelector('.modal.show') || !snapScrollEnabled) return;
    touchStartY = event.touches[0].clientY;
};

const handleTouchEnd = (event) => {
    if (!isHomePage() || document.querySelector('.modal.show') || isScrolling || !snapScrollEnabled) return;

    touchEndY = event.changedTouches[0].clientY;
    const touchDifference = touchStartY - touchEndY;

    if (Math.abs(touchDifference) > SCROLL_CONFIG.touchThreshold) {
        isScrolling = true;
        scrollToNearestSection(touchDifference > 0 ? 1 : -1);
        setTimeout(() => {
            isScrolling = false;
        }, SCROLL_CONFIG.debounceTime);
    }
};

const handleKeyDown = (event) => {
    if (!isHomePage() || isScrolling || document.querySelector('.modal.show') || !snapScrollEnabled) return;

    const keyActions = {
        'ArrowDown': () => scrollToNearestSection(1),
        'PageDown': () => scrollToNearestSection(1),
        ' ': () => scrollToNearestSection(1),
        'ArrowUp': () => scrollToNearestSection(-1),
        'PageUp': () => scrollToNearestSection(-1),
        'Home': () => scrollToTop(),
        'End': () => {
            const footer = document.getElementById('footer-section');
            footer?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    };

    if (keyActions[event.key]) {
        event.preventDefault();
        isScrolling = true;
        keyActions[event.key]();
        setTimeout(() => {
            isScrolling = false;
        }, SCROLL_CONFIG.debounceTime);
    }
};

// =============================================================================
// MODAL MANAGEMENT
// =============================================================================

const showCollaborationModal = (title, companyProfile, description) => {
    const modalElements = {
        title: document.getElementById('collaborationModalLabel'),
        companyProfile: document.getElementById('modalCompanyProfile'),
        description: document.getElementById('modalInstitutionDescription'),
        modal: document.getElementById('collaborationModal')
    };

    // Validate all modal elements exist
    if (!Object.values(modalElements).every(el => el)) {
        console.error('Modal elements not found');
        return;
    }

    // Set modal content
    modalElements.title.textContent = title || 'No Title';
    modalElements.companyProfile.innerHTML = companyProfile
        ? JSON.parse(companyProfile)
        : 'No company profile available.';
    modalElements.description.innerHTML = description
        ? JSON.parse(description)
        : 'No description available.';

    // Create and show modal
    const modal = new bootstrap.Modal(modalElements.modal, {
        keyboard: true,
        backdrop: true,
        focus: true
    });

    // Cleanup on modal hide
    modalElements.modal.addEventListener('hidden.bs.modal', () => {
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }, { once: true });

    modal.show();
};

// =============================================================================
// CAROUSEL MANAGEMENT
// =============================================================================

const moveTestimonial = (direction) => {
    const cards = document.querySelectorAll('.testimonial-card');
    if (!cards.length || !DOM.testimonialContainer) return;

    const cardWidth = cards[0].offsetWidth;
    const containerWidth = DOM.testimonialContainer.offsetWidth;
    const cardsPerView = Math.floor(containerWidth / cardWidth);

    // Ensure we have at least 1 card per view
    const effectiveCardsPerView = Math.max(1, cardsPerView);

    // Calculate new index with bounds checking
    const maxIndex = Math.max(0, cards.length - effectiveCardsPerView);
    const newIndex = currentTestimonialIndex + direction;

    // Update current index with proper bounds
    currentTestimonialIndex = Math.max(0, Math.min(newIndex, maxIndex));

    // Apply transform
    const translateX = currentTestimonialIndex * cardWidth;
    DOM.testimonialCarousel.style.transform = `translateX(-${translateX}px)`;

    // Update navigation buttons
    updateTestimonialNavButtons(cards.length, effectiveCardsPerView);
};

const updateTestimonialNavButtons = (cardCount, cardsPerView) => {
    const buttons = document.querySelectorAll('.testimonial-section .nav-arrow');
    const [leftButton, rightButton] = buttons;

    if (!leftButton || !rightButton) return;

    // Ensure cardsPerView is at least 1 to avoid division issues
    const effectiveCardsPerView = Math.max(1, cardsPerView);

    const isAtStart = currentTestimonialIndex === 0;
    const isAtEnd = currentTestimonialIndex >= Math.max(0, cardCount - effectiveCardsPerView);

    // Update button states
    leftButton.disabled = isAtStart;
    rightButton.disabled = isAtEnd;

    // Update visual states
    leftButton.classList.toggle('disabled', isAtStart);
    rightButton.classList.toggle('disabled', isAtEnd);

    // Add visual feedback
    leftButton.style.opacity = isAtStart ? '0.5' : '1';
    rightButton.style.opacity = isAtEnd ? '0.5' : '1';
    leftButton.style.cursor = isAtStart ? 'not-allowed' : 'pointer';
    rightButton.style.cursor = isAtEnd ? 'not-allowed' : 'pointer';
};

// Fungsi ini (moveKerjasama) dan updateKerjasamaNavButtons di bawahnya
// sudah ditulis dengan baik untuk fungsionalitas slider kerjasama.
// Memastikan fungsi-fungsi ini ada dan dipanggil dengan benar (misalnya via onclick di HTML
// atau event listener yang di-setup) akan membuat navigasi kerjasama berfungsi.
// Inisialisasi juga sudah ada di setupCarousels.
const moveKerjasama = (direction) => {
    // Gunakan selector baru dari objek DOM
    if (!DOM.kerjasamaSlider) return;

    // Kita sekarang memilih 'halaman', bukan 'baris'
    const pages = document.querySelectorAll('.kerjasama-page');
    if (!pages.length) return;

    const newIndex = currentKerjasamaIndex + direction;

    // Batasi indeks agar tidak keluar dari rentang halaman yang ada
    currentKerjasamaIndex = Math.max(0, Math.min(newIndex, pages.length - 1));

    // Geser slider utama berdasarkan indeks halaman saat ini
    DOM.kerjasamaSlider.style.transform = `translateX(-${currentKerjasamaIndex * 100}%)`;

    updateKerjasamaNavButtons(pages.length);
};

const updateKerjasamaNavButtons = (pageCount) => {
    // Cari tombol di dalam section yang benar
    const leftButton = document.querySelector('.kerjasama-section .nav-arrow.left');
    const rightButton = document.querySelector('.kerjasama-section .nav-arrow.right');

    if (!leftButton || !rightButton) return;

    // Sembunyikan kedua tombol jika hanya ada satu halaman atau kurang
    if (pageCount <= 1) {
        leftButton.style.display = 'none';
        rightButton.style.display = 'none';
        return;
    } else {
        leftButton.style.display = 'flex'; // atau 'block'
        rightButton.style.display = 'flex'; // atau 'block'
    }

    const isAtStart = currentKerjasamaIndex === 0;
    const isAtEnd = currentKerjasamaIndex >= pageCount - 1;

    leftButton.disabled = isAtStart;
    rightButton.disabled = isAtEnd;

    // Tambahkan style visual untuk tombol disabled
    leftButton.style.opacity = isAtStart ? '0.5' : '1';
    rightButton.style.opacity = isAtEnd ? '0.5' : '1';
    leftButton.style.cursor = isAtStart ? 'not-allowed' : 'pointer';
    rightButton.style.cursor = isAtEnd ? 'not-allowed' : 'pointer';
};

// =============================================================================
// SEARCH FUNCTIONALITY
// =============================================================================

const createSearchResultCard = (item, type) => {
    const templates = {
        news: (item) => `
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card">
                    ${item.image ? `<img src="${item.image}" class="card-img-top" alt="${item.title}">` : ''}
                    <div class="card-body">
                        <h5 class="card-title">${item.title}</h5>
                        <p class="card-text">${item.content}</p>
                        <a href="${item.url}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        `,
        testimonials: (item) => `
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card">
                    ${item.image ? `<img src="${item.image}" class="card-img-top" alt="${item.name}">` : ''}
                    <div class="card-body">
                        <h5 class="card-title">${item.name}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">${item.student}</h6>
                        <p class="card-text">${item.content}</p>
                    </div>
                </div>
            </div>
        `,
        collaborates: (item) => `
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card">
                    ${item.logo ? `<img src="${item.logo}" class="card-img-top" alt="${item.institution_name}">` : ''}
                    <div class="card-body">
                        <h5 class="card-title">${item.institution_name}</h5>
                        <p class="card-text">${item.company_profile}</p>
                        <small class="text-muted">Date: ${item.date}</small>
                    </div>
                </div>
            </div>
        `
    };

    return templates[type] ? templates[type](item) : '';
};

const showSearchResults = (data) => {
    const query = data.query || 'Unknown Query';
    let resultsHTML = `
        <div class="container mt-5">
            <h2>Search Results for: "${query}"</h2>
            <div class="row">
    `;

    const sections = [
        { name: 'news', title: 'Berita' },
        { name: 'testimonials', title: 'Testimoni' },
        { name: 'collaborates', title: 'Kerjasama' }
    ];

    sections.forEach(section => {
        if (data[section.name]?.length) {
            resultsHTML += `
                <div class="col-12 mb-4">
                    <h4>${section.title}</h4>
                    <div class="row">
                        ${data[section.name]
                    .map(item => createSearchResultCard(item, section.name))
                    .join('')}
                    </div>
                </div>
            `;
        }
    });

    resultsHTML += `
            </div>
            <div class="text-center mt-4">
                <a href="/" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    `;

    openSearchResultWindow(resultsHTML, `Search Results - ${query}`);
};

const showNoResults = (query) => {
    const content = `
        <div class="container text-center mt-5">
            <h1>No Results Found</h1>
            <p>Sorry, we couldn't find any results for: <strong>"${query || 'Unknown Query'}"</strong></p>
            <p>Try using a different or more specific keyword.</p>
            <a href="/" class="btn btn-primary">Back to Home</a>
        </div>
    `;

    openSearchResultWindow(content, 'No Results Found');
};

const openSearchResultWindow = (content, title) => {
    const newWindow = window.open('', '_blank');
    newWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>${title} - Teknik Metalurgi IT Del</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            ${content}
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
    `);
};

// =============================================================================
// FORM HANDLING
// =============================================================================

const handleSearchForm = async (e) => {
    e.preventDefault();

    const query = DOM.searchInput.value.trim();
    if (!query) {
        alert('Please enter a search keyword.');
        return;
    }

    const submitButton = DOM.searchForm.querySelector('button[type="submit"]');
    const originalButtonContent = submitButton.innerHTML;

    // Show loading state
    submitButton.innerHTML = '<i class="bi bi-hourglass-split"></i>';
    submitButton.disabled = true;

    try {
        const response = await fetch(`/search?query=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();

        // Handle different response types
        if (data.page) {
            window.location.href = data.page.url;
        } else if (data.news?.length || data.testimonials?.length || data.collaborates?.length) {
            showSearchResults(data);
        } else {
            showNoResults(query);
        }
    } catch (error) {
        console.error('Search error:', error);
        alert(`Search error: ${error.message}`);
    } finally {
        // Restore button state
        submitButton.innerHTML = originalButtonContent;
        submitButton.disabled = false;
    }
};

const handleQuestionForm = async (e) => {
    e.preventDefault();

    const email = document.getElementById('email')?.value;
    const userType = document.querySelector('input[name="userType"]:checked')?.value;
    const question = document.getElementById('question')?.value;

    if (!userType) {
        alert('Please select a user type.');
        return;
    }

    const requestData = {
        email,
        type: 'question',
        user_type: userType,
        content: question
    };

    console.log('Sending question data:', requestData);

    try {
        const response = await fetch('/api/inquiries', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestData)
        });

        const data = await response.json();
        console.log('Server response:', data);

        if (data.success) {
            DOM.questionForm.classList.add('d-none');
            DOM.questionConfirmation?.classList.remove('d-none');

            if (DOM.successToast) {
                bootstrap.Toast.getOrCreateInstance(DOM.successToast).show();
            }

            DOM.questionForm.reset();
        } else {
            alert(`Failed to submit question: ${data.message || 'Unknown error'}`);
        }
    } catch (error) {
        console.error('Question submission error:', error);
        alert(`Error submitting question: ${error.message || 'Unknown error'}`);
    }
};

const handleReviewForm = async (e) => {
    e.preventDefault();

    const email = document.getElementById('reviewEmail')?.value;
    const rating = document.getElementById('rating')?.value;
    const reviewText = document.getElementById('reviewText')?.value;

    const requestData = {
        email,
        type: 'review',
        content: reviewText,
        rating
    };

    try {
        const response = await fetch('/api/inquiries', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestData)
        });

        const data = await response.json();

        if (data.success) {
            DOM.reviewForm.classList.add('d-none');
            DOM.reviewConfirmation?.classList.remove('d-none');

            if (DOM.successToast) {
                bootstrap.Toast.getOrCreateInstance(DOM.successToast).show();
            }

            DOM.reviewForm.reset();
        } else {
            alert(`Failed to submit review: ${data.message || 'Unknown error'}`);
        }
    } catch (error) {
        console.error('Review submission error:', error);
        alert('Error submitting review.');
    }
};

// =============================================================================
// EVENT LISTENERS SETUP
// =============================================================================

const setupScrollEvents = () => {
    if (!isHomePage()) return;

    // Only add scroll events if snap scroll is enabled
    if (snapScrollEnabled) {
        document.addEventListener('wheel', handleWheelScroll, { passive: false });
        document.addEventListener('touchstart', handleTouchStart, { passive: true });
        document.addEventListener('touchend', handleTouchEnd, { passive: true });
        document.addEventListener('keydown', handleKeyDown);
    }
};

const setupScrollVisibility = () => {
    const handleScroll = debounce(() => {
        if (DOM.arrowUp) {
            DOM.arrowUp.classList.toggle('visible',
                window.scrollY > SCROLL_CONFIG.scrollYThreshold);
        }
    }, 100);

    window.addEventListener('scroll', handleScroll);
};

const setupSmoothScrollLinks = () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            e.preventDefault();

            const targetId = anchor.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                if (isHomePage() && snapScrollEnabled) isScrolling = true;

                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                if (isHomePage() && snapScrollEnabled) {
                    setTimeout(() => {
                        isScrolling = false;
                    }, SCROLL_CONFIG.debounceTime);
                }
            }
        });
    });
};

const setupTooltips = () => {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el);
    });
};

const setupCarousels = () => {
    // Initialize testimonial carousel
    if (DOM.testimonialContainer && document.querySelector('.testimonial-card')) {
        const cards = document.querySelectorAll('.testimonial-card');
        const containerWidth = DOM.testimonialContainer.offsetWidth;
        const cardWidth = cards[0].offsetWidth;
        const cardsPerView = Math.floor(containerWidth / cardWidth);
        const effectiveCardsPerView = Math.max(1, cardsPerView);

        // Reset index to 0 on initialization
        currentTestimonialIndex = 0;

        // Update buttons immediately
        updateTestimonialNavButtons(cards.length, effectiveCardsPerView);

        // Add resize listener for testimonial carousel
        const handleTestimonialResize = debounce(() => {
            const newCardsPerView = Math.floor(DOM.testimonialContainer.offsetWidth / cards[0].offsetWidth);
            const newEffectiveCardsPerView = Math.max(1, newCardsPerView);

            // Adjust current index if needed
            const maxIndex = Math.max(0, cards.length - newEffectiveCardsPerView);
            currentTestimonialIndex = Math.min(currentTestimonialIndex, maxIndex);

            // Update transform
            DOM.testimonialCarousel.style.transform = `translateX(-${currentTestimonialIndex * cards[0].offsetWidth}px)`;

            // Update buttons
            updateTestimonialNavButtons(cards.length, newEffectiveCardsPerView);
        }, 250);

        window.addEventListener('resize', handleTestimonialResize);
    }

    // Initialize kerjasama carousel
    // Logika untuk kerjasama carousel (moveKerjasama, updateKerjasamaNavButtons)
    // sudah ada dan diekspor secara global (window.moveKerjasama).
    // Inisialisasi di bawah ini memastikan state awal benar.
    // Jika tombol navigasi di HTML memanggil window.moveKerjasama(-1) atau window.moveKerjasama(1),
    // maka fungsionalitasnya akan berjalan sesuai dengan logika yang sudah ada.
    if (DOM.kerjasamaSlider && document.querySelectorAll('.kerjasama-page').length) {
        // Reset index ke 0 saat inisialisasi
        currentKerjasamaIndex = 0;
        DOM.kerjasamaSlider.style.transform = 'translateX(0%)'; // Pastikan slider di posisi awal
        updateKerjasamaNavButtons(document.querySelectorAll('.kerjasama-page').length);
    }
};

const setupForms = () => {
    // Search form
    if (DOM.searchForm && DOM.searchInput) {
        DOM.searchForm.addEventListener('submit', handleSearchForm);
    }

    // Question form
    if (DOM.questionForm) {
        DOM.questionForm.addEventListener('submit', handleQuestionForm);
    }

    // Review form
    if (DOM.reviewForm) {
        DOM.reviewForm.addEventListener('submit', handleReviewForm);
    }
};

const setupModals = () => {
    // Modal backdrop handler
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('modal-backdrop')) {
            document.querySelectorAll('.modal.show').forEach(modal => {
                bootstrap.Modal.getInstance(modal)?.hide();
            });
        }
    });

    // Chat modal tab switching
    if (DOM.chatModal) {
        DOM.chatModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const tab = button.getAttribute('data-bs-tab');

            if (tab === 'review') {
                const tabs = {
                    review: {
                        tab: document.getElementById('review-tab'),
                        pane: document.getElementById('review-pane')
                    },
                    question: {
                        tab: document.getElementById('question-tab'),
                        pane: document.getElementById('question-pane')
                    }
                };

                if (Object.values(tabs).every(t => t.tab && t.pane)) {
                    tabs.question.tab.classList.remove('active');
                    tabs.question.pane.classList.remove('show', 'active');
                    tabs.review.tab.classList.add('active');
                    tabs.review.pane.classList.add('show', 'active');
                }
            }
        });
    }
};

const setupResizeListener = () => {
    const handleResize = debounce(() => {
        const wasEnabled = snapScrollEnabled;
        updateSnapScrollState();

        // If snap scroll state changed, update event listeners
        if (wasEnabled !== snapScrollEnabled) {
            cleanup();
            setupScrollEvents();
        }
    }, 250);

    window.addEventListener('resize', handleResize);
};

// =============================================================================
// INITIALIZATION AND CLEANUP
// =============================================================================

const initialize = () => {
    // First, determine if snap scroll should be enabled
    updateSnapScrollState();

    // Setup all functionality
    setupScrollEvents();
    setupScrollVisibility();
    setupSmoothScrollLinks();
    setupTooltips();
    setupCarousels();
    setupForms();
    setupModals();
    setupResizeListener();

    // ---- MODIFIKASI DIMULAI: Membuat arrowUp berfungsi ----
    if (DOM.arrowUp) {
        DOM.arrowUp.addEventListener('click', (event) => {
            event.preventDefault(); // Mencegah aksi default jika arrowUp adalah tag <a>
            scrollToTop();
        });
    }
    // ---- MODIFIKASI SELESAI ----


    // Log current device state for debugging
    console.log('Device Detection:', {
        isMobile: DeviceDetector.isMobile(),
        isTablet: DeviceDetector.isTablet(),
        isSplitScreen: DeviceDetector.isSplitScreen(),
        snapScrollEnabled: snapScrollEnabled,
        screenWidth: window.innerWidth,
        screenHeight: window.innerHeight,
        userAgent: navigator.userAgent
    });
};

const cleanup = () => {
    if (isHomePage()) {
        document.removeEventListener('wheel', handleWheelScroll);
        document.removeEventListener('touchstart', handleTouchStart);
        document.removeEventListener('touchend', handleTouchEnd);
        document.removeEventListener('keydown', handleKeyDown);
    }
};

// =============================================================================
// APPLICATION START
// =============================================================================

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', initialize);

// Cleanup on page unload
window.addEventListener('unload', cleanup);

// =============================================================================
// GLOBAL EXPORTS (if needed by other scripts)
// =============================================================================

// Make certain functions available globally if needed
window.showCollaborationModal = showCollaborationModal;
window.moveTestimonial = moveTestimonial;
window.moveKerjasama = moveKerjasama; // Fungsi ini sudah diekspor, pastikan tombol di HTML memanggilnya.
window.DeviceDetector = DeviceDetector;
