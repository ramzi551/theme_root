<?php
/**
 * تحسينات WooCommerce
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * تعديل عدد المنتجات في الصفحة
 */
function professional_theme_products_per_page($cols) {
    $products_per_page = get_theme_mod('products_per_page', 12);
    return $products_per_page;
}
add_filter('loop_shop_per_page', 'professional_theme_products_per_page', 20);

/**
 * إخفاء/إظهار شريط التبويب في صفحة المنتج
 */
function professional_theme_product_tabs($tabs) {
    if (!get_theme_mod('product_tabs_display', true)) {
        return array();
    }
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'professional_theme_product_tabs');

/**
 * تخصيص عدد المنتجات ذات الصلة
 */
function professional_theme_related_products_args($args) {
    if (get_theme_mod('related_products_display', true)) {
        $args['posts_per_page'] = get_theme_mod('related_products_count', 4);
    } else {
        $args['posts_per_page'] = 0;
    }
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'professional_theme_related_products_args');

/**
 * تفعيل AJAX للإضافة إلى السلة
 */
function professional_theme_enable_ajax_add_to_cart() {
    if (get_theme_mod('enable_ajax_add_to_cart', true)) {
        wp_enqueue_script('wc-add-to-cart');
    }
}
add_action('wp_enqueue_scripts', 'professional_theme_enable_ajax_add_to_cart');

/**
 * تفعيل تحديث السلة المباشر
 */
function professional_theme_cart_update_script() {
    if (is_cart() && get_theme_mod('enable_cart_auto_update', true)) {
        ?>
        <script type="text/javascript">
        jQuery(function($) {
            // تحديث السلة عند تغيير الكمية
            $('.woocommerce').on('change', 'input.qty', function() {
                $('[name="update_cart"]').trigger('click');
            });
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'professional_theme_cart_update_script');

/**
 * إضافة كلاسات CSS لتخطيط صفحة المتجر
 */
function professional_theme_shop_layout_classes($classes) {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $shop_layout = get_theme_mod('shop_page_layout', 'sidebar-right');
        $classes[] = 'shop-layout-' . sanitize_html_class($shop_layout);
    }
    
    if (is_product()) {
        $product_layout = get_theme_mod('product_page_layout', 'standard');
        $classes[] = 'product-layout-' . sanitize_html_class($product_layout);
    }
    
    if (is_checkout()) {
        $checkout_layout = get_theme_mod('checkout_layout', 'two-column');
        $classes[] = 'checkout-layout-' . sanitize_html_class($checkout_layout);
    }
    
    return $classes;
}
add_filter('body_class', 'professional_theme_shop_layout_classes');

/**
 * إضافة فلاتر المنتجات
 */
function professional_theme_product_filters() {
    if (!get_theme_mod('show_product_filters', true)) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    }
}
add_action('wp', 'professional_theme_product_filters');

/**
 * تخصيص تخطيط صفحة الدفع
 */
function professional_theme_checkout_layout() {
    if (is_checkout() && get_theme_mod('checkout_layout', 'two-column') === 'two-column') {
        ?>
        <style type="text/css">
            .woocommerce-checkout {
                display: flex;
                flex-wrap: wrap;
            }
            .woocommerce-checkout .col2-set {
                width: 60%;
                padding-right: 30px;
            }
            .woocommerce-checkout #order_review_heading,
            .woocommerce-checkout #order_review {
                width: 40%;
            }
            @media (max-width: 992px) {
                .woocommerce-checkout .col2-set,
                .woocommerce-checkout #order_review_heading,
                .woocommerce-checkout #order_review {
                    width: 100%;
                    padding-right: 0;
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'professional_theme_checkout_layout');

/**
 * تخصيص عدد المنتجات في الصف
 */
function professional_theme_products_per_row_css() {
    if (!is_shop() && !is_product_category() && !is_product_tag()) {
        return;
    }
    
    $products_per_row = get_theme_mod('products_per_row', 4);
    ?>
    <style type="text/css">
        .woocommerce ul.products li.product,
        .woocommerce-page ul.products li.product {
            width: calc((100% - <?php echo (($products_per_row - 1) * 30); ?>px) / <?php echo $products_per_row; ?>);
            margin-right: 30px;
        }
        .woocommerce ul.products li.product:nth-child(<?php echo $products_per_row; ?>n),
        .woocommerce-page ul.products li.product:nth-child(<?php echo $products_per_row; ?>n) {
            margin-right: 0;
        }
        @media (max-width: 992px) {
            .woocommerce ul.products li.product,
            .woocommerce-page ul.products li.product {
                width: calc((100% - 30px) / 2);
            }
            .woocommerce ul.products li.product:nth-child(2n),
            .woocommerce-page ul.products li.product:nth-child(2n) {
                margin-right: 0;
            }
            .woocommerce ul.products li.product:nth-child(<?php echo $products_per_row; ?>n),
            .woocommerce-page ul.products li.product:nth-child(<?php echo $products_per_row; ?>n) {
                margin-right: 30px;
            }
            .woocommerce ul.products li.product:nth-child(2n),
            .woocommerce-page ul.products li.product:nth-child(2n) {
                margin-right: 0;
            }
        }
        @media (max-width: 768px) {
            .woocommerce ul.products li.product,
            .woocommerce-page ul.products li.product {
                width: 100%;
                margin-right: 0;
            }
        }
    </style>
    <?php
}
add_action('wp_head', 'professional_theme_products_per_row_css');
