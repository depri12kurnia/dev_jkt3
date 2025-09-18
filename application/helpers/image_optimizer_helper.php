<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Image Optimizer Helper
 * Helper untuk optimalisasi gambar dengan WebP conversion dan lazy loading
 */

if (!function_exists('get_optimized_image_url')) {
    /**
     * Generate URL gambar yang dioptimalkan dengan WebP support
     * 
     * @param string $image_path Path gambar relative dari assets/upload/image/
     * @param bool $webp_support Apakah browser support WebP (akan dideteksi via JS)
     * @param array $options Opsi tambahan (width, height, quality)
     * @return string URL gambar yang dioptimalkan
     */
    function get_optimized_image_url($image_path, $webp_support = false, $options = array())
    {
        $CI = &get_instance();

        if (empty($image_path)) {
            return '';
        }

        // Path asli gambar
        $original_path = 'assets/upload/image/' . $image_path;
        $original_full_path = FCPATH . $original_path;

        // Cek apakah file asli ada
        if (!file_exists($original_full_path)) {
            return base_url($original_path); // Return original jika tidak ada
        }

        // Generate nama file WebP
        $path_info = pathinfo($image_path);
        $webp_filename = $path_info['filename'] . '.webp';
        $webp_path = 'assets/upload/image/webp/' . $webp_filename;
        $webp_full_path = FCPATH . $webp_path;

        // Jika browser support WebP dan file WebP sudah ada
        if ($webp_support && file_exists($webp_full_path)) {
            return base_url($webp_path);
        }

        // Jika browser support WebP tapi file WebP belum ada, coba convert
        if ($webp_support && extension_loaded('gd')) {
            if (create_webp_version($original_full_path, $webp_full_path, $options)) {
                return base_url($webp_path);
            }
        }

        // Fallback ke gambar original
        return base_url($original_path);
    }
}

if (!function_exists('create_webp_version')) {
    /**
     * Convert gambar ke format WebP
     * 
     * @param string $source_path Path file sumber
     * @param string $target_path Path file target WebP
     * @param array $options Opsi konversi (quality, width, height)
     * @return bool Success status
     */
    function create_webp_version($source_path, $target_path, $options = array())
    {
        if (!extension_loaded('gd') || !function_exists('imagewebp')) {
            return false;
        }

        // Default options
        $quality = isset($options['quality']) ? $options['quality'] : 80;
        $max_width = isset($options['max_width']) ? $options['max_width'] : 1920;
        $max_height = isset($options['max_height']) ? $options['max_height'] : 1080;

        // Buat direktori WebP jika belum ada
        $webp_dir = dirname($target_path);
        if (!is_dir($webp_dir)) {
            mkdir($webp_dir, 0755, true);
        }

        // Cek apakah file WebP sudah ada dan lebih baru
        if (file_exists($target_path) && filemtime($target_path) >= filemtime($source_path)) {
            return true;
        }

        // Deteksi tipe gambar
        $image_info = getimagesize($source_path);
        if (!$image_info) {
            return false;
        }

        $image_type = $image_info[2];
        $source_image = null;

        // Load gambar berdasarkan tipe
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $source_image = imagecreatefromjpeg($source_path);
                break;
            case IMAGETYPE_PNG:
                $source_image = imagecreatefrompng($source_path);
                break;
            case IMAGETYPE_GIF:
                $source_image = imagecreatefromgif($source_path);
                break;
            case IMAGETYPE_WEBP:
                $source_image = imagecreatefromwebp($source_path);
                break;
            default:
                return false;
        }

        if (!$source_image) {
            return false;
        }

        // Get dimensi asli
        $original_width = imagesx($source_image);
        $original_height = imagesy($source_image);

        // Hitung dimensi baru (resize jika perlu)
        $new_width = $original_width;
        $new_height = $original_height;

        if ($original_width > $max_width || $original_height > $max_height) {
            $ratio = min($max_width / $original_width, $max_height / $original_height);
            $new_width = round($original_width * $ratio);
            $new_height = round($original_height * $ratio);
        }

        // Buat gambar baru dengan dimensi yang sudah disesuaikan
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Preserve transparency untuk PNG
        if ($image_type == IMAGETYPE_PNG) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Resize gambar
        imagecopyresampled(
            $new_image,
            $source_image,
            0,
            0,
            0,
            0,
            $new_width,
            $new_height,
            $original_width,
            $original_height
        );

        // Convert ke WebP
        $success = imagewebp($new_image, $target_path, $quality);

        // Cleanup
        imagedestroy($source_image);
        imagedestroy($new_image);

        return $success;
    }
}

