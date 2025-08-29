document.addEventListener('DOMContentLoaded', function () {
    // Intersection Observer for animations
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

    // Observe all staff cards
    document.querySelectorAll('.volunteers-items').forEach(card => {
        observer.observe(card);
    });

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazyload');
                        img.classList.add('lazyloaded');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('.lazyload').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Add staff count
    const staffCount = document.querySelectorAll('.volunteers-items').length;
    if (staffCount > 0) {
        const countHTML = `
            <div class="staff-count">
                <i class="fa fa-users"></i>
                Total ${staffCount} Data SDM
            </div>
        `;
        document.querySelector('.volunteers-option').insertAdjacentHTML('beforebegin', countHTML);
    }

    // Error handling for missing images
    document.querySelectorAll('.volunteers-img img').forEach(img => {
        img.addEventListener('error', function () {
            this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGVlMmU2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzZjNzU3ZCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg==';
            this.alt = 'No Image Available';
        });
    });

    // Smooth scroll for breadcrumb links
    document.querySelectorAll('.breadcrumb a').forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});