// Initialize Open-Accessibility
document.addEventListener('DOMContentLoaded', function () {
    // console.log('DOM loaded, initializing accessibility widget...');

    // Create accessibility widget
    createAccessibilityWidget();

    // Initialize accessibility features  
    initializeAccessibility();

    // Add main content ID for skip link
    addMainContentId();
});

// Add debug logging
function createAccessibilityWidget() {
    // Check if widget already exists
    if (document.getElementById('accessibility-widget')) {
        console.log('Accessibility widget already exists');
        return;
    }

    console.log('Creating accessibility widget...');

    // Create widget HTML
    const widgetHTML = `
        <div id="accessibility-widget">
            <button type="button" class="accessibility-btn" aria-label="Open Accessibility Options" title="Accessibility Options">
                <i class="fa fa-universal-access" aria-hidden="true"></i>
                <span class="sr-only">Accessibility</span>
            </button>

            <div class="accessibility-panel" id="accessibility-panel" role="dialog" aria-labelledby="accessibility-title" aria-hidden="true">
                <div class="panel-header">
                    <h3 id="accessibility-title">
                        <i class="fa fa-universal-access" aria-hidden="true"></i>
                        Pengaturan Aksesibilitas
                    </h3>
                    <button type="button" class="close-btn" aria-label="Close Accessibility Panel" title="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="panel-body">
                    <!-- Font Size Controls -->
                    <div class="accessibility-group">
                        <h4><i class="fa fa-font" aria-hidden="true"></i> Ukuran Teks</h4>
                        <div class="btn-group" role="group" aria-label="Font size controls">
                            <button type="button" class="btn btn-outline-primary" id="decrease-font" title="Perkecil Teks">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                <span class="sr-only">Perkecil Teks</span>
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="reset-font" title="Reset Ukuran Teks">
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                <span class="sr-only">Reset Ukuran Teks</span>
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="increase-font" title="Perbesar Teks">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span class="sr-only">Perbesar Teks</span>
                            </button>
                        </div>
                    </div>

                    <!-- Contrast Controls -->
                    <div class="accessibility-group">
                        <h4><i class="fa fa-adjust" aria-hidden="true"></i> Kontras & Tampilan</h4>
                        <div class="toggle-controls">
                            <label class="toggle-switch">
                                <input type="checkbox" id="high-contrast" aria-describedby="contrast-desc">
                                <span class="slider"></span>
                                <span class="label-text">Kontras Tinggi</span>
                            </label>
                            <small id="contrast-desc" class="form-text text-muted">
                                Meningkatkan kontras untuk kemudahan membaca
                            </small>
                        </div>

                        <div class="toggle-controls">
                            <label class="toggle-switch">
                                <input type="checkbox" id="dark-mode" aria-describedby="dark-desc">
                                <span class="slider"></span>
                                <span class="label-text">Mode Gelap</span>
                            </label>
                            <small id="dark-desc" class="form-text text-muted">
                                Mengaktifkan tema gelap untuk mengurangi ketegangan mata
                            </small>
                        </div>
                    </div>

                    <!-- Reading Aids -->
                    <div class="accessibility-group">
                        <h4><i class="fa fa-eye" aria-hidden="true"></i> Bantuan Membaca</h4>
                        <div class="toggle-controls">
                            <label class="toggle-switch">
                                <input type="checkbox" id="reading-guide" aria-describedby="guide-desc">
                                <span class="slider"></span>
                                <span class="label-text">Panduan Baca</span>
                            </label>
                            <small id="guide-desc" class="form-text text-muted">
                                Menampilkan garis panduan untuk membantu membaca
                            </small>
                        </div>

                        <div class="toggle-controls">
                            <label class="toggle-switch">
                                <input type="checkbox" id="dyslexia-font" aria-describedby="dyslexia-desc">
                                <span class="slider"></span>
                                <span class="label-text">Font Ramah Disleksia</span>
                            </label>
                            <small id="dyslexia-desc" class="form-text text-muted">
                                Menggunakan font yang mudah dibaca untuk disleksia
                            </small>
                        </div>
                    </div>

                    <!-- Text to Speech -->
                    <div class="accessibility-group">
                        <h4><i class="fa fa-volume-up" aria-hidden="true"></i> Suara</h4>
                        <div class="toggle-controls">
                            <label class="toggle-switch">
                                <input type="checkbox" id="text-to-speech" aria-describedby="speech-desc">
                                <span class="slider"></span>
                                <span class="label-text">Baca Teks</span>
                            </label>
                            <small id="speech-desc" class="form-text text-muted">
                                Aktifkan pembacaan teks dengan suara
                            </small>
                        </div>
                    </div>

                    <!-- Reset All -->
                    <div class="accessibility-group">
                        <button type="button" class="btn btn-secondary w-100" id="reset-all">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            Reset Semua Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Add widget to body
    document.body.insertAdjacentHTML('beforeend', widgetHTML);
    console.log('Accessibility widget HTML added to body');

    // Debug: Check if elements exist
    setTimeout(() => {
        const widget = document.getElementById('accessibility-widget');
        const panel = document.getElementById('accessibility-panel');
        const groups = document.querySelectorAll('.accessibility-group');

        console.log('Widget created:', !!widget);
        console.log('Panel created:', !!panel);
        console.log('Groups found:', groups.length);

        groups.forEach((group, index) => {
            console.log(`Group ${index + 1}:`, group.querySelector('h4')?.textContent);
        });
    }, 100);
}

function initializeAccessibility() {
    // Wait for widget to be created
    setTimeout(() => {
        // console.log('Initializing accessibility features...');

        const accessibilityBtn = document.querySelector('.accessibility-btn');
        const accessibilityPanel = document.querySelector('.accessibility-panel');
        const closeBtn = document.querySelector('.close-btn');

        // console.log('Elements found:', {
        //     btn: !!accessibilityBtn,
        //     panel: !!accessibilityPanel,
        //     close: !!closeBtn
        // });

        if (!accessibilityBtn || !accessibilityPanel || !closeBtn) {
            // console.error('Accessibility widget elements not found');
            return;
        }

        // Toggle panel
        accessibilityBtn.addEventListener('click', function () {
            // console.log('Accessibility button clicked');
            togglePanel();
        });

        closeBtn.addEventListener('click', function () {
            // console.log('Close button clicked');
            closePanel();
        });

        // Close panel when clicking outside
        document.addEventListener('click', function (e) {
            const widget = document.getElementById('accessibility-widget');
            if (widget && !widget.contains(e.target)) {
                closePanel();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function (e) {
            // Alt + A to open accessibility panel
            if (e.altKey && e.key === 'a') {
                e.preventDefault();
                togglePanel();
            }

            // Escape to close panel
            if (e.key === 'Escape') {
                closePanel();
            }
        });

        // Initialize all accessibility features
        initializeFontSize();
        initializeHighContrast();
        initializeDarkMode();
        initializeReadingGuide();
        initializeDyslexiaFont();
        initializeTextToSpeech();
        initializeResetAll();

        // Load saved settings
        loadSettings();

        // console.log('Accessibility widget initialized successfully');
    }, 500); // Increased timeout
}

function togglePanel() {
    const panel = document.querySelector('.accessibility-panel');
    if (panel) {
        const wasActive = panel.classList.contains('active');
        panel.classList.toggle('active');
        console.log('Panel toggled, active:', panel.classList.contains('active'));

        if (panel.classList.contains('active')) {
            panel.setAttribute('aria-hidden', 'false');
            const title = panel.querySelector('h3');
            if (title) title.focus();

            // Force show content immediately
            setTimeout(() => {
                forceShowContent();

                // Debug visibility again
                const groups = panel.querySelectorAll('.accessibility-group');
                console.log('Groups visible after force:', groups.length);
                groups.forEach((group, index) => {
                    const computed = window.getComputedStyle(group);
                    console.log(`Group ${index + 1} after force - display:`, computed.display, 'visibility:', computed.visibility, 'opacity:', computed.opacity);
                });
            }, 50);
        } else {
            panel.setAttribute('aria-hidden', 'true');
        }
    } else {
        console.error('Panel not found!');
    }
}

function closePanel() {
    const panel = document.querySelector('.accessibility-panel');
    if (panel) {
        panel.classList.remove('active');
        panel.setAttribute('aria-hidden', 'true');
        // console.log('Panel closed');
    }
}

function addMainContentId() {
    const mainContent = document.querySelector('main') ||
        document.querySelector('.main-content') ||
        document.querySelector('#content') ||
        document.querySelector('.container');

    if (mainContent && !mainContent.id) {
        mainContent.id = 'main-content';
        // console.log('Main content ID added');
    }
}

// Font Size Controls
function initializeFontSize() {
    let currentFontSize = parseInt(localStorage.getItem('fontSize')) || 100;

    const increaseBtn = document.getElementById('increase-font');
    const decreaseBtn = document.getElementById('decrease-font');
    const resetBtn = document.getElementById('reset-font');

    if (!increaseBtn || !decreaseBtn || !resetBtn) return;

    increaseBtn.addEventListener('click', function () {
        currentFontSize = Math.min(currentFontSize + 10, 150);
        applyFontSize(currentFontSize);
        saveSettings();
    });

    decreaseBtn.addEventListener('click', function () {
        currentFontSize = Math.max(currentFontSize - 10, 80);
        applyFontSize(currentFontSize);
        saveSettings();
    });

    resetBtn.addEventListener('click', function () {
        currentFontSize = 100;
        applyFontSize(currentFontSize);
        saveSettings();
    });

    function applyFontSize(size) {
        document.documentElement.style.fontSize = size + '%';
        localStorage.setItem('fontSize', size);
    }

    // Apply saved font size
    if (currentFontSize !== 100) {
        applyFontSize(currentFontSize);
    }
}

// High Contrast Mode
function initializeHighContrast() {
    const toggle = document.getElementById('high-contrast');
    if (!toggle) return;

    toggle.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('high-contrast-mode');
        } else {
            document.body.classList.remove('high-contrast-mode');
        }
        saveSettings();
    });
}

// Dark Mode
function initializeDarkMode() {
    const toggle = document.getElementById('dark-mode');
    if (!toggle) return;

    toggle.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark-mode-enabled');
        } else {
            document.body.classList.remove('dark-mode-enabled');
        }
        saveSettings();
    });
}

// Reading Guide
function initializeReadingGuide() {
    const toggle = document.getElementById('reading-guide');
    if (!toggle) return;

    let guideLine = null;

    toggle.addEventListener('change', function () {
        if (this.checked) {
            enableReadingGuide();
        } else {
            disableReadingGuide();
        }
        saveSettings();
    });

    function enableReadingGuide() {
        if (!guideLine) {
            guideLine = document.createElement('div');
            guideLine.className = 'reading-guide-line';
            document.body.appendChild(guideLine);
        }

        document.body.classList.add('reading-guide-active');
        document.addEventListener('mousemove', updateGuideLine);
    }

    function disableReadingGuide() {
        document.body.classList.remove('reading-guide-active');
        document.removeEventListener('mousemove', updateGuideLine);
    }

    function updateGuideLine(e) {
        if (guideLine) {
            guideLine.style.top = e.clientY + 'px';
        }
    }
}

// Dyslexia Font
function initializeDyslexiaFont() {
    const toggle = document.getElementById('dyslexia-font');
    if (!toggle) return;

    toggle.addEventListener('change', function () {
        if (this.checked) {
            loadDyslexiaFont();
        } else {
            removeDyslexiaFont();
        }
        saveSettings();
    });

    function loadDyslexiaFont() {
        if (!document.getElementById('dyslexia-font-link')) {
            const link = document.createElement('link');
            link.id = 'dyslexia-font-link';
            link.rel = 'stylesheet';
            link.href = 'https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap';
            document.head.appendChild(link);

            // Wait for font to load
            setTimeout(() => {
                document.body.style.fontFamily = '"Lexend", sans-serif';
            }, 500);
        } else {
            document.body.style.fontFamily = '"Lexend", sans-serif';
        }
    }

    function removeDyslexiaFont() {
        document.body.style.fontFamily = '';
    }
}

// Text to Speech
function initializeTextToSpeech() {
    const toggle = document.getElementById('text-to-speech');
    if (!toggle) return;

    let speechEnabled = false;

    toggle.addEventListener('change', function () {
        speechEnabled = this.checked;

        if (speechEnabled) {
            enableTextToSpeech();
        } else {
            disableTextToSpeech();
        }
        saveSettings();
    });

    function enableTextToSpeech() {
        document.addEventListener('click', handleTextToSpeech);

        // Show instruction
        showNotification('Text-to-Speech aktif. Klik pada teks untuk mendengarkan.');
    }

    function disableTextToSpeech() {
        document.removeEventListener('click', handleTextToSpeech);
        speechSynthesis.cancel();
    }

    function handleTextToSpeech(e) {
        if (speechEnabled && e.target.textContent.trim()) {
            const text = e.target.textContent.trim();
            if (text.length > 3) { // Only read text longer than 3 characters
                speechSynthesis.cancel(); // Stop any current speech

                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'id-ID';
                utterance.rate = 0.8;
                utterance.pitch = 1;
                utterance.volume = 0.8;

                speechSynthesis.speak(utterance);
            }
        }
    }
}

// Reset All Settings
function initializeResetAll() {
    const resetBtn = document.getElementById('reset-all');
    if (!resetBtn) return;

    resetBtn.addEventListener('click', function () {
        // Reset all toggles
        document.querySelectorAll('.accessibility-panel input[type="checkbox"]').forEach(toggle => {
            toggle.checked = false;
        });

        // Reset font size
        document.documentElement.style.fontSize = '';

        // Remove all classes
        document.body.classList.remove('high-contrast-mode', 'dark-mode-enabled', 'reading-guide-active');
        document.body.style.fontFamily = '';

        // Clear local storage
        localStorage.removeItem('accessibilitySettings');
        localStorage.removeItem('fontSize');

        // Stop speech
        speechSynthesis.cancel();

        showNotification('Semua pengaturan aksesibilitas telah direset.');
    });
}

// Save Settings
function saveSettings() {
    const settings = {
        fontSize: document.documentElement.style.fontSize,
        highContrast: document.getElementById('high-contrast')?.checked || false,
        darkMode: document.getElementById('dark-mode')?.checked || false,
        readingGuide: document.getElementById('reading-guide')?.checked || false,
        dyslexiaFont: document.getElementById('dyslexia-font')?.checked || false,
        textToSpeech: document.getElementById('text-to-speech')?.checked || false
    };

    localStorage.setItem('accessibilitySettings', JSON.stringify(settings));
}

// Load Settings
function loadSettings() {
    const saved = localStorage.getItem('accessibilitySettings');
    if (saved) {
        try {
            const settings = JSON.parse(saved);

            // Apply saved settings
            if (settings.fontSize) {
                document.documentElement.style.fontSize = settings.fontSize;
            }

            const highContrastToggle = document.getElementById('high-contrast');
            if (highContrastToggle) {
                highContrastToggle.checked = settings.highContrast;
                if (settings.highContrast) {
                    document.body.classList.add('high-contrast-mode');
                }
            }

            const darkModeToggle = document.getElementById('dark-mode');
            if (darkModeToggle) {
                darkModeToggle.checked = settings.darkMode;
                if (settings.darkMode) {
                    document.body.classList.add('dark-mode-enabled');
                }
            }

            const readingGuideToggle = document.getElementById('reading-guide');
            if (readingGuideToggle) {
                readingGuideToggle.checked = settings.readingGuide;
                if (settings.readingGuide) {
                    readingGuideToggle.dispatchEvent(new Event('change'));
                }
            }

            const dyslexiaToggle = document.getElementById('dyslexia-font');
            if (dyslexiaToggle) {
                dyslexiaToggle.checked = settings.dyslexiaFont;
                if (settings.dyslexiaFont) {
                    dyslexiaToggle.dispatchEvent(new Event('change'));
                }
            }

            const speechToggle = document.getElementById('text-to-speech');
            if (speechToggle) {
                speechToggle.checked = settings.textToSpeech;
                if (settings.textToSpeech) {
                    speechToggle.dispatchEvent(new Event('change'));
                }
            }
        } catch (e) {
            // console.warn('Error loading accessibility settings:', e);
        }
    }
}

// Utility function to show notifications
function showNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #00B9AD;
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 185, 173, 0.3);
        z-index: 10000;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        max-width: 300px;
        word-wrap: break-word;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.3s ease;
    `;

    notification.textContent = message;
    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translateY(0)';
    }, 100);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Tambahkan ke file JavaScript accessibility yang sudah ada
