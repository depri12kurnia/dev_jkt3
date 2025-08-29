// Back to Top Functionality - Enhanced Version
(function () {
    'use strict';

    // Wait for DOM to be fully loaded
    function initBackToTop() {
        // console.log('Initializing back to top...'); // Debug log

        const backToTop = document.getElementById('backToTop');

        if (!backToTop) {
            // console.error('Back to top element not found!');
            return;
        }

        // console.log('Back to top element found:', backToTop); // Debug log

        const threshold = 200;
        let isScrolling = false;

        // Function untuk menampilkan/menyembunyikan tombol
        function toggleBackToTop() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;

            // console.log('Current scroll position:', scrollTop); // Debug log

            if (scrollTop > threshold) {
                if (!backToTop.classList.contains('show')) {
                    backToTop.classList.add('show');
                    // console.log('Showing back to top button'); // Debug log
                }
            } else {
                if (backToTop.classList.contains('show')) {
                    backToTop.classList.remove('show');
                    // console.log('Hiding back to top button'); // Debug log
                }
            }

            // Update progress indicator
            const docHeight = Math.max(
                document.body.scrollHeight,
                document.body.offsetHeight,
                document.documentElement.clientHeight,
                document.documentElement.scrollHeight,
                document.documentElement.offsetHeight
            ) - window.innerHeight;

            if (docHeight > 0) {
                const scrollProgress = (scrollTop / docHeight) * 360;
                backToTop.style.setProperty('--scroll-progress', scrollProgress + 'deg');
            }
        }

        // Optimized scroll listener
        function handleScroll() {
            if (!isScrolling) {
                window.requestAnimationFrame(function () {
                    toggleBackToTop();
                    isScrolling = false;
                });
                isScrolling = true;
            }
        }

        // Click handler function - LANGSUNG KE ATAS
        function handleClick(e) {
            e.preventDefault();
            e.stopPropagation();

            // console.log('Back to top button clicked!'); // Debug log

            // Add visual feedback
            backToTop.style.transform = 'scale(0.95)';

            // LANGSUNG SCROLL KE ATAS - TANPA ANIMASI
            try {
                // Method 1: Instant scroll
                window.scrollTo(0, 0);
                // console.log('Instant scroll to top executed'); // Debug log

                // Method 2: Force scroll untuk semua browser
                document.documentElement.scrollTop = 0;
                document.body.scrollTop = 0;

                // Method 3: jQuery fallback jika ada
                if (typeof $ !== 'undefined') {
                    $('html, body').scrollTop(0);
                }

            } catch (error) {
                // console.error('Scroll error:', error);
                // Emergency fallback
                window.pageYOffset = 0;
                document.documentElement.scrollTop = 0;
                document.body.scrollTop = 0;
            }

            // Reset button style
            setTimeout(function () {
                backToTop.style.transform = '';
            }, 150);
        }

        // Add event listeners
        window.addEventListener('scroll', handleScroll, { passive: true });

        // Multiple click event methods for maximum compatibility
        backToTop.addEventListener('click', handleClick);
        backToTop.addEventListener('touchend', function (e) {
            e.preventDefault();
            handleClick(e);
        });

        // Keyboard accessibility
        backToTop.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                handleClick(e);
            }
        });

        // Make sure button is clickable
        backToTop.style.pointerEvents = 'auto';
        backToTop.style.cursor = 'pointer';
        backToTop.setAttribute('tabindex', '0');
        backToTop.setAttribute('role', 'button');
        backToTop.setAttribute('aria-label', 'Kembali ke atas');

        // Initial check
        toggleBackToTop();

        // console.log('Back to top initialized successfully!'); // Debug log

        // Test click functionality after 2 seconds
        setTimeout(function () {
            // console.log('Back to top button properties:');
            // console.log('- Display:', window.getComputedStyle(backToTop).display);
            // console.log('- Pointer events:', window.getComputedStyle(backToTop).pointerEvents);
            // console.log('- Z-index:', window.getComputedStyle(backToTop).zIndex);
            // console.log('- Position:', window.getComputedStyle(backToTop).position);
        }, 2000);
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBackToTop);
    } else {
        initBackToTop();
    }

    // Fallback initialization
    window.addEventListener('load', function () {
        setTimeout(initBackToTop, 100);
    });

    // Global fallback function - LANGSUNG KE ATAS
    window.scrollToTopFallback = function () {
        // console.log('Global fallback function called');

        // LANGSUNG SCROLL KE ATAS
        try {
            window.scrollTo(0, 0);
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;

            // jQuery fallback
            if (typeof $ !== 'undefined') {
                $('html, body').scrollTop(0);
            }

            // console.log('Fallback scroll to top executed');
        } catch (e) {
            // console.error('Fallback scroll error:', e);
        }
    };

})();