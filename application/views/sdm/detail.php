<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Detail SDM</h3>
                    </div>
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>">Home ></a></li>
                            <li><a href="<?php echo base_url('sdm'); ?>">SDM ></a></li>
                            <li class="active"><?php echo $sdm->nama; ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-single-team py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="single-team-card">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-5">
                            <div class="single-team-img">
                                <div class="profile-img-wrapper">
                                    <img src="<?php echo !empty($sdm->foto_url) ? base_url('assets/upload/sdm/' . $sdm->foto_url) : base_url('assets/images/staff/default-avatar.jpg'); ?>"
                                        alt="<?php echo htmlspecialchars($sdm->nama); ?>"
                                        class="img-fluid profile-img lazyload" />
                                    <div class="profile-overlay">
                                        <div class="status-badge">
                                            <?php if (!empty($sdm->nip)): ?>
                                                <span class="badge badge-success">
                                                    <i class="bi bi-shield-check me-1"></i>ASN
                                                </span>
                                            <?php else: ?>
                                                <span class="badge badge-info">
                                                    <i class="bi bi-briefcase me-1"></i>Non-ASN
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-7">
                            <div class="single-team-details">
                                <div class="profile-header">
                                    <h5 class="profile-name"><?php echo $sdm->nama; ?></h5>
                                    <div class="profile-subtitle">
                                        <?php if (!empty($sdm->jabatan)): ?>
                                            <h4 class="position-title"><?php echo $sdm->jabatan; ?></h4>
                                        <?php endif; ?>

                                        <?php if (!empty($sdm->level)): ?>
                                            <span class="level-badge level-<?php echo $sdm->level; ?>">
                                                <?php echo ucfirst($sdm->level); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($sdm->deskripsi)): ?>
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="bio-section">
                                                    <h4 class="bio-title">
                                                        <i class="bi bi-person-lines-fill me-2"></i>
                                                        Profil & Deskripsi
                                                    </h4>
                                                    <div class="bio-content tinymce-content">
                                                        <?php echo $sdm->deskripsi; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Actions -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="navigation-actions text-center">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary me-3">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="<?php echo base_url('sdm'); ?>" class="btn btn-outline-primary">
                        <i class="bi bi-people me-2"></i>Lihat Semua SDM
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Single Team Styling */
    .bg-single-team {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 70vh;
    }

    .single-team-card {
        background: #fff;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .single-team-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
    }

    /* Profile Image */
    .profile-img-wrapper {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .profile-img {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: cover;
        border-radius: 20px;
        transition: transform 0.3s ease;
    }

    .profile-img:hover {
        transform: scale(1.05);
    }

    .profile-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .status-badge .badge {
        font-size: 0.85rem;
        padding: 0.5rem 0.8rem;
        border-radius: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
    }

    .badge-info {
        background: linear-gradient(135deg, #17a2b8, #6f42c1);
        border: none;
    }

    /* Profile Details */
    .profile-header {
        margin-bottom: 2rem;
    }

    .profile-name {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .position-title {
        color: #00B9AD;
        font-weight: 600;
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .level-badge {
        display: inline-block;
        padding: 0.4rem 1rem;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .level-institusi {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
    }

    .level-jurusan {
        background: linear-gradient(135deg, #4834d4, #686de0);
        color: white;
    }

    .level-prodi {
        background: linear-gradient(135deg, #00d2d3, #01a3a4);
        color: white;
    }

    .level-unit {
        background: linear-gradient(135deg, #ff9ff3, #f368e0);
        color: white;
    }

    .level-pusat {
        background: linear-gradient(135deg, #feca57, #ff9ff3);
        color: white;
    }

    /* Info Items */
    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(0, 185, 173, 0.05);
        border-radius: 12px;
        border-left: 4px solid #00B9AD;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(0, 185, 173, 0.1);
        transform: translateX(5px);
    }

    .info-icon {
        color: #00B9AD;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-content label {
        display: block;
        font-weight: 600;
        color: #6c757d;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.2rem;
    }

    .info-content span,
    .info-content a {
        font-size: 1rem;
        color: #2c3e50;
        font-weight: 500;
    }

    .contact-link {
        color: #00B9AD !important;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .contact-link:hover {
        color: #008a80 !important;
        text-decoration: underline;
    }

    /* Contact Actions */
    .contact-actions {
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-contact {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-contact:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    /* Bio Section */
    .bio-section {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .bio-title {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e9ecef;
    }

    /* TinyMCE Content Styling */
    .tinymce-content {
        color: #555;
        line-height: 1.7;
        font-size: 1rem;
    }

    .tinymce-content p {
        margin-bottom: 1rem;
        text-align: justify;
    }

    .tinymce-content h1,
    .tinymce-content h2,
    .tinymce-content h3,
    .tinymce-content h4,
    .tinymce-content h5,
    .tinymce-content h6 {
        color: #2c3e50;
        font-weight: 600;
        margin: 1.5rem 0 1rem 0;
        line-height: 1.3;
    }

    .tinymce-content h1 {
        font-size: 2rem;
        border-bottom: 2px solid #00B9AD;
        padding-bottom: 0.5rem;
    }

    .tinymce-content h2 {
        font-size: 1.7rem;
        color: #00B9AD;
    }

    .tinymce-content h3 {
        font-size: 1.4rem;
    }

    .tinymce-content h4 {
        font-size: 1.2rem;
    }

    .tinymce-content h5,
    .tinymce-content h6 {
        font-size: 1rem;
    }

    .tinymce-content ul,
    .tinymce-content ol {
        margin: 1rem 0;
        padding-left: 2rem;
    }

    .tinymce-content li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .tinymce-content ul li {
        list-style-type: disc;
    }

    .tinymce-content ol li {
        list-style-type: decimal;
    }

    .tinymce-content ul ul,
    .tinymce-content ol ol,
    .tinymce-content ul ol,
    .tinymce-content ol ul {
        margin: 0.5rem 0;
    }

    .tinymce-content blockquote {
        background: rgba(0, 185, 173, 0.1);
        border-left: 4px solid #00B9AD;
        margin: 1.5rem 0;
        padding: 1rem 1.5rem;
        font-style: italic;
        border-radius: 0 8px 8px 0;
    }

    .tinymce-content blockquote p {
        margin-bottom: 0;
        color: #666;
    }

    .tinymce-content strong,
    .tinymce-content b {
        font-weight: 700;
        color: #2c3e50;
    }

    .tinymce-content em,
    .tinymce-content i {
        font-style: italic;
        color: #555;
    }

    .tinymce-content a {
        color: #00B9AD;
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: all 0.3s ease;
    }

    .tinymce-content a:hover {
        color: #008a80;
        border-bottom-color: #008a80;
        text-decoration: none;
    }

    .tinymce-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin: 1rem 0;
        display: block;
    }

    .tinymce-content img.aligncenter {
        margin: 1rem auto;
    }

    .tinymce-content img.alignleft {
        float: left;
        margin: 0 1rem 1rem 0;
    }

    .tinymce-content img.alignright {
        float: right;
        margin: 0 0 1rem 1rem;
    }

    .tinymce-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .tinymce-content th,
    .tinymce-content td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }

    .tinymce-content th {
        background: linear-gradient(135deg, #00B9AD, #4CAF50);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .tinymce-content tr:hover {
        background: rgba(0, 185, 173, 0.05);
    }

    .tinymce-content code {
        background: #f8f9fa;
        color: #e83e8c;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
    }

    .tinymce-content pre {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 1rem;
        overflow-x: auto;
        margin: 1rem 0;
    }

    .tinymce-content pre code {
        background: none;
        color: #2c3e50;
        padding: 0;
    }

    .tinymce-content hr {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        margin: 2rem 0;
        border-radius: 1px;
    }

    /* Text alignment classes */
    .tinymce-content .text-left {
        text-align: left;
    }

    .tinymce-content .text-center {
        text-align: center;
    }

    .tinymce-content .text-right {
        text-align: right;
    }

    .tinymce-content .text-justify {
        text-align: justify;
    }

    /* Font size classes */
    .tinymce-content .small {
        font-size: 0.85rem;
    }

    .tinymce-content .large {
        font-size: 1.2rem;
    }

    /* Text color classes */
    .tinymce-content .text-primary {
        color: #00B9AD !important;
    }

    .tinymce-content .text-success {
        color: #28a745 !important;
    }

    .tinymce-content .text-danger {
        color: #dc3545 !important;
    }

    .tinymce-content .text-warning {
        color: #ffc107 !important;
    }

    .tinymce-content .text-info {
        color: #17a2b8 !important;
    }

    .tinymce-content .text-muted {
        color: #6c757d !important;
    }

    /* Background color classes */
    .tinymce-content .bg-light {
        background-color: #f8f9fa !important;
        padding: 0.5rem;
        border-radius: 4px;
    }

    .tinymce-content .bg-primary {
        background-color: #00B9AD !important;
        color: white !important;
        padding: 0.5rem;
        border-radius: 4px;
    }

    /* Video responsive */
    .tinymce-content .video-responsive {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        margin: 1.5rem 0;
        border-radius: 8px;
    }

    .tinymce-content .video-responsive iframe,
    .tinymce-content .video-responsive object,
    .tinymce-content .video-responsive embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .single-team-card {
            padding: 2rem 1.5rem;
        }

        .profile-name {
            font-size: 1.1rem;
        }

        .position-title {
            font-size: 1.1rem;
        }

        .contact-actions {
            flex-direction: column;
        }

        .btn-contact {
            width: 100%;
            text-align: center;
        }

        .navigation-actions .btn {
            width: 100%;
            margin-bottom: 1rem;
        }

        .navigation-actions {
            text-align: left;
        }

        .tinymce-content {
            font-size: 0.95rem;
        }

        .tinymce-content h1 {
            font-size: 1.6rem;
        }

        .tinymce-content h2 {
            font-size: 1.4rem;
        }

        .tinymce-content h3 {
            font-size: 1.2rem;
        }

        .tinymce-content table {
            font-size: 0.85rem;
        }

        .tinymce-content th,
        .tinymce-content td {
            padding: 0.5rem 0.75rem;
        }

        .tinymce-content blockquote {
            padding: 0.75rem 1rem;
            margin: 1rem 0;
        }
    }

    @media (max-width: 576px) {
        .single-team-card {
            padding: 1.5rem 1rem;
        }

        .info-item {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }

        .bio-section {
            padding: 1.5rem;
        }

        .tinymce-content ul,
        .tinymce-content ol {
            padding-left: 1.5rem;
        }

        .tinymce-content img.alignleft,
        .tinymce-content img.alignright {
            float: none;
            margin: 1rem auto;
            display: block;
        }

        .tinymce-content table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }
</style>