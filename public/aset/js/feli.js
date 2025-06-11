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
    kerjasamaContainer: document.querySelector('.kerjasama-container')
};

const SCROLL_CONFIG = {
    debounceTime: 1000,
    scrollThreshold: 100,
    touchThreshold: 50,
    scrollYThreshold: 300
};

let isScrolling = false;
let currentTestimonialIndex = 0;
let currentKerjasamaIndex = 0;
let touchStartY = 0;
let touchEndY = 0;

// Utility Functions
const getCsrfToken = () => {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta?.content ?? '';
};

const isHomePage = () => {
    const { pathname } = window.location;
    return pathname === '/' || pathname === '/home' || pathname.endsWith('index');
};

const scrollToTop = () => window.scrollTo({ top: 0, behavior: 'smooth' });

const getScrollableSections = () => {
    if (!isHomePage()) return [];
    const sections = [
        'header-section',
        'hero-section',
        'news-section',
        'testimonial-section',
        'kerjasama-section',
        'footer-section'
    ];
    return sections
        .map(id => document.getElementById(id))
        .filter(section => section !== null);
};

// Scroll Handling
const scrollToNearestSection = (direction) => {
    if (!isHomePage() || isScrolling) return;

    const sections = getScrollableSections();
    const currentScrollY = window.scrollY;

    const targetSection = direction > 0
        ? sections.find(section => section.offsetTop > currentScrollY + SCROLL_CONFIG.scrollThreshold)
        : sections.slice().reverse().find(section => section.offsetTop < currentScrollY - SCROLL_CONFIG.scrollThreshold);

    if (targetSection) {
        isScrolling = true;
        targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        setTimeout(() => { isScrolling = false; }, SCROLL_CONFIG.debounceTime);
    }
};

// Event Handlers
const handleWheelScroll = (event) => {
    if (!isHomePage() || document.querySelector('.modal.show')) {
        return;
    }
    event.preventDefault();
    if (!isScrolling) {
        scrollToNearestSection(event.deltaY > 0 ? 1 : -1);
    }
};

const handleTouchStart = (event) => {
    if (!isHomePage() || document.querySelector('.modal.show')) return;
    touchStartY = event.touches[0].clientY;
};

const handleTouchEnd = (event) => {
    if (!isHomePage() || document.querySelector('.modal.show') || isScrolling) return;

    touchEndY = event.changedTouches[0].clientY;
    const touchDifference = touchStartY - touchEndY;

    if (Math.abs(touchDifference) > SCROLL_CONFIG.touchThreshold) {
        isScrolling = true;
        scrollToNearestSection(touchDifference > 0 ? 1 : -1);
        setTimeout(() => { isScrolling = false; }, SCROLL_CONFIG.debounceTime);
    }
};

const handleKeyDown = (event) => {
    if (!isHomePage() || isScrolling || document.querySelector('.modal.show')) return;

    const actions = {
        'ArrowDown': () => scrollToNearestSection(1),
        'PageDown': () => scrollToNearestSection(1),
        ' ': () => scrollToNearestSection(1),
        'ArrowUp': () => scrollToNearestSection(-1),
        'PageUp': () => scrollToNearestSection(-1),
        'Home': () => scrollToTop(),
        'End': () => document.getElementById('footer-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' })
    };

    if (actions[event.key]) {
        event.preventDefault();
        isScrolling = true;
        actions[event.key]();
        setTimeout(() => { isScrolling = false; }, SCROLL_CONFIG.debounceTime);
    }
};

// Modal Handling
const showCollaborationModal = (title, companyProfile, description) => {
    const modalElements = {
        title: document.getElementById('collaborationModalLabel'),
        companyProfile: document.getElementById('modalCompanyProfile'),
        description: document.getElementById('modalInstitutionDescription'),
        modal: document.getElementById('collaborationModal')
    };

    if (Object.values(modalElements).every(el => el)) {
        modalElements.title.textContent = title || 'No Title';
        modalElements.companyProfile.innerHTML = companyProfile ? JSON.parse(companyProfile) : 'No company profile available.';
        modalElements.description.innerHTML = description ? JSON.parse(description) : 'No description available.';

        const modal = new bootstrap.Modal(modalElements.modal, {
            keyboard: true,
            backdrop: true,
            focus: true
        });

        modalElements.modal.addEventListener('hidden.bs.modal', () => {
            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }, { once: true });

        modal.show();
    } else {
        console.error('Modal elements not found');
    }
};

