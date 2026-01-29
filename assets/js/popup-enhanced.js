/**
 * Compact Popup Modal Manager
 * Optimized for smaller size and better performance
 */
class CompactPopupManager {
    constructor() {
        this.modalElement = document.getElementById('iklanModal');
        this.modalInstance = null;
        this.countdownTimer = null;
        this.networkSpeed = this.detectNetworkSpeed();
        this.lazyImages = [];
        this.isModalShown = false;

        this.init();
    }

    init() {
        if (!this.modalElement) {
            console.warn('Popup modal element not found');
            return;
        }

        // Initialize lazy loading manager
        this.initLazyLoading();

        // Setup modal with shorter delay for compact experience
        this.setupModal();

        // Setup performance monitoring
        this.setupPerformanceMonitoring();
    }

    detectNetworkSpeed() {
        if ('connection' in navigator) {
            const connection = navigator.connection;
            if (connection.effectiveType === '4g') return 'fast';
            if (connection.effectiveType === '3g') return 'medium';
            return 'slow';
        }
        return 'medium';
    }

    initLazyLoading() {
        // Collect lazy images (those intended to load via data-src)
        this.lazyImages = this.modalElement.querySelectorAll('.popup-lazy');

        // If no lazy images exist, hide the loading overlay when the primary image is ready
        if (!this.lazyImages || this.lazyImages.length === 0) {
            const primaryImg = this.modalElement.querySelector('.popup-image.popup-primary');
            const overlay = primaryImg?.closest('.popup-image-container')?.querySelector('.popup-loading-overlay');

            const hideOverlay = () => {
                if (overlay) {
                    overlay.classList.add('popup-hidden');
                    setTimeout(() => {
                        overlay.style.display = 'none';
                    }, 400);
                }
            };

            // If primary image is already cached/loaded, hide immediately
            if (primaryImg && primaryImg.complete && primaryImg.naturalWidth > 0) {
                hideOverlay();
            } else if (primaryImg) {
                // Hide overlay once primary image finishes loading
                primaryImg.addEventListener('load', hideOverlay, { once: true });
                primaryImg.addEventListener('error', () => {
                    this.handleImageError(primaryImg, overlay);
                }, { once: true });
            } else {
                // No image found; hide overlay to avoid blocking UI
                hideOverlay();
            }

            return; // No lazy-loading setup needed
        }

        if ('IntersectionObserver' in window) {
            this.setupIntersectionObserver();
        } else {
            // Fallback for older browsers
            this.loadAllImages();
        }
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.loadImage(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '30px 0px' // Reduced for compact size
        });

