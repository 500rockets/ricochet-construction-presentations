// Presentation Navigation Script
class PresentationController {
    constructor() {
        this.currentSlide = 1;
        this.totalSlides = 9;
        this.slides = document.querySelectorAll('.slide');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.slideCounter = document.getElementById('slideCounter');
        this.progressFill = document.querySelector('.progress-fill');
        
        this.init();
    }
    
    init() {
        this.updateSlideDisplay();
        this.bindEvents();
        this.updateButtons();
        this.updateProgress();
    }
    
    bindEvents() {
        // Button clicks
        this.prevBtn.addEventListener('click', () => this.previousSlide());
        this.nextBtn.addEventListener('click', () => this.nextSlide());
        
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            switch(e.key) {
                case 'ArrowLeft':
                case 'ArrowUp':
                    this.previousSlide();
                    e.preventDefault();
                    break;
                case 'ArrowRight':
                case 'ArrowDown':
                case ' ':
                    this.nextSlide();
                    e.preventDefault();
                    break;
                case 'Home':
                    this.goToSlide(1);
                    e.preventDefault();
                    break;
                case 'End':
                    this.goToSlide(this.totalSlides);
                    e.preventDefault();
                    break;
                case 'Escape':
                    this.toggleFullscreen();
                    e.preventDefault();
                    break;
            }
        });
        
        // Touch/swipe support
        let startX = 0;
        let startY = 0;
        
        document.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });
        
        document.addEventListener('touchend', (e) => {
            if (!startX || !startY) return;
            
            let endX = e.changedTouches[0].clientX;
            let endY = e.changedTouches[0].clientY;
            
            let diffX = startX - endX;
            let diffY = startY - endY;
            
            // Only trigger if horizontal swipe is greater than vertical
            if (Math.abs(diffX) > Math.abs(diffY)) {
                if (Math.abs(diffX) > 50) { // Minimum swipe distance
                    if (diffX > 0) {
                        this.nextSlide();
                    } else {
                        this.previousSlide();
                    }
                }
            }
            
            startX = 0;
            startY = 0;
        });
        
        // Click to advance (except on buttons and interactive elements)
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.nav-controls') && 
                !e.target.closest('.cta-button') && 
                !e.target.closest('.project-photo') && 
                !e.target.closest('.team-photo') &&
                !e.target.closest('.email-link') &&
                !e.target.closest('#lightbox')) {
                this.nextSlide();
            }
        });
    }
    
    nextSlide() {
        if (this.currentSlide < this.totalSlides) {
            this.currentSlide++;
            this.updateSlideDisplay();
            this.updateButtons();
            this.updateProgress();
            this.animateSlideTransition();
        }
    }
    
    previousSlide() {
        if (this.currentSlide > 1) {
            this.currentSlide--;
            this.updateSlideDisplay();
            this.updateButtons();
            this.updateProgress();
            this.animateSlideTransition();
        }
    }
    
    goToSlide(slideNumber) {
        if (slideNumber >= 1 && slideNumber <= this.totalSlides) {
            this.currentSlide = slideNumber;
            this.updateSlideDisplay();
            this.updateButtons();
            this.updateProgress();
            this.animateSlideTransition();
        }
    }
    
    updateSlideDisplay() {
        this.slides.forEach((slide, index) => {
            slide.classList.remove('active', 'prev');
            
            if (index + 1 === this.currentSlide) {
                slide.classList.add('active');
            } else if (index + 1 < this.currentSlide) {
                slide.classList.add('prev');
            }
        });
    }
    
    updateButtons() {
        this.prevBtn.disabled = this.currentSlide === 1;
        this.nextBtn.disabled = this.currentSlide === this.totalSlides;
    }
    
    updateProgress() {
        const progressPercentage = (this.currentSlide / this.totalSlides) * 100;
        this.progressFill.style.width = `${progressPercentage}%`;
        this.slideCounter.textContent = `${this.currentSlide} / ${this.totalSlides}`;
    }
    
    animateSlideTransition() {
        // Add a subtle animation class for enhanced transitions
        const currentSlideElement = document.querySelector('.slide.active');
        if (currentSlideElement) {
            currentSlideElement.style.transform = 'translateX(0) scale(0.98)';
            setTimeout(() => {
                currentSlideElement.style.transform = 'translateX(0) scale(1)';
            }, 100);
        }
    }
    
    toggleFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(err => {
                console.log(`Error attempting to enable fullscreen: ${err.message}`);
            });
        } else {
            document.exitFullscreen();
        }
    }
    
    // Auto-advance functionality (optional)
    startAutoAdvance(intervalMs = 10000) {
        this.autoAdvanceInterval = setInterval(() => {
            if (this.currentSlide < this.totalSlides) {
                this.nextSlide();
            } else {
                this.stopAutoAdvance();
            }
        }, intervalMs);
    }
    
    stopAutoAdvance() {
        if (this.autoAdvanceInterval) {
            clearInterval(this.autoAdvanceInterval);
            this.autoAdvanceInterval = null;
        }
    }
    
    // Add slide indicators
    createSlideIndicators() {
        const indicatorContainer = document.createElement('div');
        indicatorContainer.className = 'slide-indicators';
        
        for (let i = 1; i <= this.totalSlides; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'slide-indicator';
            indicator.dataset.slide = i;
            indicator.addEventListener('click', () => this.goToSlide(i));
            indicatorContainer.appendChild(indicator);
        }
        
        document.querySelector('.presentation-container').appendChild(indicatorContainer);
        this.updateIndicators();
    }
    
    updateIndicators() {
        const indicators = document.querySelectorAll('.slide-indicator');
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index + 1 === this.currentSlide);
        });
    }
}

