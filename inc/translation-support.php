<?php
/**
 * ملف دعم الترجمة والمتاجر متعددة اللغات
 *
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * تهيئة دعم الترجمة في القالب
 */
function professional_theme_translation_setup() {
    // تحميل ملف الترجمة من مجلد languages
    load_theme_textdomain('professional-theme', get_template_directory() . '/languages');

    // إضافة دعم ترجمة للنصوص المحددة في القالب
    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if (is_readable($locale_file)) {
        require_once($locale_file);
    }
}
add_action('after_setup_theme', 'professional_theme_translation_setup');

/**
 * دعم WPML/Polylang للقوائم المخصصة
 */
function professional_theme_multilingual_menus($args) {
    // إذا كان WPML مفعل، استخدم القائمة المترجمة
    if (function_exists('icl_object_id') && isset($args['theme_location'])) {
        $theme_location = $args['theme_location'];
        $locations = get_nav_menu_locations();
        
        if (isset($locations[$theme_location])) {
            $menu_id = $locations[$theme_location];
            $menu_id = apply_filters('wpml_object_id', $menu_id, 'nav_menu', true);
            $args['menu'] = $menu_id;
        }
    }
    
    // إذا كان Polylang مفعل، استخدم القائمة المترجمة
    if (function_exists('pll_current_language') && isset($args['theme_location'])) {
        $theme_location = $args['theme_location'];
        $locations = get_nav_menu_locations();
        
        if (isset($locations[$theme_location])) {
            $menu_id = $locations[$theme_location];
            $args['menu'] = $menu_id;
        }
    }
    
    return $args;
}
add_filter('wp_nav_menu_args', 'professional_theme_multilingual_menus');

/**
 * دعم RTL/LTR حسب اللغة
 */
