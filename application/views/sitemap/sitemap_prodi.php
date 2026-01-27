<?php
header('Content-Type: application/xml; charset=UTF-8', true);
$datetime1 = new DateTime(date('Y-m-d H:i:s'));
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url() ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </url>
    <?php foreach ($post as $item) { ?>
        <url>
            <loc><?= base_url('jurusan/' . $item['slug']) ?></loc>
            <lastmod><?= date('Y-m-d', strtotime($item['created_at'])) ?></lastmod>
        </url>
    <?php } ?>
</urlset>