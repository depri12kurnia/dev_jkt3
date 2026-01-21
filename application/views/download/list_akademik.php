<section class="bg-servicesstyle2-section">
    <div class="container">
        <div class="row">
            <div class="our-services-option">
                <div class="section-header">
                    <h2><?php //echo $title 
                        ?> List Dokumen Akademik</h2>
                    <p>SKL, KRS, Pengajuan Surat Keterangan Pengganti dll </p>
                </div>
                <!-- .section-header -->
                <div class="row">
                    <style type="text/css" media="screen">
                        th,
                        td {
                            text-align: left !important;
                            vertical-align: top !important;
                            padding: 6px 12px !important;
                            color: #000 !important;
                        }
                    </style>

                    <div class="col-md-12">
                        <div class="table-responsive mailbox-messages">
                            <h5 class="contact-title">Layanan Akademik</h5>
                            <!-- Custom Filter -->
                            <!-- End Custom Filter -->
                            <table id="dokumen" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Dokumen</th>
                                        <th>Jenis</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($dokumen as $dokumen) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $dokumen->judul_download ?></td>
                                            <td><?php echo $dokumen->nama_jenis_download ?></td>
                                            <td>
                                                <button class="btn btn-secondary btn-xs" title="Preview" onclick="openPreview('<?php echo base_url('unduhan/unduh/' . $dokumen->id_download) ?>','<?php echo htmlspecialchars($dokumen->judul_download, ENT_QUOTES, 'UTF-8') ?>')" title="Lihat <?php echo htmlspecialchars($dokumen->judul_download, ENT_QUOTES, 'UTF-8') ?>">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $dokumen->id_download) ?>" title="Download" class="btn btn-primary btn-xs" target="_blank" title="Unduh <?php echo htmlspecialchars($dokumen->judul_download, ENT_QUOTES, 'UTF-8') ?>">
                                                    <i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End .row -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Pratinjau Dokumen</h5>
                <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height:80vh; overflow:auto;">
                <div id="pdfViewer" style="width:100%; min-height:100%;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- pdf.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js"></script>
<script>
    if (window['pdfjsLib']) {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    }

    function renderPdf(url) {
        var container = document.getElementById('pdfViewer');
        if (!container || !window['pdfjsLib']) return false;
        container.innerHTML = '';
        var loadingTask = pdfjsLib.getDocument({
            url: url
        });
        loadingTask.promise.then(function(pdf) {
            var scale = 1.2;
            var renderPage = function(pageNum) {
                pdf.getPage(pageNum).then(function(page) {
                    var viewport = page.getViewport({
                        scale: scale
                    });
                    var canvas = document.createElement('canvas');
                    canvas.style.display = 'block';
                    canvas.style.margin = '0 auto 12px auto';
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    container.appendChild(canvas);
                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
            };
            for (var pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                renderPage(pageNum);
            }
        }).catch(function(err) {
            console.error('PDF render error:', err);
            window.open(url, '_blank');
        });
        return true;
    }

    function openPreview(url, title) {
        var titleEl = document.getElementById('previewModalLabel');
        if (titleEl && title) titleEl.textContent = 'Pratinjau: ' + title;
        var handled = renderPdf(url);
        $('#previewModal').modal('show');
        if (!handled) window.open(url, '_blank');
    }

    function hidePreviewModal() {
        var modalEl = document.getElementById('previewModal');
        try {
            if (window.bootstrap && window.bootstrap.Modal) {
                var instance = window.bootstrap.Modal.getInstance(modalEl) || new window.bootstrap.Modal(modalEl);
                instance.hide();
            } else if (window.jQuery) {
                window.jQuery('#previewModal').modal('hide');
            } else {
                modalEl.classList.remove('show');
                modalEl.style.display = 'none';
                document.body.classList.remove('modal-open');
                var backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) backdrop.remove();
            }
        } catch (e) {
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
            document.body.classList.remove('modal-open');
            var backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) backdrop.remove();
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        var dismissBtns = document.querySelectorAll('#previewModal [data-dismiss="modal"], #previewModal [data-bs-dismiss="modal"]');
        dismissBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                hidePreviewModal();
            });
        });
        var modalEl = document.getElementById('previewModal');
        if (modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function() {
                var container = document.getElementById('pdfViewer');
                if (container) container.innerHTML = '';
            });
        }
    });
</script>