// Carousel Navigation
const moveTestimonial = (direction) => {
    const cards = document.querySelectorAll('.testimonial-card');
    if (!cards.length || !DOM.testimonialContainer) return;

    const cardWidth = cards[0].offsetWidth;
    const cardsPerView = Math.floor(DOM.testimonialContainer.offsetWidth / cardWidth);

    currentTestimonialIndex = Math.max(0, Math.min(
        currentTestimonialIndex + direction,
        cards.length - cardsPerView
    ));

    DOM.testimonialCarousel.style.transform = `translateX(-${currentTestimonialIndex * cardWidth}px)`;
    updateTestimonialNavButtons(cards.length, cardsPerView);
};

const updateTestimonialNavButtons = (cardCount, cardsPerView) => {
    const [leftButton, rightButton] = document.querySelectorAll('.testimonial-section .nav-arrow');
    if (leftButton && rightButton) {
        leftButton.disabled = currentTestimonialIndex === 0;
        rightButton.disabled = currentTestimonialIndex >= cardCount - cardsPerView;
        leftButton.classList.toggle('disabled', currentTestimonialIndex === 0);
        rightButton.classList.toggle('disabled', currentTestimonialIndex >= cardCount - cardsPerView);
    }
};

const moveKerjasama = (direction) => {
    const rows = document.querySelectorAll('.kerjasama-row');
    if (!rows.length || !DOM.kerjasamaContainer) return;

    currentKerjasamaIndex = Math.max(0, Math.min(
        currentKerjasamaIndex + direction,
        rows.length - 1
    ));

    DOM.kerjasamaContainer.style.transform = `translateX(-${currentKerjasamaIndex * 100}%)`;
    updateKerjasamaNavButtons(rows.length);
};

const updateKerjasamaNavButtons = (rowCount) => {
    const [leftButton, rightButton] = document.querySelectorAll('.kerjasama-section .nav-arrow');
    if (leftButton && rightButton) {
        leftButton.disabled = currentKerjasamaIndex === 0;
        rightButton.disabled = currentKerjasamaIndex >= rowCount - 1;
        leftButton.classList.toggle('disabled', currentKerjasamaIndex === 0);
        rightButton.classList.toggle('disabled', currentKerjasamaIndex >= rowCount - 1);
    }
};