        this.lazyImages.forEach(img => {
            observer.observe(img);
        });
    }

    loadImage(img) {
        // Support both data-src and existing src as a fallback
        const source = img?.dataset?.src || img.getAttribute('src');
        if (img.classList.contains('popup-lazyloaded')) return;
        if (!source) return;

        const overlay = img.closest('.popup-image-container')?.querySelector('.popup-loading-overlay');

        // Create temp image for preloading
        const tempImg = new Image();

        tempImg.onload = () => {
            // Update src
            if (img.dataset && img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }

            // Update classes
            img.classList.remove('popup-lazy');
            img.classList.add('popup-lazyloaded');

            // Hide loading overlay
            if (overlay) {
                overlay.classList.add('popup-hidden');
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 400); // Faster for compact experience
            }

            // Trigger success callback
            this.onImageLoadSuccess(img);
        };

        tempImg.onerror = () => {
            this.handleImageError(img, overlay);
        };

        // Start loading with shorter timeout for compact experience
        tempImg.src = source;

        // Timeout fallback - shorter for compact
        setTimeout(() => {
            if (!img.classList.contains('popup-lazyloaded')) {
                this.handleImageError(img, overlay);
            }
        }, 7000); // Reduced timeout
    }

    handleImageError(img, overlay) {
        img.classList.remove('popup-lazy');
        img.classList.add('popup-error');

        if (overlay) {
            overlay.innerHTML = `
                <div class="popup-loading-content">
                    <div class="popup-loading-text" style="color: #dc3545; font-size: 0.85rem;">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        Gagal memuat gambar
                    </div>
                </div>
            `;
        }

        console.warn('Failed to load popup image:', img.dataset.src);
    }

    onImageLoadSuccess(img) {
        // Trigger compact success animation
        img.style.animation = 'popup-fadeInScale 0.4s ease-out';
    }

    loadAllImages() {
        this.lazyImages.forEach(img => this.loadImage(img));
    }

    setupModal() {
        // Calculate optimal delay - shorter for compact experience
        const delay = this.calculateOptimalDelay();

        setTimeout(() => {
            this.showModal();
        }, delay);
    }

    calculateOptimalDelay() {
        // Base delay - shorter for compact
        let delay = 1200;

        // Adjust based on network speed
        if (this.networkSpeed === 'slow') delay += 800;
        if (this.networkSpeed === 'fast') delay -= 400;

        // Adjust based on page load performance
        if (performance.timing) {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            if (loadTime > 3000) delay += 300; // Smaller adjustment
        }

        return Math.max(800, Math.min(2000, delay)); // Min 0.8s, Max 2s
    }

    showModal() {
        if (this.isModalShown) return;

        try {
            this.modalInstance = new bootstrap.Modal(this.modalElement, {
                backdrop: 'static',
                keyboard: true,
                focus: true
            });

            // Setup event listeners
            this.setupModalEventListeners();

            // Show modal
            this.modalInstance.show();
            this.isModalShown = true;

            // Preload images when modal shows
            this.preloadModalImages();

        } catch (error) {
            console.error('Failed to initialize modal:', error);
        }
    }

    setupModalEventListeners() {
        // Modal shown event
        this.modalElement.addEventListener('shown.bs.modal', () => {
            this.onModalShown();
        });

        // Modal hide event
        this.modalElement.addEventListener('hide.bs.modal', () => {
            this.onModalHide();
        });

        // Modal hidden event
        this.modalElement.addEventListener('hidden.bs.modal', () => {
            this.onModalHidden();
        });
    }

    onModalShown() {
        // Start auto-close countdown - shorter for compact
        this.startCountdown();

        // Load visible images immediately
        this.loadVisibleImages();

        // Add subtle floating animation to modal (reduced for compact)
        const modalDialog = this.modalElement.querySelector('.modal-dialog');
        if (modalDialog && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            modalDialog.style.animation = 'popup-subtle-float 8s ease-in-out infinite';
        }
    }

    onModalHide() {
        // Clear countdown
        this.clearCountdown();

        // Add compact exit animation
        this.modalElement.style.animation = 'popup-fadeOut 0.3s ease-out';
    }

    onModalHidden() {
        // Cleanup
        this.cleanup();
    }

    loadVisibleImages() {
        this.lazyImages.forEach(img => {
            if (this.isElementVisible(img)) {
                this.loadImage(img);
            }
        });
    }

    isElementVisible(element) {
        const rect = element.getBoundingClientRect();
        const vw = window.innerWidth || document.documentElement.clientWidth;
        const vh = window.innerHeight || document.documentElement.clientHeight;
        // Consider visible if any part intersects the viewport
        return (
            rect.bottom >= 0 &&
            rect.right >= 0 &&
            rect.top <= vh &&
            rect.left <= vw
        );
    }

    preloadModalImages() {
        // Compact preload strategy
        const imagesToPreload = this.networkSpeed === 'fast' ? this.lazyImages.length :
            this.networkSpeed === 'medium' ? 1 : 1;

        for (let i = 0; i < Math.min(imagesToPreload, this.lazyImages.length); i++) {
            setTimeout(() => {
                this.loadImage(this.lazyImages[i]);
            }, i * 150); // Faster stagger for compact
        }
    }

    startCountdown() {
        let countdown = 15; // Shorter countdown for compact
        const closeBtn = this.modalElement.querySelector('.btn-close');

        this.countdownTimer = setInterval(() => {
            countdown--;

            if (closeBtn && countdown > 0) {
                closeBtn.setAttribute('title', `Auto close in ${countdown}s`);
                closeBtn.setAttribute('aria-label', `Tutup (auto close dalam ${countdown} detik)`);
            }

            if (countdown <= 0) {
                this.clearCountdown();
                this.hideModal();
            }
        }, 1000);
    }

    clearCountdown() {
        if (this.countdownTimer) {
            clearInterval(this.countdownTimer);
            this.countdownTimer = null;
        }
    }

    hideModal() {
        if (this.modalInstance) {
            this.modalInstance.hide();
        }
    }

    setupPerformanceMonitoring() {
        // Compact performance monitoring
        if ('PerformanceObserver' in window) {
            try {
                const observer = new PerformanceObserver((list) => {
                    const entries = list.getEntries();
                    entries.forEach(entry => {
                        if (entry.entryType === 'navigation') {
                            const loadTime = entry.loadEventEnd - entry.fetchStart;
                            if (loadTime > 2500) { // Lower threshold for compact
                                this.reduceAnimations();
                            }
                        }
                    });
                });

                observer.observe({ entryTypes: ['navigation'] });
            } catch (error) {
                console.warn('Performance monitoring not supported');
            }
        }
    }

    reduceAnimations() {
        // Reduce animations for compact performance
        const style = document.createElement('style');
        style.textContent = `
            .popup-modal-wrapper * {
                animation-duration: 0.2s !important;
                transition-duration: 0.2s !important;
            }
        `;
        document.head.appendChild(style);
    }

    cleanup() {
        // Clear timers
        this.clearCountdown();

        // Reset state
        this.isModalShown = false;

        // Cleanup any remaining loading states
        const loadingOverlays = this.modalElement.querySelectorAll('.popup-loading-overlay');
        loadingOverlays.forEach(overlay => {
            overlay.style.display = 'none';
        });
    }
}

