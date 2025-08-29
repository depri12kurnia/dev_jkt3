document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('iklanModal');

    if (!modalElement) {
        console.error('Modal element not found!');
        return;
    }

    // Delay untuk memastikan page fully loaded
    setTimeout(function () {
        const modal = new bootstrap.Modal(modalElement, {
            backdrop: 'static',
            keyboard: true,
            focus: true
        });

        // Custom entrance animation
        modal.show();

        // Add extra animations when modal is shown
        modalElement.addEventListener('shown.bs.modal', function () {
            // Add floating animation to the modal
            modalElement.querySelector('.modal-dialog').style.animation = 'float 3s ease-in-out infinite';

            // Add typewriter effect to title (optional)
            const title = modalElement.querySelector('.modal-title');
            if (title) {
                const text = title.textContent;
                title.textContent = '';
                let i = 0;
                const typeWriter = function () {
                    if (i < text.length) {
                        title.textContent += text.charAt(i);
                        i++;
                        setTimeout(typeWriter, 100);
                    }
                };
                setTimeout(typeWriter, 1000);
            }

            // Add confetti effect (optional)
            setTimeout(function () {
                createConfetti();
            }, 1500);
        });

        // Enhanced exit animation
        modalElement.addEventListener('hide.bs.modal', function () {
            modalElement.classList.add('animate__animated', 'animate__zoomOut');
        });

        // Auto close after 20 seconds with countdown
        let countdown = 20;
        const countdownInterval = setInterval(function () {
            countdown--;
            const closeBtn = modalElement.querySelector('.btn-close');
            if (closeBtn && countdown > 0) {
                closeBtn.setAttribute('title', `Auto close in ${countdown}s`);
            }

            if (countdown <= 0) {
                clearInterval(countdownInterval);
                modal.hide();
            }
        }, 1000);

        // Clear countdown when manually closed
        modalElement.addEventListener('hidden.bs.modal', function () {
            clearInterval(countdownInterval);
        });

    }, 1500); // Delay 1.5 seconds after page load
});

// Confetti effect function
function createConfetti() {
    const colors = ['#FFD700', '#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7'];
    const confettiContainer = document.createElement('div');
    confettiContainer.style.position = 'fixed';
    confettiContainer.style.top = '0';
    confettiContainer.style.left = '0';
    confettiContainer.style.width = '100%';
    confettiContainer.style.height = '100%';
    confettiContainer.style.pointerEvents = 'none';
    confettiContainer.style.zIndex = '9999';
    document.body.appendChild(confettiContainer);

    for (let i = 0; i < 50; i++) {
        const confetti = document.createElement('div');
        confetti.style.position = 'absolute';
        confetti.style.width = '10px';
        confetti.style.height = '10px';
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.left = Math.random() * 100 + '%';
        confetti.style.top = '-10px';
        confetti.style.borderRadius = '50%';
        confetti.style.animation = `confetti-fall ${Math.random() * 3 + 2}s linear forwards`;
        confettiContainer.appendChild(confetti);
    }

    // Remove confetti after animation
    setTimeout(function () {
        document.body.removeChild(confettiContainer);
    }, 5000);
}

// Add confetti animation CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes confetti-fall {
        0% {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Enhanced marquee control
document.addEventListener('DOMContentLoaded', function () {
    const marqueeText = document.querySelector('.marquee-text');
    const marqueeContainer = document.querySelector('.marquee-container');

    if (marqueeText && marqueeContainer) {
        // Pause on hover
        marqueeContainer.addEventListener('mouseenter', function () {
            marqueeText.style.animationPlayState = 'paused';
        });

        marqueeContainer.addEventListener('mouseleave', function () {
            marqueeText.style.animationPlayState = 'running';
        });

        // Adjust speed based on text length
        const textLength = marqueeText.textContent.length;
        const baseSpeed = 15; // seconds
        const adjustedSpeed = Math.max(10, baseSpeed * (textLength / 100));
        marqueeText.style.animationDuration = adjustedSpeed + 's';

        // Add click to pause/play
        marqueeContainer.addEventListener('click', function () {
            const currentState = marqueeText.style.animationPlayState;
            marqueeText.style.animationPlayState = currentState === 'paused' ? 'running' : 'paused';
        });
    }
});