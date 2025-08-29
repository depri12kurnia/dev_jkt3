<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kontribusi Berita | Poltekkes Jakarta III</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- Recaptcha Google -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body{
            font-family: 'Open Sans', sans-serif;
        }
        .signUpForm {
            max-width: 90%;
            background-color: #ffffff;
            margin: auto;
            padding: 40px;
            box-shadow: 0px 6px 18px rgb(0 0 0 / 9%);
            border-radius: 12px;
        }
        .signUpForm .form-header {
            gap: 5px;
            text-align: center;
            font-size: .9em;
        }
        .signUpForm .form-header .stepIndicator {
            position: relative;
            flex: 1;
            padding-bottom: 30px;
        }
        .signUpForm .form-header .stepIndicator.active {
            font-weight: 600;
        }
        .signUpForm .form-header .stepIndicator.finish {
            font-weight: 600;
            color: #009688;
        }
        .signUpForm .form-header .stepIndicator::before {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            z-index: 9;
            width: 20px;
            height: 20px;
            background-color: #d5efed;
            border-radius: 50%;
            border: 3px solid #ecf5f4;
        }
        .signUpForm .form-header .stepIndicator.active::before {
            background-color: #a7ede8;
            border: 3px solid #d5f9f6;
        }
        .signUpForm .form-header .stepIndicator.finish::before {
            background-color: #009688;
            border: 3px solid #b7e1dd;
        }
        .signUpForm .form-header .stepIndicator::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 8px;
            width: 100%;
            height: 3px;
            background-color: #f3f3f3;
        }
        .signUpForm .form-header .stepIndicator.active::after {
            background-color: #a7ede8;
        }
        .signUpForm .form-header .stepIndicator.finish::after {
            background-color: #009688;
        }
        .signUpForm .form-header .stepIndicator:last-child:after {
            display: none;
        }
        .signUpForm input {
            padding: 15px 20px;
            width: 100%;
            font-size: 1em;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
        }

        .signUpForm select {
            padding: 15px 20px;
            width: 100%;
            font-size: 1em;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
        }

        .signUpForm textarea {
            padding: 15px 20px;
            height: 200px;
            width: 100%;
            font-size: 1em;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
        }

        .signUpForm input:focus {
            border: 1px solid #009688;
            outline: 0;
        }
        .signUpForm input.invalid {
            border: 1px solid #ffaba5;
        }
        .signUpForm .step {
          display: none;
        }
        .signUpForm .form-footer{
            overflow:auto;
            gap: 20px;
        }

        .button{
            background-color: #00B9AD;
            border: 1px solid #00B9AD !important;
            color: #ffffff;
            border: none;
            padding: 13px 30px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            flex: 1;
            margin-top: 5px;
        }
        
        .signUpForm .form-footer button{
            background-color: #00B9AD;
            border: 1px solid #00B9AD !important;
            color: #ffffff;
            border: none;
            padding: 13px 30px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            flex: 1;
            margin-top: 5px;
        }
        .signUpForm .form-footer button:hover {
          opacity: 0.8;
        }
        
        .signUpForm .form-footer #prevBtn {
            background-color: #fff;
            color: #009688;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            }

        .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 15px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default radio button */
        .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        }

        /* Create a custom radio button */
        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
        background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .container input:checked ~ .checkmark {
        background-color: #2196F3;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .container input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the indicator (dot/circle) */
        .container .checkmark:after {
            top: 9px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }

         /* Modal Styles */
         .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }
        
    </style>
    <!--Klik kanan-->
    <script type="text/javascript">
        
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        }, false);

        // Menonaktifkan pintasan keyboard tertentu
        document.addEventListener('keydown', function(e) {
            // Disable F12 key
            if (e.key === 'F12') {
                e.preventDefault();
            }

            // Disable Ctrl+Shift+I (DevTools), Ctrl+U (View Source), Ctrl+Shift+J (Console)
            if (e.ctrlKey && (e.shiftKey && (e.key === 'I' || e.key === 'J')) || e.key === 'U') {
                e.preventDefault();
            }
        }, false);
    </script>
</head>
<body>
</br>
</br>
<img src="<?php echo htmlentities(base_url('assets/logo-baru.png')) ?>" class="center" style="width: auto; height: 100px;">
        </br>
