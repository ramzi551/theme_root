<?php
/**
 * توافق القالب مع المكونات الإضافية الشائعة
 *
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * توافق مع Elementor
 */
function professional_theme_elementor_support() {
    // التحقق من وجود Elementor
    if (!did_action('elementor/loaded')) {
        return;
    }
    
    // إضافة دعم للعرض الكامل في Elementor
    add_theme_support('elementor-page-title');
    add_theme_support('elementor-default-colors');
    add_theme_support('elementor-default-fonts');
    
    // إضافة مواقع Elementor مخصصة
    if (class_exists('\\Elementor\\Plugin')) {
        if (method_exists(\Elementor\Plugin::$instance->themes_manager, 'register_locations')) {
            \Elementor\Plugin::$instance->themes_manager->register_locations([
                'header' => [
                    'label' => __('الهيدر', 'professional-theme'),
                    'multiple' => false,
                    'edit_in_content' => false,
                ],
                'footer' => [
                    'label' => __('الفوتر', 'professional-theme'),
                    'multiple' => false,
                    'edit_in_content' => false,
                ],
                'single' => [
                    'label' => __('محتوى المقال', 'professional-theme'),
                    'multiple' => false,
                    'edit_in_content' => true,
                ],
                'archive' => [
                    'label' => __('محتوى الأرشيف', 'professional-theme'),
                    'multiple' => false,
                    'edit_in_content' => false,
                ],
            ]);
        }
    }
    
    // إضافة أنماط CSS لتصحيح مشاكل التوافق مع Elementor
    add_action('wp_enqueue_scripts', 'professional_theme_elementor_styles');
}
add_action('after_setup_theme', 'professional_theme_elementor_support');

/**
 * إضافة أنماط CSS لتصحيح مشاكل التوافق مع Elementor
 */
function professional_theme_elementor_styles() {
    if (class_exists('\\Elementor\\Plugin')) {
        wp_add_inline_style('professional-theme-style', '
            /* تصحيح مشاكل التوافق مع Elementor */
            .elementor-page .site-content {
                padding: 0;
                width: 100%;
                max-width: 100%;
            }
            .elementor-page .entry-content {
                margin: 0;
            }
            .elementor-page .site-header,
            .elementor-page .site-footer {
                z-index: 999;
            }
        ');
    }
}

/**
 * توافق مع WooCommerce
 */
function professional_theme_woocommerce_support() {
    // التحقق من وجود WooCommerce
    if (!class_exists('WooCommerce')) {
        return;
    }
    
    // إضافة دعم WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // إزالة العنوان الافتراضي من صفحة المتجر
    add_filter('woocommerce_show_page_title', '__return_false');
    
    // تخصيص عدد المنتجات في الصف
    add_filter('loop_shop_columns', 'professional_theme_woocommerce_loop_columns');
    
    // تخصيص عدد المنتجات في الصفحة
    add_filter('loop_shop_per_page', 'professional_theme_woocommerce_products_per_page');
    
    // إضافة أنماط CSS لتصحيح مشاكل التوافق مع WooCommerce
    add_action('wp_enqueue_scripts', 'professional_theme_woocommerce_styles');
    
    // تخصيص سلة التسوق المصغرة
    add_filter('woocommerce_add_to_cart_fragments', 'professional_theme_woocommerce_cart_fragments');
}
add_action('after_setup_theme', 'professional_theme_woocommerce_support');

/**
 * تخصيص عدد المنتجات في الصف
 */
function professional_theme_woocommerce_loop_columns() {
    return get_theme_mod('woocommerce_columns', 3);
}

/**
 * تخصيص عدد المنتجات في الصفحة
 */
function professional_theme_woocommerce_products_per_page() {
    return get_theme_mod('woocommerce_products_per_page', 12);
}

/**
 * إضافة أنماط CSS لتصحيح مشاكل التوافق مع WooCommerce
 */
function professional_theme_woocommerce_styles() {
    if (class_exists('WooCommerce')) {
        wp_add_inline_style('professional-theme-style', '
            /* تصحيح مشاكل التوافق مع WooCommerce */
            .woocommerce ul.products li.product .button {
                margin-top: 1em;
            }
            .woocommerce-cart table.cart img {
                width: 80px;
            }
            .woocommerce-checkout #payment {
                background: #f8f8f8;
            }
            .woocommerce-message,
            .woocommerce-info,
            .woocommerce-error {
                border-radius: 3px;
            }
        ');
    }
}

/**
 * تخصيص سلة التسوق المصغرة
 */
function professional_theme_woocommerce_cart_fragments($fragments) {
    if (class_exists('WooCommerce')) {
        ob_start();
        ?>
        <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        <?php
        $fragments['.cart-count'] = ob_get_clean();
    }
    return $fragments;
}

/**
 * توافق مع Yoast SEO
 */
function professional_theme_yoast_seo_support() {
    // التحقق من وجود Yoast SEO
    if (!defined('WPSEO_VERSION')) {
        return;
    }
    
    // إضافة دعم لمخطط البيانات المنظمة
    add_theme_support('yoast-seo-breadcrumbs');
    
    // استخدام فتات الخبز من Yoast SEO
    add_filter('professional_theme_breadcrumbs', 'professional_theme_use_yoast_breadcrumbs');
}
add_action('after_setup_theme', 'professional_theme_yoast_seo_support');

/**
 * استخدام فتات الخبز من Yoast SEO
 */
function professional_theme_use_yoast_breadcrumbs() {
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
        return true;
    }
    return false;
}

