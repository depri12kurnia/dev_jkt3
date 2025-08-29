<script>
  tinymce.init({
    selector: '#isi',
    height: 300,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars code fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table',
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px"
  });

  tinymce.init({
    selector: '#body',
    height: 300,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars code fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table',
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px"
  });

  tinymce.init({
    selector: '.textarea',
    height: 300,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars code fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table',
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px"
  });

  tinymce.init({
    selector: '.textareatengah',
    height: 500,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars code fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table'
  });
</script>

<!-- SWEETALERT2 Flash Messages -->
<?php if ($this->session->flashdata('sukses')) { ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '<?php echo addslashes($this->session->flashdata('sukses')); ?>',
      timer: 3000,
      showConfirmButton: false
    });
  </script>
<?php } ?>

<?php if (isset($error)) { ?>
  <script>
    Swal.fire({
      icon: 'warning',
      title: 'Oops...',
      text: '<?php echo addslashes(strip_tags($error)); ?>',
      timer: 3000,
      showConfirmButton: false
    });
  </script>
<?php } ?>

<?php if ($this->session->flashdata('warning')) { ?>
  <script>
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan',
      text: '<?php echo addslashes($this->session->flashdata('warning')); ?>',
      timer: 3000,
      showConfirmButton: false
    });
  </script>
<?php } ?>

<!-- Date Picker Configuration -->
<?php
$sek = date('Y');
$awal = $sek - 100;
?>
<script>
  $(document).ready(function() {
    // Date pickers with error handling
    try {
      $(".datepicker").datepicker({
        changeYear: true,
        changeMonth: true,
        dateFormat: "yy-mm-dd",
        yearRange: "<?php echo $awal ?>:<?php echo date('Y') ?>"
      });

      $(".tanggal").datepicker({
        changeYear: true,
        changeMonth: true,
        dateFormat: "dd-mm-yy",
        yearRange: "<?php echo $awal ?>:<?php echo date('Y') ?>"
      });
    } catch (e) {
      console.log('Datepicker initialization error:', e);
    }
  });
</script>

<!-- Custom Functions -->
<script>
  // Sweet alert for delete confirmation
  function confirmation(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');

    Swal.fire({
      title: 'Yakin ingin menghapus data ini?',
      text: "Data yang sudah dihapus tidak dapat dikembalikan",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = urlToRedirect;
      }
    });
  }

  // Email sending confirmation
  function kirim(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');

    Swal.fire({
      title: 'Yakin Ingin Mengirim Surat Ini?',
      text: "Pengiriman Surat Sebaiknya Kurang dari 200 Kali/jam agar tidak terkena Blokir Server.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Kirim!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = urlToRedirect;
      }
    });
  }

  // Access confirmation
  function akses(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');

    Swal.fire({
      title: 'Yakin ingin memberi akses?',
      text: "Data yang diberi akses akan bisa login",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Beri Akses!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = urlToRedirect;
      }
    });
  }
</script>

<!-- Select2 and iCheck Initialization -->
<script>
  $(document).ready(function() {
    // Safe Select2 initialization
    try {
      $('.select2').each(function() {
        if (!$(this).hasClass('select2-hidden-accessible')) {
          $(this).select2({
            theme: 'bootstrap',
            width: '100%',
            placeholder: "Pilih...",
            allowClear: true
          });
        }
      });
    } catch (e) {
      console.error('Select2 initialization error:', e);
    }

    // Safe iCheck initialization
    try {
      $('input[type="checkbox"].icheck, input[type="radio"].icheck').each(function() {
        if (!$(this).hasClass('icheckbox_flat-blue') && !$(this).hasClass('iradio_flat-blue')) {
          $(this).iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
          });
        }
      });
    } catch (e) {
      console.error('iCheck initialization error:', e);
    }
  });
</script>

<!-- Global Error Handler -->
<script>
  // Global AJAX error handler
  $(document).ajaxError(function(event, xhr, settings) {
    if (xhr.status === 403) {
      Swal.fire({
        icon: 'error',
        title: 'Akses Ditolak',
        text: 'Anda tidak memiliki akses untuk melakukan operasi ini.'
      });
    } else if (xhr.status === 500) {
      Swal.fire({
        icon: 'error',
        title: 'Server Error',
        text: 'Terjadi kesalahan pada server. Silakan coba lagi.'
      });
    }
  });

  // Window load handler
  $(window).on('load', function() {
    try {
      $('.loading-overlay').fadeOut();
    } catch (e) {
      console.error('Loading overlay error:', e);
    }
  });

  // Form submit handler
  $(document).on('submit', 'form', function() {
    try {
      $('.loading-overlay').show();
    } catch (e) {
      console.error('Form submit handler error:', e);
    }
  });
</script>

</div>
</div>
</div>
</div>
</section>
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.0 Rev
  </div>
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://poltekkesjakarta3.ac.id">Polkes Jakarta 3</a>.</strong> All rights reserved.
</footer>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<script>
  $(function() {
    $('#datatable').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true
    })
  })
</script>

</body>

</html>