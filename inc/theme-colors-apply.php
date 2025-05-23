<?php
/**
 * تطبيق نظام الألوان المتكامل
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة CSS ديناميكي لنظام الألوان بناءً على إعدادات التخصيص
 */
function professional_theme_colors_dynamic_css() {
    // الألوان الأساسية
    $primary_color = get_theme_mod('primary_color', '#0f766e');
    $secondary_color = get_theme_mod('secondary_color', '#64748b');
    $accent_color = get_theme_mod('accent_color', '#f59e0b');
    $text_color = get_theme_mod('text_color', '#333333');
    $background_color = get_theme_mod('background_color', '#ffffff');
    
    // ألوان الأزرار
    $button_primary_color = get_theme_mod('button_primary_color', $primary_color);
    $button_primary_text_color = get_theme_mod('button_primary_text_color', '#ffffff');
    $button_secondary_color = get_theme_mod('button_secondary_color', $secondary_color);
    $button_secondary_text_color = get_theme_mod('button_secondary_text_color', '#ffffff');
    
    // ألوان المتجر
    $shop_button_color = get_theme_mod('shop_button_color', $primary_color);
    $shop_button_text_color = get_theme_mod('shop_button_text_color', '#ffffff');
    $shop_price_color = get_theme_mod('shop_price_color', '#0f766e');
    $shop_sale_price_color = get_theme_mod('shop_sale_price_color', '#dc2626');
    $shop_sale_badge_color = get_theme_mod('shop_sale_badge_color', '#dc2626');
    
    // تطبيق الألوان على العناصر
    ?>
    <style type="text/css">
        /* الألوان الأساسية */
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --accent-color: <?php echo esc_attr($accent_color); ?>;
            --text-color: <?php echo esc_attr($text_color); ?>;
            --background-color: <?php echo esc_attr($background_color); ?>;
            --button-primary-color: <?php echo esc_attr($button_primary_color); ?>;
            --button-primary-text-color: <?php echo esc_attr($button_primary_text_color); ?>;
            --button-secondary-color: <?php echo esc_attr($button_secondary_color); ?>;
            --button-secondary-text-color: <?php echo esc_attr($button_secondary_text_color); ?>;
            --shop-button-color: <?php echo esc_attr($shop_button_color); ?>;
            --shop-button-text-color: <?php echo esc_attr($shop_button_text_color); ?>;
            --shop-price-color: <?php echo esc_attr($shop_price_color); ?>;
            --shop-sale-price-color: <?php echo esc_attr($shop_sale_price_color); ?>;
            --shop-sale-badge-color: <?php echo esc_attr($shop_sale_badge_color); ?>;
        }
        
        body {
            color: <?php echo esc_attr($text_color); ?>;
            background-color: <?php echo esc_attr($background_color); ?>;
        }
        
        a {
            color: <?php echo esc_attr($primary_color); ?>;
        }
        
        a:hover, a:focus {
            color: <?php echo esc_attr(professional_theme_darken_color($primary_color, 20)); ?>;
        }
        
        .accent-color, .entry-meta .cat-links a, .entry-meta .tags-links a {
            color: <?php echo esc_attr($accent_color); ?>;
        }
        
        .bg-primary {
            background-color: <?php echo esc_attr($primary_color); ?>;
            color: #ffffff;
        }
        
        .bg-secondary {
            background-color: <?php echo esc_attr($secondary_color); ?>;
            color: #ffffff;
        }
        
        .bg-accent {
            background-color: <?php echo esc_attr($accent_color); ?>;
            color: #ffffff;
        }
        
        /* ألوان الأزرار */
        .btn-primary, 
        .button.button-primary,
        button.primary,
        input[type="button"].primary,
        input[type="submit"].primary {
            background-color: <?php echo esc_attr($button_primary_color); ?>;
            color: <?php echo esc_attr($button_primary_text_color); ?>;
            border-color: <?php echo esc_attr($button_primary_color); ?>;
        }
        
        .btn-primary:hover, 
        .button.button-primary:hover,
        button.primary:hover,
        input[type="button"].primary:hover,
        input[type="submit"].primary:hover {
            background-color: <?php echo esc_attr(professional_theme_darken_color($button_primary_color, 10)); ?>;
            border-color: <?php echo esc_attr(professional_theme_darken_color($button_primary_color, 10)); ?>;
        }
        
        .btn-secondary, 
        .button.button-secondary,
        button.secondary,
        input[type="button"].secondary,
        input[type="submit"].secondary {
            background-color: <?php echo esc_attr($button_secondary_color); ?>;
            color: <?php echo esc_attr($button_secondary_text_color); ?>;
            border-color: <?php echo esc_attr($button_secondary_color); ?>;
        }
        
        .btn-secondary:hover, 
        .button.button-secondary:hover,
        button.secondary:hover,
        input[type="button"].secondary:hover,
        input[type="submit"].secondary:hover {
            background-color: <?php echo esc_attr(professional_theme_darken_color($button_secondary_color, 10)); ?>;
            border-color: <?php echo esc_attr(professional_theme_darken_color($button_secondary_color, 10)); ?>;
        }
        
        /* ألوان المتجر */
        .woocommerce #respond input#submit, 
        .woocommerce a.button, 
        .woocommerce button.button, 
        .woocommerce input.button,
        .woocommerce #respond input#submit.alt, 
        .woocommerce a.button.alt, 
        .woocommerce button.button.alt, 
        .woocommerce input.button.alt {
            background-color: <?php echo esc_attr($shop_button_color); ?>;
            color: <?php echo esc_attr($shop_button_text_color); ?>;
        }
        
        .woocommerce #respond input#submit:hover, 
        .woocommerce a.button:hover, 
        .woocommerce button.button:hover, 
        .woocommerce input.button:hover,
        .woocommerce #respond input#submit.alt:hover, 
        .woocommerce a.button.alt:hover, 
        .woocommerce button.button.alt:hover, 
        .woocommerce input.button.alt:hover {
            background-color: <?php echo esc_attr(professional_theme_darken_color($shop_button_color, 10)); ?>;
            color: <?php echo esc_attr($shop_button_text_color); ?>;
        }
        
        .woocommerce div.product p.price, 
        .woocommerce div.product span.price,
        .woocommerce ul.products li.product .price {
            color: <?php echo esc_attr($shop_price_color); ?>;
        }
        
        .woocommerce div.product p.price del, 
        .woocommerce div.product span.price del,
        .woocommerce ul.products li.product .price del {
            color: <?php echo esc_attr($shop_sale_price_color); ?>;
        }
        
        .woocommerce span.onsale {
            background-color: <?php echo esc_attr($shop_sale_badge_color); ?>;
            color: #ffffff;
        }
        
        /* تخطيط المتجر */
        <?php
        $shop_layout = get_theme_mod('shop_page_layout', 'sidebar-right');
        
        if ($shop_layout === 'sidebar-right') {
            ?>
            .woocommerce-page.shop-layout-sidebar-right #primary {
                float: left;
                width: 70%;
            }
            .woocommerce-page.shop-layout-sidebar-right #secondary {
                float: right;
                width: 25%;
            }
            <?php
        } elseif ($shop_layout === 'sidebar-left') {
            ?>
            .woocommerce-page.shop-layout-sidebar-left #primary {
                float: right;
                width: 70%;
            }
            .woocommerce-page.shop-layout-sidebar-left #secondary {
                float: left;
                width: 25%;
            }
            <?php
        } elseif ($shop_layout === 'full-width') {
            ?>
            .woocommerce-page.shop-layout-full-width #primary {
                width: 100%;
            }
            .woocommerce-page.shop-layout-full-width #secondary {
                display: none;
            }
            <?php
        }
        
        // تخطيط صفحة المنتج
        $product_layout = get_theme_mod('product_page_layout', 'standard');
        
        if ($product_layout === 'full-width') {
            ?>
            .single-product.product-layout-full-width .product {
                max-width: 100%;
            }
            .single-product.product-layout-full-width .product .summary {
                padding: 0 30px;
            }
            <?php
        } elseif ($product_layout === 'sticky-info') {
            ?>
            .single-product.product-layout-sticky-info .product .summary {
                position: sticky;
                top: 30px;
            }
            <?php
        } elseif ($product_layout === 'gallery-left') {
            ?>
            .single-product.product-layout-gallery-left .product {
                display: flex;
                flex-wrap: wrap;
            }
            .single-product.product-layout-gallery-left .product .woocommerce-product-gallery {
                float: left;
                width: 55%;
            }
            .single-product.product-layout-gallery-left .product .summary {
                float: right;
                width: 40%;
            }
            <?php
        }
        ?>
        
        /* تخطيط صفحة الدفع */
        <?php
        $checkout_layout = get_theme_mod('checkout_layout', 'two-column');
        
        if ($checkout_layout === 'two-column') {
            ?>
            .woocommerce-checkout.checkout-layout-two-column .col2-set {
                width: 58%;
                float: left;
                margin-right: 4%;
            }
            .woocommerce-checkout.checkout-layout-two-column #order_review_heading,
            .woocommerce-checkout.checkout-layout-two-column #order_review {
                width: 38%;
                float: right;
                margin-right: 0;
            }
            @media (max-width: 768px) {
                .woocommerce-checkout.checkout-layout-two-column .col2-set,
                .woocommerce-checkout.checkout-layout-two-column #order_review_heading,
                .woocommerce-checkout.checkout-layout-two-column #order_review {
                    width: 100%;
                    float: none;
                }
            }
            <?php
        }
        ?>
        
        /* الخطوط */
        <?php
        $headings_font = get_theme_mod('headings_font_family', 'Cairo');
        $body_font = get_theme_mod('body_font_family', 'Cairo');
        $base_font_size = get_theme_mod('base_font_size', '16');
        $headings_weight = get_theme_mod('headings_font_weight', '700');
        $body_weight = get_theme_mod('body_font_weight', '400');
        ?>
        
        body {
            font-family: '<?php echo esc_attr($body_font); ?>', sans-serif;
            font-weight: <?php echo esc_attr($body_weight); ?>;
            font-size: <?php echo esc_attr($base_font_size); ?>px;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: '<?php echo esc_attr($headings_font); ?>', sans-serif;
            font-weight: <?php echo esc_attr($headings_weight); ?>;
            color: <?php echo esc_attr($text_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'professional_theme_colors_dynamic_css', 20);
