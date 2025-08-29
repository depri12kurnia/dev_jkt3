$(document).ready(function () {
    // Initialize FAQ enhancements
    initFAQEnhancements();
});

function initFAQEnhancements() {
    // Initialize smooth accordion
    initSmoothAccordion();

    // Add control buttons
    addControlButtons();

    // Add keyboard navigation
    addKeyboardNavigation();

    // Add hover effects
    addHoverEffects();
}

function initSmoothAccordion() {
    // Close all panels on load
    $('.panel-collapse').removeClass('in');

    // Handle accordion toggle with smooth animation
    $('.panel-title a').off('click').on('click', function (e) {
        e.preventDefault();

        const $this = $(this);
        const target = $this.attr('href');
        const $panel = $(target);
        const $allPanels = $('.panel-collapse');
        const $allTriggers = $('.panel-title a');
        const $parentPanel = $this.closest('.panel');

        // Check if current panel is open
        const isOpen = $panel.hasClass('in');

        // Remove active states
        $('.panel').removeClass('panel-active');
        $allTriggers.attr('aria-expanded', 'false');

        // Close all panels with smooth animation
        $allPanels.each(function () {
            if ($(this).hasClass('in')) {
                $(this).removeClass('in').slideUp(300);
            }
        });

        // If panel wasn't open, open it
        if (!isOpen) {
            setTimeout(() => {
                $panel.addClass('in').slideDown(300);
                $this.attr('aria-expanded', 'true');
                $parentPanel.addClass('panel-active');

                // Scroll to panel if needed
                scrollToPanel($parentPanel);
            }, 150);
        }
    });
}


function addControlButtons() {
    // Check if controls already exist
    if ($('.accordion-controls').length > 0) {
        return;
    }

    const controlHTML = `
        <div class="accordion-controls">
            <button type="button" class="btn btn-primary btn-sm" id="expand-all">
                <i class="fa fa-plus-circle"></i> Buka Semua
            </button>
            <button type="button" class="btn btn-primary btn-sm" id="collapse-all">
                <i class="fa fa-minus-circle"></i> Tutup Semua
            </button>
        </div>
    `;

    $('.panel-group').before(controlHTML);

    // Expand all
    $('#expand-all').on('click', function () {
        $('.panel-collapse').addClass('in').slideDown(300);
        $('.panel-title a').attr('aria-expanded', 'true');
        $('.panel').addClass('panel-active');
    });

    // Collapse all
    $('#collapse-all').on('click', function () {
        $('.panel-collapse').removeClass('in').slideUp(300);
        $('.panel-title a').attr('aria-expanded', 'false');
        $('.panel').removeClass('panel-active');
    });
}

function addKeyboardNavigation() {
    // Add keyboard navigation
    $(document).on('keydown', '.panel-title a', function (e) {
        const $panels = $('.panel-title a');
        const currentIndex = $panels.index(this);

        switch (e.keyCode) {
            case 13: // Enter
            case 32: // Space
                e.preventDefault();
                $(this).trigger('click');
                break;
            case 38: // Up arrow
                e.preventDefault();
                if (currentIndex > 0) {
                    $panels.eq(currentIndex - 1).focus();
                }
                break;
            case 40: // Down arrow
                e.preventDefault();
                if (currentIndex < $panels.length - 1) {
                    $panels.eq(currentIndex + 1).focus();
                }
                break;
            case 36: // Home
                e.preventDefault();
                $panels.first().focus();
                break;
            case 35: // End
                e.preventDefault();
                $panels.last().focus();
                break;
        }
    });
}

function addHoverEffects() {
    // Add hover effects
    $('.panel').hover(
        function () {
            if (!$(this).find('.panel-collapse').hasClass('in')) {
                $(this).addClass('panel-hover');
            }
        },
        function () {
            $(this).removeClass('panel-hover');
        }
    );
}

function scrollToPanel($panel) {
    if ($panel.length === 0) return;

    const offset = $panel.offset().top - 100;
    $('html, body').animate({
        scrollTop: offset
    }, 500);
}

// Utility functions
const FAQUtils = {
    // Open specific panel by ID
    openPanel: function (panelId) {
        const $panel = $('#' + panelId);
        const $trigger = $(`a[href="#${panelId}"]`);

        if ($panel.length) {
            $('.panel-collapse').removeClass('in').slideUp(300);
            $('.panel-title a').attr('aria-expanded', 'false');
            $('.panel').removeClass('panel-active');

            $panel.addClass('in').slideDown(300);
            $trigger.attr('aria-expanded', 'true');
            $trigger.closest('.panel').addClass('panel-active');

            scrollToPanel($trigger.closest('.panel'));
        }
    },

    // Get currently open panels
    getOpenPanels: function () {
        return $('.panel-collapse.in').map(function () {
            return this.id;
        }).get();
    },

    // Close all panels
    closeAll: function () {
        $('.panel-collapse').removeClass('in').slideUp(300);
        $('.panel-title a').attr('aria-expanded', 'false');
        $('.panel').removeClass('panel-active');
    }
};

// Make utilities globally available
window.FAQUtils = FAQUtils;