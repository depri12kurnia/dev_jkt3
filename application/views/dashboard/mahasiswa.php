<div class="container mt-4">
    <h2>Data Mahasiswa</h2>
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#importModal">
        Import Excel
    </button>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <table id="mahasiswaTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Prodi</th>
                <th>Aktif</th>
                <th>Total</th>
                <th>L</th>
                <th>P</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($mahasiswa) && is_array($mahasiswa)): ?>
                <?php foreach ($mahasiswa as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['periode']) ?></td>
                        <td><?= htmlspecialchars($row['prodi']) ?></td>
                        <td><?= htmlspecialchars($row['aktif']) ?></td>
                        <td><?= htmlspecialchars($row['total']) ?></td>
                        <td><?= htmlspecialchars($row['l']) ?></td>
                        <td><?= htmlspecialchars($row['p']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= site_url('admin/dashboard/import_mahasiswa') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih File Excel (.xlsx)</label>
                        <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables JS (pastikan sudah include di layout utama atau tambahkan di sini) -->
<script>
    $(document).ready(function() {
        $('#mahasiswaTable').DataTable();
    });
</script>