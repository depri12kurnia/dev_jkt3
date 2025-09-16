<section class="testimonial-section">
    <div class="testimonial-container">
        <div class="section-title" data-aos="fade-up">
            <h2>Testimoni Alumni</h2>
            <p>Pengalaman alumni Poltekkes Kemenkes Jakarta III yang telah sukses berkarir di dunia kesehatan</p>
        </div>

        <div class="testimonial-slider-wrapper">
            <!-- Navigation Buttons -->
            <button class="slider-nav prev-btn" id="prevBtn">
                <i class="fa fa-chevron-left"></i>
            </button>
            <button class="slider-nav next-btn" id="nextBtn">
                <i class="fa fa-chevron-right"></i>
            </button>

            <!-- Testimonial Slider -->
            <div class="testimonial-slider" id="testimonialSlider">
                <?php if (!empty($testimoni)): ?>
                    <?php
                    $total_testimoni = count($testimoni);
                    $testimoni_per_slide = 4; // Sesuaikan dengan grid 4 kolom
                    $total_slides = ceil($total_testimoni / $testimoni_per_slide);
                    ?>

                    <?php for ($slide = 0; $slide < $total_slides; $slide++): ?>
                        <div class="testimonial-slide <?php echo ($slide == 0) ? 'active' : '' ?>">
                            <div class="testimonial-grid">
                                <?php
                                $start_index = $slide * $testimoni_per_slide;
                                $end_index = min($start_index + $testimoni_per_slide, $total_testimoni);
                                ?>

                                <?php for ($i = $start_index; $i < $end_index; $i++): ?>
                                    <?php $item = $testimoni[$i]; ?>
                                    <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?php echo (($i % $testimoni_per_slide) + 1) * 100 ?>">
                                        <div class="card-border"></div>
                                        <div class="quote-icon">
                                            <i class="fa fa-quote-left"></i>
                                        </div>
                                        <div class="testimonial-text">
                                            "<?php echo htmlspecialchars($item->isi, ENT_QUOTES, 'UTF-8') ?>"
                                        </div>
                                        <div class="client-info">
                                            <div class="client-avatar">
                                                <?php if (!empty($item->foto)): ?>
                                                    <img src="<?php echo base_url('assets/images/testimoni/' . $item->foto) ?>"
                                                        alt="<?php echo htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8') ?>"
                                                        class="avatar-photo">
                                                <?php else: ?>
                                                    <span class="initials"><?php echo strtoupper(substr($item->nama, 0, 2)) ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="client-details">
                                                <h4><?php echo htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8') ?></h4>
                                                <p>
                                                    <?php if (!empty($item->jabatan)): ?>
                                                        <?php echo htmlspecialchars($item->jabatan, ENT_QUOTES, 'UTF-8') ?>
                                                        <?php if (!empty($item->asal_prodi)): ?>
                                                            - <?php echo htmlspecialchars($item->asal_prodi, ENT_QUOTES, 'UTF-8') ?>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php echo htmlspecialchars($item->asal_prodi, ENT_QUOTES, 'UTF-8') ?>
                                                    <?php endif; ?>
                                                </p>
                                                <div class="rating">
                                                    <i class="fa fa-star star"></i>
                                                    <i class="fa fa-star star"></i>
                                                    <i class="fa fa-star star"></i>
                                                    <i class="fa fa-star star"></i>
                                                    <i class="fa fa-star star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>

                                <!-- Fill empty slots jika kurang dari 4 item di slide terakhir -->
                                <?php if ($slide == $total_slides - 1): ?>
                                    <?php $remaining_slots = $testimoni_per_slide - ($end_index - $start_index); ?>
                                    <?php for ($j = 0; $j < $remaining_slots; $j++): ?>
                                        <div class="testimonial-card-placeholder"></div>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endfor; ?>

                <?php else: ?>
                    <!-- Fallback jika tidak ada testimoni -->
                    <div class="testimonial-slide active">
                        <div class="testimonial-grid">
                            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                                <div class="card-border"></div>
                                <div class="quote-icon">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="testimonial-text">
                                    "Poltekkes Jakarta 3 memberikan bekal yang sangat kuat dalam bidang keperawatan. Dosen-dosen profesional dan fasilitas laboratorium yang lengkap membuat saya siap menghadapi dunia kerja."
                                </div>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <span class="initials">NS</span>
                                    </div>
                                    <div class="client-details">
                                        <h4>Nur Sari, S.Kep</h4>
                                        <p>Kepala Ruang ICU RS Husada</p>
                                        <div class="rating">
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                                <div class="card-border"></div>
                                <div class="quote-icon">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="testimonial-text">
                                    "Pembelajaran praktik yang mendalam di laboratorium kesehatan membuat saya siap menjadi analis kesehatan yang handal. Poltekkes Jakarta 3 the best!"
                                </div>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <span class="initials">AF</span>
                                    </div>
                                    <div class="client-details">
                                        <h4>Ahmad Fauzi, A.Md.AK</h4>
                                        <p>Analis Lab Prodia</p>
                                        <div class="rating">
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                                <div class="card-border"></div>
                                <div class="quote-icon">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="testimonial-text">
                                    "Pengalaman belajar di Poltekkes Jakarta 3 sangat berharga. Skill farmasi klinis yang diperoleh membantu saya dalam memberikan pelayanan farmasi yang optimal di rumah sakit."
                                </div>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <span class="initials">SF</span>
                                    </div>
                                    <div class="client-details">
                                        <h4>Siti Fatimah, S.Farm</h4>
                                        <p>Apoteker RS Mayapada</p>
                                        <div class="rating">
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="400">
                                <div class="card-border"></div>
                                <div class="quote-icon">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="testimonial-text">
                                    "Alumni Poltekkes Jakarta 3 selalu menjadi prioritas di dunia kerja. Kompetensi yang kami miliki sangat diakui oleh industri kesehatan nasional maupun internasional."
                                </div>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <span class="initials">BA</span>
                                    </div>
                                    <div class="client-details">
                                        <h4>Budi Anggoro, S.Tr.Ft</h4>
                                        <p>Fisioterapis RS Siloam</p>
                                        <div class="rating">
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Dots Indicator -->
            <div class="slider-dots" id="sliderDots">
                <?php if (!empty($testimoni)): ?>
                    <?php for ($dot = 0; $dot < $total_slides; $dot++): ?>
                        <span class="dot <?php echo ($dot == 0) ? 'active' : '' ?>" data-slide="<?php echo $dot ?>"></span>
                    <?php endfor; ?>
                <?php else: ?>
                    <span class="dot active" data-slide="0"></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="cta-section" data-aos="fade-up" data-aos-delay="700">
            <h3>Bergabunglah dengan Alumni Sukses Kami!</h3>
            <p>Wujudkan impian berkarir di dunia kesehatan bersama Poltekkes Kemenkes Jakarta III</p>
            <a href="https://sipenmaru.poltekkesjakarta3.ac.id" target="_blank" class="cta-button">
                <span class="btn-text">
                    <i class="fa fa-graduation-cap"></i> Daftar Sekarang
                </span>
                <span class="btn-overlay"></span>
            </a>
        </div>
    </div>
