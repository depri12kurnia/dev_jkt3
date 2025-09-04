<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Berita</h3>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item">Berita</li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo character_limiter(strip_tags($berita->judul_berita), 30); ?></li>
                        </ol>
                    </div>
                    <!-- .page-header-content -->
                </div>
                <!-- .page-header -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .page-header-overlay -->
</section>
<section class="bg-single-blog improved-blog">
    <style>
        .improved-blog .blog-items {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            padding: 32px 24px;
            margin-bottom: 24px;
        }

        .improved-blog .blog-img img {
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .improved-blog .blog-content-box {
            margin-top: 18px;
        }

        .improved-blog .meta-box {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
            font-size: 15px;
            color: #888;
        }

        .improved-blog .meta-post {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 18px;
        }

        .improved-blog .meta-post li {
            display: flex;
            align-items: center;
        }

        .improved-blog .blog-content h4 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #2c3e50;
        }

        .improved-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 24px;
            font-size: 15px;
            color: #888;
            margin-bottom: 18px;
        }

        .improved-meta .event-author-name {
            display: flex;
            align-items: center;
            gap: 7px;
            font-weight: 500;
        }

        .improved-meta .author-icon {
            color: #2980b9;
            font-size: 1.2em;
        }

        .improved-meta .author-label {
            color: #555;
        }

        .improved-meta .author-name {
            color: #2c3e50;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .improved-meta .author-name:hover {
            color: #e67e22;
        }

        .improved-meta .meta-post {
            list-style: none;
            display: flex;
            gap: 18px;
            margin: 0;
            padding: 0;
        }

        .improved-meta .meta-post li {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .improved-meta .meta-icon {
            color: #e67e22;
            font-size: 1em;
        }

        @media (max-width: 991px) {

            .improved-blog .col-md-8,
            .improved-blog .col-md-4 {
                width: 100%;
                max-width: 100%;
                flex: 0 0 100%;
            }

        }

        @media (max-width: 600px) {

            .improved-blog .blog-items,

            .improved-blog .blog-content h4 {
                font-size: 1.3rem;
            }

            .improved-meta {
                flex-direction: column;
                gap: 10px;
                font-size: 13px;
            }

            .improved-meta .meta-post {
                gap: 10px;
            }
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="single-blog">
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-items">
                            <?php if ($berita->gambar != "") { ?>
                                <div class="blog-img">
                                    <a href="#"><img src="<?php echo base_url('assets/upload/image/' . $berita->gambar) ?>" alt="blog-img-10" class="img-responsive lazyload" /></a>
                                </div>
                            <?php } ?>
                            <div class="blog-content-box">
                                <div class="meta-box improved-meta">
                                    <div class="event-author-option">
                                        <div class="event-author-name">
                                            <span class="author-icon"><i class="fa fa-user-circle"></i></span>
                                            <span class="author-label">Posted by</span>
                                            <a href="#" class="author-name"><?php echo $berita->nama; ?></a>
                                        </div>
                                    </div>
                                    <ul class="meta-post">
                                        <li>
                                            <span class="meta-icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            <span><?php echo date('d M Y', strtotime($berita->tanggal_publish)); ?></span>
                                        </li>
                                        <li>
                                            <span class="meta-icon"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                            <span><?php echo $berita->hits; ?> Viewer</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="blog-content">
                                    <h4><?php echo $berita->judul_berita; ?></h4>
                                    <?php echo $berita->isi; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- latestnews -->
<section id="latestnews" class="px-2 latest_news">
    <div class="container py-2">
        <h2 class="display-6 fw-semibold text-body-emphasis m-0">Berita Lainnya</h2>
        <hr class="mt-2 mb-1">
        <div class="row py-3 row-cols-2 row-cols-lg-4">
            <?php foreach ($berita_lainnya as $berita) { ?>
                <div class="col mb-2">
                    <div class="text-black bg-body-secondary mb-3 text-center post-images">
                        <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"
                            title="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>"
                            class=""><img src="<?php echo base_url('assets/upload/image/thumbs/' . $berita->gambar); ?>"
                                alt="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>"
                                class="img-fluid "></a>

                    </div>
                    <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"
                        title="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>">
                        <h3 class="fs-6 fw-semibold mb-3"><?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?></h3>
                    </a>
                    <small class="fs-7 text-capitalize badge bg-warning text-dark">Utama</small>
                    <small class="fs-7 badge bg-light text-dark"> <?php echo date('d M Y H:i', strtotime($berita->tanggal_publish)); ?> </small>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="container btn-more d-flex justify-content-end align-items-center ">
        <a href="<?php echo base_url('berita'); ?>" class="px-4 py-2 rounded-pillb fs-7 fw-semibold mx-1" title="Selengkapnya"><i class="bi bi-arrow-right text-default fs-5"></i> Selengkapnya</a>
    </div>
</section>
<!-- End latestnews -->