
<!-- Start Contact us Section -->
<section class="bg-contact-us">
    <div class="container">
        <div class="row">
            <div class="contact-us">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="contact-title">Pengajuan ISBN</h3>
                        <form action="#" method="POST" class="contact-form">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" value="<?php echo $isbn->judul; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis" value="<?php echo $isbn->penulis; ?>" readonly>
                            </div>
                             <div class="form-group">
                                <label for="status">Status Pengajuan ISBN</label>
                                <input type="text" class="form-control" id="status" name="status" placeholder="status" value="<?php echo $isbn->status; ?>" readonly>
                            </div>
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control text-area" name="deskripsi" placeholder="Deskripsi" readonly><?php echo $isbn->deskripsi; ?></textarea>
                        </form>
                    </div>
                    <!-- .col-md-6 -->
                    <div class="col-md-4">
                        <h3 class="contact-title">Preview</h3>
                        <iframe src="<?php echo base_url('assets/upload/isbn/' . $isbn->attachment) ?>#toolbar=0" width="600" height="550"></iframe>
                    </div>
                    <!-- .col-md-4 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .contact-us -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End Contact us Section -->