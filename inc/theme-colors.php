<?php
/**
 * تطبيق الألوان المخصصة على القالب
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * دالة لتطبيق الألوان والخطوط المخصصة
 */
function professional_theme_custom_css() {
    $output_css = "<style type='text/css'>\n";

    // ===== الألوان الأساسية =====
    $primary_color = get_theme_mod('primary_color', '#0f766e');
    $secondary_color = get_theme_mod('secondary_color', '#2563eb');
    $accent_color = get_theme_mod('accent_color', '#f97316');
    $text_color = get_theme_mod('text_color', '#333333');
    $background_color = get_theme_mod('background_color', '#ffffff');

    // تطبيق الألوان الأساسية
    $output_css .= "body { color: {$text_color}; background-color: {$background_color}; }\n";
    $output_css .= "a { color: {$primary_color}; }\n";
    $output_css .= "a:hover, a:focus { color: " . professional_theme_darken_color($primary_color, 20) . "; }\n";
    $output_css .= ".btn-primary, input[type='submit'], button[type='submit'], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { background-color: {$primary_color}; border-color: {$primary_color}; }\n";
    $output_css .= ".btn-primary:hover, input[type='submit']:hover, button[type='submit']:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover { background-color: " . professional_theme_darken_color($primary_color, 20) . "; border-color: " . professional_theme_darken_color($primary_color, 20) . "; }\n";
    $output_css .= ".btn-secondary { background-color: {$secondary_color}; border-color: {$secondary_color}; }\n";
    $output_css .= ".btn-secondary:hover { background-color: " . professional_theme_darken_color($secondary_color, 20) . "; border-color: " . professional_theme_darken_color($secondary_color, 20) . "; }\n";
    $output_css .= ".accent-color, .accent-text { color: {$accent_color}; }\n";
    $output_css .= ".accent-bg { background-color: {$accent_color}; }\n";
    $output_css .= ".accent-border { border-color: {$accent_color}; }\n";
    $output_css .= ".main-navigation ul li a:hover, .main-navigation ul li.current-menu-item a { color: {$primary_color}; }\n";
    $output_css .= ".entry-title a:hover, .widget a:hover { color: {$primary_color}; }\n";
    $output_css .= ".site-title a, .site-description { color: {$text_color}; }\n";
    $output_css .= ".pagination .page-numbers.current { background-color: {$primary_color}; color: white; }\n";
    $output_css .= ".widget-title { border-bottom: 2px solid {$primary_color}; }\n";

    // ===== ألوان الأزرار =====
    $button_primary_color = get_theme_mod('button_primary_color', '#0f766e');
    $button_primary_text_color = get_theme_mod('button_primary_text_color', '#ffffff');
    $button_secondary_color = get_theme_mod('button_secondary_color', '#6c757d');
    $button_secondary_text_color = get_theme_mod('button_secondary_text_color', '#ffffff');

    // تطبيق ألوان الأزرار
    $output_css .= ".btn-primary, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { background-color: {$button_primary_color}; border-color: {$button_primary_color}; color: {$button_primary_text_color}; }\n";
    $output_css .= ".btn-primary:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover { background-color: " . professional_theme_darken_color($button_primary_color, 20) . "; border-color: " . professional_theme_darken_color($button_primary_color, 20) . "; color: {$button_primary_text_color}; }\n";
    $output_css .= ".btn-secondary { background-color: {$button_secondary_color}; border-color: {$button_secondary_color}; color: {$button_secondary_text_color}; }\n";
    $output_css .= ".btn-secondary:hover { background-color: " . professional_theme_darken_color($button_secondary_color, 20) . "; border-color: " . professional_theme_darken_color($button_secondary_color, 20) . "; color: {$button_secondary_text_color}; }\n";
    $output_css .= "button, input[type='button'], input[type='reset'], input[type='submit'] { background-color: {$button_primary_color}; color: {$button_primary_text_color}; }\n";
    $output_css .= "button:hover, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover { background-color: " . professional_theme_darken_color($button_primary_color, 20) . "; }\n";

    // ===== ألوان الهيدر =====
    $header_topbar_bg_color = get_theme_mod('header_topbar_bg_color', '#f8f9fa');
    $header_topbar_text_color = get_theme_mod('header_topbar_text_color', '#333333');
    $header_social_bar_bg_color = get_theme_mod('header_social_bar_bg_color', '#eeeeee');
    $header_social_bar_icon_color = get_theme_mod('header_social_bar_icon_color', '#555555');
    $main_header_bg_color = get_theme_mod('main_header_bg_color', '#ffffff');
    $main_header_text_color = get_theme_mod('main_header_text_color', '#000000');

    // تطبيق ألوان الهيدر
    $output_css .= ".topbar { background-color: {$header_topbar_bg_color}; color: {$header_topbar_text_color}; }\n";
    $output_css .= ".topbar a { color: {$header_topbar_text_color}; }\n";
    $output_css .= ".topbar a:hover { color: " . professional_theme_darken_color($header_topbar_text_color, 20) . "; }\n";
    $output_css .= ".social-bar { background-color: {$header_social_bar_bg_color}; }\n";
    $output_css .= ".social-bar .social-icons a { color: {$header_social_bar_icon_color}; }\n";
    $output_css .= ".social-bar .social-icons a:hover { color: " . professional_theme_darken_color($header_social_bar_icon_color, 20) . "; }\n";
    $output_css .= ".site-header { background-color: {$main_header_bg_color}; }\n";
    $output_css .= ".site-header, .site-header p, .site-header .site-description { color: {$main_header_text_color}; }\n";
    $output_css .= ".site-header a, .site-header .main-navigation a { color: {$main_header_text_color}; }\n";
    $output_css .= ".site-header a:hover, .site-header .main-navigation a:hover { color: {$primary_color}; }\n";
    $output_css .= ".main-navigation ul ul { background-color: {$main_header_bg_color}; border-top: 3px solid {$primary_color}; }\n";
    $output_css .= ".main-navigation ul ul a { color: {$main_header_text_color}; }\n";
    $output_css .= ".main-navigation ul ul a:hover { background-color: {$primary_color}; color: white; }\n";

    // ===== ألوان الفوتر =====
    $footer_bg_color = get_theme_mod('footer_bg_color', '#1f2937');
    $footer_text_color = get_theme_mod('footer_text_color', '#ffffff');
    $footer_link_color = get_theme_mod('footer_link_color', '#9ca3af');
    $footer_link_hover_color = get_theme_mod('footer_link_hover_color', '#ffffff');

    // تطبيق ألوان الفوتر
    $output_css .= ".site-footer { background-color: {$footer_bg_color}; color: {$footer_text_color}; }\n";
    $output_css .= ".site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 { color: {$footer_text_color}; }\n";
    $output_css .= ".site-footer a { color: {$footer_link_color}; }\n";
    $output_css .= ".site-footer a:hover { color: {$footer_link_hover_color}; }\n";
    $output_css .= ".footer-widget-title { color: {$footer_text_color}; }\n";
    $output_css .= ".footer-bottom { background-color: " . professional_theme_darken_color($footer_bg_color, 20) . "; color: {$footer_text_color}; }\n";
    $output_css .= "#toTop { background-color: {$primary_color}; color: white; }\n";
    $output_css .= "#toTop:hover { background-color: " . professional_theme_darken_color($primary_color, 20) . "; }\n";
    
    // تطبيق تخطيط الفوتر
    $footer_layout = get_theme_mod('footer_layout', 'columns-4');
    switch ($footer_layout) {
        case 'columns-1':
            $output_css .= ".footer-widgets { display: flex; flex-wrap: wrap; }\n";
            $output_css .= ".footer-widget-area { flex: 0 0 100%; max-width: 100%; padding: 0 15px; }\n";
            break;
        case 'columns-2':
            $output_css .= ".footer-widgets { display: flex; flex-wrap: wrap; margin: 0 -15px; }\n";
            $output_css .= ".footer-widget-area { flex: 0 0 50%; max-width: 50%; padding: 0 15px; }\n";
            $output_css .= "@media (max-width: 768px) { .footer-widget-area { flex: 0 0 100%; max-width: 100%; } }\n";
            break;
        case 'columns-3':
            $output_css .= ".footer-widgets { display: flex; flex-wrap: wrap; margin: 0 -15px; }\n";
            $output_css .= ".footer-widget-area { flex: 0 0 33.333%; max-width: 33.333%; padding: 0 15px; }\n";
            $output_css .= "@media (max-width: 992px) { .footer-widget-area { flex: 0 0 50%; max-width: 50%; } }\n";
            $output_css .= "@media (max-width: 768px) { .footer-widget-area { flex: 0 0 100%; max-width: 100%; } }\n";
            break;
        case 'columns-4':
        default:
            $output_css .= ".footer-widgets { display: flex; flex-wrap: wrap; margin: 0 -15px; }\n";
            $output_css .= ".footer-widget-area { flex: 0 0 25%; max-width: 25%; padding: 0 15px; }\n";
            $output_css .= "@media (max-width: 1200px) { .footer-widget-area { flex: 0 0 33.333%; max-width: 33.333%; } }\n";
            $output_css .= "@media (max-width: 992px) { .footer-widget-area { flex: 0 0 50%; max-width: 50%; } }\n";
            $output_css .= "@media (max-width: 768px) { .footer-widget-area { flex: 0 0 100%; max-width: 100%; } }\n";
            break;
    }
    
    // إظهار/إخفاء زر العودة للأعلى
    if (!get_theme_mod('footer_show_back_to_top', true)) {
        $output_css .= "#toTop { display: none !important; }\n";
    }

    // ===== ألوان المتجر =====
    if (class_exists('WooCommerce')) {
        $shop_button_color = get_theme_mod('shop_button_color', '#0f766e');
        $shop_button_text_color = get_theme_mod('shop_button_text_color', '#ffffff');
        $product_price_color = get_theme_mod('product_price_color', '#0f766e');
        $product_sale_price_color = get_theme_mod('product_sale_price_color', '#ef4444');
        $product_sale_badge_color = get_theme_mod('product_sale_badge_color', '#ef4444');

        // تطبيق ألوان المتجر
        $output_css .= ".woocommerce ul.products li.product .button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { background-color: {$shop_button_color}; color: {$shop_button_text_color}; }\n";
        $output_css .= ".woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover { background-color: " . professional_theme_darken_color($shop_button_color, 20) . "; color: {$shop_button_text_color}; }\n";
        $output_css .= ".woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price { color: {$product_price_color}; }\n";
        $output_css .= ".woocommerce ul.products li.product .price ins, .woocommerce div.product p.price ins, .woocommerce div.product span.price ins { color: {$product_sale_price_color}; }\n";
        $output_css .= ".woocommerce span.onsale { background-color: {$product_sale_badge_color}; color: #ffffff; }\n";
        
        // تخطيط صفحة المتجر
        $shop_layout = get_theme_mod('shop_page_layout', 'sidebar-right');
        if ($shop_layout == 'sidebar-right') {
            $output_css .= ".woocommerce .content-area { float: left; width: 75%; }\n";
            $output_css .= ".woocommerce .widget-area { float: right; width: 25%; padding-left: 30px; }\n";
            $output_css .= "@media (max-width: 992px) { .woocommerce .content-area, .woocommerce .widget-area { width: 100%; padding-left: 0; float: none; } }\n";
        } elseif ($shop_layout == 'sidebar-left') {
            $output_css .= ".woocommerce .content-area { float: right; width: 75%; }\n";
            $output_css .= ".woocommerce .widget-area { float: left; width: 25%; padding-right: 30px; }\n";
            $output_css .= "@media (max-width: 992px) { .woocommerce .content-area, .woocommerce .widget-area { width: 100%; padding-right: 0; float: none; } }\n";
        } elseif ($shop_layout == 'full-width') {
            $output_css .= ".woocommerce .widget-area { display: none; }\n";
            $output_css .= ".woocommerce .content-area { width: 100%; }\n";
        }
        
        // تخطيط صفحة المنتج
        $product_layout = get_theme_mod('product_page_layout', 'standard');
        if ($product_layout == 'full-width') {
            $output_css .= ".single-product .product .summary, .single-product .product .woocommerce-tabs { max-width: 1200px; margin-left: auto; margin-right: auto; }\n";
        } elseif ($product_layout == 'sticky-info') {
            $output_css .= ".single-product .product .summary { position: sticky; top: 30px; }\n";
        } elseif ($product_layout == 'gallery-left') {
            $output_css .= ".single-product .product { display: flex; flex-wrap: wrap; }\n";
            $output_css .= ".single-product .product .woocommerce-product-gallery { order: 1; width: 55%; }\n";
            $output_css .= ".single-product .product .summary { order: 2; width: 45%; padding-left: 30px; }\n";
            $output_css .= ".single-product .product .woocommerce-tabs { order: 3; width: 100%; }\n";
            $output_css .= "@media (max-width: 992px) { .single-product .product .woocommerce-product-gallery, .single-product .product .summary { width: 100%; padding-left: 0; } }\n";
        }
        
        // تخطيط صفحة الدفع
        $checkout_layout = get_theme_mod('checkout_layout', 'two-column');
        if ($checkout_layout == 'two-column') {
            $output_css .= ".woocommerce-checkout { display: flex; flex-wrap: wrap; }\n";
            $output_css .= ".woocommerce-checkout .col2-set { width: 60%; padding-right: 30px; }\n";
            $output_css .= ".woocommerce-checkout #order_review_heading, .woocommerce-checkout #order_review { width: 40%; }\n";
            $output_css .= "@media (max-width: 992px) { .woocommerce-checkout .col2-set, .woocommerce-checkout #order_review_heading, .woocommerce-checkout #order_review { width: 100%; padding-right: 0; } }\n";
        }
        
        // عدد المنتجات في الصف
        $products_per_row = get_theme_mod('products_per_row', 4);
        $output_css .= ".woocommerce ul.products li.product, .woocommerce-page ul.products li.product { width: calc((100% - " . (($products_per_row - 1) * 30) . "px) / {$products_per_row}); margin-right: 30px; }\n";
        $output_css .= ".woocommerce ul.products li.product:nth-child({$products_per_row}n), .woocommerce-page ul.products li.product:nth-child({$products_per_row}n) { margin-right: 0; }\n";
        $output_css .= "@media (max-width: 992px) { .woocommerce ul.products li.product, .woocommerce-page ul.products li.product { width: calc((100% - 30px) / 2); } .woocommerce ul.products li.product:nth-child(2n), .woocommerce-page ul.products li.product:nth-child(2n) { margin-right: 0; } .woocommerce ul.products li.product:nth-child({$products_per_row}n), .woocommerce-page ul.products li.product:nth-child({$products_per_row}n) { margin-right: 30px; } .woocommerce ul.products li.product:nth-child(2n), .woocommerce-page ul.products li.product:nth-child(2n) { margin-right: 0; } }\n";
        $output_css .= "@media (max-width: 768px) { .woocommerce ul.products li.product, .woocommerce-page ul.products li.product { width: 100%; margin-right: 0; } }\n";
        
        // إخفاء/إظهار شريط التبويب في صفحة المنتج
        if (!get_theme_mod('product_tabs_display', true)) {
            $output_css .= ".woocommerce-tabs { display: none !important; }\n";
        }
    }

    // ===== الخطوط =====
    $headings_font_family = get_theme_mod('headings_font_family', 'Cairo');
    $headings_font_weight = get_theme_mod('headings_font_weight', '700');
    $body_font_family = get_theme_mod('body_font_family', 'Cairo');
    $body_font_weight = get_theme_mod('body_font_weight', '400');
    $base_font_size = get_theme_mod('base_font_size', '16px');

    // تطبيق الخطوط
    $output_css .= "body, p, li, td, th, span, div:not([class*='icon']):not(i) { font-family: '{$body_font_family}', sans-serif; font-weight: {$body_font_weight}; }\n";
    $output_css .= "html { font-size: {$base_font_size}; }\n";
    $output_css .= "h1, h2, h3, h4, h5, h6, .site-title, .widget-title { font-family: '{$headings_font_family}', sans-serif; font-weight: {$headings_font_weight}; }\n";

    // تطبيق إعدادات الأداء
    if (get_theme_mod('enable_lazy_loading', true)) {
        $output_css .= "img:not(.no-lazy) { transition: opacity 0.3s; }\n";
        $output_css .= "img.lazyload, img.lazyloading { opacity: 0; }\n";
        $output_css .= "img.lazyloaded { opacity: 1; }\n";
    }

    $output_css .= "</style>\n";
    echo $output_css;
}
add_action('wp_head', 'professional_theme_custom_css', 20);

