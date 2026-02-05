// Custom Google Translate Implementation
class CustomGoogleTranslate {
    constructor() {
        this.currentLang = 'id';
        this.baseUrl = this.getBaseUrl(); // Hasilnya: https://poltekkesjakarta3.ac.id/
        this.isMobile = window.innerWidth <= 768;
        this.init();
    }

    getBaseUrl() {
        // window.location.origin akan mengambil protocol + host secara otomatis
        // Hasil: "https://poltekkesjakarta3.ac.id"
        const origin = window.location.origin;

        // Tambahkan slash di akhir agar konsisten saat pemanggilan API/asset
        return `${origin}/`;
    }

    init() {
        this.createCustomInterface();
        this.loadGoogleTranslate();

        // Add resize listener for mobile detection
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth <= 768;
        });

        // Delay handlers until Google Translate is loaded
        setTimeout(() => {
            this.handleLanguageChange();
        }, 1000);
    }

    createCustomInterface() {
        const container = document.querySelector('.google-translate-container');
        if (!container) {
            return;
        }

        container.innerHTML = `
            <div class="custom-language-switcher">
                <button class="custom-translate-btn" id="translateBtn" type="button" 
                        aria-expanded="false" aria-haspopup="true">
                    <img src="${this.baseUrl}assets/flag/idn.png" alt="ID" class="flag-icon" id="currentFlag" 
                         onerror="this.style.display='none'">
                    <span id="currentLang">ID</span>
                    <i class="fa fa-chevron-down" style="font-size: 12px; margin-left: 8px;"></i>
                </button>
                <div class="translate-dropdown" id="translateDropdown" role="menu">
                    <a href="#" class="translate-option active" data-lang="id" data-google-lang="/id/id" role="menuitem">
                        <img src="${this.baseUrl}assets/flag/idn.png" alt="ID" class="flag-icon" 
                             onerror="this.style.display='none'">
                        <span>Bahasa Indonesia</span>
                    </a>
                    <a href="#" class="translate-option" data-lang="en" data-google-lang="/id/en" role="menuitem">
                        <img src="${this.baseUrl}assets/flag/eng.png" alt="EN" class="flag-icon" 
                             onerror="this.style.display='none'">
                        <span>English</span>
                    </a>
                </div>
            </div>
            <div id="google_translate_element" style="display: none !important;"></div>
        `;
    }

    loadGoogleTranslate() {
        // Initialize Google Translate function first
        window.googleTranslateElementInit = () => {
            try {
                new google.translate.TranslateElement({
                    pageLanguage: 'id',
                    includedLanguages: 'id,en,ar,zh,ja,ko,th,vi,ms,tl',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                    autoDisplay: false,
                    multilanguagePage: true
                }, 'google_translate_element');

                // Set up after initialization
                setTimeout(() => {
                    this.setupGoogleTranslateEvents();
                }, 500);

            } catch (error) {
                console.error('Error initializing Google Translate:', error);
            }
        };

        // Load Google Translate script
        if (!window.google || !window.google.translate) {
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            script.async = true;
            script.onerror = () => {
                console.error('Failed to load Google Translate script');
            };
            document.head.appendChild(script);
        } else {
            window.googleTranslateElementInit();
        }
    }

    setupGoogleTranslateEvents() {
        // Hide Google Translate elements
        const elements = document.querySelectorAll('.goog-te-banner-frame, #goog-gt-tt, .goog-te-balloon-frame');
        elements.forEach(el => {
            if (el) el.style.display = 'none';
        });

        // Fix body positioning
        document.body.style.top = '0';
        document.body.style.position = 'static';
    }

    handleLanguageChange() {
        const btn = document.getElementById('translateBtn');
        const dropdown = document.getElementById('translateDropdown');
        const options = document.querySelectorAll('.translate-option');

        if (!btn || !dropdown) {
            console.error('Translation UI elements not found');
            return;
        }

        // Enhanced mobile touch support
        const toggleDropdown = (e) => {
            e.preventDefault();
            e.stopPropagation();

            const isOpen = dropdown.classList.contains('show');

            // Close other dropdowns first
            document.querySelectorAll('.translate-dropdown.show').forEach(dd => {
                if (dd !== dropdown) {
                    dd.classList.remove('show');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('show');

            // Update aria-expanded
            btn.setAttribute('aria-expanded', dropdown.classList.contains('show'));

            // Update chevron icon
            const icon = btn.querySelector('i');
            if (icon) {
                icon.style.transform = dropdown.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        };

        // Add both click and touchstart for better mobile support
        btn.addEventListener('click', toggleDropdown);
        btn.addEventListener('touchstart', (e) => {
            // Prevent default to avoid double firing
            if (this.isMobile) {
                e.preventDefault();
                toggleDropdown(e);
            }
        }, { passive: false });

        // Enhanced close dropdown functionality
        const closeDropdown = (e) => {
            if (!e.target.closest('.custom-language-switcher')) {
                dropdown.classList.remove('show');
                btn.setAttribute('aria-expanded', 'false');
                const icon = btn.querySelector('i');
                if (icon) {
                    icon.style.transform = 'rotate(0deg)';
                }
            }
        };

        // Add multiple event listeners for better compatibility
        document.addEventListener('click', closeDropdown);
        document.addEventListener('touchstart', closeDropdown);

        // Add escape key support
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
                btn.setAttribute('aria-expanded', 'false');
                btn.focus(); // Return focus to button
                const icon = btn.querySelector('i');
                if (icon) {
                    icon.style.transform = 'rotate(0deg)';
                }
            }
        });

        // Enhanced language selection
        options.forEach(option => {
            const selectLanguage = (e) => {
                e.preventDefault();
                e.stopPropagation();

                const lang = option.dataset.lang;
                const googleLang = option.dataset.googleLang;

                this.translatePage(googleLang);
                this.updateInterface(option);

                // Close dropdown
                dropdown.classList.remove('show');
                btn.setAttribute('aria-expanded', 'false');

                const icon = btn.querySelector('i');
                if (icon) {
                    icon.style.transform = 'rotate(0deg)';
                }
            };

            option.addEventListener('click', selectLanguage);
            option.addEventListener('touchstart', (e) => {
                if (this.isMobile) {
                    e.preventDefault();
                    selectLanguage(e);
                }
            }, { passive: false });

            // Keyboard navigation support
            option.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    selectLanguage(e);
                }
            });
        });

        // Add keyboard navigation for dropdown items
        btn.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown' && dropdown.classList.contains('show')) {
                e.preventDefault();
                const firstOption = dropdown.querySelector('.translate-option');
                if (firstOption) firstOption.focus();
            }
        });
    }

    translatePage(targetLang) {
        try {
            // Method 1: Using Google Translate cookie
            const expires = new Date();
            expires.setTime(expires.getTime() + (24 * 60 * 60 * 1000)); // 24 hours
            document.cookie = `googtrans=${targetLang}; expires=${expires.toUTCString()}; path=/`;

            // Method 2: Using select element if available
            setTimeout(() => {
                const selectElement = document.querySelector('#google_translate_element select');
                if (selectElement) {
                    const options = selectElement.options;
                    for (let i = 0; i < options.length; i++) {
                        if (options[i].value === targetLang) {
                            selectElement.selectedIndex = i;
                            selectElement.dispatchEvent(new Event('change'));
                            break;
                        }
                    }
                }
            }, 100);

            this.currentLang = targetLang.split('/')[2] || targetLang;
            localStorage.setItem('preferred_language', this.currentLang);

            // Reload page to apply translation
            setTimeout(() => {
                window.location.reload();
            }, 500);

        } catch (error) {
            console.error('Error translating page:', error);
        }
    }

    updateInterface(selectedOption) {
        const currentFlag = document.getElementById('currentFlag');
        const currentLang = document.getElementById('currentLang');
        const langText = selectedOption.dataset.lang.toUpperCase();

        // Update flag
        const flagImg = selectedOption.querySelector('.flag-icon');
        const flagText = selectedOption.querySelector('.flag-text');

        if (currentFlag && flagImg) {
            currentFlag.src = flagImg.src;
            currentFlag.style.display = 'inline';
        } else if (currentFlag && flagText) {
            currentFlag.style.display = 'none';
        }

        // Update language text
        if (currentLang) {
            currentLang.textContent = langText;
        }

        // Update active state
        document.querySelectorAll('.translate-option').forEach(opt => {
            opt.classList.remove('active');
        });
        selectedOption.classList.add('active');
    }

    // Auto-restore language preference
    restoreLanguagePreference() {
        // Check cookie first
        const cookieValue = this.getCookie('googtrans');
        const savedLang = localStorage.getItem('preferred_language');

        const langToRestore = cookieValue ? cookieValue.split('/')[2] : savedLang;

        if (langToRestore && langToRestore !== 'id') {
            setTimeout(() => {
                const savedOption = document.querySelector(`[data-lang="${langToRestore}"]`);
                if (savedOption) {
                    this.updateInterface(savedOption);
                }
            }, 1000);
        }
    }

    getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    try {
        const translator = new CustomGoogleTranslate();

        // Restore language preference after everything loads
        window.addEventListener('load', () => {
            setTimeout(() => {
                translator.restoreLanguagePreference();
            }, 2000);
        });

    } catch (error) {
        console.error('Error initializing CustomGoogleTranslate:', error);

        // Fallback to simple Google Translate
        window.googleTranslateElementInit = function () {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en,ar,zh',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        };

        const script = document.createElement('script');
        script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
        document.head.appendChild(script);
    }
});