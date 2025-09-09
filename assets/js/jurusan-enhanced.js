document.addEventListener('DOMContentLoaded', function () {
    // Show More SDM Functionality
    const btnShowMore = document.getElementById('btn-show-more-sdm');
    const hiddenItems = document.querySelectorAll('.sdm-hidden');
    let isExpanded = false;

    if (btnShowMore) {
        btnShowMore.addEventListener('click', function () {
            if (!isExpanded) {
                // Show hidden items with staggered animation
                hiddenItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.remove('d-none');
                        item.classList.add('show-item');
                    }, index * 100);
                });

                // Update button
                this.innerHTML = `
                    <i class="bi bi-chevron-up me-1"></i>
                    <span class="btn-text">Tampilkan Lebih Sedikit</span>
                `;
                isExpanded = true;
            } else {
                // Hide items with staggered animation
                hiddenItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.remove('show-item');
                        setTimeout(() => {
                            item.classList.add('d-none');
                        }, 300);
                    }, index * 50);
                });

                // Update button
                this.innerHTML = `
                    <i class="bi bi-chevron-down me-1"></i>
                    <span class="btn-text">Tampilkan Lebih</span>
                    <span class="badge bg-primary ms-2"><?php echo !empty($sdm_list) ? count($sdm_list) - $max_display : 0; ?> lainnya</span>
                `;
                isExpanded = false;

                // Scroll back to SDM section
                document.getElementById('custom-cards').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    // Counter Animation for Statistics
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            element.textContent = Math.round(current);
            if (current >= target) {
                clearInterval(timer);
                element.textContent = target;
            }
        }, 20);
    }

    // Trigger counter animation when statistics section is visible
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.counter-number');
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    animateCounter(counter, target);
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe statistics sections
    const statsSection = document.querySelector('.row.mt-5.pt-4.border-top');
    if (statsSection) {
        observer.observe(statsSection);
    }

    // Enhanced image loading with error handling
    const images = document.querySelectorAll('.card-img-top');
    images.forEach(img => {
        img.addEventListener('load', function () {
            this.style.opacity = '1';
            this.style.background = 'none';
        });

        img.addEventListener('error', function () {
            this.style.backgroundColor = '#f8f9fa';
            this.style.display = 'flex';
            this.style.alignItems = 'center';
            this.style.justifyContent = 'center';
            this.innerHTML = '<i class="bi bi-person-circle text-muted" style="font-size: 3rem;"></i>';
        });
    });

    // Track user interactions for analytics
    document.querySelectorAll('.btn, .card').forEach(element => {
        element.addEventListener('click', function () {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'sdm_interaction', {
                    'event_category': 'SDM Section',
                    'event_label': this.textContent.trim() || this.className,
                    'page_title': 'Jurusan <?php echo $jurusan_data->nama; ?>',
                    'total_sdm': <? php echo !empty($sdm_list) ?count($sdm_list): 0; ?>
                        });
    }
                });
            });

// Add tooltip for badges
const badges = document.querySelectorAll('.badge');
badges.forEach(badge => {
    badge.setAttribute('title', badge.textContent.trim());
});

// Statistics hover effects
const statItems = document.querySelectorAll('.stat-item');
statItems.forEach(item => {
    item.addEventListener('mouseenter', function () {
        const icon = this.querySelector('i');
        if (icon) {
            icon.style.transform = 'scale(1.1) rotate(5deg)';
        }
    });

    item.addEventListener('mouseleave', function () {
        const icon = this.querySelector('i');
        if (icon) {
            icon.style.transform = 'scale(1) rotate(0deg)';
        }
    });
});

// Mobile responsive fixes
function handleMobileLayout() {
    const isMobile = window.innerWidth < 768;

    if (isMobile) {
        // Force mobile layout
        document.querySelectorAll('.floating-stats').forEach(el => {
            el.style.position = 'relative';
            el.style.top = 'auto';
            el.style.left = 'auto';
            el.style.right = 'auto';
            el.style.bottom = 'auto';
            el.style.animation = 'none';
        });

        // Adjust grid layouts
        document.querySelectorAll('.row.g-5, .row.g-4').forEach(el => {
            el.style.display = 'block';
        });
    }
}

// Run on load and resize
handleMobileLayout();
window.addEventListener('resize', handleMobileLayout);
        });