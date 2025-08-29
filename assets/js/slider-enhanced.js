document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.querySelector('#slider');

    if (carousel) {
        // Simple approach - use data attributes instead
        carousel.setAttribute('data-bs-pause', 'hover');
        carousel.setAttribute('data-bs-interval', '5000');

        // Add loading state
        carousel.classList.add('carousel-loading');

        // Remove loading when ready
        setTimeout(() => {
            carousel.classList.remove('carousel-loading');
        }, 1000);

        // Enhanced image error handling
        const images = carousel.querySelectorAll('img');
        images.forEach((img) => {
            img.addEventListener('error', function () {
                console.warn('Image failed to load:', this.src);
                this.style.display = 'none';
            });
        });

        // Touch support
        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        carousel.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const threshold = 50; // Minimum swipe distance
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > threshold) {
                if (diff > 0) {
                    // Swipe left - next slide
                    carousel.next();
                } else {
                    // Swipe right - previous slide
                    carousel.prev();
                }
            }
        }
    }
});

// Alternative approach - Wait for Bootstrap to be fully loaded
window.addEventListener('load', function () {
    // Re-initialize if needed
    const carousel = document.querySelector('#slider');
    if (carousel && typeof bootstrap !== 'undefined') {
        // Ensure carousel is properly initialized
        if (!bootstrap.Carousel.getInstance(carousel)) {
            new bootstrap.Carousel(carousel);
        }
    }
});