function professional_theme_rtl_support() {
    // إضافة دعم RTL للغات التي تحتاجه
    if (is_rtl()) {
        wp_enqueue_style('professional-theme-rtl', get_template_directory_uri() . '/rtl.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'professional_theme_rtl_support');

/**
 * تخصيص الإعدادات حسب اللغة (WPML/Polylang)
 */
function professional_theme_language_specific_settings($value, $option) {
    // الحصول على اللغة الحالية
    $current_language = '';
    
    if (function_exists('icl_object_id')) {
        $current_language = apply_filters('wpml_current_language', NULL);
    } elseif (function_exists('pll_current_language')) {
        $current_language = pll_current_language();
    }
    
    // إذا لم تكن هناك لغة محددة، استخدم القيمة الافتراضية
    if (empty($current_language)) {
        return $value;
    }
    
    // قائمة الإعدادات التي يمكن تخصيصها حسب اللغة
    $language_specific_options = array(
        'footer_copyright_text',
        'header_tagline',
        'contact_address',
        'newsletter_heading',
        'newsletter_text',
    );
    
    // إذا كان الإعداد ضمن القائمة، ابحث عن قيمة مخصصة للغة
    if (in_array($option, $language_specific_options)) {
        $lang_option = $option . '_' . $current_language;
        $lang_value = get_option($lang_option);
        
        if ($lang_value !== false) {
            return $lang_value;
        }
    }
    
    return $value;
}
add_filter('option_theme_mods_professional-theme', 'professional_theme_language_specific_settings', 10, 2);

/**
 * إضافة حقول إضافية لدعم الترجمة في لوحة التخصيص
 */
function professional_theme_multilingual_customizer_fields($wp_customize) {
    // التحقق من وجود WPML أو Polylang
    $multilingual_active = function_exists('icl_object_id') || function_exists('pll_languages_list');
    
    if (!$multilingual_active) {
        return;
    }
    
    // الحصول على قائمة اللغات المدعومة
    $languages = array();
    
    if (function_exists('icl_object_id')) {
        $languages = apply_filters('wpml_active_languages', NULL, array('skip_missing' => 0));
    } elseif (function_exists('pll_languages_list')) {
        $pll_languages = pll_languages_list(array('fields' => 'slug'));
        foreach ($pll_languages as $lang) {
            $languages[$lang] = array('language_code' => $lang);
        }
    }
    
    // إضافة قسم للإعدادات متعددة اللغات
    $wp_customize->add_section('professional_theme_multilingual', array(
        'title'       => __('إعدادات متعددة اللغات', 'professional-theme'),
        'description' => __('تخصيص إعدادات القالب لكل لغة.', 'professional-theme'),
        'priority'    => 200,
    ));
    
    // إضافة حقول مخصصة لكل لغة
    foreach ($languages as $lang_code => $lang_data) {
        if (isset($lang_data['language_code'])) {
            $lang_code = $lang_data['language_code'];
        }
        
        // حقوق النشر لكل لغة
        $wp_customize->add_setting('footer_copyright_text_' . $lang_code, array(
            'default'           => sprintf(__('© %s - جميع الحقوق محفوظة', 'professional-theme'), date('Y') . ' ' . get_bloginfo('name')),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage',
        ));
        $wp_customize->add_control('footer_copyright_text_' . $lang_code, array(
            'label'       => sprintf(__('نص حقوق النشر (%s)', 'professional-theme'), $lang_code),
            'description' => __('نص حقوق النشر في الفوتر. استخدم {year} لإدراج السنة الحالية.', 'professional-theme'),
            'section'     => 'professional_theme_multilingual',
            'type'        => 'textarea',
        ));
        
        // عنوان النشرة البريدية لكل لغة
        $wp_customize->add_setting('newsletter_heading_' . $lang_code, array(
            'default'           => __('اشترك في نشرتنا البريدية', 'professional-theme'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ));
        $wp_customize->add_control('newsletter_heading_' . $lang_code, array(
            'label'       => sprintf(__('عنوان النشرة البريدية (%s)', 'professional-theme'), $lang_code),
            'section'     => 'professional_theme_multilingual',
            'type'        => 'text',
        ));
        
        // نص النشرة البريدية لكل لغة
        $wp_customize->add_setting('newsletter_text_' . $lang_code, array(
            'default'           => __('احصل على آخر الأخبار والعروض الحصرية مباشرة إلى بريدك الإلكتروني.', 'professional-theme'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ));
        $wp_customize->add_control('newsletter_text_' . $lang_code, array(
            'label'       => sprintf(__('نص النشرة البريدية (%s)', 'professional-theme'), $lang_code),
            'section'     => 'professional_theme_multilingual',
            'type'        => 'textarea',
        ));
    }
}
add_action('customize_register', 'professional_theme_multilingual_customizer_fields');

/**
 * دعم WooCommerce متعدد اللغات
 */
function professional_theme_woocommerce_multilingual_support() {
    // التحقق من وجود WooCommerce
    if (!class_exists('WooCommerce')) {
        return;
    }
    
    // دعم WPML WooCommerce Multilingual
    if (class_exists('woocommerce_wpml')) {
        // إضافة دعم إضافي لـ WCML
        add_filter('wcml_multi_currency_ajax_actions', 'professional_theme_add_action_to_multi_currency');
    }
    
    // دعم Polylang for WooCommerce
    if (function_exists('pll_current_language') && class_exists('Polylang_Woocommerce')) {
        // إضافة دعم إضافي لـ Polylang WooCommerce
    }
}
add_action('init', 'professional_theme_woocommerce_multilingual_support');

/**
 * إضافة دعم AJAX لعملات متعددة في WPML
 */
function professional_theme_add_action_to_multi_currency($actions) {
    $actions[] = 'professional_theme_update_mini_cart';
    return $actions;
}

/**
 * تحديث ملف POT للترجمة
 * يمكن استخدام هذه الدالة لتحديث ملف POT عند تحديث القالب
 */
function professional_theme_update_pot_file() {
    // هذه الدالة تستخدم فقط للتطوير وليس في الإنتاج
    if (!function_exists('wp_get_pomo_file_data')) {
        return;
    }
    
    // مسار ملف POT
    $pot_file = get_template_directory() . '/languages/professional-theme.pot';
    
    // تحديث ملف POT
    if (file_exists($pot_file)) {
        // تحديث ملف POT باستخدام WP-CLI أو أدوات أخرى
    }
}
