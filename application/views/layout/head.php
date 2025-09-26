<?php
// Site
$site_info = $this->konfigurasi_model->listing();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo strip_tags($site_info->tentang) . ', ' . $title ?>">
    <meta name="keywords" content="<?php echo $site_info->keywords . ', ' . $title  ?>">
    <meta name="keywords" content="Poltekkes Terbaik, Poltekkes Kemenkes, Poltekkes, Politeknik Kesehatan, Politeknik Kesehatan Kemenkes, Politeknik Kesehatan Jakarta III, Poltekkes Jakarta III, Poltekkes Jakarta 3, Poltekkes Jakarta Timur, Poltekkes Jaktim, Poltekkes JKT3, Poltekkes Kemenkes Jakarta III, Poltekkes Kemenkes Jakarta 3, Poltekkes Kemenkes Jakarta Timur, Poltekkes Kemenkes Jaktim, Poltekkes Kemenkes JKT3">
    <meta name="keywords" content="Politeknik Kesehatan Jakarta III, Politeknik Kesehatan Jakarta 3, Politeknik Kesehatan Jakarta Timur, Politeknik Kesehatan Jaktim, Politeknik Kesehatan JKT3">
    <meta name="keywords" content="Politeknik Terbaik, Politeknik Kesehatan Terbaik, Politeknik Kesehatan Kemenkes Terbaik, Poltekkes Terbaik, Poltekkes Kemenkes Terbaik">
    <meta name="keywords" content="Kampus Kesehatan, Kampus Kesehatan Terbaik, Kampus Kesehatan Kemenkes, Kampus Kesehatan Kemenkes Terbaik">
    <meta name="keywords" content="Institut Kesehatan, Institut Kesehatan Terbaik, Institut Kesehatan Kemenkes, Institut Kesehatan Kemenkes Terbaik">
    <meta name="keywords" content="BLU Kampus, BLU Kampus Kesehatan, BLU Kampus Kesehatan Kemenkes, BLU Poltekkes, BLU Poltekkes Kemenkes">
    <meta name="keywords" content="Kelas Internasional, Kelas Internasional Poltekkes, Kelas Internasional Poltekkes Kemenkes">
    <meta name="keywords" content="Kelas Alih Jenjang, Kelas Alih Jenjang Poltekkes, Kelas Alih Jenjang Poltekkes Kemenkes">
    <meta name="keywords" content="Kelas Karyawan, Kelas Karyawan Poltekkes, Kelas Karyawan Poltekkes Kemenkes">
    <meta name="keywords" content="Pendidikan Kesehatan, Pendidikan Kesehatan Terbaik, Pendidikan Kesehatan Kemenkes, Pendidikan Kesehatan Kemenkes Terbaik">
    <meta name="keywords" content="Kesehatan, Kesehatan Terbaik, Kesehatan Kemenkes, Kesehatan Kemenkes Terbaik">
    <meta name="keywords" content="Kampus Merdeka, Kampus Merdeka Poltekkes, Kampus Merdeka Poltekkes Kemenkes">
    <meta name="keywords" content="spmb, spmb poltekkes, spmb poltekkes kemenkes, spmb poltekkes jakarta iii, spmb poltekkes jakarta 3, spmb poltekkes jakarta timur, spmb poltekkes jaktim, spmb poltekkes jkt3">
    <meta name="keywords" content="jalur prestasi, jalur prestasi poltekkes, jalur prestasi poltekkes kemenkes, jalur prestasi poltekkes jakarta iii, jalur prestasi poltekkes jakarta 3, jalur prestasi poltekkes jakarta timur, jalur prestasi poltekkes jaktim, jalur prestasi poltekkes jkt3">
    <meta name="keywords" content="jalur undangan, jalur undangan poltekkes, jalur undangan poltekkes kemenkes, jalur undangan poltekkes jakarta iii, jalur undangan poltekkes jakarta 3, jalur undangan poltekkes jakarta timur, jalur undangan poltekkes jaktim, jalur undangan poltekkes jkt3">
    <meta name="keywords" content="kesehatan nomor satu, kesehatan nomor satu, kesehatan terbaik, kesehatan no 1, kesehatan no satu">
    <meta name="author" content="<?php echo $site_info->namaweb ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">
    <meta http-equiv="Permissions-Policy" content="camera=(), microphone=(), geolocation=()">

    <!-- icon -->
    <link rel="shortcut icon" href="<?php echo $this->website->icon(); ?>">

    <!-- Preload critical logo for faster loading -->
    <link rel="preload" as="image" href="<?php echo $this->website->logo(); ?>" importance="high">

    <!-- Prealoader -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" media="all" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    </noscript>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <!-- DataTables CSS untuk Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Swiper CSS untuk carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <!-- Custom CSS From jsDeliver -->


    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/responsive.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/google-translate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom-translate.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pendidikan-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/staff-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/agenda-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/partners-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/berita-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backtotop-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/popup-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blog-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/open-accessibility.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/faq-enhanced.css">

    <!-- jQuery (WAJIB untuk DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>