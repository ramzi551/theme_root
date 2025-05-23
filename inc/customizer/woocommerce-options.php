<?php
/**
 * خيارات WooCommerce المتقدمة
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة خيارات WooCommerce المتقدمة إلى لوحة تخصيص ووردبرس
 */
function professional_theme_woocommerce_options($wp_customize) {
    
    // التأكد من أن WooCommerce مثبت
    if (!class_exists('WooCommerce')) {
        return;
    }
    
    // ===== لوحة إعدادات المتجر =====
    $wp_customize->add_panel('professional_theme_woocommerce_panel', array(
        'title'       => __('إعدادات المتجر المتقدمة', 'professional-theme'),
        'description' => __('تخصيص إعدادات المتجر وصفحات المنتجات.', 'professional-theme'),
        'priority'    => 40,
    ));

    // ===== 1. إعدادات صفحة المنتجات =====
    $wp_customize->add_section('professional_theme_product_page', array(
        'title'       => __('صفحة المنتج الواحد', 'professional-theme'),
        'description' => __('تخصيص تخطيط وعناصر صفحة المنتج الواحد.', 'professional-theme'),
        'panel'       => 'professional_theme_woocommerce_panel',
        'priority'    => 10,
    ));

    // تخطيط صفحة المنتج
    $wp_customize->add_setting('product_page_layout', array(
        'default'           => 'standard',
        'sanitize_callback' => 'professional_theme_sanitize_select',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('product_page_layout', array(
        'label'       => __('تخطيط صفحة المنتج', 'professional-theme'),
        'description' => __('اختر تخطيط صفحة المنتج الواحد.', 'professional-theme'),
        'section'     => 'professional_theme_product_page',
        'type'        => 'select',
        'choices'     => array(
            'standard'     => __('قياسي', 'professional-theme'),
            'full-width'   => __('عرض كامل', 'professional-theme'),
            'sticky-info'  => __('معلومات ثابتة', 'professional-theme'),
            'gallery-left' => __('معرض الصور يسار', 'professional-theme'),
        ),
        'priority'    => 10,
    ));

    // إظهار شريط التبويب
    $wp_customize->add_setting('product_tabs_display', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('product_tabs_display', array(
        'label'       => __('إظهار شريط التبويب', 'professional-theme'),
        'description' => __('إظهار شريط التبويب (الوصف، المراجعات، معلومات إضافية).', 'professional-theme'),
        'section'     => 'professional_theme_product_page',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));

    // إظهار المنتجات ذات الصلة
    $wp_customize->add_setting('related_products_display', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('related_products_display', array(
        'label'       => __('إظهار المنتجات ذات الصلة', 'professional-theme'),
        'description' => __('إظهار قسم المنتجات ذات الصلة في صفحة المنتج.', 'professional-theme'),
        'section'     => 'professional_theme_product_page',
        'type'        => 'checkbox',
        'priority'    => 30,
    ));

    // عدد المنتجات ذات الصلة
    $wp_customize->add_setting('related_products_count', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('related_products_count', array(
        'label'       => __('عدد المنتجات ذات الصلة', 'professional-theme'),
        'description' => __('عدد المنتجات التي تظهر في قسم المنتجات ذات الصلة.', 'professional-theme'),
        'section'     => 'professional_theme_product_page',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 12,
            'step' => 1,
        ),
        'priority'    => 40,
    ));

    // ===== 2. إعدادات صفحة أرشيف المنتجات =====
    $wp_customize->add_section('professional_theme_shop_page', array(
        'title'       => __('صفحة المتجر', 'professional-theme'),
        'description' => __('تخصيص تخطيط وعناصر صفحة المتجر (أرشيف المنتجات).', 'professional-theme'),
        'panel'       => 'professional_theme_woocommerce_panel',
        'priority'    => 20,
    ));

    // تخطيط صفحة المتجر
    $wp_customize->add_setting('shop_page_layout', array(
        'default'           => 'sidebar-right',
        'sanitize_callback' => 'professional_theme_sanitize_select',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('shop_page_layout', array(
        'label'       => __('تخطيط صفحة المتجر', 'professional-theme'),
        'description' => __('اختر تخطيط صفحة المتجر.', 'professional-theme'),
        'section'     => 'professional_theme_shop_page',
        'type'        => 'select',
        'choices'     => array(
            'sidebar-right' => __('سايدبار يمين', 'professional-theme'),
            'sidebar-left'  => __('سايدبار يسار', 'professional-theme'),
            'full-width'    => __('عرض كامل', 'professional-theme'),
        ),
        'priority'    => 10,
    ));

    // عدد المنتجات في الصف
    $wp_customize->add_setting('products_per_row', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('products_per_row', array(
        'label'       => __('عدد المنتجات في الصف', 'professional-theme'),
        'description' => __('عدد المنتجات التي تظهر في كل صف.', 'professional-theme'),
        'section'     => 'professional_theme_shop_page',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 2,
            'max'  => 6,
            'step' => 1,
        ),
        'priority'    => 20,
    ));

    // عدد المنتجات في الصفحة
    $wp_customize->add_setting('products_per_page', array(
        'default'           => 12,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('products_per_page', array(
        'label'       => __('عدد المنتجات في الصفحة', 'professional-theme'),
        'description' => __('عدد المنتجات التي تظهر في كل صفحة.', 'professional-theme'),
        'section'     => 'professional_theme_shop_page',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 4,
            'max'  => 48,
            'step' => 4,
        ),
        'priority'    => 30,
    ));

    // إظهار فلاتر المنتجات
    $wp_customize->add_setting('show_product_filters', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('show_product_filters', array(
        'label'       => __('إظهار فلاتر المنتجات', 'professional-theme'),
        'description' => __('إظهار فلاتر المنتجات في صفحة المتجر.', 'professional-theme'),
        'section'     => 'professional_theme_shop_page',
        'type'        => 'checkbox',
        'priority'    => 40,
    ));

    // ===== 3. إعدادات السلة وصفحة الدفع =====
    $wp_customize->add_section('professional_theme_cart_checkout', array(
        'title'       => __('السلة وصفحة الدفع', 'professional-theme'),
        'description' => __('تخصيص صفحات السلة والدفع.', 'professional-theme'),
        'panel'       => 'professional_theme_woocommerce_panel',
        'priority'    => 30,
    ));

    // تفعيل AJAX للسلة
    $wp_customize->add_setting('enable_ajax_add_to_cart', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_ajax_add_to_cart', array(
        'label'       => __('تفعيل AJAX للإضافة إلى السلة', 'professional-theme'),
        'description' => __('إضافة المنتجات إلى السلة بدون إعادة تحميل الصفحة.', 'professional-theme'),
        'section'     => 'professional_theme_cart_checkout',
        'type'        => 'checkbox',
        'priority'    => 10,
    ));

    // تفعيل تحديث السلة المباشر
    $wp_customize->add_setting('enable_cart_auto_update', array(
        'default'           => true,
        'sanitize_callback' => 'professional_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('enable_cart_auto_update', array(
        'label'       => __('تفعيل تحديث السلة المباشر', 'professional-theme'),
        'description' => __('تحديث السلة مباشرة عند تغيير الكميات.', 'professional-theme'),
        'section'     => 'professional_theme_cart_checkout',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));

    // تخطيط صفحة الدفع
    $wp_customize->add_setting('checkout_layout', array(
        'default'           => 'two-column',
        'sanitize_callback' => 'professional_theme_sanitize_select',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('checkout_layout', array(
        'label'       => __('تخطيط صفحة الدفع', 'professional-theme'),
        'description' => __('اختر تخطيط صفحة الدفع.', 'professional-theme'),
        'section'     => 'professional_theme_cart_checkout',
        'type'        => 'select',
        'choices'     => array(
            'one-column'  => __('عمود واحد', 'professional-theme'),
            'two-column'  => __('عمودان', 'professional-theme'),
        ),
        'priority'    => 30,
    ));
}