// Lightbox functionality
const projectImages = [
    {
        src: '/images/ProjectPhotos/apartment_balcony_replacement.JPG',
        caption: 'Apartment Balcony Replacement'
    },
    {
        src: '/images/ProjectPhotos/apartment_rebuild_roofing_2.JPG',
        caption: 'Apartment Rebuild Roofing'
    },
    {
        src: '/images/ProjectPhotos/commercial_remodeled_interior.JPG',
        caption: 'Commercial Remodeled Interior'
    },
    {
        src: '/images/ProjectPhotos/retaining_wall.JPG',
        caption: 'Retaining Wall Construction'
    },
    {
        src: '/images/ProjectPhotos/team_working_drainage_repair.JPG',
        caption: 'Team Working Drainage Repair'
    },
    {
        src: '/images/ProjectPhotos/apartment_painting.jpg',
        caption: 'Apartment Painting Project'
    }
];

let currentLightboxIndex = 0;

function openLightbox(index) {
    currentLightboxIndex = index;
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    lightboxImage.src = projectImages[index].src;
    lightboxImage.alt = projectImages[index].caption;
    lightboxCaption.textContent = projectImages[index].caption;
    lightboxCounter.textContent = `${index + 1} / ${projectImages.length}`;
    
    lightbox.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
}

function changeLightboxImage(direction) {
    currentLightboxIndex += direction;
    
    if (currentLightboxIndex >= projectImages.length) {
        currentLightboxIndex = 0;
    } else if (currentLightboxIndex < 0) {
        currentLightboxIndex = projectImages.length - 1;
    }
    
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    lightboxImage.src = projectImages[currentLightboxIndex].src;
    lightboxImage.alt = projectImages[currentLightboxIndex].caption;
    lightboxCaption.textContent = projectImages[currentLightboxIndex].caption;
    lightboxCounter.textContent = `${currentLightboxIndex + 1} / ${projectImages.length}`;
}

// Close lightbox when clicking outside the image
document.addEventListener('click', (e) => {
    const lightbox = document.getElementById('lightbox');
    if (e.target === lightbox) {
        closeLightbox();
    }
});

// Keyboard navigation for lightbox
document.addEventListener('keydown', (e) => {
    const lightbox = document.getElementById('lightbox');
    if (lightbox.style.display === 'block') {
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                changeLightboxImage(-1);
                break;
            case 'ArrowRight':
                changeLightboxImage(1);
                break;
        }
    }
});

// Initialize presentation when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const presentation = new PresentationController();
    
    // Optional: Add slide indicators
    // presentation.createSlideIndicators();
    
    // Optional: Start auto-advance (uncomment to enable)
    // presentation.startAutoAdvance(15000); // 15 seconds per slide
    
    // Add some helpful console commands for development
    window.presentation = presentation;
    console.log('Presentation loaded! Use arrow keys, space, or click to navigate.');
    console.log('Available commands: presentation.goToSlide(n), presentation.startAutoAdvance(), presentation.stopAutoAdvance()');
});

// Add CSS for slide indicators if enabled
const indicatorStyles = `
.slide-indicators {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 1000;
}

.slide-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid rgba(251, 191, 36, 0.5);
    background: transparent;
    cursor: pointer;
    transition: all 0.3s ease;
}

.slide-indicator.active {
    background: #fbbf24;
    border-color: #fbbf24;
}

.slide-indicator:hover {
    border-color: #fbbf24;
    background: rgba(251, 191, 36, 0.3);
}
`;

// Inject indicator styles if needed
function injectIndicatorStyles() {
    const style = document.createElement('style');
    style.textContent = indicatorStyles;
    document.head.appendChild(style);
}

// Export for potential module use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PresentationController;
}
