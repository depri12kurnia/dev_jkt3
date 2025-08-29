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
    <style>
       body{
            font-family: 'Open Sans', sans-serif;
        }
        .signUpForm {
            max-width: 100%;
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

        .button-beck{
            background-color: #F7F9F9;
            border: 1px solid #F7F9F9 !important;
            color: #686969;
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

        /* Style for the loading spinner */
        .spinner {
            display: none;
            margin: 0 auto;
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 0, 0, .3);
            border-radius: 50%;
            border-top-color: #000;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Hide the form when loading */
        .loading .form-container {
            display: none;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            }
        .preview-container img {
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
<div class="signUpForm">
    <?php echo form_open_multipart('kontributor/do_upload', array('id' => 'uploadForm', 'class' => 'signUpForm', 'onsubmit' => 'confirmSubmit(event)'));?>
        <?php $this->security->get_csrf_hash(); ?>
        <?php form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>    
        <!-- start step indicators -->
        <div class="form-header d-flex mb-4">
            <span class="stepIndicator">Kontribusi</span>
            <span class="stepIndicator">Upload</span>
        </div>
        <!-- end step indicators -->

        <!-- step two -->
        <div>
            <p class="text-center mb-4">Upload Gambar</p>
            <?php if($this->session->flashdata('message')): ?>
                <p><?php echo $this->session->flashdata('message'); ?></p>
            <?php endif; ?>
            <div class="spinner"></div>
            <div class="mb-3">
                <p>Jenis Gambar : Jpeg, JPG, PNG Maks Ukuran 3Mb</p></br>
                <p>Bisa Pilih Langsung 2 atau lebih gambar (Dengan Cara Tekan dan Tahan Tombol CTRL + Klik Beberapa Gambar Sekaligus)</p>
                <input type="file" name="images[]" multiple="multiple" id="fileInput" value="<?= htmlentities(set_value('images'), ENT_QUOTES) ?>">
                <div class="preview-container" id="previewContainer"></div>
            </div>
        </div>
    
        <!-- start previous / next buttons -->
        <div class="form-footer d-flex">
            <input type="button" class="button-beck" value="Sebelumnya" onclick="history.back()"/> 
            <input type="submit" value="Simpan" class="button"/>
        </div>
        <!-- end previous / next buttons -->
    </form>
</div>
    <script>
        document.getElementById('uploadForm').onsubmit = function() {
            // Show the loading spinner
            document.querySelector('.spinner').style.display = 'block';
            // Add the 'loading' class to the body to hide the form
            document.body.classList.add('loading');
        };

        document.getElementById('fileInput').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = ''; // Clear previous previews

            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '300px'; // Set your custom width here
                    img.style.height = '200px'; 
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        });

        function confirmSubmit(event) {
            // Tampilkan dialog konfirmasi
            var result = confirm("Apakah Anda yakin ingin mengirimkan kontribusi ?");
            
            // Jika pengguna memilih "OK", kirimkan formulir; jika tidak, batalkan pengiriman
            if (!result) {
                event.preventDefault();
            }
        }

    </script>
</body>
</html>
