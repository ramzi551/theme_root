<?php
/**
 * خيارات هيدر المستخدم المخصص
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة خيارات هيدر المستخدم المخصص إلى لوحة تخصيص ووردبرس
 */
function professional_theme_header_user_options($wp_customize) {
    
    // ===== لوحة هيدر المستخدم المخصص =====
    $wp_customize->add_panel('professional_theme_user_header_panel', array(
        'title'       => __('هيدر المستخدم المخصص', 'professional-theme'),
        'description' => __('تخصيص إعدادات هيدر المستخدم المخصص.', 'professional-theme'),
        'priority'    => 35,
    ));

    // 1. الإعدادات الأساسية
    $wp_customize->add_section('user_header_main_settings', array(
        'title'       => __('1. الإعدادات الأساسية (هيدر المستخدم)', 'professional-theme'),
        'panel'       => 'professional_theme_user_header_panel',
        'priority'    => 1,
    ));
    $wp_customize->add_setting('enable_user_header', array(
        'default'           => false,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_user_header', array(
        'label'       => __('تفعيل هيدر المستخدم المخصص', 'professional-theme'),
        'description' => __('عند التفعيل، سيتم استخدام هيدر المستخدم المخصص بدلاً من الهيدر العام.', 'professional-theme'),
        'section'     => 'user_header_main_settings',
        'type'        => 'checkbox',
    ));

    // 2. الشعار والتخطيط
    $wp_customize->add_section('user_header_logo_section', array(
        'title'           => __('2. الشعار والتخطيط (هيدر المستخدم)', 'professional-theme'),
        'panel'           => 'professional_theme_user_header_panel',
        'priority'        => 2,
        'active_callback' => 'professional_theme_is_user_header_enabled_for_section',
    ));
    $wp_customize->add_setting('user_header_logo', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'user_header_logo', array(
        'label'       => __('تحميل الشعار (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_logo_section',
        'mime_type'   => 'image',
    )));
    $wp_customize->add_setting('user_logo_height', array(
        'default'           => 60,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('user_logo_height', array(
        'label'       => __('ارتفاع الشعار (px) (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_logo_section',
        'type'        => 'range',
        'input_attrs' => array('min' => 20, 'max' => 200, 'step' => 5),
    ));
    $wp_customize->add_setting('user_header_logo_position', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('user_header_logo_position', array(
        'label'       => __('محاذاة الشعار (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_logo_section',
        'type'        => 'radio',
        'choices'     => array(
            'left'   => 'يسار',
            'center' => 'وسط',
            'right'  => 'يمين',
        ),
    ));
    $wp_customize->add_setting('user_header_show_tagline', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('user_header_show_tagline', array(
        'label'       => __('عرض وصف الموقع أسفل الشعار (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_logo_section',
        'type'        => 'checkbox',
    ));

    // 3. عناصر التفاعل
    $wp_customize->add_section('user_header_icons', array(
        'title'           => __('3. عناصر التفاعل والأيقونات (هيدر المستخدم)', 'professional-theme'),
        'panel'           => 'professional_theme_user_header_panel',
        'priority'        => 3,
        'active_callback' => 'professional_theme_is_user_header_enabled_for_section',
    ));
    $icons = ['menu' => 'القائمة', 'search' => 'بحث', 'account' => 'الحساب', 'wishlist' => 'المفضلة', 'cart' => 'السلة'];
    foreach ($icons as $key => $label) {
        $wp_customize->add_setting("user_header_show_{$key}", array(
            'default'           => true,
            'sanitize_callback' => 'professional_theme_sanitize_checkbox',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control("user_header_show_{$key}", array(
            'label'       => __("إظهار أيقونة {$label} (هيدر المستخدم)", 'professional-theme'),
            'section'     => 'user_header_icons',
            'type'        => 'checkbox',
        ));
    }

    $wp_customize->add_setting('user_header_show_custom_button', array(
        'default'           => false, 
        'sanitize_callback' => 'professional_theme_sanitize_checkbox', 
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('user_header_show_custom_button', array(
        'label'       => __('إظهار زر مخصص (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_icons',
        'type'        => 'checkbox',
    ));
    $wp_customize->add_setting('user_header_custom_button_text', array(
        'default'           => 'اتصل بنا', 
        'sanitize_callback' => 'sanitize_text_field', 
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('user_header_custom_button_text', array(
        'label'           => __('نص الزر المخصص (هيدر المستخدم)', 'professional-theme'),
        'section'         => 'user_header_icons',
        'type'            => 'text',
        'active_callback' => 'professional_theme_is_user_custom_button_enabled_for_controls',
    ));
    $wp_customize->add_setting('user_header_custom_button_link', array(
        'default'           => '#', 
        'sanitize_callback' => 'esc_url_raw', 
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('user_header_custom_button_link', array(
        'label'           => __('رابط الزر المخصص (هيدر المستخدم)', 'professional-theme'),
        'section'         => 'user_header_icons',
        'type'            => 'url',
        'active_callback' => 'professional_theme_is_user_custom_button_enabled_for_controls',
    ));

    // 4. الشريط العلوي
    $wp_customize->add_section('user_header_topbar', array(
        'title'           => __('4. الشريط العلوي (هيدر المستخدم)', 'professional-theme'),
        'panel'           => 'professional_theme_user_header_panel',
        'priority'        => 4,
        'active_callback' => 'professional_theme_is_user_header_enabled_for_section',
    ));
    $wp_customize->add_setting('user_header_show_topbar', array(
        'default'           => true, 
        'sanitize_callback' => 'professional_theme_sanitize_checkbox', 
        'transport'         => 'refresh'
    ));
    $wp_customize->add_control('user_header_show_topbar', array(
        'label'       => __('إظهار الشريط العلوي (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_topbar',
        'type'        => 'checkbox',
    ));
    $wp_customize->add_setting('user_header_email', array(
        'default'           => '', 
        'sanitize_callback' => 'sanitize_email', 
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('user_header_email', array(
        'label'       => __('البريد الإلكتروني (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_topbar',
        'type'        => 'email',
    ));
    $wp_customize->add_setting('user_header_phone', array(
        'default'           => '', 
        'sanitize_callback' => 'sanitize_text_field', 
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('user_header_phone', array(
        'label'       => __('رقم الهاتف (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_topbar',
        'type'        => 'text',
    ));
    $socials = ['facebook', 'twitter', 'instagram', 'telegram', 'snapchat', 'tiktok'];
    foreach ($socials as $social) {
        $wp_customize->add_setting("user_header_social_{$social}", array(
            'default'           => '', 
            'sanitize_callback' => 'esc_url_raw', 
            'transport'         => 'refresh'
        ));
        $wp_customize->add_control("user_header_social_{$social}", array(
            'label'       => __(ucfirst($social) . ' URL (هيدر المستخدم)', 'professional-theme'),
            'section'     => 'user_header_topbar',
            'type'        => 'url',
        ));
    }

    // 5. المظهر والتنسيقات
    $wp_customize->add_section('user_header_appearance', array(
        'title'           => __('5. المظهر والتنسيقات (هيدر المستخدم)', 'professional-theme'),
        'panel'           => 'professional_theme_user_header_panel',
        'priority'        => 5,
        'active_callback' => 'professional_theme_is_user_header_enabled_for_section',
    ));

    $user_header_styles = [
        'user_header_bg_color'          => ['لون خلفية الهيدر (المستخدم)', '#ffffff'],
        'user_header_text_color'        => ['لون نص الهيدر (المستخدم)', '#000000'],
        'user_header_link_hover_color'  => ['لون الروابط عند التمرير (المستخدم)', '#007bff'],
        'user_header_topbar_bg_color'   => ['خلفية الشريط العلوي (المستخدم)', '#f8f9fa'],
        'user_header_topbar_text_color' => ['نص الشريط العلوي (المستخدم)', '#6c757d'],
    ];
    foreach ($user_header_styles as $key => $value) {
        $wp_customize->add_setting($key, array(
            'default'           => $value[1], 
            'sanitize_callback' => 'sanitize_hex_color', 
            'transport'         => 'postMessage'
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $key, array(
            'label'       => __($value[0], 'professional-theme'),
            'section'     => 'user_header_appearance',
        )));
    }

    $wp_customize->add_setting('user_header_border_radius', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('user_header_border_radius', array(
        'label'       => __('درجة التدوير (Radius) (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_appearance',
        'type'        => 'range',
        'input_attrs' => array('min' => 0, 'max' => 30, 'step' => 1),
    ));
    $wp_customize->add_setting('user_header_font_size', array(
        'default'           => 16,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('user_header_font_size', array(
        'label'       => __('حجم الخط في الهيدر (px) (هيدر المستخدم)', 'professional-theme'),
        'section'     => 'user_header_appearance',
        'type'        => 'range',
        'input_attrs' => array('min' => 10, 'max' => 30, 'step' => 1),
    ));
    
    // 6. قسم الهيرو (أسفل الهيدر المستخدم)
    $wp_customize->add_section("user_header_hero_section", array(
        "title"           => __("6. قسم الهيرو (هيدر المستخدم)", "professional-theme"),
        "panel"           => "professional_theme_user_header_panel",
        "priority"        => 6,
        'active_callback' => 'professional_theme_is_user_header_enabled_for_section',
    ));

    $wp_customize->add_setting("user_header_show_hero", array(
        "default"           => false,
        "sanitize_callback" => "professional_theme_sanitize_checkbox",
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control("user_header_show_hero", array(
        "label"       => __("إظهار قسم الهيرو أسفل الهيدر (المستخدم)", "professional-theme"),
        "section"     => "user_header_hero_section",
        "type"        => "checkbox",
    ));

    $wp_customize->add_setting("user_hero_title", array(
        "default"           => __("عنوان هيرو افتراضي", "professional-theme"),
        "sanitize_callback" => "sanitize_text_field",
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control("user_hero_title", array(
        "label"           => __("عنوان الهيرو (المستخدم)", "professional-theme"),
        "section"         => "user_header_hero_section",
        "type"            => "text",
        "active_callback" => "professional_theme_is_user_hero_enabled",
    ));

    $wp_customize->add_setting("user_hero_subtitle", array(
        "default"           => __("نص فرعي لقسم الهيرو يصف المزيد.", "professional-theme"),
        "sanitize_callback" => "wp_kses_post",
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control("user_hero_subtitle", array(
        "label"           => __("النص الفرعي للهيرو (المستخدم)", "professional-theme"),
        "section"         => "user_header_hero_section",
        "type"            => "textarea",
        "active_callback" => "professional_theme_is_user_hero_enabled",
    ));

    $wp_customize->add_setting("user_hero_background_image", array(
        "default"           => "",
        "sanitize_callback" => "absint", // Store attachment ID
        'transport'         => 'refresh', // Image changes usually need refresh
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "user_hero_background_image", array(
        "label"           => __("صورة خلفية الهيرو (المستخدم)", "professional-theme"),
        "section"         => "user_header_hero_section",
        "mime_type"       => "image",
        "active_callback" => "professional_theme_is_user_hero_enabled",
    )));

    $wp_customize->add_setting("user_hero_background_color", array(
        "default"           => "#f0f0f0",
        "sanitize_callback" => "sanitize_hex_color",
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "user_hero_background_color", array(
        "label"           => __("لون خلفية الهيرو (إذا لم تختر صورة) (المستخدم)", "professional-theme"),
        "section"         => "user_header_hero_section",
        "active_callback" => "professional_theme_is_user_hero_enabled",
    )));

    $wp_customize->add_setting("user_hero_text_color", array(
        "default"           => "#333333",
        "sanitize_callback" => "sanitize_hex_color",
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "user_hero_text_color", array(
        "label"           => __("لون نص الهيرو (المستخدم)", "professional-theme"),
        "section"         => "user_header_hero_section",
        "active_callback" => "professional_theme_is_user_hero_enabled",
    )));

    $wp_customize->add_setting("user_hero_button_text", array(
        "default"           => __("اعرف المزيد", "professional-theme"),
        "sanitize_callback" => "sanitize_text_field",
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control("user_hero_button_text", array(
        "label"           => __("نص زر الهيرو (المستخدم)", "professional-theme"),
        "section"         => "user_header_hero_section",
        "type"            => "text",
        "active_callback" => "professional_theme_is_user_hero_enabled",
    ));

    $wp_customize->add_setting("user_hero_button_link", array(
        "default"           => "#",
        "sanitize_callback" => "esc_url_raw",
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control("user_hero_button_link", array(
        "label"           => __("رابط زر الهيرو (المستخدم)", "professional-theme"),
        "section"         => "user_header_hero_section",
        "type"            => "url",
        "active_callback" => "professional_theme_is_user_hero_enabled",
    ));
}
