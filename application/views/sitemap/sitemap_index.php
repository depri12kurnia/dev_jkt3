<?php
header('Content-Type: application/xml; charset=UTF-8', true);
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc><?= base_url('sitemap/alumni.xml') ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </sitemap>
    <sitemap>
        <loc><?= base_url('sitemap/berita.xml') ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </sitemap>
    <sitemap>
        <loc><?= base_url('sitemap/pendidikan.xml') ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </sitemap>
    <sitemap>
        <loc><?= base_url('sitemap/prodi.xml') ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </sitemap>
    <sitemap>
        <loc><?= base_url('sitemap/tentang.xml') ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </sitemap>
    <sitemap>
        <loc><?= base_url('sitemap/custom.xml') ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </sitemap>
</sitemapindex>