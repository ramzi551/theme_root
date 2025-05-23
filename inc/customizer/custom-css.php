<?php
/**
 * خيارات CSS المخصص المتقدمة
 *
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة خيارات CSS المخصص إلى لوحة تخصيص ووردبرس
 */
function professional_theme_custom_css_options($wp_customize) {
    
    // ===== قسم CSS المخصص =====
    $wp_customize->add_section('professional_theme_custom_css', array(
        'title'       => __('CSS مخصص متقدم', 'professional-theme'),
        'description' => __('إضافة أكواد CSS مخصصة لتخصيص مظهر القالب بشكل متقدم.', 'professional-theme'),
        'priority'    => 200,
    ));

    // ===== 1. CSS عام =====
    
    // تفعيل CSS المخصص
    $wp_customize->add_setting('enable_custom_css', array(
        'default'           => false,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_custom_css', array(
        'label'       => __('تفعيل CSS المخصص', 'professional-theme'),
        'description' => __('تفعيل استخدام أكواد CSS المخصصة في الموقع.', 'professional-theme'),
        'section'     => 'professional_theme_custom_css',
        'type'        => 'checkbox',
        'priority'    => 10,
    ));

    // CSS عام
    $wp_customize->add_setting('custom_css_global', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_global', array(
        'label'           => __('CSS عام', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على جميع صفحات الموقع.', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 20,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false);
        },
    ));

    // ===== 2. CSS للهيدر =====
    
    // CSS للهيدر
    $wp_customize->add_setting('custom_css_header', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_header', array(
        'label'           => __('CSS للهيدر', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على هيدر الموقع فقط.', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 30,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false);
        },
    ));

    // ===== 3. CSS للفوتر =====
    
    // CSS للفوتر
    $wp_customize->add_setting('custom_css_footer', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_footer', array(
        'label'           => __('CSS للفوتر', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على فوتر الموقع فقط.', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 40,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false);
        },
    ));

    // ===== 4. CSS للصفحة الرئيسية =====
    
    // CSS للصفحة الرئيسية
    $wp_customize->add_setting('custom_css_home', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_home', array(
        'label'           => __('CSS للصفحة الرئيسية', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على الصفحة الرئيسية فقط.', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 50,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false);
        },
    ));

    // ===== 5. CSS للمتجر =====
    
    // CSS للمتجر
    $wp_customize->add_setting('custom_css_shop', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_shop', array(
        'label'           => __('CSS للمتجر', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على صفحات المتجر فقط.', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 60,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false) && class_exists('WooCommerce');
        },
    ));

    // ===== 6. CSS للجوال =====
    
    // CSS للجوال
    $wp_customize->add_setting('custom_css_mobile', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_mobile', array(
        'label'           => __('CSS للجوال', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على الأجهزة المحمولة فقط (أقل من 768 بكسل).', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 70,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false);
        },
    ));

    // ===== 7. CSS للأجهزة اللوحية =====
    
    // CSS للأجهزة اللوحية
    $wp_customize->add_setting('custom_css_tablet', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_tablet', array(
        'label'           => __('CSS للأجهزة اللوحية', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على الأجهزة اللوحية فقط (768 إلى 1024 بكسل).', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 80,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false);
        },
    ));

    // ===== 8. CSS للأجهزة المكتبية =====
    
    // CSS للأجهزة المكتبية
    $wp_customize->add_setting('custom_css_desktop', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_desktop', array(
        'label'           => __('CSS للأجهزة المكتبية', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على الأجهزة المكتبية فقط (أكبر من 1024 بكسل).', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 90,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false);
        },
    ));

    // ===== 9. CSS للاتجاه RTL =====
    
    // CSS للاتجاه RTL
    $wp_customize->add_setting('custom_css_rtl', array(
        'default'           => '',
        'sanitize_callback' => 'professional_theme_sanitize_css',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('custom_css_rtl', array(
        'label'           => __('CSS للاتجاه RTL', 'professional-theme'),
        'description'     => __('أضف أكواد CSS مخصصة تطبق على الاتجاه RTL فقط.', 'professional-theme'),
        'section'         => 'professional_theme_custom_css',
        'type'            => 'textarea',
        'priority'        => 100,
        'active_callback' => function() {
            return get_theme_mod('enable_custom_css', false);
        },
    ));
}
add_action('customize_register', 'professional_theme_custom_css_options');

/**
 * تنظيف وتأمين كود CSS المخصص
 */
function professional_theme_sanitize_css($css) {
    return wp_strip_all_tags($css);
}

/**
 * إضافة CSS المخصص إلى رأس الصفحة
 */
function professional_theme_output_custom_css() {
    // التحقق من تفعيل CSS المخصص
    if (!get_theme_mod('enable_custom_css', false)) {
        return;
    }
    
    // بدء تجميع CSS
    $custom_css = '';
    
    // إضافة CSS العام
    $global_css = get_theme_mod('custom_css_global', '');
    if (!empty($global_css)) {
        $custom_css .= $global_css . "\n";
    }
    
    // إضافة CSS للهيدر
    $header_css = get_theme_mod('custom_css_header', '');
    if (!empty($header_css)) {
        $custom_css .= "/* CSS للهيدر */\n" . $header_css . "\n";
    }
    
    // إضافة CSS للفوتر
    $footer_css = get_theme_mod('custom_css_footer', '');
    if (!empty($footer_css)) {
        $custom_css .= "/* CSS للفوتر */\n" . $footer_css . "\n";
    }
    
    // إضافة CSS للصفحة الرئيسية إذا كنا في الصفحة الرئيسية
    if (is_front_page() || is_home()) {
        $home_css = get_theme_mod('custom_css_home', '');
        if (!empty($home_css)) {
            $custom_css .= "/* CSS للصفحة الرئيسية */\n" . $home_css . "\n";
        }
    }
    
    // إضافة CSS للمتجر إذا كنا في صفحة المتجر
    if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product() || is_cart() || is_checkout())) {
        $shop_css = get_theme_mod('custom_css_shop', '');
        if (!empty($shop_css)) {
            $custom_css .= "/* CSS للمتجر */\n" . $shop_css . "\n";
        }
    }
    
    // إضافة CSS للجوال
    $mobile_css = get_theme_mod('custom_css_mobile', '');
    if (!empty($mobile_css)) {
        $custom_css .= "@media (max-width: 767px) {\n" . $mobile_css . "\n}\n";
    }
    
    // إضافة CSS للأجهزة اللوحية
    $tablet_css = get_theme_mod('custom_css_tablet', '');
    if (!empty($tablet_css)) {
        $custom_css .= "@media (min-width: 768px) and (max-width: 1023px) {\n" . $tablet_css . "\n}\n";
    }
    
    // إضافة CSS للأجهزة المكتبية
    $desktop_css = get_theme_mod('custom_css_desktop', '');
    if (!empty($desktop_css)) {
        $custom_css .= "@media (min-width: 1024px) {\n" . $desktop_css . "\n}\n";
    }
    
    // إضافة CSS للاتجاه RTL
    if (is_rtl()) {
        $rtl_css = get_theme_mod('custom_css_rtl', '');
        if (!empty($rtl_css)) {
            $custom_css .= "/* CSS للاتجاه RTL */\n" . $rtl_css . "\n";
        }
    }
    
    // إخراج CSS إذا كان هناك محتوى
    if (!empty($custom_css)) {
        echo '<style type="text/css" id="professional-theme-custom-css">' . "\n";
        echo "/* CSS مخصص من لوحة التخصيص */\n";
        echo $custom_css;
        echo '</style>' . "\n";
    }
}
add_action('wp_head', 'professional_theme_output_custom_css', 999);