// Scroll hide/show functionality
let scrollTimer = null;
let isScrolling = false;

function initScrollBehavior() {
    const accessibilityWidget = document.getElementById('accessibility-widget');

    if (!accessibilityWidget) return;

    function hideWidget() {
        accessibilityWidget.classList.add('hidden');
        isScrolling = true;
    }

    function showWidget() {
        accessibilityWidget.classList.remove('hidden');
        isScrolling = false;
    }

    function handleScroll() {
        if (!isScrolling) {
            hideWidget();
        }

        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(showWidget, 150);
    }

    // Event listeners
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Show on mouse hover di area kanan
    document.addEventListener('mousemove', function (e) {
        if (e.clientX > window.innerWidth - 80) {
            showWidget();
        }
    });
}

// Panggil function saat DOM ready
document.addEventListener('DOMContentLoaded', initScrollBehavior);

// Tambahkan function debug ini di bagian akhir file

function forceShowContent() {
    console.log('Force showing accessibility content...');

    // Force remove any hiding classes
    const panel = document.querySelector('.accessibility-panel.active');
    if (panel) {
        // Remove any potential hiding classes
        panel.classList.remove('d-none', 'hidden', 'invisible');

        // Force style all groups
        const groups = panel.querySelectorAll('.accessibility-group');
        groups.forEach((group, index) => {
            group.style.cssText = `
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                height: auto !important;
                overflow: visible !important;
                margin-bottom: 20px !important;
                padding-bottom: 15px !important;
                border-bottom: 1px solid #e9ecef !important;
            `;

            // Force show all children
            const children = group.querySelectorAll('*');
            children.forEach(child => {
                if (!child.matches('input[type="checkbox"]')) {
                    child.style.visibility = 'visible';
                    child.style.opacity = '1';
                }
            });

            console.log(`Group ${index + 1} forced visible`);
        });
    }
}
