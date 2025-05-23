<?php
/**
 * نظام الألوان المتكامل للقالب
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة خيارات الألوان المتكاملة إلى لوحة تخصيص ووردبرس
 */
function professional_theme_colors_options($wp_customize) {
    
    // ===== لوحة الألوان الرئيسية =====
    $wp_customize->add_panel('professional_theme_colors_panel', array(
        'title'       => __('نظام الألوان المتكامل', 'professional-theme'),
        'description' => __('تخصيص جميع ألوان القالب بشكل متكامل.', 'professional-theme'),
        'priority'    => 20,
    ));

    // ===== 1. الألوان الأساسية =====
    $wp_customize->add_section('professional_theme_primary_colors', array(
        'title'       => __('الألوان الأساسية', 'professional-theme'),
        'description' => __('تخصيص الألوان الأساسية للقالب.', 'professional-theme'),
        'panel'       => 'professional_theme_colors_panel',
        'priority'    => 10,
    ));

    // اللون الأساسي
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#0f766e',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'       => __('اللون الأساسي', 'professional-theme'),
        'description' => __('اللون الرئيسي للقالب، يستخدم في الأزرار والعناصر المهمة.', 'professional-theme'),
        'section'     => 'professional_theme_primary_colors',
        'priority'    => 10,
    )));

    // اللون الثانوي
    $wp_customize->add_setting('secondary_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label'       => __('اللون الثانوي', 'professional-theme'),
        'description' => __('اللون الثانوي للقالب، يستخدم في العناصر الثانوية.', 'professional-theme'),
        'section'     => 'professional_theme_primary_colors',
        'priority'    => 20,
    )));

    // لون التمييز (Accent)
    $wp_customize->add_setting('accent_color', array(
        'default'           => '#f97316',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label'       => __('لون التمييز (Accent)', 'professional-theme'),
        'description' => __('لون التمييز للقالب، يستخدم لإبراز العناصر المهمة.', 'professional-theme'),
        'section'     => 'professional_theme_primary_colors',
        'priority'    => 30,
    )));

    // لون النص الأساسي
    $wp_customize->add_setting('text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_color', array(
        'label'       => __('لون النص الأساسي', 'professional-theme'),
        'description' => __('لون النص الأساسي في القالب.', 'professional-theme'),
        'section'     => 'professional_theme_primary_colors',
        'priority'    => 40,
    )));

    // لون خلفية الموقع
    $wp_customize->add_setting('background_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
        'label'       => __('لون خلفية الموقع', 'professional-theme'),
        'description' => __('لون خلفية الموقع الرئيسية.', 'professional-theme'),
        'section'     => 'professional_theme_primary_colors',
        'priority'    => 50,
    )));

    // ===== 2. ألوان الأزرار =====
    $wp_customize->add_section('professional_theme_button_colors', array(
        'title'       => __('ألوان الأزرار', 'professional-theme'),
        'description' => __('تخصيص ألوان الأزرار في القالب.', 'professional-theme'),
        'panel'       => 'professional_theme_colors_panel',
        'priority'    => 20,
    ));

    // لون الزر الأساسي
    $wp_customize->add_setting('button_primary_color', array(
        'default'           => '#0f766e',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_primary_color', array(
        'label'       => __('لون الزر الأساسي', 'professional-theme'),
        'description' => __('لون الأزرار الأساسية في القالب.', 'professional-theme'),
        'section'     => 'professional_theme_button_colors',
        'priority'    => 10,
    )));

    // لون نص الزر الأساسي
    $wp_customize->add_setting('button_primary_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_primary_text_color', array(
        'label'       => __('لون نص الزر الأساسي', 'professional-theme'),
        'description' => __('لون النص في الأزرار الأساسية.', 'professional-theme'),
        'section'     => 'professional_theme_button_colors',
        'priority'    => 20,
    )));

    // لون الزر الثانوي
    $wp_customize->add_setting('button_secondary_color', array(
        'default'           => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_secondary_color', array(
        'label'       => __('لون الزر الثانوي', 'professional-theme'),
        'description' => __('لون الأزرار الثانوية في القالب.', 'professional-theme'),
        'section'     => 'professional_theme_button_colors',
        'priority'    => 30,
    )));

    // لون نص الزر الثانوي
    $wp_customize->add_setting('button_secondary_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_secondary_text_color', array(
        'label'       => __('لون نص الزر الثانوي', 'professional-theme'),
        'description' => __('لون النص في الأزرار الثانوية.', 'professional-theme'),
        'section'     => 'professional_theme_button_colors',
        'priority'    => 40,
    )));

    // ===== 3. ألوان الفوتر =====
    $wp_customize->add_section('professional_theme_footer_colors', array(
        'title'       => __('ألوان الفوتر', 'professional-theme'),
        'description' => __('تخصيص ألوان الفوتر في القالب.', 'professional-theme'),
        'panel'       => 'professional_theme_colors_panel',
        'priority'    => 30,
    ));

    // لون خلفية الفوتر
    $wp_customize->add_setting('footer_bg_color', array(
        'default'           => '#1f2937',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
        'label'       => __('لون خلفية الفوتر', 'professional-theme'),
        'description' => __('لون خلفية الفوتر الرئيسي.', 'professional-theme'),
        'section'     => 'professional_theme_footer_colors',
        'priority'    => 10,
    )));

    // لون نص الفوتر
    $wp_customize->add_setting('footer_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_text_color', array(
        'label'       => __('لون نص الفوتر', 'professional-theme'),
        'description' => __('لون النص في الفوتر.', 'professional-theme'),
        'section'     => 'professional_theme_footer_colors',
        'priority'    => 20,
    )));

    // لون روابط الفوتر
    $wp_customize->add_setting('footer_link_color', array(
        'default'           => '#9ca3af',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_link_color', array(
        'label'       => __('لون روابط الفوتر', 'professional-theme'),
        'description' => __('لون الروابط في الفوتر.', 'professional-theme'),
        'section'     => 'professional_theme_footer_colors',
        'priority'    => 30,
    )));

    // لون روابط الفوتر عند التمرير
    $wp_customize->add_setting('footer_link_hover_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_link_hover_color', array(
        'label'       => __('لون روابط الفوتر عند التمرير', 'professional-theme'),
        'description' => __('لون الروابط في الفوتر عند تمرير المؤشر عليها.', 'professional-theme'),
        'section'     => 'professional_theme_footer_colors',
        'priority'    => 40,
    )));

    // ===== 4. ألوان المتجر =====
    $wp_customize->add_section('professional_theme_shop_colors', array(
        'title'       => __('ألوان المتجر', 'professional-theme'),
        'description' => __('تخصيص ألوان صفحات المتجر.', 'professional-theme'),
        'panel'       => 'professional_theme_colors_panel',
        'priority'    => 40,
    ));

    // لون أزرار المتجر
    $wp_customize->add_setting('shop_button_color', array(
        'default'           => '#0f766e',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'shop_button_color', array(
        'label'       => __('لون أزرار المتجر', 'professional-theme'),
        'description' => __('لون أزرار الشراء وإضافة المنتج للسلة.', 'professional-theme'),
        'section'     => 'professional_theme_shop_colors',
        'priority'    => 10,
    )));

    // لون نص أزرار المتجر
    $wp_customize->add_setting('shop_button_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'shop_button_text_color', array(
        'label'       => __('لون نص أزرار المتجر', 'professional-theme'),
        'description' => __('لون النص في أزرار المتجر.', 'professional-theme'),
        'section'     => 'professional_theme_shop_colors',
        'priority'    => 20,
    )));

    // لون سعر المنتج
    $wp_customize->add_setting('product_price_color', array(
        'default'           => '#0f766e',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'product_price_color', array(
        'label'       => __('لون سعر المنتج', 'professional-theme'),
        'description' => __('لون سعر المنتج في صفحات المتجر.', 'professional-theme'),
        'section'     => 'professional_theme_shop_colors',
        'priority'    => 30,
    )));

    // لون السعر المخفض
    $wp_customize->add_setting('product_sale_price_color', array(
        'default'           => '#ef4444',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'product_sale_price_color', array(
        'label'       => __('لون السعر المخفض', 'professional-theme'),
        'description' => __('لون السعر المخفض في صفحات المتجر.', 'professional-theme'),
        'section'     => 'professional_theme_shop_colors',
        'priority'    => 40,
    )));

    // لون شارة التخفيض
    $wp_customize->add_setting('product_sale_badge_color', array(
        'default'           => '#ef4444',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'product_sale_badge_color', array(
        'label'       => __('لون شارة التخفيض', 'professional-theme'),
        'description' => __('لون شارة التخفيض على المنتجات.', 'professional-theme'),
        'section'     => 'professional_theme_shop_colors',
        'priority'    => 50,
    )));
}