/**
 * تطبيق إعدادات الأداء والتحسين
 */
function professional_theme_apply_performance_options() {
    // تفعيل التحميل الكسول للصور
    if (get_theme_mod('enable_lazy_loading', true)) {
        add_filter('wp_get_attachment_image_attributes', 'professional_theme_add_lazy_loading_attribute', 10, 3);
        add_filter('the_content', 'professional_theme_add_lazy_loading_to_content_images');
        add_filter('post_thumbnail_html', 'professional_theme_add_lazy_loading_to_content_images');
        add_filter('woocommerce_product_get_image', 'professional_theme_add_lazy_loading_to_content_images');
    }

    // تفعيل الصور المتجاوبة
    if (get_theme_mod('enable_responsive_images', true)) {
        add_theme_support('responsive-embeds');
        add_filter('wp_calculate_image_srcset_meta', '__return_null');
    }

    // تفعيل التخزين المؤقت للصفحات
    if (get_theme_mod('enable_page_caching', true)) {
        add_filter('wp_headers', 'professional_theme_cache_headers');
    }
    
    // تفعيل ضغط CSS و JavaScript
    if (get_theme_mod('enable_css_minification', true) || get_theme_mod('enable_js_minification', true)) {
        add_filter('style_loader_src', 'professional_theme_remove_script_version', 15, 1);
        add_filter('script_loader_src', 'professional_theme_remove_script_version', 15, 1);
    }

    // تأجيل تحميل JavaScript
    if (get_theme_mod('enable_js_defer', true)) {
        add_filter('script_loader_tag', 'professional_theme_defer_scripts', 10, 3);
    }
}
add_action('after_setup_theme', 'professional_theme_apply_performance_options');

