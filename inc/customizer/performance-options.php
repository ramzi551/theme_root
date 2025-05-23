<?php
/**
 * إعدادات الأداء والتحسين
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة خيارات الأداء والتحسين إلى لوحة تخصيص ووردبرس
 */
function professional_theme_performance_options($wp_customize) {
    
    // ===== قسم خيارات الأداء والتحسين =====
    $wp_customize->add_section('professional_theme_performance_options', array(
        'title'       => __('الأداء والتحسين', 'professional-theme'),
        'description' => __('تحسين أداء الموقع وسرعة التحميل.', 'professional-theme'),
        'priority'    => 150,
    ));

    // ===== 1. تحسينات CSS و JavaScript =====
    
    // تفعيل ضغط CSS
    $wp_customize->add_setting('enable_css_minification', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_css_minification', array(
        'label'       => __('تفعيل ضغط CSS', 'professional-theme'),
        'description' => __('تقليل حجم ملفات CSS لتحسين سرعة التحميل.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'checkbox',
        'priority'    => 10,
    ));

    // تفعيل ضغط JavaScript
    $wp_customize->add_setting('enable_js_minification', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_js_minification', array(
        'label'       => __('تفعيل ضغط JavaScript', 'professional-theme'),
        'description' => __('تقليل حجم ملفات JavaScript لتحسين سرعة التحميل.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));

    // تأجيل تحميل JavaScript
    $wp_customize->add_setting('enable_js_defer', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_js_defer', array(
        'label'       => __('تأجيل تحميل JavaScript', 'professional-theme'),
        'description' => __('تأجيل تحميل ملفات JavaScript لتسريع ظهور المحتوى.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'checkbox',
        'priority'    => 30,
    ));

    // ===== 2. تحسينات الصور =====
    
    // تفعيل التحميل الكسول للصور
    $wp_customize->add_setting('enable_lazy_loading', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_lazy_loading', array(
        'label'       => __('تفعيل التحميل الكسول للصور', 'professional-theme'),
        'description' => __('تحميل الصور فقط عند ظهورها في نطاق الرؤية.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'checkbox',
        'priority'    => 40,
    ));

    // تفعيل الصور المتجاوبة
    $wp_customize->add_setting('enable_responsive_images', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_responsive_images', array(
        'label'       => __('تفعيل الصور المتجاوبة', 'professional-theme'),
        'description' => __('تحميل الصور بالحجم المناسب لكل جهاز.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'checkbox',
        'priority'    => 50,
    ));

    // ===== 3. تحسينات الخطوط =====
    
    // تحسين تحميل الخطوط
    $wp_customize->add_setting('optimize_font_loading', array(
        'default'           => 'swap',
        'sanitize_callback' => 'professional_theme_sanitize_select',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('optimize_font_loading', array(
        'label'       => __('تحسين تحميل الخطوط', 'professional-theme'),
        'description' => __('اختر طريقة تحميل الخطوط لتحسين الأداء.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'select',
        'choices'     => array(
            'swap'     => __('عرض النص فوراً بخط بديل (swap)', 'professional-theme'),
            'block'    => __('انتظار تحميل الخط (block)', 'professional-theme'),
            'fallback' => __('استخدام الخط البديل فقط (fallback)', 'professional-theme'),
            'optional' => __('تحميل الخط إذا كان متاحاً (optional)', 'professional-theme'),
        ),
        'priority'    => 60,
    ));

    // تحميل الخطوط محلياً
    $wp_customize->add_setting('load_fonts_locally', array(
        'default'           => false,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('load_fonts_locally', array(
        'label'       => __('تحميل الخطوط محلياً', 'professional-theme'),
        'description' => __('تحميل خطوط جوجل محلياً بدلاً من استدعائها من الخادم الخارجي.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'checkbox',
        'priority'    => 70,
    ));

    // ===== 4. خيارات التخزين المؤقت =====
    
    // تفعيل التخزين المؤقت للصفحات
    $wp_customize->add_setting('enable_page_caching', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_page_caching', array(
        'label'       => __('تفعيل التخزين المؤقت للصفحات', 'professional-theme'),
        'description' => __('تخزين الصفحات مؤقتاً لتسريع التحميل للزوار المتكررين.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'checkbox',
        'priority'    => 80,
    ));

    // مدة التخزين المؤقت
    $wp_customize->add_setting('cache_expiration', array(
        'default'           => 24,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('cache_expiration', array(
        'label'       => __('مدة التخزين المؤقت (ساعات)', 'professional-theme'),
        'description' => __('المدة التي يتم فيها الاحتفاظ بالصفحات المخزنة مؤقتاً.', 'professional-theme'),
        'section'     => 'professional_theme_performance_options',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 72,
            'step' => 1,
        ),
        'priority'    => 90,
        'active_callback' => function() {
            return get_theme_mod('enable_page_caching', true);
        },
    ));
}
