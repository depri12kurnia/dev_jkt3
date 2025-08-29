document.addEventListener('DOMContentLoaded', function () {
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.widget, .blog-content p, .blog-content h5').forEach(el => {
        observer.observe(el);
    });

    // Enhanced download button interactions
    document.querySelectorAll('.download-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Smooth scroll for anchor links - FIXED
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const href = this.getAttribute('href');

            // Skip if href is just "#" or invalid
            if (!href || href === '#') {
                return;
            }

            // Clean and validate selector
            let targetId = href.substring(1); // Remove #

            // Check if selector starts with number (invalid CSS selector)
            if (/^\d/.test(targetId)) {
                // Try to find element by ID using getElementById (works with numeric IDs)
                const target = document.getElementById(targetId);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
                return;
            }

            // Use querySelector for valid CSS selectors
            try {
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            } catch (error) {
                console.warn(`Invalid selector: ${href}`, error);
                // Fallback: try getElementById
                const fallbackTarget = document.getElementById(targetId);
                if (fallbackTarget) {
                    fallbackTarget.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Image lazy loading with fade effect
    const images = document.querySelectorAll('.blog-img img');
    images.forEach(img => {
        img.addEventListener('load', function () {
            this.style.opacity = '1';
        });

        if (img.complete) {
            img.style.opacity = '1';
        } else {
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s ease';
        }
    });
});