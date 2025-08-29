<?php
header('Content-type: application/xml; charset="ISO-8859-1"', true);
$datetime1 = new DateTime(date('Y-m-d H:i:s'));
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url() ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </url>
    <?php foreach ($post as $item) { ?>
        <url>
            <loc><?= base_url('pages/alumni/' . $item['slug_pages']) ?></loc>
            <lastmod><?= date('Y-m-d', strtotime($item['tanggal_publish'])) ?></lastmod>
        </url>
    <?php } ?>
</urlset>