// Compact Button Interactions
class CompactButtonEnhancer {
    constructor() {
        this.buttons = document.querySelectorAll('.popup-btn');
        this.init();
    }

    init() {
        this.buttons.forEach(btn => {
            this.enhanceButton(btn);
        });
    }

    enhanceButton(btn) {
        btn.addEventListener('click', (e) => {
            this.createCompactRippleEffect(e, btn);
        });
    }

    createCompactRippleEffect(e, button) {
        const ripple = document.createElement('span');
        ripple.classList.add('popup-compact-ripple');

        const rect = button.getBoundingClientRect();
        const size = Math.min(rect.width, rect.height) * 1.5; // Smaller ripple
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: scale(0);
            animation: popup-compact-ripple-effect 0.4s linear;
            pointer-events: none;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
        `;

        button.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 400);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    // Wait for critical resources to load
    if (document.readyState === 'loading') {
        window.addEventListener('load', initializeCompactPopup);
    } else {
        initializeCompactPopup();
    }
});

function initializeCompactPopup() {
    // Initialize compact popup modal manager
    new CompactPopupManager();

    // Initialize compact button enhancer
    new CompactButtonEnhancer();

    // Add compact styles
    addCompactStyles();
}

function addCompactStyles() {
    if (!document.querySelector('#popup-compact-styles')) {
        const style = document.createElement('style');
        style.id = 'popup-compact-styles';
        style.textContent = `
            @keyframes popup-compact-ripple-effect {
                to {
                    transform: scale(3);
                    opacity: 0;
                }
            }
            
            @keyframes popup-subtle-float {
                0%, 100% {
                    transform: translateY(0px) translateZ(0);
                }
                50% {
                    transform: translateY(-5px) translateZ(0);
                }
            }
            
            @keyframes popup-fadeOut {
                from {
                    opacity: 1;
                    transform: scale(1);
                }
                to {
                    opacity: 0;
                    transform: scale(0.95);
                }
            }
            
            .popup-btn {
                position: relative;
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    }
}

// Handle visibility change for performance
document.addEventListener('visibilitychange', function () {
    const modal = document.getElementById('iklanModal');
    if (modal && modal.classList.contains('show')) {
        if (document.hidden) {
            // Pause animations when tab is not visible
            modal.style.animationPlayState = 'paused';
        } else {
            // Resume animations when tab becomes visible
            modal.style.animationPlayState = 'running';
        }
    }
});

// Export for external use
window.CompactPopupManager = CompactPopupManager;
window.CompactButtonEnhancer = CompactButtonEnhancer;