<?php
/**
 * تطبيق إعدادات الأداء والتحسين
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * تطبيق إعدادات ضغط CSS
 */
function professional_theme_apply_css_minification() {
    if (!get_theme_mod('enable_css_minification', true)) {
        return;
    }
    
    // إضافة فلتر لضغط CSS
    add_filter('style_loader_tag', 'professional_theme_minify_css', 10, 4);
}
add_action('wp_enqueue_scripts', 'professional_theme_apply_css_minification', 999);

/**
 * دالة ضغط CSS
 */
function professional_theme_minify_css($html, $handle, $href, $media) {
    if (is_admin() || strpos($href, '.min.css') !== false) {
        return $html;
    }
    
    // إضافة علامة لتحديد الملفات المضغوطة
    $html = str_replace("rel='stylesheet'", "rel='stylesheet' data-minified='true'", $html);
    
    return $html;
}

/**
 * تطبيق إعدادات ضغط JavaScript
 */
function professional_theme_apply_js_minification() {
    if (!get_theme_mod('enable_js_minification', true)) {
        return;
    }
    
    // إضافة فلتر لضغط JavaScript
    add_filter('script_loader_tag', 'professional_theme_minify_js', 10, 3);
}
add_action('wp_enqueue_scripts', 'professional_theme_apply_js_minification', 999);

/**
 * دالة ضغط JavaScript
 */
function professional_theme_minify_js($tag, $handle, $src) {
    if (is_admin() || strpos($src, '.min.js') !== false) {
        return $tag;
    }
    
    // إضافة علامة لتحديد الملفات المضغوطة
    $tag = str_replace('></script>', ' data-minified="true"></script>', $tag);
    
    return $tag;
}

/**
 * تطبيق إعدادات تأجيل تحميل JavaScript
 */
function professional_theme_apply_js_defer() {
    if (!get_theme_mod('enable_js_defer', true)) {
        return;
    }
    
    // إضافة فلتر لتأجيل تحميل JavaScript
    add_filter('script_loader_tag', 'professional_theme_defer_js', 10, 3);
}
add_action('wp_enqueue_scripts', 'professional_theme_apply_js_defer', 999);

/**
 * دالة تأجيل تحميل JavaScript
 */
function professional_theme_defer_js($tag, $handle, $src) {
    if (is_admin() || strpos($tag, 'defer') !== false) {
        return $tag;
    }
    
    // استثناء بعض السكربتات من التأجيل
    $exclude_handles = array('jquery', 'jquery-core', 'jquery-migrate');
    if (in_array($handle, $exclude_handles)) {
        return $tag;
    }
    
    // إضافة خاصية defer
    $tag = str_replace(' src', ' defer src', $tag);
    
    return $tag;
}

/**
 * تطبيق إعدادات التحميل الكسول للصور
 */
function professional_theme_apply_lazy_loading() {
    if (!get_theme_mod('enable_lazy_loading', true)) {
        return;
    }
    
    // إضافة فلتر للتحميل الكسول للصور
    add_filter('the_content', 'professional_theme_lazy_loading_images');
    add_filter('post_thumbnail_html', 'professional_theme_lazy_loading_images');
    add_filter('woocommerce_product_get_image', 'professional_theme_lazy_loading_images');
}
add_action('wp', 'professional_theme_apply_lazy_loading');


/**
 * تطبيق إعدادات الصور المتجاوبة
 */
function professional_theme_apply_responsive_images() {
    if (!get_theme_mod('enable_responsive_images', true)) {
        return;
    }
    
    // إضافة دعم الصور المتجاوبة
    add_theme_support('responsive-embeds');
    add_filter('wp_calculate_image_srcset_meta', '__return_null');
}
add_action('after_setup_theme', 'professional_theme_apply_responsive_images');

/**
 * تطبيق إعدادات التخزين المؤقت للصفحات
 */
function professional_theme_apply_page_caching($headers) {
    if (!get_theme_mod('enable_page_caching', true) || is_user_logged_in()) {
        return $headers;
    }
    
    $cache_expiration = get_theme_mod('cache_expiration', 24) * 3600; // تحويل الساعات إلى ثواني
    
    $headers['Cache-Control'] = 'public, max-age=' . $cache_expiration;
    $headers['Expires'] = gmdate('D, d M Y H:i:s', time() + $cache_expiration) . ' GMT';
    
    return $headers;
}
add_filter('wp_headers', 'professional_theme_apply_page_caching');

/**
 * إضافة CSS لتحسين الأداء
 */
function professional_theme_performance_css() {
    ?>
    <style>
    /* تحسين CLS (Cumulative Layout Shift) */
    img, video, iframe {
        max-width: 100%;
        height: auto;
        aspect-ratio: attr(width) / attr(height);
    }
    
    /* تحسين LCP (Largest Contentful Paint) */
    .entry-content img.aligncenter,
    .entry-content img.alignleft,
    .entry-content img.alignright,
    .entry-content img.alignnone,
    .wp-block-image img,
    .wp-post-image {
        content-visibility: auto;
    }
    </style>
    <?php
}
add_action('wp_head', 'professional_theme_performance_css');
