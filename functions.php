<?php
/**
 * تحديث ملف functions.php لتضمين الملفات الجديدة
 * 
 * @package ProfessionalTheme
 * @version 5.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * إعداد القالب
 */
function professional_theme_setup() {
    // إضافة دعم الترجمة
    load_theme_textdomain( 'professional-theme', get_template_directory() . '/languages' );
    
    // إضافة دعم الشعار المخصص
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // إضافة دعم الصورة المميزة
    add_theme_support( 'post-thumbnails' );
    
    // إضافة دعم عنوان الصفحة
    add_theme_support( 'title-tag' );
    
    // إضافة دعم HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style', // For WP 5.3+ to remove type attribute
        'script', // For WP 5.3+ to remove type attribute
    ) );
    
    // إضافة دعم RSS للمقالات والتعليقات
    add_theme_support( 'automatic-feed-links' );
    
    // إضافة دعم WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    
    // تسجيل القوائم
    register_nav_menus( array(
        'primary' => __( 'القائمة الرئيسية', 'professional-theme' ),
        'footer'  => __( 'قائمة الفوتر', 'professional-theme' ),
        'modern_header_menu' => __( 'قائمة الهيدر الحديث', 'professional-theme' ),
        'centered_top_menu' => __( 'القائمة العلوية للهيدر المتمركز', 'professional-theme' ),
        'user_header_top_menu' => __( 'القائمة العلوية لهيدر المستخدم', 'professional-theme' ),
    ) );
    
    // إضافة أحجام الصور المخصصة
    add_image_size( 'professional-theme-featured', 1200, 600, true );
    add_image_size( 'professional-theme-thumbnail', 600, 400, true );
}
add_action( 'after_setup_theme', 'professional_theme_setup' );

/**
 * تسجيل السايدبار
 */
