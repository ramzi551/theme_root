<?php
/**
 * تحديث ملف customizer.php الرئيسي لتضمين الملفات الجديدة
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * تحميل ملفات التخصيص المنفصلة
 */
require get_template_directory() . '/inc/customizer/header-general.php';
require get_template_directory() . '/inc/customizer/header-user.php';
require get_template_directory() . '/inc/customizer/theme-colors.php';
require get_template_directory() . '/inc/customizer/woocommerce-options.php';
require get_template_directory() . '/inc/customizer/footer-options.php';
require get_template_directory() . '/inc/customizer/performance-options.php';
require get_template_directory() . '/inc/customizer/custom-css.php';
require get_template_directory() . '/inc/customizer/social-links.php';


/**
 * إضافة خيارات التخصيص إلى لوحة تخصيص ووردبرس
 */
function professional_theme_customizer_options($wp_customize) {
    
    // --- استعادة الأقسام الافتراضية --- 
    $wp_customize->get_section('title_tagline')->priority = 10;
    $wp_customize->get_section('colors')->priority = 20;
    // $wp_customize->remove_section('colors'); // إزالة قسم الألوان الافتراضي إذا كنا سنعتمد كليًا على خياراتنا
    $wp_customize->get_section('background_image')->priority = 25;
    $wp_customize->get_section('header_image')->priority = 26;
    $wp_customize->get_section('static_front_page')->priority = 40;
    $wp_customize->get_section('custom_css')->priority = 200;

    // --- لوحة الإعدادات العامة ---
    $wp_customize->add_panel('professional_theme_general_panel', array(
        'title'       => __('الإعدادات العامة للقالب', 'professional-theme'),
        'description' => __('تخصيص الإعدادات العامة للقالب.', 'professional-theme'),
        'priority'    => 30,
    ));

    // --- قسم خيارات الخطوط ---
    $wp_customize->add_section('professional_theme_typography_options', array(
        'title'       => __('خيارات الخطوط', 'professional-theme'),
        'description' => __('تحكم في خطوط القالب وأحجامها.', 'professional-theme'),
        'panel'       => 'professional_theme_general_panel',
        'priority'    => 10,
    ));

    // قائمة خطوط جوجل المقترحة (يمكن توسيعها)
    $google_fonts = professional_theme_get_google_fonts();

    // خط العناوين
    $wp_customize->add_setting('headings_font_family', array(
        'default'           => 'Cairo',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('headings_font_family', array(
        'label'   => __('خط العناوين (H1, H2, etc.)', 'professional-theme'),
        'section' => 'professional_theme_typography_options',
        'type'    => 'select',
        'choices' => $google_fonts,
    ));

    // خط النصوص الأساسية
    $wp_customize->add_setting('body_font_family', array(
        'default'           => 'Cairo',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('body_font_family', array(
        'label'   => __('خط النصوص الأساسية (Body)', 'professional-theme'),
        'section' => 'professional_theme_typography_options',
        'type'    => 'select',
        'choices' => $google_fonts,
    ));

    // حجم الخط الأساسي
    $wp_customize->add_setting('base_font_size', array(
        'default'           => '16px',
        'sanitize_callback' => 'sanitize_text_field', // يمكن تحسين التعقيم للقيم مثل 16px, 1em
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('base_font_size', array(
        'label'       => __('حجم الخط الأساسي (مثال: 16px, 1em, 100%)', 'professional-theme'),
        'section'     => 'professional_theme_typography_options',
        'type'        => 'text',
    ));
    
    // وزن خط العناوين
    $wp_customize->add_setting('headings_font_weight', array(
        'default'           => '700',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('headings_font_weight', array(
        'label'   => __('وزن خط العناوين', 'professional-theme'),
        'section' => 'professional_theme_typography_options',
        'type'    => 'select',
        'choices' => array(
            '300' => __('Light (300)', 'professional-theme'),
            '400' => __('Normal (400)', 'professional-theme'),
            '500' => __('Medium (500)', 'professional-theme'),
            '600' => __('Semi-Bold (600)', 'professional-theme'),
            '700' => __('Bold (700)', 'professional-theme'),
            '800' => __('Extra-Bold (800)', 'professional-theme'),
        ),
    ));

    // وزن خط النصوص
    $wp_customize->add_setting('body_font_weight', array(
        'default'           => '400',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('body_font_weight', array(
        'label'   => __('وزن خط النصوص', 'professional-theme'),
        'section' => 'professional_theme_typography_options',
        'type'    => 'select',
        'choices' => array(
            '300' => __('Light (300)', 'professional-theme'),
            '400' => __('Normal (400)', 'professional-theme'),
            '500' => __('Medium (500)', 'professional-theme'),
            '600' => __('Semi-Bold (600)', 'professional-theme'),
            '700' => __('Bold (700)', 'professional-theme'),
        ),
    ));

    // --- قسم خيارات الصفحة الرئيسية ---
    $wp_customize->add_section('professional_theme_homepage_options', array(
        'title'       => __('خيارات الصفحة الرئيسية', 'professional-theme'),
        'description' => __('تخصيص عناصر الصفحة الرئيسية.', 'professional-theme'),
        'panel'       => 'professional_theme_general_panel',
        'priority'    => 20,
    ));

    // إظهار السلايدر
    $wp_customize->add_setting('homepage_show_slider', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('homepage_show_slider', array(
        'label'       => __('إظهار السلايدر', 'professional-theme'),
        'section'     => 'professional_theme_homepage_options',
        'type'        => 'checkbox',
        'priority'    => 10,
    ));

    // إظهار المنتجات المميزة
    $wp_customize->add_setting('homepage_show_featured_products', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('homepage_show_featured_products', array(
        'label'       => __('إظهار المنتجات المميزة', 'professional-theme'),
        'section'     => 'professional_theme_homepage_options',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));

    // عدد المنتجات المميزة
    $wp_customize->add_setting('homepage_featured_products_count', array(
        'default'           => 8,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('homepage_featured_products_count', array(
        'label'       => __('عدد المنتجات المميزة', 'professional-theme'),
        'section'     => 'professional_theme_homepage_options',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 4,
            'max'  => 12,
            'step' => 4,
        ),
        'priority'    => 30,
        'active_callback' => function() {
            return get_theme_mod('homepage_show_featured_products', true);
        },
    ));

    // --- قسم خيارات التوافق ---
    $wp_customize->add_section('professional_theme_compatibility_options', array(
        'title'       => __('خيارات التوافق', 'professional-theme'),
        'description' => __('تخصيص إعدادات التوافق مع المتصفحات والأجهزة.', 'professional-theme'),
        'panel'       => 'professional_theme_general_panel',
        'priority'    => 30,
    ));

    // تفعيل وضع التوافق مع المتصفحات القديمة
    $wp_customize->add_setting('enable_legacy_browser_support', array(
        'default'           => false,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_legacy_browser_support', array(
        'label'       => __('تفعيل دعم المتصفحات القديمة', 'professional-theme'),
        'description' => __('تفعيل دعم المتصفحات القديمة مثل Internet Explorer 11.', 'professional-theme'),
        'section'     => 'professional_theme_compatibility_options',
        'type'        => 'checkbox',
        'priority'    => 10,
    ));

    // تفعيل وضع الطباعة
    $wp_customize->add_setting('enable_print_mode', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_print_mode', array(
        'label'       => __('تفعيل وضع الطباعة', 'professional-theme'),
        'description' => __('تحسين تنسيق الصفحات عند الطباعة.', 'professional-theme'),
        'section'     => 'professional_theme_compatibility_options',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));

    // استدعاء دوال إضافة خيارات الهيدر
    professional_theme_header_general_options($wp_customize);
    professional_theme_header_user_options($wp_customize);
    professional_theme_colors_options($wp_customize);
    professional_theme_footer_options($wp_customize);
    professional_theme_performance_options($wp_customize);
    
    // استدعاء دوال إضافة خيارات WooCommerce إذا كانت الإضافة مفعلة
    if (class_exists('WooCommerce')) {
        professional_theme_woocommerce_options($wp_customize);
    }
}
add_action('customize_register', 'professional_theme_customizer_options', 20);

// --- دوال مساعدة ---
function professional_theme_sanitize_checkbox($checked) {
    return (isset($checked) && true == $checked) ? true : false;
}

function professional_theme_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

function professional_theme_is_user_header_enabled_for_section() {
    return get_theme_mod('enable_user_header', false);
}

function professional_theme_is_user_custom_button_enabled_for_controls() {
    return get_theme_mod('enable_user_header', false) && get_theme_mod('user_header_show_custom_button', false);
}

function professional_theme_is_user_hero_enabled() {
    return get_theme_mod('enable_user_header', false) && get_theme_mod('user_header_show_hero', false);
}

// --- قائمة خطوط جوجل --- (يمكن وضعها في ملف منفصل إذا كبرت)
function professional_theme_get_google_fonts() {
    return array(
        'Cairo' => 'Cairo',
        'Roboto' => 'Roboto',
        'Open Sans' => 'Open Sans',
        'Lato' => 'Lato',
        'Montserrat' => 'Montserrat',
        'Noto Sans Arabic' => 'Noto Sans Arabic',
        'Almarai' => 'Almarai',
        'Tajawal' => 'Tajawal',
        'Changa' => 'Changa',
        'El Messiri' => 'El Messiri',
        'Lalezar' => 'Lalezar',
        'Mada' => 'Mada',
        'Scheherazade New' => 'Scheherazade New',
        // أضف المزيد من الخطوط هنا
    );
}

// --- تحميل سكربتات التحكم والمعاينة --- 
function professional_theme_customizer_scripts() {
    wp_enqueue_script( 
        'professional-theme-customizer-controls',
        get_template_directory_uri() . '/assets/js/customizer-controls.js',
        array('jquery', 'customize-controls'), 
        wp_get_theme()->get('Version'),
        true
    );
    wp_enqueue_script( 
        'professional-theme-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array('jquery', 'customize-preview'),
        wp_get_theme()->get('Version'),
        true
    );

    // تمرير إعدادات الخطوط إلى JavaScript للمعاينة المباشرة
    $typography_settings = array(
        'headings_font_family' => get_theme_mod('headings_font_family', 'Cairo'),
        'body_font_family' => get_theme_mod('body_font_family', 'Cairo'),
        'base_font_size' => get_theme_mod('base_font_size', '16px'),
        'headings_font_weight' => get_theme_mod('headings_font_weight', '700'),
        'body_font_weight' => get_theme_mod('body_font_weight', '400'),
    );
    
    wp_localize_script('professional-theme-customizer-preview', 'professionalThemeTypography', $typography_settings);
}
add_action('customize_controls_enqueue_scripts', 'professional_theme_customizer_scripts');
add_action('customize_preview_init', 'professional_theme_customizer_scripts');
