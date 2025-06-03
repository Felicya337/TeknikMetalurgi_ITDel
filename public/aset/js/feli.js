// Fungsi untuk mendapatkan CSRF token dari meta tag
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.content : '';
}

// Fungsi untuk melakukan pencarian dengan AJAX
document.addEventListener('DOMContentLoaded', () => {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');

    if (searchForm) {
        searchForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const query = searchInput.value.trim();

            if (!query) {
                alert('Masukkan kata kunci pencarian.');
                return;
            }

            // Append query parameter to the URL for GET request
            fetch(`/search?query=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    // CSRF token is typically not needed for GET requests in Laravel
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        // Tampilkan halaman not found atau pesan error
                        window.location.href = '/not-found';
                    } else if (data.page) {
                        // Redirect ke halaman yang cocok
                        window.location.href = data.page.url;
                    } else {
                        // Tampilkan hasil pencarian di halaman pencarian
                        window.location.href = `/search?query=${encodeURIComponent(query)}`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.location.href = '/not-found';
                });
        });
    }
});

// ============ CHECK IF ON HOMEPAGE ============
function isHomepage() {
    const currentPath = window.location.pathname;
    return currentPath === '/' || currentPath === '/index' || currentPath === '';
}

// ============ SECTION SCROLLING (ONLY ON HOMEPAGE) ============
const sections = document.querySelectorAll('header, .hero-section, .news-container, .testimonial-section, .kerjasama-section, footer');
let currentSectionIndex = 0;
let isScrolling = false;
let sectionScrollingEnabled = false;

// Initialize section scrolling only on homepage
function initializeSectionScrolling() {
    if (isHomepage()) {
        sectionScrollingEnabled = true;
        console.log('Section scrolling enabled - Homepage detected');
    } else {
        sectionScrollingEnabled = false;
        console.log('Section scrolling disabled - Not on homepage');
    }
}

// Function to scroll to a specific section
function scrollToSection(index) {
    if (!sectionScrollingEnabled) return;

    if (index >= 0 && index < sections.length) {
        isScrolling = true;
        sections[index].scrollIntoView({ behavior: 'smooth' });
        currentSectionIndex = index;
        setTimeout(() => {
            isScrolling = false;
        }, 1000);
    }
}

// Handle scroll events for section navigation (only on homepage)
window.addEventListener('wheel', (event) => {
    if (!sectionScrollingEnabled) {
        return;
    }

    if (!isInsideScrollableElement(event.target)) {
        event.preventDefault();
    }

    if (isScrolling) return;

    const delta = event.deltaY;

    if (delta > 0 && currentSectionIndex < sections.length - 1) {
        scrollToSection(currentSectionIndex + 1);
    } else if (delta < 0 && currentSectionIndex > 0) {
        scrollToSection(currentSectionIndex - 1);
    }
}, { passive: false });

// Check if scroll event is inside a scrollable element
function isInsideScrollableElement(target) {
    let element = target;
    while (element && element !== document.body) {
        const style = window.getComputedStyle(element);
        if (style.overflowY === 'auto' || style.overflowY === 'scroll') {
            return true;
        }
        element = element.parentElement;
    }
    return false;
}

// Update current section on load or resize (only on homepage)
function updateCurrentSection() {
    if (!sectionScrollingEnabled) return;

    const scrollPosition = window.scrollY + window.innerHeight / 2;
    sections.forEach((section, index) => {
        const rect = section.getBoundingClientRect();
        const sectionTop = rect.top + window.scrollY;
        const sectionBottom = sectionTop + rect.height;

        if (scrollPosition >= sectionTop && scrollPosition <= sectionBottom) {
            currentSectionIndex = index;
        }
    });
}

// ============ SCROLL-TO-TOP ============
function scrollToTop() {
    if (sectionScrollingEnabled) {
        scrollToSection(0);
    } else {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

const arrowUp = document.getElementById('arrowUp');
const scrollThreshold = 300;

window.addEventListener('scroll', () => {
    if (window.pageYOffset > scrollThreshold) {
        arrowUp.classList.add('visible');
    } else {
        arrowUp.classList.remove('visible');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    initializeSectionScrolling();
    if (sectionScrollingEnabled) {
        updateCurrentSection();
    }

    if (window.pageYOffset > scrollThreshold) {
        arrowUp.classList.add('visible');
    }
});

window.addEventListener('resize', () => {
    if (sectionScrollingEnabled) {
        updateCurrentSection();
    }
});

if (arrowUp) {
    arrowUp.addEventListener('click', scrollToTop);
}

// ============ PAGE NAVIGATION HANDLER ============
window.addEventListener('popstate', () => {
    initializeSectionScrolling();
});

function reinitializeScrolling() {
    initializeSectionScrolling();
    if (sectionScrollingEnabled) {
        updateCurrentSection();
    }
}

// ============ TESTIMONIAL CAROUSEL ============
let testimonialIndex = 0;
const testimonialCarousel = document.getElementById('testimonialCarousel');
const testimonialCards = document.querySelectorAll('.testimonial-card');
const totalTestimonialCards = testimonialCards.length;

function getVisibleTestimonialCards() {
    const width = window.innerWidth;
    if (width <= 480) return 1;
    if (width <= 768) return 2;
    if (width <= 1200) return 3;
    return 4;
}

function moveTestimonialCarousel(direction) {
    const visibleCards = getVisibleTestimonialCards();
    const maxIndex = Math.max(0, totalTestimonialCards - visibleCards);

    testimonialIndex += direction;

    if (testimonialIndex < 0) {
        testimonialIndex = maxIndex;
    } else if (testimonialIndex > maxIndex) {
        testimonialIndex = 0;
    }

    const translateX = -(testimonialIndex * (100 / visibleCards));
    if (testimonialCarousel) {
        testimonialCarousel.style.transform = `translateX(${translateX}%)`;
    }
}

// ============ KERJASAMA CAROUSEL ============
let kerjasamaIndex = 0;
const kerjasamaContainer = document.querySelector('.kerjasama-container');
const kerjasamaRows = document.querySelectorAll('.kerjasama-row');
const totalKerjasamaRows = kerjasamaRows.length;

function moveKerjasama(direction) {
    kerjasamaIndex += direction;

    if (kerjasamaIndex < 0) {
        kerjasamaIndex = totalKerjasamaRows - 1;
    } else if (kerjasamaIndex >= totalKerjasamaRows) {
        kerjasamaIndex = 0;
    }

    const translateX = -(kerjasamaIndex * 100);
    if (kerjasamaContainer) {
        kerjasamaContainer.style.transform = `translateX(${translateX}%)`;
    }
}

// ============ NAVIGATION BUTTON EVENT LISTENERS ============
document.addEventListener('DOMContentLoaded', () => {
    const testimonialLeftBtn = document.querySelector('.testimonial-section .nav-arrow.left');
    const testimonialRightBtn = document.querySelector('.testimonial-section .nav-arrow.right');

    if (testimonialLeftBtn) {
        testimonialLeftBtn.addEventListener('click', () => moveTestimonialCarousel(-1));
    }
    if (testimonialRightBtn) {
        testimonialRightBtn.addEventListener('click', () => moveTestimonialCarousel(1));
    }

    const kerjasamaLeftBtn = document.querySelector('.kerjasama-section .nav-arrow.left');
    const kerjasamaRightBtn = document.querySelector('.kerjasama-section .nav-arrow.right');

    if (kerjasamaLeftBtn) {
        kerjasamaLeftBtn.addEventListener('click', () => moveKerjasama(-1));
    }
    if (kerjasamaRightBtn) {
        kerjasamaRightBtn.addEventListener('click', () => moveKerjasama(1));
    }
});

// ============ RESPONSIVE CAROUSEL HANDLING ============
window.addEventListener('resize', () => {
    const visibleCards = getVisibleTestimonialCards();
    const maxIndex = Math.max(0, totalTestimonialCards - visibleCards);

    if (testimonialIndex > maxIndex) {
        testimonialIndex = maxIndex;
    }

    const translateX = -(testimonialIndex * (100 / visibleCards));
    if (testimonialCarousel) {
        testimonialCarousel.style.transform = `translateX(${translateX}%)`;
    }
});

// ============ TOUCH/SWIPE SUPPORT ============
let startX = 0;
let endX = 0;

if (testimonialCarousel) {
    testimonialCarousel.addEventListener('touchstart', (e) => {
        startX = e.changedTouches[0].screenX;
    });

    testimonialCarousel.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].screenX;
        handleTestimonialGesture();
    });
}

function handleTestimonialGesture() {
    const minSwipeDistance = 50;
    if (endX < startX - minSwipeDistance) {
        moveTestimonialCarousel(1);
    }
    if (endX > startX + minSwipeDistance) {
        moveTestimonialCarousel(-1);
    }
}

if (kerjasamaContainer) {
    kerjasamaContainer.addEventListener('touchstart', (e) => {
        startX = e.changedTouches[0].screenX;
    });

    kerjasamaContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].screenX;
        handleKerjasamaGesture();
    });
}

function handleKerjasamaGesture() {
    const minSwipeDistance = 50;
    if (endX < startX - minSwipeDistance) {
        moveKerjasama(1);
    }
    if (endX > startX + minSwipeDistance) {
        moveKerjasama(-1);
    }
}

// ============ KEYBOARD NAVIGATION ============
document.addEventListener('keydown', (e) => {
    if (document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
        if (e.key === 'ArrowLeft') {
            moveTestimonialCarousel(-1);
            moveKerjasama(-1);
        } else if (e.key === 'ArrowRight') {
            moveTestimonialCarousel(1);
            moveKerjasama(1);
        }
    }
});

// ============ MODAL FUNCTIONS ============
function showCollaborationModal(title, companyProfile, description) {
    document.getElementById('collaborationModalLabel').textContent = title;
    let decodedCompanyProfile = companyProfile ? JSON.parse(companyProfile) : 'Tidak ada profil perusahaan';
    document.getElementById('modalCompanyProfile').innerHTML = decodedCompanyProfile;
    let decodedDescription = description ? JSON.parse(description) : 'Tidak ada deskripsi kerjasama';
    document.getElementById('modalInstitutionDescription').innerHTML = decodedDescription;
    var modal = new bootstrap.Modal(document.getElementById('collaborationModal'));
    modal.show();
}

// ============ TOOLTIP INITIALIZATION ============
document.addEventListener('DOMContentLoaded', () => {
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});

// ============ AUTO-SLIDE (OPTIONAL) ============
function autoSlideTestimonial() {
    moveTestimonialCarousel(1);
}

function autoSlideKerjasama() {
    moveKerjasama(1);
}

// Uncomment to enable auto-slide
// setInterval(autoSlideTestimonial, 5000);
// setInterval(autoSlideKerjasama, 7000);

// ============ UTILITY FUNCTIONS ============
function safeElementAction(selector, callback) {
    const element = document.querySelector(selector);
    if (element && typeof callback === 'function') {
        callback(element);
    }
}

window.moveTestimonial = function (direction) {
    moveTestimonialCarousel(direction);
};

window.moveKerjasama = function (direction) {
    moveKerjasama(direction);
};
