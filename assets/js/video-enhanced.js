document.addEventListener('DOMContentLoaded', function () {
    // console.log('Video counter: Starting initialization...');

    // Simple Counter Class
    function CounterAnimation(element) {
        this.element = element;
        this.target = parseInt(element.getAttribute('data-target') || element.textContent.replace(/\D/g, ''));
        this.suffix = element.getAttribute('data-suffix') || '';
        this.current = 0;
        this.hasStarted = false;

        // console.log('Counter created for:', this.target + this.suffix);
    }

    CounterAnimation.prototype.animate = function () {
        if (this.hasStarted) return;
        this.hasStarted = true;

        // console.log('Starting animation for:', this.target);

        const duration = 2000; // 2 seconds
        const startTime = Date.now();
        const self = this;

        function updateCounter() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function for smooth animation
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            self.current = Math.floor(easeProgress * self.target);

            self.element.textContent = self.current + self.suffix;

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                self.element.textContent = self.target + self.suffix;
                // console.log('Animation completed for:', self.target);
            }
        }

        requestAnimationFrame(updateCounter);
    };

    // Initialize all counters
    const counterElements = document.querySelectorAll('.stat-item h3[data-target]');
    const counters = [];

    // console.log('Found', counterElements.length, 'counter elements');

    counterElements.forEach(function (element) {
        const counter = new CounterAnimation(element);
        counters.push(counter);
    });

    // Intersection Observer for triggering animation
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                // console.log('Video stats section is visible, starting counters...');

                // Start animations with stagger
                counters.forEach(function (counter, index) {
                    setTimeout(function () {
                        counter.animate();
                    }, index * 300);
                });

                // Stop observing to prevent re-triggering
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Start observing
    const videoStats = document.querySelector('.video-stats');
    if (videoStats) {
        observer.observe(videoStats);
        // console.log('Observer attached to video-stats');
    } else {
        // console.log('video-stats element not found');

        // Fallback: start immediately if element not found
        setTimeout(function () {
            counters.forEach(function (counter, index) {
                setTimeout(function () {
                    counter.animate();
                }, index * 300);
            });
        }, 1000);
    }

    // Video Modal Setup
    const videoModal = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');
    const videoUrl = 'https://www.youtube.com/embed/zlBgFNwib_Q?si=gSc-FWkOTKwCvX-w&autoplay=1';

    if (videoModal && videoFrame) {
        videoModal.addEventListener('show.bs.modal', function () {
            videoFrame.src = videoUrl;
            // console.log('Video modal opened');
        });

        videoModal.addEventListener('hide.bs.modal', function () {
            videoFrame.src = '';
            // console.log('Video modal closed');
        });
    }

    // Expose for debugging
    window.videoCounters = {
        counters: counters,
        startAll: function () {
            counters.forEach(function (counter, index) {
                counter.hasStarted = false; // Reset
                setTimeout(function () {
                    counter.animate();
                }, index * 300);
            });
        }
    };

    // console.log('Video counter initialization complete');
});