<h1 class="text-center fs-4">Form Kontribusi Pelaporan Berita</h1>
    <!-- <div class="signUpForm"> -->
    <?php echo form_open_multipart('kontributor/form2', array('class' => 'signUpForm'));?>    
        <?php $this->security->get_csrf_hash(); ?>
        <?php form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
        <!-- start step indicators -->
        <div class="form-header d-flex mb-4">
            <span class="stepIndicator">Kontribusi</span>
            <span class="stepIndicator">Upload</span>
        </div>
        <!-- end step indicators -->
    
        <!-- step one -->
        <div>
            <p class="text-center mb-4">Buat Kontribusi Berita</p>
            <div class="mb-3">
                <select class="form-select" name="lp_options">
                    <option selected>-- Pilih Status --</option>
                    <option value="Pegawai">Pegawai</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                </select>
                <div style="color: tomato;"><?= form_error('lp_options') ?></div>
            </div>
            <div class="mb-3">
                <input type="text" placeholder="NIP / NIM *" onpaste="return false;" id="lp_id" name="lp_id" value="<?= htmlentities(set_value('lp_id'), ENT_QUOTES) ?>">
                <div style="color: tomato;"><?= form_error('lp_id') ?></div>
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Nama Kontributor *" onpaste="return false;" id="lp_kontributor" name="lp_kontributor" value="<?= htmlentities(set_value('lp_kontributor'), ENT_QUOTES) ?>">
                <div style="color: tomato;"><?= form_error('lp_kontributor') ?></div>
            </div>
            <div class="mb-3">
                <select class="form-select" name="lp_unit">
                    <option selected>-- Pilih Unit Kerja --</option>
                    <option value="Direktorat">Direktorat</option>
                    <option value="Keperawatan">Keperawatan</option>
                    <option value="Kebidanan">Kebidanan</option>
                    <option value="Fisioterapi">Fisioterapi</option>
                    <option value="TLM">TLM</option>
                    <!-- <option value=<?= htmlentities(set_value('Keperawatan'), ENT_QUOTES) ?>>Keperawatan</option>
                    <option value=<?= htmlentities(set_value('Kebidanan'), ENT_QUOTES) ?>>Kebidanan</option>
                    <option value=<?= htmlentities(set_value('Fisioterapi'), ENT_QUOTES) ?>>Fisioterapi</option>
                    <option value=<?= htmlentities(set_value('TLM'), ENT_QUOTES) ?>>TLM</option> -->
                </select>
                <div style="color: tomato;"><?= form_error('lp_unit') ?></div>
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Judul dan Tema Kegiatan *" onpaste="return false;" name="lp_what" <?= htmlentities(set_value('lp_what'), ENT_QUOTES) ?>>
                <div style="color: tomato;"><?= form_error('lp_what') ?></div>
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Lokasi / Tempat Kegiatan *" onpaste="return false;" name="lp_where" <?= htmlentities(set_value('lp_where'), ENT_QUOTES) ?>>
                <div style="color: tomato;"><?= form_error('lp_where') ?></div>
            </div>
            <div class="mb-3">
                <label class="mb-3">Pilih Waktu Kegitatan :</label>
                <input type="date" placeholder="Pilih Waktu, Hari dan Tanggal Kegiatan *" onpaste="return false;" name="lp_when" <?= htmlentities(set_value('lp_when'), ENT_QUOTES) ?>>
                <div style="color: tomato;"><?= form_error('lp_when') ?></div>
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Narasumber, Kriteria Peserta, Jumlah Peserta, Peserta (DL/LN) *" onpaste="return false;" name="lp_who" <?= htmlentities(set_value('lp_who'), ENT_QUOTES) ?>>
                <div style="color: tomato;"><?= form_error('lp_who') ?></div>
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Maksud dan Tujuan Kegiatan *" onpaste="return false;" name="lp_why" <?= htmlentities(set_value('lp_why'), ENT_QUOTES) ?>>
                <div style="color: tomato;"><?= form_error('lp_why') ?></div>
            </div>
            <div class="mb-3">
                <!-- <input type="text" placeholder="Proses Pelaksanaan Kegiatan(Susunan Acara) *" name="lp_how"> -->
                <textarea placeholder="Proses Pelaksanaan Kegiatan(Susunan Acara) *" onpaste="return false;" name="lp_how" <?= htmlentities(set_value('lp_how'), ENT_QUOTES) ?>></textarea>
                <div style="color: tomato;"><?= form_error('lp_how') ?></div>
            </div>
            
        </div>
    
        <!-- start previous / next buttons -->
        <div class="form-footer d-flex">
            <input type="submit" value="Selanjutnya" class="button"/>
        </div>
        <!-- end previous / next buttons -->
    </form>
    <!-- </div> -->

     <!-- Modal -->

    <!--<div id="modalRecaptcha" class="modal">-->
    <!--    <div class="modal-content">-->
    <!--        <p>Please Complete Captcha</p>-->
    <!--        <div class="g-recaptcha" data-sitekey="6Lfh7xcqAAAAAMLHi3Dk-JzZqkDuYzSWc3Eoj3b2" data-callback="recaptchaCallback"></div>-->
    <!--    </div>-->
    <!--</div>-->
    <!--End Modal-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script>
  // get the input element
    
    var validasi1 = document.getElementById('lp_id');
    
    // var inputs = document.querySelectorAll("input");
    validasi1.onkeypress = function(e) {   
        // invalid character list
    var prohibited = "!@#$%^&*()+=;:`~\|'?><,\"";
    // get the actual character string value
        var key = String.fromCharCode(e.which);
    // check if the key pressed is prohibited    
    if(prohibited.indexOf(key) >= 0){
            console.log('invalid key pressed');    
        return false;
    }
    return true;    
    };

    var validasi2 = document.getElementById('lp_kontributor');

    validasi2.onkeypress = function(e) {   
        // invalid character list
    var prohibited = "!@#$%^&*()+=;:`~\|'?><,\"";
    // get the actual character string value
        var key = String.fromCharCode(e.which);
    // check if the key pressed is prohibited    
    if(prohibited.indexOf(key) >= 0){
            console.log('invalid key pressed');    
        return false;
    }
    return true;    
    };



    // Not Allowed Paste
    (function () {
    var onload = window.onload;

    window.onload = function () {
        if (typeof onload == "function") {
            onload.apply(this, arguments);
        }

        var fields = [];
        var inputs = document.getElementsByTagName("input");
        var textareas = document.getElementsByTagName("textarea");

        for (var i = 0; i < inputs.length; i++) {
            fields.push(inputs[i]);
        }

        for (var i = 0; i < textareas.length; i++) {
            fields.push(textareas[i]);
        }

        for (var i = 0; i < fields.length; i++) {
            var field = fields[i];

            if (typeof field.onpaste != "function" && !!field.getAttribute("onpaste")) {
                field.onpaste = eval("(function () { " + field.getAttribute("onpaste") + " })");
            }

            if (typeof field.onpaste == "function") {
                var oninput = field.oninput;

                field.oninput = function () {
                    if (typeof oninput == "function") {
                        oninput.apply(this, arguments);
                    }

                    if (typeof this.previousValue == "undefined") {
                        this.previousValue = this.value;
                    }

                    var pasted = (Math.abs(this.previousValue.length - this.value.length) > 1 && this.value != "");

                    if (pasted && !this.onpaste.apply(this, arguments)) {
                        this.value = this.previousValue;
                    }

                    this.previousValue = this.value;
                };

                if (field.addEventListener) {
                    field.addEventListener("input", field.oninput, false);
                } else if (field.attachEvent) {
                    field.attachEvent("oninput", field.oninput);
                }
            }
        }
    }
})();
</script>
<!--<script>-->
    
<!--    $('#modalRecaptcha').fadeIn();-->

<!--    function recaptchaCallback() {-->
<!--        var response = grecaptcha.getResponse();-->
<!--        if (response.length === 0) {-->
<!--            console.log('reCAPTCHA not completed');-->
<!--        } else {-->
<!--            console.log('reCAPTCHA completed, response:', response);-->

<!--            $.post('<?php echo base_url("verify/verify_recaptcha"); ?>', { recaptchaResponse: response }, function(data) {-->
<!--            console.log('Server response:', data);-->
<!--            });-->

            
<!--            $('#modalRecaptcha').modal('hide');-->
<!--        }-->
<!--    }-->

<!--</script>-->

</body>
</html>
