<h4>Isi Folder: <?= $path ?></h4>

<?php if (!empty($files) && is_array($files)): ?>
    <ul>
        <?php foreach ($files as $file): ?>
            <?php $encoded_path = urlencode($file['path']); ?>
            <li>
                <?php if ($file['type'] === 'dir'): ?>
                    📁 <a href="<?= site_url('admin/dokumen/detail/' . $repo_id . '/' . $encoded_path) ?>">
                        <?= $file['name'] ?>
                    </a>
                <?php else: ?>
                    📄 <?= $file['name'] ?> -
                    <a target="_blank" href="<?= site_url('admin/dokumen/preview_file/' . $repo_id) . '?file_path=' . urlencode($file['path']) ?>">Preview</a>
                    <a target="_blank" href="<?= site_url('admin/dokumen/download_file/' . $repo_id . '/' . $encoded_path) ?>">Download</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>

    </ul>
<?php else: ?>
    <p>Tidak ada file atau folder.</p>
<?php endif; ?>