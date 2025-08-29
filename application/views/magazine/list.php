<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/dflip/js/dflip.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/dflip/css/dflip.min.css">

<section class="bg-collection-section py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="collection-option">
                    <!-- Section Header -->
                    <div class="section-header text-center mb-5">
                        <h2 class="display-4 font-weight-bold text-primary mb-3">KOLEKSI E-MAJALAH</h2>
                        <p class="lead text-muted">E-Majalah Dari Setiap Jurusan Politeknik Kesehatan Kemenkes Jakarta III</p>
                        <hr class="w-25 mx-auto">
                    </div>
                    <!-- .section-header -->

                    <!-- Magazine Grid -->
                    <div class="row">
                        <?php if (!empty($magazine)) { ?>
                            <?php foreach ($magazine as $mag) { ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                                    <div class="collection-items h-100">
                                        <div class="card shadow-sm h-100 border-0 magazine-card">
                                            <!-- Magazine Cover -->
                                            <div class="collection-img position-relative overflow-hidden">
                                                <div class="_df_book card-img-top"
                                                    id="df_manual_book_<?php echo $mag->id_magazine ?>"
                                                    source="<?php echo base_url('assets/upload/magazine/' . $mag->pdfmagazine) ?>"
                                                    style="height: 300px; cursor: pointer;">
                                                </div>

                                                <!-- Overlay on Hover -->
                                                <div class="overlay-hover position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                                                    <div class="overlay-content text-center text-white">
                                                        <i class="fa fa-book-open fa-3x mb-2"></i>
                                                        <p class="mb-0">Klik untuk Membaca</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- .collection-img -->

                                            <!-- Magazine Info -->
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title font-weight-bold text-truncate" title="<?php echo htmlspecialchars($mag->judul_magazine) ?>">
                                                    <?php echo character_limiter($mag->judul_magazine, 50) ?>
                                                </h5>

                                                <?php if (!empty($mag->isi)) { ?>
                                                    <p class="card-text text-muted small flex-grow-1">
                                                        <?php echo character_limiter(strip_tags($mag->isi), 80) ?>
                                                    </p>
                                                <?php } ?>

                                                <!-- Magazine Meta -->
                                                <div class="magazine-meta mt-auto">
                                                    <!-- Action Buttons -->
                                                    <div class="collection-content text-center">
                                                        <button class="_df_button btn btn-primary btn-block font-weight-bold"
                                                            source="<?php echo base_url('assets/upload/magazine/' . $mag->pdfmagazine) ?>"
                                                            data-title="<?php echo htmlspecialchars($mag->judul_magazine) ?>">
                                                            <i class="fa fa-book mr-2"></i>
                                                            Baca Sekarang
                                                        </button>

                                                        <div class="btn-group btn-group-sm mt-2 w-100" role="group">
                                                            <a href="<?php echo base_url('assets/upload/magazine/' . $mag->pdfmagazine) ?>"
                                                                target="_blank"
                                                                class="btn btn-outline-secondary">
                                                                <i class="fa fa-eye"></i> Buka
                                                            </a>
                                                            <button type="button"
                                                                class="btn btn-outline-info btn-share"
                                                                data-url="<?php echo base_url('magazine/read/' . $mag->slug_magazine) ?>"
                                                                data-title="<?php echo htmlspecialchars($mag->judul_magazine) ?>">
                                                                <i class="fa fa-share-alt"></i> Share
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- .collection-content -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .collection-items -->
                                </div>
                                <!-- .col -->
                            <?php } ?>
                        <?php } else { ?>
                            <!-- Empty State -->
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fa fa-book fa-5x text-muted mb-4"></i>
                                        <h4 class="text-muted">Belum Ada E-Majalah</h4>
                                        <p class="text-muted">E-Majalah akan segera tersedia. Silakan kembali lagi nanti.</p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- .row -->

                    <!-- Pagination (if needed) -->
                    <?php if (isset($pagination) && !empty($pagination)) { ?>
                        <div class="row mt-5">
                            <div class="col-12">
                                <nav aria-label="Magazine pagination">
                                    <div class="pagination-wrapper text-center">
                                        <?php echo $pagination ?>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- .collection-option -->
            </div>
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>

<!-- Custom CSS -->
<style>
    .bg-collection-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .section-header h2 {
        color: #2c3e50;
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .section-header hr {
        border-top: 3px solid #3498db;
        border-radius: 2px;
    }

    .magazine-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }

    .magazine-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    .collection-img {
        position: relative;
        background: #f8f9fa;
        border-radius: 10px 10px 0 0;
    }

    .collection-img ._df_book {
        width: 100%;
        border-radius: 10px 10px 0 0;
        transition: transform 0.3s ease;
    }

    .overlay-hover {
        top: 0;
        left: 0;
        background: rgba(52, 152, 219, 0.9);
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 10px 10px 0 0;
    }

    .collection-img:hover .overlay-hover {
        opacity: 1;
    }

    .collection-img:hover ._df_book {
        transform: scale(1.05);
    }

    .card-title {
        color: #2c3e50;
        font-size: 1.1rem;
        line-height: 1.4;
    }

    .magazine-meta {
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .magazine-meta i {
        color: #3498db;
        margin-bottom: 5px;
    }

    ._df_button {
        background: linear-gradient(135deg, #3498db, #2980b9) !important;
        border: none !important;
        border-radius: 25px !important;
        padding: 12px 25px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        transition: all 0.3s ease !important;
        color: white !important;
    }

    ._df_button:hover {
        background: linear-gradient(135deg, #2980b9, #3498db) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4) !important;
    }

    .btn-share:hover {
        background-color: #17a2b8 !important;
        border-color: #17a2b8 !important;
        color: white !important;
    }

    .empty-state {
        padding: 60px 20px;
    }

    .empty-state i {
        opacity: 0.5;
    }

    /* Pagination Styling */
    .pagination-wrapper .pagination {
        justify-content: center;
    }

    .pagination-wrapper .pagination .page-link {
        border-radius: 25px;
        margin: 0 5px;
        border: 2px solid #3498db;
        color: #3498db;
        font-weight: 600;
    }

    .pagination-wrapper .pagination .page-link:hover,
    .pagination-wrapper .pagination .page-item.active .page-link {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section-header h2 {
            font-size: 2rem;
        }

        .collection-img ._df_book {
            height: 250px !important;
        }

        .magazine-card {
            margin-bottom: 20px;
        }

        .btn-group-sm .btn {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
    }

    @media (max-width: 576px) {
        .section-header h2 {
            font-size: 1.8rem;
        }

        .collection-img ._df_book {
            height: 200px !important;
        }

        .card-body {
            padding: 15px;
        }

        ._df_button {
            font-size: 0.9rem !important;
            padding: 10px 20px !important;
        }
    }

    /* DFlip Custom Styling */
    .df-container {
        border-radius: 15px !important;
        overflow: hidden !important;
    }

    .df-ui-close {
        background: rgba(231, 76, 60, 0.9) !important;
        border-radius: 50% !important;
        width: 40px !important;
        height: 40px !important;
    }

    .df-ui-close:hover {
        background: rgba(192, 57, 43, 1) !important;
    }

    /* Loading Animation */
    ._df_book.loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }
</style>

<!-- Enhanced JavaScript -->
<script>
    $(document).ready(function() {
        // Initialize DFlip with custom options
        $("._df_book").each(function() {
            $(this).addClass('loading');
        });

        // DFlip Configuration
        window.DFLIP = window.DFLIP || {};
        DFLIP.defaults = {
            height: "100%",
            autoPlay: false,
            autoPlayStart: false,
            autoPlayDuration: 3000,
            backgroundColor: "#fff",
            backgroundImage: "",
            direction: 1,
            duration: 800,
            flipbookHardPages: true,
            flipbookPageSize: "auto",
            maxTextureSize: 1600,
            pageMode: 1,
            scrollWheel: true,
            singlePageMode: false,
            webgl: true,
            zoomRatio: 1.5,
            paddingTop: 30,
            paddingBottom: 30,
            paddingLeft: 30,
            paddingRight: 30,
            controlsPosition: "bottom",
            shareUrl: window.location.href
        };

        // Handle share button clicks
        $('.btn-share').on('click', function() {
            var url = $(this).data('url');
            var title = $(this).data('title');

            // Check if Web Share API is supported
            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: 'Baca e-majalah: ' + title,
                    url: url
                }).then(() => {
                    console.log('Successfully shared');
                }).catch((error) => {
                    console.log('Error sharing:', error);
                    fallbackShare(url, title);
                });
            } else {
                fallbackShare(url, title);
            }
        });

        function fallbackShare(url, title) {
            // Fallback share options
            var shareModal = `
                <div class="modal fade" id="shareModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Share E-Majalah</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="btn-group-vertical w-100">
                                    <a href="https://wa.me/?text=${encodeURIComponent(title + ' - ' + url)}" 
                                       target="_blank" class="btn btn-success mb-2">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}" 
                                       target="_blank" class="btn btn-primary mb-2">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}" 
                                       target="_blank" class="btn btn-info mb-2">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                    <button class="btn btn-secondary copy-link" data-url="${url}">
                                        <i class="fa fa-copy"></i> Copy Link
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Remove existing modal and add new one
            $('#shareModal').remove();
            $('body').append(shareModal);
            $('#shareModal').modal('show');
        }

        // Copy link functionality
        $(document).on('click', '.copy-link', function() {
            var url = $(this).data('url');

            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(function() {
                    showToast('Link berhasil disalin!', 'success');
                    $('#shareModal').modal('hide');
                });
            } else {
                // Fallback for older browsers
                var textArea = document.createElement("textarea");
                textArea.value = url;
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    showToast('Link berhasil disalin!', 'success');
                    $('#shareModal').modal('hide');
                } catch (err) {
                    showToast('Gagal menyalin link', 'error');
                }
                document.body.removeChild(textArea);
            }
        });

        // Toast notification function
        function showToast(message, type) {
            var toast = `
                <div class="toast-notification ${type}" style="
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${type === 'success' ? '#27ae60' : '#e74c3c'};
                    color: white;
                    padding: 15px 20px;
                    border-radius: 5px;
                    z-index: 9999;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                ">
                    ${message}
                </div>
            `;

            $('body').append(toast);

            setTimeout(function() {
                $('.toast-notification').fadeOut(function() {
                    $(this).remove();
                });
            }, 3000);
        }

        // Smooth scroll to top button
        if ($('.magazine-card').length > 6) {
            $('body').append(`
                <button id="scrollToTop" class="btn btn-primary" style="
                    position: fixed;
                    bottom: 30px;
                    right: 30px;
                    border-radius: 50%;
                    width: 50px;
                    height: 50px;
                    display: none;
                    z-index: 1000;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                ">
                    <i class="fa fa-arrow-up"></i>
                </button>
            `);

            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('#scrollToTop').fadeIn();
                } else {
                    $('#scrollToTop').fadeOut();
                }
            });

            $('#scrollToTop').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 'smooth');
            });
        }

        // Remove loading class when DFlip is ready
        setTimeout(function() {
            $("._df_book").removeClass('loading');
        }, 2000);
    });
</script>