if (!function_exists('get_picture_element')) {
    /**
     * Generate HTML picture element dengan WebP support dan lazy loading
     * 
     * @param string $image_path Path gambar relative
     * @param array $attributes Atribut HTML (alt, class, width, height, dll)
     * @param bool $lazy_load Apakah menggunakan lazy loading
     * @return string HTML picture element
     */
    function get_picture_element($image_path, $attributes = array(), $lazy_load = true)
    {
        if (empty($image_path)) {
            return '';
        }

        // Default attributes
        $default_attrs = array(
            'alt' => '',
            'class' => '',
            'width' => '',
            'height' => '',
            'loading' => $lazy_load ? 'lazy' : 'eager',
            'fetchpriority' => 'auto'
        );

        $attrs = array_merge($default_attrs, $attributes);

        // Generate URLs
        $original_url = base_url('assets/upload/image/' . $image_path);
        $path_info = pathinfo($image_path);
        $webp_filename = $path_info['filename'] . '.webp';
        $webp_url = base_url('assets/upload/image/webp/' . $webp_filename);

        // Build attributes string
        $attr_string = '';
        foreach ($attrs as $key => $value) {
            if (!empty($value)) {
                $attr_string .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }

        // Generate picture element
        $html = '<picture>';

        if ($lazy_load) {
            // Lazy loading version
            $html .= '<source data-srcset="' . $webp_url . '" type="image/webp">';
            $html .= '<source data-srcset="' . $original_url . '" type="image/' . $path_info['extension'] . '">';
            $html .= '<img data-src="' . $original_url . '"' . $attr_string . '>';
        } else {
            // Eager loading version
            $html .= '<source srcset="' . $webp_url . '" type="image/webp">';
            $html .= '<source srcset="' . $original_url . '" type="image/' . $path_info['extension'] . '">';
            $html .= '<img src="' . $original_url . '"' . $attr_string . '>';
        }

        $html .= '</picture>';

        return $html;
    }
}

if (!function_exists('generate_placeholder_svg')) {
    /**
     * Generate SVG placeholder untuk lazy loading
     * 
     * @param int $width Lebar placeholder
     * @param int $height Tinggi placeholder
     * @param string $text Teks placeholder
     * @param string $bg_color Warna background
     * @param string $text_color Warna teks
     * @return string Data URI SVG
     */
    function generate_placeholder_svg($width = 1920, $height = 1080, $text = 'Memuat gambar...', $bg_color = '#f8f9fa', $text_color = '#6c757d')
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '">';
        $svg .= '<rect width="100%" height="100%" fill="' . $bg_color . '"/>';
        $svg .= '<text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="' . $text_color . '" ';
        $svg .= 'font-family="Arial,sans-serif" font-size="24">' . htmlspecialchars($text) . '</text>';
        $svg .= '</svg>';

        return 'data:image/svg+xml,' . rawurlencode($svg);
    }
}

if (!function_exists('cleanup_webp_cache')) {
    /**
     * Bersihkan cache WebP yang sudah tidak terpakai
     * 
     * @param int $max_age Maximum age dalam hari (default 30 hari)
     * @return int Jumlah file yang dihapus
     */
    function cleanup_webp_cache($max_age = 30)
    {
        $webp_dir = FCPATH . 'assets/upload/image/webp/';

        if (!is_dir($webp_dir)) {
            return 0;
        }

        $deleted_count = 0;
        $cutoff_time = time() - ($max_age * 24 * 60 * 60);

        $files = glob($webp_dir . '*.webp');
        foreach ($files as $file) {
            if (filemtime($file) < $cutoff_time) {
                if (unlink($file)) {
                    $deleted_count++;
                }
            }
        }

        return $deleted_count;
    }
}
