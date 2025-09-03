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
    <meta name="author" content="<?php echo $site_info->namaweb ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Security Headers -->
    <!-- <meta http-equiv="Content-Security-Policy" content="
    default-src 'self';
    script-src 'self' 'unsafe-inline' 'unsafe-eval' 
               https://code.jquery.com 
               https://cdn.jsdelivr.net 
               https://cdn.datatables.net 
               https://fonts.googleapis.com;
    style-src 'self' 'unsafe-inline' 
              https://fonts.googleapis.com 
              https://cdn.jsdelivr.net 
              https://cdn.datatables.net;
    font-src 'none' 
             https://fonts.gstatic.com 
             https://cdn.jsdelivr.net;
    img-src 'self' data: blob: https:;
    connect-src 'self' https:;
    frame-src 'none';
    object-src 'none';
    base-uri 'self';
    form-action 'self';
"> -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <!-- <meta http-equiv="X-Frame-Options" content="SAMEORIGIN"> -->
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">
    <meta http-equiv="Permissions-Policy" content="camera=(), microphone=(), geolocation=()">

    <!-- icon -->
    <link rel="shortcut icon" href="<?php echo $this->website->icon(); ?>">
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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/responsive.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/google-translate.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom-translate.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slider-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pendidikan-enhanced.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/staff-enhanced.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/agenda-enhanced.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/partners-enhanced.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/video-enhanced.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/berita-enhanced.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/backtotop-enhanced.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/popup-enhanced.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/blog-enhanced.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/open-accessibility.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/faq-enhanced.css') ?>">

    <!-- jQuery (WAJIB untuk DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>