// Search Results
const showSearchResults = (data) => {
    let resultsHTML = `
        <div class="container mt-5">
            <h2>Search Results for: "${data.query || 'Unknown Query'}"</h2>
            <div class="row">
    `;

    const sections = [
        {
            name: 'news', title: 'Berita', template: item => `
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
        `},
        {
            name: 'testimonials', title: 'Testimoni', template: item => `
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
        `},
        {
            name: 'collaborates', title: 'Kerjasama', template: item => `
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
        `}
    ];

    sections.forEach(section => {
        if (data[section.name]?.length) {
            resultsHTML += `
                <div class="col-12 mb-4">
                    <h4>${section.title}</h4>
                    <div class="row">
                        ${data[section.name].map(section.template).join('')}
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

    const newWindow = window.open('', '_blank');
    newWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Search Results - Teknik Metalurgi IT Del</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            ${resultsHTML}
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
    `);
};

const showNoResults = (query) => {
    const newWindow = window.open('', '_blank');
    newWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>No Results - Teknik Metalurgi IT Del</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container text-center mt-5">
                <h1>No Results Found</h1>
                <p>Sorry, we couldn't find any results for: <strong>"${query || 'Unknown Query'}"</strong></p>
                <p>Try using a different or more specific keyword.</p>
                <a href="/" class="btn btn-primary">Back to Home</a>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
    `);
};

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    // Scroll Events
    if (isHomePage()) {
        document.addEventListener('wheel', handleWheelScroll, { passive: false });
        document.addEventListener('touchstart', handleTouchStart, { passive: true });
        document.addEventListener('touchend', handleTouchEnd, { passive: true });
        document.addEventListener('keydown', handleKeyDown);
    }

    // Scroll Visibility
    window.addEventListener('scroll', () => {
        if (DOM.arrowUp) {
            DOM.arrowUp.classList.toggle('visible', window.scrollY > SCROLL_CONFIG.scrollYThreshold);
        }
    });

    // Smooth Scroll Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = anchor.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                if (isHomePage()) isScrolling = true;
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                if (isHomePage()) setTimeout(() => { isScrolling = false; }, SCROLL_CONFIG.debounceTime);
            }
        });
    });

    // Tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el);
    });

    // Initialize Carousels
    if (DOM.testimonialContainer && document.querySelector('.testimonial-card')) {
        updateTestimonialNavButtons(
            document.querySelectorAll('.testimonial-card').length,
            Math.floor(DOM.testimonialContainer.offsetWidth / document.querySelector('.testimonial-card').offsetWidth)
        );
    }

    if (DOM.kerjasamaContainer && document.querySelectorAll('.kerjasama-row').length) {
        updateKerjasamaNavButtons(document.querySelectorAll('.kerjasama-row').length);
    }

    // Search Form
    if (DOM.searchForm && DOM.searchInput) {
        DOM.searchForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const query = DOM.searchInput.value.trim();
            if (!query) {
                alert('Please enter a search keyword.');
                return;
            }

            const submitButton = DOM.searchForm.querySelector('button[type="submit"]');
            const originalButtonContent = submitButton.innerHTML;
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

                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                const data = await response.json();

                submitButton.innerHTML = originalButtonContent;
                submitButton.disabled = false;

                if (data.page) {
                    window.location.href = data.page.url;
                } else if (data.news?.length || data.testimonials?.length || data.collaborates?.length) {
                    showSearchResults(data);
                } else {
                    showNoResults(query);
                }
            } catch (error) {
                console.error('Fetch error:', error);
                submitButton.innerHTML = originalButtonContent;
                submitButton.disabled = false;
                alert(`Search error: ${error.message}`);
            }
        });
    }

    // Modal Backdrop Handler
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('modal-backdrop')) {
            document.querySelectorAll('.modal.show').forEach(modal => {
                bootstrap.Modal.getInstance(modal)?.hide();
            });
        }
    });
    // Question Form
    if (DOM.questionForm) {
        DOM.questionForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email')?.value;
            const userType = document.querySelector('input[name="userType"]:checked')?.value;
            const question = document.getElementById('question')?.value;

            if (!userType) {
                alert('Please select a user type.');
                return;
            }

            console.log('Sending question data:', { email, type: 'question', user_type: userType, content: question });

            try {
                const response = await fetch('/api/inquiries', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, type: 'question', user_type: userType, content: question })
                });

                const data = await response.json();
                console.log('Server response:', data);

                if (data.success) {
                    DOM.questionForm.classList.add('d-none');
                    DOM.questionConfirmation?.classList.remove('d-none');
                    bootstrap.Toast.getOrCreateInstance(DOM.successToast).show();
                    DOM.questionForm.reset();
                } else {
                    alert(`Failed to submit question: ${data.message || 'Unknown error'}`);
                }
            } catch (error) {
                console.error('Fetch error:', error);
                alert(`Error submitting question: ${error.message || 'Unknown error'}`);
            }
        });
    }
    // Review Form
    if (DOM.reviewForm) {
        DOM.reviewForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('reviewEmail')?.value;
            const rating = document.getElementById('rating')?.value;
            const reviewText = document.getElementById('reviewText')?.value;

            try {
                const response = await fetch('/api/inquiries', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, type: 'review', content: reviewText, rating })
                });

                const data = await response.json();
                if (data.success) {
                    DOM.reviewForm.classList.add('d-none');
                    DOM.reviewConfirmation?.classList.remove('d-none');
                    bootstrap.Toast.getOrCreateInstance(DOM.successToast).show();
                    DOM.reviewForm.reset();
                } else {
                    alert(`Failed to submit review: ${data.message || 'Unknown error'}`);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error submitting review.');
            }
        });
    }
    // Chat Modal
    if (DOM.chatModal) {
        DOM.chatModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const tab = button.getAttribute('data-bs-tab');
            if (tab === 'review') {
                const tabs = {
                    review: { tab: document.getElementById('review-tab'), pane: document.getElementById('review-pane') },
                    question: { tab: document.getElementById('question-tab'), pane: document.getElementById('question-pane') }
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
});

// Cleanup
window.addEventListener('unload', () => {
    if (isHomePage()) {
        document.removeEventListener('wheel', handleWheelScroll);
        document.removeEventListener('touchstart', handleTouchStart);
        document.removeEventListener('touchend', handleTouchEnd);
        document.removeEventListener('keydown', handleKeyDown);
    }
});