/**
 * توافق مع Contact Form 7
 */
function professional_theme_contact_form7_support() {
    // التحقق من وجود Contact Form 7
    if (!class_exists('WPCF7')) {
        return;
    }
    
    // إضافة أنماط CSS لتصحيح مشاكل التوافق مع Contact Form 7
    add_action('wp_enqueue_scripts', 'professional_theme_contact_form7_styles');
}
add_action('after_setup_theme', 'professional_theme_contact_form7_support');

/**
 * إضافة أنماط CSS لتصحيح مشاكل التوافق مع Contact Form 7
 */
function professional_theme_contact_form7_styles() {
    if (class_exists('WPCF7')) {
        wp_add_inline_style('professional-theme-style', '
            /* تصحيح مشاكل التوافق مع Contact Form 7 */
            .wpcf7-form input[type="text"],
            .wpcf7-form input[type="email"],
            .wpcf7-form input[type="url"],
            .wpcf7-form input[type="tel"],
            .wpcf7-form textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 3px;
            }
            .wpcf7-form input[type="submit"] {
                background-color: var(--primary-color, #0f766e);
                color: #fff;
                border: none;
                padding: 12px 20px;
                border-radius: 3px;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .wpcf7-form input[type="submit"]:hover {
                background-color: var(--primary-color-dark, #0b5d55);
            }
            .wpcf7-not-valid-tip {
                color: #dc3232;
                font-size: 14px;
                margin-top: 5px;
            }
            .wpcf7-response-output {
                margin: 20px 0;
                padding: 15px;
                border-radius: 3px;
            }
        ');
    }
}

/**
 * توافق مع WPML/Polylang
 */
function professional_theme_multilingual_plugins_support() {
    // التحقق من وجود WPML
    if (defined('ICL_SITEPRESS_VERSION')) {
        // إضافة دعم WPML
        add_filter('wpml_custom_field_settings', 'professional_theme_wpml_custom_fields');
    }
    
    // التحقق من وجود Polylang
    if (defined('POLYLANG_VERSION') || function_exists('pll_languages_list')) {
        // إضافة دعم Polylang
        add_action('pll_init', 'professional_theme_polylang_init');
    }
}
add_action('after_setup_theme', 'professional_theme_multilingual_plugins_support');

/**
 * إضافة دعم حقول مخصصة في WPML
 */
function professional_theme_wpml_custom_fields($settings) {
    // حقول مخصصة للترجمة
    $custom_fields = array(
        'footer_copyright_text',
        'header_tagline',
        'contact_address',
        'newsletter_heading',
        'newsletter_text',
    );
    
    foreach ($custom_fields as $field) {
        $settings[$field] = array(
            'translate' => 1, // 1 = ترجمة
            'display_as_translated' => 0, // 0 = لا تعرض كمترجم
            'data' => true, // true = بيانات
        );
    }
    
    return $settings;
}

/**
 * إضافة دعم Polylang
 */
function professional_theme_polylang_init() {
    // تسجيل السلاسل النصية للترجمة
    if (function_exists('pll_register_string')) {
        pll_register_string('footer_copyright', get_theme_mod('footer_copyright_text', ''), 'Professional Theme', true);
        pll_register_string('header_tagline', get_theme_mod('header_tagline', ''), 'Professional Theme', true);
        pll_register_string('contact_address', get_theme_mod('contact_address', ''), 'Professional Theme', true);
        pll_register_string('newsletter_heading', get_theme_mod('newsletter_heading', ''), 'Professional Theme', true);
        pll_register_string('newsletter_text', get_theme_mod('newsletter_text', ''), 'Professional Theme', true);
    }
}

/**
 * توافق مع Gutenberg
 */
function professional_theme_gutenberg_support() {
    // إضافة دعم Gutenberg
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    
    // إضافة أنماط CSS لتصحيح مشاكل التوافق مع Gutenberg
    add_action('wp_enqueue_scripts', 'professional_theme_gutenberg_styles');
    
    // إضافة أنماط محرر Gutenberg
    add_editor_style('assets/css/editor-style.css');
}
add_action('after_setup_theme', 'professional_theme_gutenberg_support');

/**
 * إضافة أنماط CSS لتصحيح مشاكل التوافق مع Gutenberg
 */
function professional_theme_gutenberg_styles() {
    wp_add_inline_style('professional-theme-style', '
        /* تصحيح مشاكل التوافق مع Gutenberg */
        .wp-block-cover,
        .wp-block-cover-image {
            margin-bottom: 1.5em;
        }
        .wp-block-button {
            margin-bottom: 1.5em;
        }
        .wp-block-table {
            margin-bottom: 1.5em;
        }
        .wp-block-image {
            margin-bottom: 1.5em;
        }
        .wp-block-quote {
            margin-bottom: 1.5em;
        }
        .wp-block-pullquote {
            margin-bottom: 1.5em;
        }
        .wp-block-media-text {
            margin-bottom: 1.5em;
        }
        .wp-block-separator {
            margin-bottom: 1.5em;
        }
        .wp-block-columns {
            margin-bottom: 1.5em;
        }
        .wp-block-group {
            margin-bottom: 1.5em;
        }
        .wp-block-gallery {
            margin-bottom: 1.5em;
        }
        .wp-block-embed {
            margin-bottom: 1.5em;
        }
    ');
}

/**
 * توافق مع Page Builders الشائعة
 */
function professional_theme_page_builders_support() {
    // توافق مع Beaver Builder
    if (class_exists('FLBuilder')) {
        add_action('wp_enqueue_scripts', 'professional_theme_beaver_builder_styles');
    }
    
    // توافق مع Divi Builder
    if (defined('ET_BUILDER_VERSION')) {
        add_action('wp_enqueue_scripts', 'professional_theme_divi_builder_styles');
    }
    
    // توافق مع Visual Composer
    if (defined('WPB_VC_VERSION')) {
        add_action('wp_enqueue_scripts', 'professional_theme_visual_composer_styles');
    }
}
add_action('after_setup_theme', 'professional_theme_page_builders_support');

/**
 * إضافة أنماط CSS لتصحيح مشاكل التوافق مع Beaver Builder
 */
function professional_theme_beaver_builder_styles() {
    wp_add_inline_style('professional-theme-style', '
        /* تصحيح مشاكل التوافق مع Beaver Builder */
        .fl-builder .site-content {
            padding: 0;
            width: 100%;
            max-width: 100%;
        }
        .fl-builder .entry-content {
            margin: 0;
        }
    ');
}

/**
 * إضافة أنماط CSS لتصحيح مشاكل التوافق مع Divi Builder
 */
function professional_theme_divi_builder_styles() {
    wp_add_inline_style('professional-theme-style', '
        /* تصحيح مشاكل التوافق مع Divi Builder */
        .et-db #et-boc .et-l .et_pb_section {
            padding: 0;
        }
        .et-db #et-boc .et-l .et_pb_row {
            padding: 0;
        }
    ');
}

/**
 * إضافة أنماط CSS لتصحيح مشاكل التوافق مع Visual Composer
 */
function professional_theme_visual_composer_styles() {
    wp_add_inline_style('professional-theme-style', '
        /* تصحيح مشاكل التوافق مع Visual Composer */
        .vc_row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        .vc_column_container > .vc_column-inner {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
    ');
}

/**
 * توافق مع المكونات الإضافية للأمان
 */
function professional_theme_security_plugins_support() {
    // توافق مع Wordfence
    if (defined('WORDFENCE_VERSION')) {
        // إضافة دعم Wordfence
    }
    
    // توافق مع iThemes Security
    if (class_exists('ITSEC_Core')) {
        // إضافة دعم iThemes Security
    }
    
    // توافق مع Sucuri
    if (defined('SUCURISCAN_VERSION')) {
        // إضافة دعم Sucuri
    }
}
add_action('after_setup_theme', 'professional_theme_security_plugins_support');

/**
 * توافق مع المكونات الإضافية للتحسين
 */
function professional_theme_optimization_plugins_support() {
    // توافق مع WP Rocket
    if (defined('WP_ROCKET_VERSION')) {
        // إضافة دعم WP Rocket
    }
    
    // توافق مع W3 Total Cache
    if (defined('W3TC')) {
        // إضافة دعم W3 Total Cache
    }
    
    // توافق مع WP Super Cache
    if (defined('WP_CACHE')) {
        // إضافة دعم WP Super Cache
    }
    
    // توافق مع Autoptimize
    if (class_exists('autoptimizeMain')) {
        // إضافة دعم Autoptimize
    }
}
add_action('after_setup_theme', 'professional_theme_optimization_plugins_support');