function professional_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'السايدبار', 'professional-theme' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'أضف الويدجت هنا لتظهر في السايدبار.', 'professional-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    // تسجيل سايدبار المتجر
    if (class_exists('WooCommerce')) {
        register_sidebar( array(
            'name'          => __( 'سايدبار المتجر', 'professional-theme' ),
            'id'            => 'shop-sidebar',
            'description'   => __( 'أضف الويدجت هنا لتظهر في سايدبار صفحات المتجر.', 'professional-theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
    
    for ( $i = 1; $i <= 4; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( __( 'فوتر %d', 'professional-theme' ), $i ),
            'id'            => 'footer-' . $i,
            'description'   => sprintf( __( 'أضف الويدجت هنا لتظهر في العمود %d من الفوتر.', 'professional-theme' ), $i ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title footer-widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
}
add_action( 'widgets_init', 'professional_theme_widgets_init' );

/**
 * إضافة الأنماط والسكربتات (نسخة محسنة v5.2)
 */
function professional_theme_scripts() {
    // --- أنماط CSS --- 
    
    // تحميل خطوط جوجل المختارة من Customizer مع font-display: swap
    $headings_font = get_theme_mod('headings_font_family', 'Cairo');
    $body_font = get_theme_mod('body_font_family', 'Cairo');
    $font_families = array();

    if ($headings_font) {
        $font_families[] = str_replace(' ', '+', $headings_font) . ':' . get_theme_mod('headings_font_weight', '700');
    }
    if ($body_font && $body_font !== $headings_font) { 
        $font_families[] = str_replace(' ', '+', $body_font) . ':' . get_theme_mod('body_font_weight', '400');
    } elseif ($body_font === $headings_font && get_theme_mod('body_font_weight', '400') !== get_theme_mod('headings_font_weight', '700')){
        $font_families[] = str_replace(' ', '+', $body_font) . ':' . get_theme_mod('body_font_weight', '400');
    }
    
    if (empty($font_families)) {
        $font_families[] = 'Cairo:400,700'; 
    }

    $font_families = array_unique($font_families); 
    
    // تحسين تحميل الخطوط بناءً على إعدادات الأداء
    $font_display = get_theme_mod('optimize_font_loading', 'swap');
    
    if (get_theme_mod('load_fonts_locally', false)) {
        // تحميل الخطوط محلياً (يتطلب تنفيذ إضافي لتنزيل الخطوط محلياً)
        // هذا مجرد مثال، يمكن تطويره لاحقاً
        wp_enqueue_style('professional-theme-local-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', array(), wp_get_theme()->get('Version'));
    } else {
        if (!empty($font_families)) {
            $fonts_url = 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $font_families) . '&display=' . $font_display;
            wp_enqueue_style('professional-theme-google-fonts', $fonts_url, array(), null);
        }
    }
    
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
    wp_enqueue_style('professional-theme-main', get_stylesheet_uri(), array(), wp_get_theme()->get('Version')); 
    wp_enqueue_style('professional-theme-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array('professional-theme-main'), wp_get_theme()->get('Version'));
    wp_enqueue_style('professional-theme-header-base', get_template_directory_uri() . '/assets/css/header/header-base.css', array('professional-theme-main'), wp_get_theme()->get('Version'));
    
    $active_header_style = 'classic'; 
    $enable_user_header = get_theme_mod('enable_user_header', false);

    if ($enable_user_header) {
        $active_header_style = 'user';
    } else {
        $active_header_style = get_theme_mod('header_style', 'classic');
    }

    $header_style_css_path = get_template_directory() . '/assets/css/header/header-' . $active_header_style . '.css';
    $header_style_css_uri = get_template_directory_uri() . '/assets/css/header/header-' . $active_header_style . '.css';

    if (file_exists($header_style_css_path)) {
        wp_enqueue_style('professional-theme-header-style-' . $active_header_style, $header_style_css_uri, array('professional-theme-header-base'), wp_get_theme()->get('Version'));
    }
    
    // تحميل JavaScript مع تأجيل التحميل إذا كان مفعلاً
    $js_defer = get_theme_mod('enable_js_defer', true) ? true : false;
    
    wp_enqueue_script('professional-theme-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), $js_defer);
    wp_localize_script('professional-theme-main-js', 'professionalTheme', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'sticky_header_enabled' => get_theme_mod('enable_sticky_header', false),
        'search_popup_enabled' => get_theme_mod('enable_search_popup', true),
        'header_style' => $active_header_style,
        'lazy_loading' => get_theme_mod('enable_lazy_loading', true)
    ));
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'professional_theme_scripts');

/**
 * تضمين ملفات إضافية
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/theme-colors.php';
require get_template_directory() . '/inc/theme-colors-apply.php';
require get_template_directory() . '/inc/performance-apply.php';
require get_template_directory() . '/inc/footer-apply.php';
require get_template_directory() . '/inc/user-header-colors-apply.php';


/**
 * دوال مساعدة
 */
if (!function_exists('professional_theme_sanitize_select')) {
    function professional_theme_sanitize_select($input, $setting) {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
}

if (!function_exists('professional_theme_darken_color')) {
    function professional_theme_darken_color($hex, $steps) {
        $steps = max(-255, min(255, $steps));
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $r = max(0, min(255, $r - $steps));
        $g = max(0, min(255, $g - $steps));
        $b = max(0, min(255, $b - $steps));
        return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT)
             . str_pad(dechex($g), 2, '0', STR_PAD_LEFT)
             . str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('professional_theme_adjust_brightness')) {
    function professional_theme_adjust_brightness($hex, $steps) {
        $steps = max(-255, min(255, $steps));
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) .
                   str_repeat(substr($hex, 1, 1), 2) .
                   str_repeat(substr($hex, 2, 1), 2);
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $r = max(0, min(255, $r + $steps));
        $g = max(0, min(255, $g + $steps));
        $b = max(0, min(255, $b + $steps));
        return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT) .
               str_pad(dechex($g), 2, '0', STR_PAD_LEFT) .
               str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
    }
}

/**
 * دالة القائمة الافتراضية
 */
function professional_theme_primary_menu_fallback() {
    if (current_user_can('manage_options')) {
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url(admin_url('nav-menus.php')) . '">' . __('إنشاء قائمة رئيسية', 'professional-theme') . '</a></li>';
        echo '</ul>';
    }
}

/**
 * إضافة كلاسات CSS إلى وسم body بناءً على نمط الهيدر الفعلي
 */
function professional_theme_body_classes($classes) {
    $active_header_style = 'classic';
    $enable_user_header = get_theme_mod('enable_user_header', false);

    if ($enable_user_header) {
        $active_header_style = 'user';
    } else {
        $active_header_style = get_theme_mod('header_style', 'classic');
    }
    
    $classes[] = 'header-style-' . sanitize_html_class($active_header_style);
    
    if (get_theme_mod('enable_sticky_header', false)) {
        $classes[] = 'sticky-header-enabled';
    }
    
    if (is_rtl()) {
        $classes[] = 'rtl-active';
    } else {
        $classes[] = 'ltr-active';
    }
    
    return $classes;
}
add_filter('body_class', 'professional_theme_body_classes');

/**
 * تحميل خطوط جوجل المختارة في الهيدر (للمعاينة المباشرة وللواجهة الأمامية)
 */
function professional_theme_load_selected_fonts_early() {
    // تحميل الخطوط محلياً إذا كان مفعلاً
    if (get_theme_mod('load_fonts_locally', false)) {
        echo "<link rel='stylesheet' id='professional-theme-google-fonts-early' href='" . esc_url(get_template_directory_uri() . '/assets/fonts/fonts.css') . "' type='text/css' media='all' />\n";
        return;
    }
    
    $headings_font = get_theme_mod('headings_font_family', 'Cairo');
    $body_font = get_theme_mod('body_font_family', 'Cairo');
    $font_families = array();

    if ($headings_font) {
        $font_families[] = str_replace(' ', '+', $headings_font) . ':' . get_theme_mod('headings_font_weight', '700');
    }
    if ($body_font && $body_font !== $headings_font) {
        $font_families[] = str_replace(' ', '+', $body_font) . ':' . get_theme_mod('body_font_weight', '400');
    } elseif ($body_font === $headings_font && get_theme_mod('body_font_weight', '400') !== get_theme_mod('headings_font_weight', '700')){
        $font_families[] = str_replace(' ', '+', $body_font) . ':' . get_theme_mod('body_font_weight', '400');
    }
    
    if (empty($font_families)) {
        $font_families[] = 'Cairo:400,700';
    }
    $font_families = array_unique($font_families);
    
    // تحسين تحميل الخطوط بناءً على إعدادات الأداء
    $font_display = get_theme_mod('optimize_font_loading', 'swap');

    if (!empty($font_families)) {
        $fonts_url = 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $font_families) . '&display=' . $font_display;
        echo "<link rel='stylesheet' id='professional-theme-google-fonts-early' href='" . esc_url($fonts_url) . "' type='text/css' media='all' />\n";
    }
}
add_action('wp_head', 'professional_theme_load_selected_fonts_early', 1); 
add_action('customize_controls_print_styles', 'professional_theme_load_selected_fonts_early');

/**
 * تفعيل التحميل الكسول للصور
 */
function professional_theme_lazy_loading_images($content) {
    if (!get_theme_mod('enable_lazy_loading', true)) {
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
add_filter('the_content', 'professional_theme_lazy_loading_images');
add_filter('post_thumbnail_html', 'professional_theme_lazy_loading_images');
add_filter('woocommerce_product_get_image', 'professional_theme_lazy_loading_images');

/**
 * تفعيل الصور المتجاوبة
 */
function professional_theme_responsive_images() {
    if (!get_theme_mod('enable_responsive_images', true)) {
        return;
    }
    
    add_theme_support('responsive-embeds');
    add_filter('wp_calculate_image_srcset_meta', '__return_null');
}
add_action('after_setup_theme', 'professional_theme_responsive_images');

/**
 * تفعيل التخزين المؤقت للصفحات
 */
function professional_theme_page_cache_headers($headers) {
    if (!get_theme_mod('enable_page_caching', true) || is_user_logged_in()) {
        return $headers;
    }
    
    $cache_expiration = get_theme_mod('cache_expiration', 24) * 3600; // تحويل الساعات إلى ثواني
    
    $headers['Cache-Control'] = 'public, max-age=' . $cache_expiration;
    $headers['Expires'] = gmdate('D, d M Y H:i:s', time() + $cache_expiration) . ' GMT';
    
    return $headers;
}
add_filter('wp_headers', 'professional_theme_page_cache_headers');