</section>

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    .testimonial-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #CDDC29 25%, #60C0D0 50%, #00B9AD 100%);
        background-size: 400% 400%;
        animation: gradientShift 20s ease infinite;
        position: relative;
        overflow: hidden;
    }

    .testimonial-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.08"><circle cx="30" cy="30" r="4"/><circle cx="10" cy="10" r="2"/><circle cx="50" cy="50" r="2"/><circle cx="10" cy="50" r="1.5"/><circle cx="50" cy="10" r="1.5"/></g></svg>') repeat;
        pointer-events: none;
        animation: patternMove 30s linear infinite;
    }

    .testimonial-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
    }

    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title h2 {
        font-size: 3.5rem;
        color: white;
        margin-bottom: 20px;
        font-weight: 800;
        background: linear-gradient(45deg, #ffffff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.3));
    }

    .section-title p {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.95);
        max-width: 700px;
        margin: 0 auto;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        line-height: 1.6;
    }

    /* Slider Wrapper */
    .testimonial-slider-wrapper {
        position: relative;
        margin-bottom: 60px;
    }

    .testimonial-slider {
        overflow: hidden;
        position: relative;
        border-radius: 20px;
    }

    .testimonial-slide {
        display: none;
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .testimonial-slide.active {
        display: block;
        opacity: 1;
        transform: translateX(0);
    }

    .testimonial-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }

    /* Placeholder untuk slot kosong */
    .testimonial-card-placeholder {
        visibility: hidden;
    }

    /* Navigation Buttons */
    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 60px;
        height: 60px;
        border: none;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.1));
        backdrop-filter: blur(15px);
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        z-index: 10;
        box-shadow:
            0 15px 35px rgba(0, 0, 0, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        outline: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        min-width: 60px;
        min-height: 60px;
        max-width: 60px;
        max-height: 60px;
        line-height: 1;
        text-align: center;
        vertical-align: middle;
    }

    .slider-nav i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-style: normal;
        font-weight: normal;
        line-height: 1;
        margin: 0;
        padding: 0;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
    }

    .slider-nav:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0.15));
        transform: translateY(-50%) scale(1.15);
        box-shadow:
            0 20px 45px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .slider-nav:active {
        transform: translateY(-50%) scale(0.95);
        transition: transform 0.1s ease;
    }

    .prev-btn {
        left: -35px;
    }

    .next-btn {
        right: -35px;
    }

    /* Enhanced Dots */
    .slider-dots {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 45px;
    }

    .dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        cursor: pointer;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        box-sizing: border-box;
        border: 2px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }

    .dot::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 6px;
        height: 6px;
        background: white;
        border-radius: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: transform 0.3s ease;
    }

    .dot.active {
        background: rgba(255, 255, 255, 0.5);
        border-color: rgba(255, 255, 255, 0.6);
        transform: scale(1.2);
    }

    .dot.active::before {
        transform: translate(-50%, -50%) scale(1);
    }

    .dot:hover {
        background: rgba(255, 255, 255, 0.4);
        transform: scale(1.3);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .testimonial-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 35px 25px;
        /* box-shadow:
            0 25px 50px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.3); */
        position: relative;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform-style: preserve-3d;
        height: fit-content;
    }

    .card-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1);
        background-size: 600% 100%;
        animation: borderFlow 12s ease infinite;
        border-radius: 25px 25px 0 0;
    }

    .testimonial-card:hover {
        transform: translateY(-20px) rotateX(5deg);
        /* box-shadow:
            0 40px 80px rgba(0, 0, 0, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)); */
    }

    .testimonial-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 70%); */
        opacity: 0;
        transition: opacity 0.5s ease;
        border-radius: 25px;
    }

    .testimonial-card:hover::after {
        opacity: 1;
    }

    .quote-icon {
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 20px;
        transition: all 0.4s ease;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .testimonial-card:hover .quote-icon {
        color: rgba(255, 255, 255, 0.9);
        transform: scale(1.1) rotate(-5deg);
    }

    .testimonial-text {
        font-size: 1rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 25px;
        font-style: italic;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        font-weight: 400;
        min-height: 120px;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .client-info {
        display: flex;
        align-items: center;
        gap: 15px;
        position: relative;
        z-index: 2;
    }

    /* Updated Avatar Styles for Photos */
    .client-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        transition: all 0.4s ease;
        border: 3px solid rgba(255, 255, 255, 0.4);
        flex-shrink: 0;
        overflow: hidden;
        position: relative;
    }

    .avatar-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
        transition: all 0.4s ease;
        filter: brightness(1.1) contrast(1.1) saturate(1.2);
    }

    .client-avatar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), transparent, rgba(255, 255, 255, 0.1));
        border-radius: 50%;
        pointer-events: none;
        z-index: 1;
    }

    .testimonial-card:hover .client-avatar {
        transform: scale(1.15) rotate(5deg);
        box-shadow:
            0 15px 35px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.5);
        border-color: rgba(255, 255, 255, 0.6);
    }

    .testimonial-card:hover .avatar-photo {
        transform: scale(1.05);
        filter: brightness(1.2) contrast(1.2) saturate(1.3);
    }

    /* Style untuk initials */
    .initials {
        color: white;
        font-size: 1.4rem;
        font-weight: bold;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        z-index: 2;
        position: relative;
    }

    .client-details {
        flex: 1;
        min-width: 0;
    }

    .client-details h4 {
        font-size: 1.1rem;
        color: white;
        margin-bottom: 5px;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .client-details p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
        margin-bottom: 8px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .rating {
        display: flex;
        gap: 2px;
        margin-top: 5px;
    }

    .star {
        color: #ffd700;
        font-size: 1rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        filter: drop-shadow(0 0 3px rgba(255, 215, 0, 0.5));
    }

    .testimonial-card:hover .star {
        transform: scale(1.1);
        filter: drop-shadow(0 0 5px rgba(255, 215, 0, 0.8));
    }

    .cta-section {
        text-align: center;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        border-radius: 30px;
        padding: 60px 50px;
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow:
            0 30px 60px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        transition: all 0.5s ease;
    }

    .cta-section:hover {
        transform: translateY(-10px);
        box-shadow:
            0 40px 80px rgba(0, 0, 0, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
    }

    .cta-section h3 {
        color: white;
        font-size: 2.5rem;
        margin-bottom: 25px;
        font-weight: 800;
        background: linear-gradient(45deg, #ffffff, #f8f9fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .cta-section p {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 35px;
        font-size: 1.25rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        line-height: 1.6;
    }

    .cta-button {
        display: inline-block;
        padding: 20px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.2rem;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.1));
        backdrop-filter: blur(15px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        transition: all 0.4s ease;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .btn-text {
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .btn-overlay {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s ease;
    }

    .cta-button:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0.15));
    }

    .cta-button:hover .btn-overlay {
        left: 100%;
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }

        25% {
            background-position: 50% 25%;
        }

        50% {
            background-position: 100% 50%;
        }

        75% {
            background-position: 50% 75%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    @keyframes borderFlow {
        0% {
            background-position: 0% 50%;
        }

        33% {
            background-position: 50% 25%;
        }

        66% {
            background-position: 100% 75%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    @keyframes patternMove {
        0% {
            transform: translateX(0) translateY(0);
        }

        25% {
            transform: translateX(-20px) translateY(-10px);
        }

        50% {
            transform: translateX(0) translateY(-20px);
        }

        75% {
            transform: translateX(20px) translateY(-10px);
        }

        100% {
            transform: translateX(0) translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-12px);
        }
    }

    .testimonial-card:nth-child(odd) {
        animation: float 8s ease-in-out infinite;
    }

    .testimonial-card:nth-child(even) {
        animation: float 8s ease-in-out infinite reverse;
        animation-delay: -2s;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .testimonial-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .testimonial-container {
            max-width: 1000px;
        }

        .prev-btn {
            left: -25px;
        }

        .next-btn {
            right: -25px;
        }
    }

    @media (max-width: 992px) {
        .testimonial-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .testimonial-card {
            padding: 40px 30px;
        }

        .testimonial-text {
            font-size: 1.05rem;
            min-height: 140px;
        }

        .prev-btn {
            left: -15px;
        }

        .next-btn {
            right: -15px;
        }

        .slider-nav {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
            min-width: 50px;
            min-height: 50px;
            max-width: 50px;
            max-height: 50px;
        }

        .client-avatar {
            width: 55px;
            height: 55px;
        }
    }

    @media (max-width: 768px) {
        .testimonial-section {
            padding: 60px 0;
        }

        .section-title h2 {
            font-size: 2.5rem;
        }

        .section-title p {
            font-size: 1.1rem;
        }

        .testimonial-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .testimonial-card {
            padding: 35px 25px;
            margin: 0 10px;
        }

        .testimonial-text {
            min-height: auto;
            -webkit-line-clamp: unset;
        }

        .client-avatar {
            width: 65px;
            height: 65px;
        }

        .client-details h4 {
            font-size: 1.2rem;
            white-space: normal;
        }

        .client-details p {
            font-size: 0.9rem;
            white-space: normal;
        }

        .cta-section {
            padding: 40px 30px;
            margin: 0 10px;
        }

        .cta-section h3 {
            font-size: 2rem;
        }

        .quote-icon {
            font-size: 1.8rem;
        }

        .prev-btn {
            left: 10px;
        }

        .next-btn {
            right: 10px;
        }

        .slider-nav {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
            min-width: 45px;
            min-height: 45px;
            max-width: 45px;
            max-height: 45px;
        }
    }

    @media (max-width: 480px) {
        .testimonial-container {
            padding: 0 15px;
        }

        .testimonial-card {
            padding: 30px 20px;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .cta-section h3 {
            font-size: 1.8rem;
        }

        .cta-button {
            padding: 16px 30px;
            font-size: 1.1rem;
        }

        .client-info {
            gap: 12px;
        }

        .client-avatar {
            width: 55px;
            height: 55px;
        }

        .slider-nav {
            width: 40px;
            height: 40px;
            font-size: 1rem;
            min-width: 40px;
            min-height: 40px;
            max-width: 40px;
            max-height: 40px;
        }

        .prev-btn {
            left: 5px;
        }

        .next-btn {
            right: 5px;
        }
    }

    /* Performance optimizations */
    .testimonial-card {
        will-change: transform;
    }

    .client-avatar {
        will-change: transform;
    }

    .star {
        will-change: transform;
    }

    .avatar-photo {
        will-change: transform, filter;
    }
</style>

<!-- AOS JavaScript -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 1200,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100,
            delay: 100
        });

        // Handle missing images
        const avatarImages = document.querySelectorAll('.avatar-photo');
        avatarImages.forEach((img, index) => {
            img.addEventListener('error', function() {
                const avatar = this.parentElement;
                const name = this.alt || `User ${index + 1}`;
                const initials = name.split(' ').map(word => word.charAt(0)).join('').substring(0, 2);

                // Hide the image
                this.style.display = 'none';

                // Create initials element if not exists
                if (!avatar.querySelector('.initials')) {
                    const initialsSpan = document.createElement('span');
                    initialsSpan.className = 'initials';
                    initialsSpan.textContent = initials.toUpperCase();
                    avatar.appendChild(initialsSpan);
                }
            });
        });

        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.testimonial-slide');
        const dots = document.querySelectorAll('.dot');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach(slide => {
                slide.classList.remove('active');
            });
            dots.forEach(dot => {
                dot.classList.remove('active');
            });

            if (slides[index]) {
                slides[index].classList.add('active');
            }
            if (dots[index]) {
                dots[index].classList.add('active');
            }
            currentSlide = index;
        }

        function nextSlide() {
            const next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }

        function prevSlide() {
            const prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
        }

        // Event listeners
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);

        // Dots navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Auto-play slider hanya jika ada lebih dari 1 slide
        let autoSlideInterval;
        if (totalSlides > 1) {
            autoSlideInterval = setInterval(nextSlide, 6000);

            // Pause auto-play on hover
            const sliderWrapper = document.querySelector('.testimonial-slider-wrapper');
            if (sliderWrapper) {
                sliderWrapper.addEventListener('mouseenter', () => {
                    clearInterval(autoSlideInterval);
                });

                sliderWrapper.addEventListener('mouseleave', () => {
                    autoSlideInterval = setInterval(nextSlide, 6000);
                });
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (totalSlides > 1) {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                }
            }
        });

        // Touch/swipe support
        let startX = 0;
        let endX = 0;

        const sliderWrapper = document.querySelector('.testimonial-slider-wrapper');
        if (sliderWrapper && totalSlides > 1) {
            sliderWrapper.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });

            sliderWrapper.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });
        }

        function handleSwipe() {
            const threshold = 50;
            const diff = startX - endX;

            if (Math.abs(diff) > threshold) {
                if (diff > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        }

        // Enhanced intersection observer
        const observerOptions = {
            threshold: [0.1, 0.3, 0.5],
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');

                    // Add stagger animation for stars
                    const stars = entry.target.querySelectorAll('.star');
                    stars.forEach((star, index) => {
                        setTimeout(() => {
                            star.style.animation = `starTwinkle 0.5s ease ${index * 0.1}s`;
                        }, 500);
                    });
                }
            });
        }, observerOptions);

        document.querySelectorAll('.testimonial-card').forEach(card => {
            observer.observe(card);
        });

        // Add star twinkle animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes starTwinkle {
                0% { transform: scale(1); }
                50% { transform: scale(1.3); }
                100% { transform: scale(1); }
            }
        `;
        document.head.appendChild(style);
    });
</script>