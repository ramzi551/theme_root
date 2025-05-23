<?php
/**
 * خيارات الهيدر العامة
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة خيارات الهيدر العامة إلى لوحة تخصيص ووردبرس
 */
function professional_theme_header_general_options($wp_customize) {
    
    // ===== قسم خيارات الهيدر العامة =====
    $wp_customize->add_section('professional_theme_header_options', array(
        'title'       => __('خيارات الهيدر العامة', 'professional-theme'),
        'description' => __('تخصيص نمط وإعدادات الهيدر العامة (باستثناء هيدر المستخدم المخصص)', 'professional-theme'),
        'priority'    => 30, 
    ));

    // ===== 1. إعدادات نمط الهيدر =====
    
    // اختيار نمط الهيدر
    $wp_customize->add_setting('header_style', array(
        'default'           => 'classic',
        'sanitize_callback' => 'professional_theme_sanitize_select',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('header_style', array(
        'label'       => __('نمط الهيدر', 'professional-theme'),
        'description' => __('اختر نمط الهيدر المفضل لديك.', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'select',
        'choices'     => array(
            'classic'     => __('الكلاسيكي', 'professional-theme'),
            'modern'      => __('الحديث', 'professional-theme'),
            'centered'    => __('المتمركز', 'professional-theme'),
        ),
        'priority'    => 10,
    ));

    // تفعيل قسم الهيرو في الهيدر العام
    $wp_customize->add_setting('general_header_show_hero', array(
        'default'           => false,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('general_header_show_hero', array(
        'label'       => __('إظهار قسم الهيرو أسفل الهيدر العام', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'checkbox',
        'priority'    => 15, 
    ));

    // ===== 2. إعدادات شريط التوب بار =====
    
    // تفعيل شريط التوب بار
    $wp_customize->add_setting('topbar_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
    ));
    $wp_customize->add_control('topbar_enabled', array(
        'label'       => __('تفعيل الشريط العلوي (Topbar)', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));

    // حجم أيقونات التواصل
    $wp_customize->add_setting('topbar_social_icon_size', array(
        'default'           => '18px',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('topbar_social_icon_size', array(
        'label'       => __('حجم أيقونات التواصل (px)', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'text',
        'priority'    => 25,
    ));

    // محاذاة أيقونات التواصل
    $wp_customize->add_setting('topbar_social_icon_alignment', array(
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('topbar_social_icon_alignment', array(
        'label'       => __('محاذاة أيقونات التواصل', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'select',
        'choices'     => array(
            'left'   => __('يسار', 'professional-theme'),
            'right'  => __('يمين', 'professional-theme'),
            'center' => __('وسط', 'professional-theme'),
        ),
        'priority'    => 30,
    ));

    // ===== 3. إعدادات شريط الترحيب ورقم واتساب الدعم =====
    
    // تفعيل شريط الترحيب
    $wp_customize->add_setting('header_welcome_text_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
    ));
    $wp_customize->add_control('header_welcome_text_enabled', array(
        'label'       => __('تفعيل شريط الترحيب العلوي', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'checkbox',
        'priority'    => 35,
    ));

    // نص الترحيب
    $wp_customize->add_setting('header_welcome_text', array(
        'default'           => 'مرحبًا بك في متجرنا – شحن مجاني فوق 200 ريال!',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('header_welcome_text', array(
        'label'       => __('نص الترحيب', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'text',
        'priority'    => 40,
    ));

    // رقم واتساب الدعم
    $wp_customize->add_setting('header_whatsapp_number', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('header_whatsapp_number', array(
        'label'       => __('رقم واتساب الدعم', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'text',
        'description' => __('اكتب الرقم بدون + مثال: 966501234567', 'professional-theme'),
        'priority'    => 45,
    ));

    // إظهار زر "طلب سريع"
    $wp_customize->add_setting('header_show_whatsapp_button', array(
        'default'           => false,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
    ));
    $wp_customize->add_control('header_show_whatsapp_button', array(
        'label'       => __('إظهار زر "طلب سريع"', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'checkbox',
        'priority'    => 50,
    ));

    // نص زر واتساب
    $wp_customize->add_setting('header_whatsapp_button_text', array(
        'default'           => 'طلب سريع',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('header_whatsapp_button_text', array(
        'label'       => __('نص زر واتساب', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'text',
        'priority'    => 55,
    ));

    // ===== 4. إعدادات شريط الإعلانات =====
    
    // إظهار شريط الإعلانات
    $wp_customize->add_setting('show_ad_bar', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
    ));
    $wp_customize->add_control('show_ad_bar', array(
        'label'       => __('إظهار شريط الإعلانات', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'checkbox',
        'priority'    => 60,
    ));

    // نص الإعلان
    $wp_customize->add_setting('ad_text', array(
        'default'           => 'عروض خاصة! خصم 20% على جميع المنتجات',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('ad_text', array(
        'label'       => __('نص الإعلان', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'text',
        'priority'    => 65,
    ));

    // رابط الإعلان
    $wp_customize->add_setting('ad_link', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('ad_link', array(
        'label'       => __('رابط الإعلان', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'type'        => 'url',
        'priority'    => 70,
    ));

    // ===== 5. ألوان الهيدر العام =====
    
    // لون خلفية شريط الترحيب
    $wp_customize->add_setting('header_topbar_bg_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_topbar_bg_color', array(
        'label'       => __('لون خلفية شريط الترحيب', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'priority'    => 75,
    )));

    // لون نص شريط الترحيب
    $wp_customize->add_setting('header_topbar_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage', 
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_topbar_text_color', array(
        'label'       => __('لون نص شريط الترحيب', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'priority'    => 80,
    )));

    // لون خلفية شريط أيقونات التواصل
    $wp_customize->add_setting('header_social_bar_bg_color', array(
        'default'           => '#eeeeee',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_social_bar_bg_color', array(
        'label'       => __('لون خلفية شريط أيقونات التواصل', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'priority'    => 85,
    )));

    // لون أيقونات التواصل الاجتماعي
    $wp_customize->add_setting('header_social_bar_icon_color', array(
        'default'           => '#555555',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_social_bar_icon_color', array(
        'label'       => __('لون أيقونات التواصل الاجتماعي', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'priority'    => 90,
    )));

    // لون خلفية الهيدر الرئيسي
    $wp_customize->add_setting('main_header_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_header_bg_color', array(
        'label'       => __('لون خلفية الهيدر الرئيسي', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'priority'    => 95,
    )));

    // لون نص الهيدر الرئيسي
    $wp_customize->add_setting('main_header_text_color', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_header_text_color', array(
        'label'       => __('لون نص الهيدر الرئيسي', 'professional-theme'),
        'section'     => 'professional_theme_header_options',
        'priority'    => 100,
    )));
}
