document.addEventListener('DOMContentLoaded', function () {
    // console.log('Partners carousel: Starting initialization...');

    var partnersContainer = document.querySelector('.partners-container');
    var wrapper = document.querySelector('.swiper-wrapper');
    var originalSlides = document.querySelectorAll('.swiper-slide');

    if (!wrapper || originalSlides.length === 0) {
        // console.log('Partners carousel: No elements found');
        return;
    }

    // console.log('Found ' + originalSlides.length + ' partner slides');

    var isInitialized = false;
    var animationStarted = false;

    function cloneSlides() {
        // console.log('Cloning slides for infinite scroll...');

        for (var i = 0; i < originalSlides.length; i++) {
            var clone = originalSlides[i].cloneNode(true);
            clone.classList.add('cloned');
            clone.setAttribute('data-clone', i);
            wrapper.appendChild(clone);
        }

        // console.log('Slides cloned successfully');
    }

    function setWrapperWidth() {
        var slideWidth = 180;
        var gap = 24;
        var totalSlides = wrapper.querySelectorAll('.swiper-slide').length;
        var totalWidth = (slideWidth + gap) * totalSlides;

        wrapper.style.width = totalWidth + 'px';
        // console.log('Wrapper width set to: ' + totalWidth + 'px for ' + totalSlides + ' slides');
    }

    function startAnimation() {
        if (animationStarted) return;

        // console.log('Starting carousel animation...');
        wrapper.classList.add('auto-scroll');
        animationStarted = true;
    }

    function stopAnimation() {
        wrapper.classList.remove('auto-scroll');
        animationStarted = false;
        // console.log('Animation stopped');
    }

    function pauseAnimation() {
        if (wrapper.classList.contains('auto-scroll')) {
            wrapper.style.animationPlayState = 'paused';
            // console.log('Animation paused');
        }
    }

    function resumeAnimation() {
        if (wrapper.classList.contains('auto-scroll')) {
            wrapper.style.animationPlayState = 'running';
            // console.log('Animation resumed');
        }
    }

    function createNavigation() {
        var navHTML = '<button class="carousel-nav prev" type="button" aria-label="Previous partners">' +
            '<i class="fa fa-chevron-left"></i>' +
            '</button>' +
            '<button class="carousel-nav next" type="button" aria-label="Next partners">' +
            '<i class="fa fa-chevron-right"></i>' +
            '</button>';

        partnersContainer.insertAdjacentHTML('beforeend', navHTML);

        var prevBtn = partnersContainer.querySelector('.carousel-nav.prev');
        var nextBtn = partnersContainer.querySelector('.carousel-nav.next');

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', function () {
                // console.log('Previous button clicked');
                pauseAnimation();
                setTimeout(resumeAnimation, 3000);
            });

            nextBtn.addEventListener('click', function () {
                // console.log('Next button clicked');
                pauseAnimation();
                setTimeout(resumeAnimation, 3000);
            });
        }

        // console.log('Navigation created');
    }

    function setupHoverEvents() {
        partnersContainer.addEventListener('mouseenter', function () {
            pauseAnimation();
        });

        partnersContainer.addEventListener('mouseleave', function () {
            resumeAnimation();
        });

        // console.log('Hover events setup');
    }

    function handleImageErrors() {
        var images = wrapper.querySelectorAll('img');

        for (var i = 0; i < images.length; i++) {
            images[i].addEventListener('error', function () {
                // console.log('Image failed to load: ' + this.src);
                this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjgwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiNmOGY5ZmEiIHN0cm9rZT0iI2RlZTJlNiIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM2Yzc1N2QiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5QYXJ0bmVyPC90ZXh0Pjwvc3ZnPg==';
                this.alt = 'Partner Logo';
            });

            images[i].addEventListener('load', function () {
                this.style.opacity = '1';
            });

            if (!images[i].complete) {
                images[i].style.opacity = '0.5';
            }
        }

        // console.log('Image error handling setup');
    }

    function handleVisibilityChange() {
        document.addEventListener('visibilitychange', function () {
            if (document.hidden) {
                pauseAnimation();
            } else if (!document.hidden && animationStarted) {
                resumeAnimation();
            }
        });

        // console.log('Visibility change handler setup');
    }

    function setupTouchEvents() {
        var touchStartX = 0;
        var touchEndX = 0;

        partnersContainer.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
            pauseAnimation();
        }, { passive: true });

        partnersContainer.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;

            var diff = touchStartX - touchEndX;
            var threshold = 50;

            if (Math.abs(diff) > threshold) {
                setTimeout(resumeAnimation, 5000);
            } else {
                setTimeout(resumeAnimation, 2000);
            }
        }, { passive: true });

        // console.log('Touch events setup');
    }

    function init() {
        try {
            // console.log('Initializing partners carousel...');

            cloneSlides();
            setWrapperWidth();
            createNavigation();
            setupHoverEvents();
            setupTouchEvents();
            handleImageErrors();
            handleVisibilityChange();

            setTimeout(function () {
                startAnimation();
                // console.log('Partners carousel fully initialized and running');
            }, 1500);

            isInitialized = true;

        } catch (error) {
            // console.error('Error initializing partners carousel:', error);
        }
    }

    init();

    window.partnersCarousel = {
        start: startAnimation,
        stop: stopAnimation,
        pause: pauseAnimation,
        resume: resumeAnimation,
        isRunning: function () { return animationStarted; },
        restart: function () {
            stopAnimation();
            setTimeout(startAnimation, 100);
        }
    };

    // console.log('Partners carousel controls exposed to window.partnersCarousel');
});