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
    <meta name="keywords" content="poltekkes">
    <meta name="keywords" content="poltekkes jakarta 3">
    <meta name="keywords" content="poltekkes jakarta">
    <meta name="keywords" content="jakarta 3">
    <meta name="keywords" content="poltekkes 3">
    <meta name="keywords" content="poltekkes jati">
    <!-- icon -->
    <link rel="shortcut icon" href="<?php echo $this->website->icon(); ?>">
    <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Plugin css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/css/animate.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/css/flexslider.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/css/jquery.nstSlider.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/css/lightcase.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/fonts/flaticon.css" />


    <!-- own style css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css" media="all" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/css/rtl.css" media="all" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@a5c74d838ccf791130711a740caa93001d3d2ec6/tema/assets/css/responsive.css" media="all" />
    <!-- end own style css -->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/tema/assets/css/swiper.min.css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/admin/plugins/datatables/dataTables.bootstrap4.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/admin/plugins/select2/select2.min.css">
    <!-- dflip StyleSheet -->
    <link href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/dflip/css/dflip.min.css" rel="stylesheet">
    <!-- dflip Icons Stylesheet -->
    <link href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@0481945ae21d8030627feda12eb97759bdad489f/dflip/css/themify-icons.min.css" rel="stylesheet">
    <!-- Floating Images -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/Assets-Jakarta-3@d0f9fd5c35674c1e9047ccad2c74518e6ad7c2ac/floating/floating.css" />

    <!-- Recaptcha Google -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <style type="text/css" media="screen">
        p {
            margin-bottom: 15px;
        }
    </style>
    <!-- Running Text On Modals Popup -->
</head>
<!-- google analytic -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-77QD9RNNKJ"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-77QD9RNNKJ', {
        'debug_mode': true
    });
</script>
<!-- end google analytic -->


<body>
    <!-- <div id="google_translate_element"></div>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
            }, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->

    <!--Klik kanan-->
    <!-- <script type="text/javascript">
        
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        }, false);

        
        document.addEventListener('keydown', function(e) {
           
            if (e.key === 'F12') {
                e.preventDefault();
            }

            
            if (e.ctrlKey && (e.shiftKey && (e.key === 'I' || e.key === 'J')) || e.key === 'U') {
                e.preventDefault();
            }
        }, false);
    </script> -->