/**
 * إضافة خاصية التحميل الكسول للصور
 */
function professional_theme_add_lazy_loading_attribute($attr, $attachment, $size) {
    if (!is_admin() && !is_feed() && !is_preview()) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}

/**
 * إضافة خاصية التحميل الكسول للصور في المحتوى
 */
function professional_theme_add_lazy_loading_to_content_images($content) {
    if (is_admin() || is_feed() || is_preview()) {
        return $content;
    }
    
    // تحويل الصور إلى تحميل كسول
    if (function_exists('wp_lazy_loading_enabled') && wp_lazy_loading_enabled('img', 'the_content')) {
        return $content;
    }
    
    return preg_replace_callback('/<img([^>]+)>/i', function($matches) {
        if (strpos($matches[1], 'loading=') !== false) {
            return $matches[0];
        }
        
        return str_replace('<img', '<img loading="lazy"', $matches[0]);
    }, $content);
}

/**
 * إضافة رؤوس التخزين المؤقت
 */
function professional_theme_cache_headers($headers) {
    if (is_user_logged_in()) {
        return $headers;
    }
    
    $cache_expiration = get_theme_mod('cache_expiration', 24) * 3600; // تحويل الساعات إلى ثواني
    
    $headers['Cache-Control'] = 'public, max-age=' . $cache_expiration;
    $headers['Expires'] = gmdate('D, d M Y H:i:s', time() + $cache_expiration) . ' GMT';
    
    return $headers;
}

/**
 * إزالة إصدار السكربت لتحسين التخزين المؤقت
 */
function professional_theme_remove_script_version($src) {
    if (is_admin()) {
        return $src;
    }
    
    $parts = explode('?', $src);
    return $parts[0];
}

/**
 * إضافة خاصية defer للسكربتات
 */
function professional_theme_defer_scripts($tag, $handle, $src) {
    if (is_admin()) {
        return $tag;
    }
    
    // استثناء بعض السكربتات المهمة
    $exclude_list = array('jquery', 'jquery-core', 'jquery-migrate');
    
    if (in_array($handle, $exclude_list)) {
        return $tag;
    }
    
    // إضافة خاصية defer
    if (strpos($tag, 'defer') === false) {
        $tag = str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
