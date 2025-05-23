<?php
/**
 * خيارات الفوتر
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة خيارات الفوتر إلى لوحة تخصيص ووردبرس
 */
function professional_theme_footer_options($wp_customize) {
    
    // ===== قسم خيارات الفوتر =====
    $wp_customize->add_section('professional_theme_footer_options', array(
        'title'       => __('خيارات الفوتر', 'professional-theme'),
        'description' => __('تخصيص تخطيط وإعدادات الفوتر.', 'professional-theme'),
        'priority'    => 90,
    ));

    // ===== 1. إعدادات تخطيط الفوتر =====
    
    // نمط الفوتر
    $wp_customize->add_setting('footer_style', array(
        'default'           => 'standard',
        'sanitize_callback' => 'professional_theme_sanitize_select',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('footer_style', array(
        'label'       => __('نمط الفوتر', 'professional-theme'),
        'description' => __('اختر نمط الفوتر المفضل لديك.', 'professional-theme'),
        'section'     => 'professional_theme_footer_options',
        'type'        => 'select',
        'choices'     => array(
            'standard'    => __('قياسي', 'professional-theme'),
            'multi-tier'  => __('متعدد الطبقات', 'professional-theme'),
            'minimal'     => __('مصغر', 'professional-theme'),
            'newsletter'  => __('مع نموذج اشتراك', 'professional-theme'),
            'map'         => __('مع خريطة', 'professional-theme'),
        ),
        'priority'    => 5,
    ));

    // إظهار شعار الفوتر
    $wp_customize->add_setting('footer_show_logo', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('footer_show_logo', array(
        'label'       => __('إظهار الشعار في الفوتر', 'professional-theme'),
        'section'     => 'professional_theme_footer_options',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));

    // شعار الفوتر
    $wp_customize->add_setting('footer_logo', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'footer_logo', array(
        'label'           => __('شعار الفوتر', 'professional-theme'),
        'description'     => __('تحميل شعار مخصص للفوتر (اختياري).', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'mime_type'       => 'image',
        'priority'        => 30,
        'active_callback' => function() {
            return get_theme_mod('footer_show_logo', true);
        },
    )));

    // حجم شعار الفوتر
    $wp_customize->add_setting('footer_logo_height', array(
        'default'           => 80,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('footer_logo_height', array(
        'label'           => __('ارتفاع شعار الفوتر (بكسل)', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'range',
        'input_attrs'     => array(
            'min'  => 30,
            'max'  => 200,
            'step' => 5,
        ),
        'priority'        => 35,
        'active_callback' => function() {
            return get_theme_mod('footer_show_logo', true);
        },
    ));

    // ===== 2. إعدادات المحتوى =====
    
    // نص حقوق النشر
    $wp_customize->add_setting('footer_copyright_text', array(
        'default'           => sprintf(__('© %s - جميع الحقوق محفوظة', 'professional-theme'), date('Y') . ' ' . get_bloginfo('name')),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('footer_copyright_text', array(
        'label'       => __('نص حقوق النشر', 'professional-theme'),
        'description' => __('نص حقوق النشر في الفوتر. استخدم {year} لإدراج السنة الحالية.', 'professional-theme'),
        'section'     => 'professional_theme_footer_options',
        'type'        => 'textarea',
        'priority'    => 40,
    ));

    // إظهار روابط التواصل الاجتماعي
    $wp_customize->add_setting('footer_show_social', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('footer_show_social', array(
        'label'       => __('إظهار روابط التواصل الاجتماعي', 'professional-theme'),
        'section'     => 'professional_theme_footer_options',
        'type'        => 'checkbox',
        'priority'    => 50,
    ));

    // ===== 3. إعدادات إضافية =====
    
    // إظهار زر العودة للأعلى
    $wp_customize->add_setting('footer_show_back_to_top', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('footer_show_back_to_top', array(
        'label'       => __('إظهار زر العودة للأعلى', 'professional-theme'),
        'section'     => 'professional_theme_footer_options',
        'type'        => 'checkbox',
        'priority'    => 60,
    ));

    // إظهار قائمة الفوتر
    $wp_customize->add_setting('footer_show_menu', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('footer_show_menu', array(
        'label'       => __('إظهار قائمة الفوتر', 'professional-theme'),
        'section'     => 'professional_theme_footer_options',
        'type'        => 'checkbox',
        'priority'    => 70,
    ));

    // إظهار معلومات الدفع
    $wp_customize->add_setting('footer_show_payment_icons', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('footer_show_payment_icons', array(
        'label'       => __('إظهار أيقونات طرق الدفع', 'professional-theme'),
        'section'     => 'professional_theme_footer_options',
        'type'        => 'checkbox',
        'priority'    => 80,
    ));
    
    // طرق الدفع المدعومة
    $payment_methods = array(
        'visa'       => 'Visa',
        'mastercard' => 'MasterCard',
        'amex'       => 'American Express',
        'paypal'     => 'PayPal',
        'mada'       => 'مدى',
        'applepay'   => 'Apple Pay',
    );

    foreach ($payment_methods as $method_id => $method_name) {
        $wp_customize->add_setting('payment_method_' . $method_id, array(
            'default'           => true,
            'sanitize_callback' => 'professional_theme_sanitize_checkbox',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control('payment_method_' . $method_id, array(
            'label'           => sprintf(__('إظهار %s', 'professional-theme'), $method_name),
            'section'         => 'professional_theme_footer_options',
            'type'            => 'checkbox',
            'priority'        => 90,
            'active_callback' => function() {
                return get_theme_mod('footer_show_payment_icons', true);
            },
        ));
    }

    // إعدادات خاصة بنمط الفوتر مع نموذج اشتراك
    $wp_customize->add_setting('newsletter_title', array(
        'default'           => __('اشترك في نشرتنا البريدية', 'professional-theme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('newsletter_title', array(
        'label'           => __('عنوان النشرة البريدية', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'text',
        'priority'        => 100,
        'active_callback' => function() {
            return get_theme_mod('footer_style', 'standard') === 'newsletter';
        },
    ));
    
    $wp_customize->add_setting('newsletter_description', array(
        'default'           => __('احصل على آخر الأخبار والعروض الحصرية مباشرة إلى بريدك الإلكتروني.', 'professional-theme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('newsletter_description', array(
        'label'           => __('وصف النشرة البريدية', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'textarea',
        'priority'        => 110,
        'active_callback' => function() {
            return get_theme_mod('footer_style', 'standard') === 'newsletter';
        },
    ));
    
    $wp_customize->add_setting('newsletter_form_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('newsletter_form_id', array(
        'label'           => __('معرف نموذج Contact Form 7', 'professional-theme'),
        'description'     => __('أدخل معرف نموذج Contact Form 7 للاشتراك في النشرة البريدية.', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'text',
        'priority'        => 120,
        'active_callback' => function() {
            return get_theme_mod('footer_style', 'standard') === 'newsletter';
        },
    ));
    
    // إعدادات خاصة بنمط الفوتر مع خريطة
    $wp_customize->add_setting('google_maps_api_key', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('google_maps_api_key', array(
        'label'           => __('مفتاح Google Maps API', 'professional-theme'),
        'description'     => __('أدخل مفتاح Google Maps API الخاص بك.', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'text',
        'priority'        => 130,
        'active_callback' => function() {
            return get_theme_mod('footer_style', 'standard') === 'map';
        },
    ));
    
    $wp_customize->add_setting('map_latitude', array(
        'default'           => '24.7136',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('map_latitude', array(
        'label'           => __('خط العرض للخريطة', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'text',
        'priority'        => 140,
        'active_callback' => function() {
            return get_theme_mod('footer_style', 'standard') === 'map';
        },
    ));
    
    $wp_customize->add_setting('map_longitude', array(
        'default'           => '46.6753',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('map_longitude', array(
        'label'           => __('خط الطول للخريطة', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'text',
        'priority'        => 150,
        'active_callback' => function() {
            return get_theme_mod('footer_style', 'standard') === 'map';
        },
    ));
    
    $wp_customize->add_setting('map_zoom', array(
        'default'           => '15',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('map_zoom', array(
        'label'           => __('مستوى تكبير الخريطة', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'number',
        'input_attrs'     => array(
            'min'  => 1,
            'max'  => 20,
            'step' => 1,
        ),
        'priority'        => 160,
        'active_callback' => function() {
            return get_theme_mod('footer_style', 'standard') === 'map';
        },
    ));
    
    $wp_customize->add_setting('map_title', array(
        'default'           => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('map_title', array(
        'label'           => __('عنوان العلامة على الخريطة', 'professional-theme'),
        'section'         => 'professional_theme_footer_options',
        'type'            => 'text',
        'priority'        => 170,
        'active_callback' => function() {
            return get_theme_mod('footer_style', 'standard') === 'map';
        },
    ));
}