/**
 * إضافة محرر CSS متقدم (CodeMirror) إلى لوحة التخصيص
 */
function professional_theme_custom_css_editor_scripts() {
    wp_enqueue_code_editor(array('type' => 'text/css'));
    wp_enqueue_script('professional-theme-custom-css-editor', get_template_directory_uri() . '/assets/js/custom-css-editor.js', array('jquery', 'code-editor'), '1.0', true);
}
add_action('customize_controls_enqueue_scripts', 'professional_theme_custom_css_editor_scripts');

/**
 * إنشاء ملف JavaScript لتفعيل محرر CSS المتقدم
 */
function professional_theme_create_custom_css_editor_js() {
    // مسار الملف
    $js_file = get_template_directory() . '/assets/js/custom-css-editor.js';
    
    // إنشاء مجلد assets/js إذا لم يكن موجوداً
    if (!file_exists(dirname($js_file))) {
        wp_mkdir_p(dirname($js_file));
    }
    
    // محتوى ملف JavaScript
    $js_content = <<<'EOT'
/**
 * تفعيل محرر CSS المتقدم في لوحة التخصيص
 */
(function($) {
    'use strict';
    
    // تفعيل محرر CSS المتقدم عند تحميل لوحة التخصيص
    wp.customize.bind('ready', function() {
        var cssFields = [
            'custom_css_global',
            'custom_css_header',
            'custom_css_footer',
            'custom_css_home',
            'custom_css_shop',
            'custom_css_mobile',
            'custom_css_tablet',
            'custom_css_desktop',
            'custom_css_rtl'
        ];
        
        // تفعيل محرر CSS المتقدم لكل حقل
        cssFields.forEach(function(fieldId) {
            var control = wp.customize.control(fieldId);
            
            if (control) {
                var textarea = control.container.find('textarea')[0];
                
                if (textarea) {
                    var editor = wp.codeEditor.initialize(textarea, {
                        codemirror: {
                            mode: 'css',
                            lineNumbers: true,
                            lineWrapping: true,
                            indentUnit: 4,
                            indentWithTabs: true,
                            theme: 'default'
                        }
                    });
                    
                    // تحديث قيمة الحقل عند تغيير المحرر
                    editor.codemirror.on('change', function() {
                        textarea.value = editor.codemirror.getValue();
                        $(textarea).trigger('change');
                    });
                }
            }
        });
    });
})(jQuery);
EOT;
    
    // كتابة الملف إذا لم يكن موجوداً
    if (!file_exists($js_file)) {
        file_put_contents($js_file, $js_content);
    }
}
add_action('after_setup_theme', 'professional_theme_create_custom_css_editor_js');
