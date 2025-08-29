<?php if (is_array($repos)): ?>
    <ul>
        <?php foreach ($repos as $repo): ?>
            <?php if (is_array($repo) && isset($repo['id'], $repo['name'])): ?>
                <li>
                    <a href="<?= site_url('admin/dokumen/detail/' . $repo['id']) ?>">
                        <?= $repo['name'] ?>
                    </a>
                </li>
            <?php else: ?>
                <li>Format repos salah / tidak lengkap</li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Data repos tidak valid atau gagal ambil dari API.</p>
<?php endif; ?>