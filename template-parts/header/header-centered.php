<?php
/**
 * القالب الجزئي للهيدر المتمركز
 *
 * @package ProfessionalTheme
 * @version 2.3 - إضافة نافذة البحث المنبثقة وإصلاح CSS لعداد السلة
 */

if ( ! defined( 'ABSPATH' ) ) exit; // الخروج إذا تم الوصول مباشرة

// --- جلب إعدادات الألوان من المخصص ---
$main_header_bg_color = get_theme_mod( 'main_header_bg_color', '#ffffff' );
$main_header_text_color = get_theme_mod( 'main_header_text_color', '#000000' );

?>

<header class="site-header header-style-centered" id="masthead" style="color: <?php echo esc_attr( $main_header_text_color ); ?>;">
    
    <?php // get_template_part( 'template-parts/topbar' ); // تم التعليق للحفاظ على التصميم الأصلي تمامًا كما في الصور السابقة إن لم يكن موجودًا ?>

    <div class="header-mid" style="background-color: <?php echo esc_attr( $main_header_bg_color ); ?>;">
        <div class="container">
            <div class="centered-header">
                <!-- أيقونات البحث والسلة على اليسار -->
                <div class="left-icons">
                    <?php 
                    // ✅ تأكد من طلب أيقونة البحث هنا
                    get_template_part( 'template-parts/header/components/header-icons', '', array(
                        'wrapper_class' => '', // لا حاجة لكلاس إضافي هنا عادةً
                        'icons' => array(
                            'search'   => true, // عرض أيقونة البحث
                            'cart'     => true, // عرض أيقونة السلة
                            'account'  => false, 
                            'wishlist' => false  
                        ),
                        'show_icon_text' => false,
                        // 'icon_color' => $main_header_text_color // يمكن إزالة هذا إذا كان اللون يأتي من CSS
                    ) ); 
                    ?>
                </div>

                <!-- الشعار في المنتصف -->
                <?php 
                get_template_part( 'template-parts/header/components/logo', '', array(
                    'wrapper_class' => 'logo-wrapper',
                    'show_tagline' => false
                ) ); 
                ?>

                <!-- أيقونات الحساب والمفضلة على اليمين -->
                <div class="right-icons">
                    <?php 
                    // ✅ تأكد من عدم طلب أيقونة البحث هنا
                    get_template_part( 'template-parts/header/components/header-icons', '', array(
                        'wrapper_class' => '',
                        'icons' => array(
                            'search'   => false, 
                            'cart'     => false, 
                            'account'  => true, // عرض أيقونة الحساب
                            'wishlist' => true  // عرض أيقونة المفضلة
                        ),
                        'show_icon_text' => false,
                        // 'icon_color' => $main_header_text_color
                    ) ); 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php 
    // ✅ إضافة قسم الفئات إذا كان موجودًا في التصميم الأصلي
    // إذا لم يكن موجودًا، يمكن إزالة هذا القسم بالكامل
    $show_centered_categories = true; // يمكنك ربط هذا بخيار في المخصص إذا أردت
    if ($show_centered_categories && class_exists('WooCommerce')) : 
    ?>
    <!-- قسم الفئات -->
    <div class="header-bot" style="background-color: <?php echo esc_attr( $main_header_bg_color ); ?>; border-top: 1px solid <?php echo esc_attr( professional_theme_adjust_brightness($main_header_bg_color, -20) ); ?>;">
        <div class="wrap centered-menu-wrap">
    <div class="centered-categories">
        <button class="cat-btn" aria-expanded="false" aria-controls="centered-cat-menu">
            <i class="fas fa-bars"></i>
            <span><?php esc_html_e('فئات المنتجات', 'professional-theme'); ?></span>
            <i class="fas fa-chevron-down"></i>
        </button>
        <div class="cat-menu" id="centered-cat-menu">
            <?php
                echo '<ul>';
                wp_list_categories( [ 'taxonomy' => 'product_cat', 'title_li' => '', 'hide_empty' => 0 ] );
                echo '</ul>';
            ?>
        </div>
    </div>

    <?php if ( has_nav_menu( 'centered_top_menu' ) ) : ?>
        <nav class="main-navigation centered-menu" aria-label="<?php esc_attr_e('القائمة الرئيسية', 'professional-theme'); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'centered_top_menu',
                'menu_class'     => 'centered-menu-items',
                'container'      => false,
                'depth'          => 2,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>
    <?php endif; ?>
</div>
    </div>
    <?php endif; ?>

    <?php // ✅ إضافة نافذة البحث المنبثقة هنا (نفس الكود الموجود في header-classic.php) ?>
    <?php if ( get_theme_mod( 'enable_search_popup', true ) ) : ?>
    <!-- نافذة البحث المنبثقة -->
    <div class="search-popup">
        <div class="search-popup-content">
            <button class="search-close" aria-label="<?php esc_attr_e( 'إغلاق البحث', 'professional-theme' ); ?>">
                <i class="fas fa-times"></i>
            </button>
            <?php 
            // تحميل مكون نموذج البحث
            get_template_part( 'template-parts/header/components/search-form', '', array(
                'form_id' => 'popup-search-form-centered', // يمكن استخدام ID مختلف إذا أردت
                'input_id' => 'popup-search-input-centered',
                'placeholder' => __( 'ابحث في الموقع...', 'professional-theme' ),
                'wrapper_class' => 'search-form-component popup-search-form',
                'button_text' => __( 'بحث', 'professional-theme' )
            ) ); 
            ?>
        </div>
    </div>
    <?php endif; ?>

</header><!-- #masthead -->

<?php // ✅ إضافة CSS مخصص لإصلاح تموضع عداد السلة في هذا الهيدر فقط ?>
<style>
.header-style-centered .left-icons .icon-link.icon-cart {
    position: relative; /* ضروري لتموضع العداد بشكل صحيح */
}
.header-style-centered .left-icons .icon-link.icon-cart .cart-count {
    position: absolute;
    top: -8px; 
    right: -8px; /* الافتراضي LTR */
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 10px;
    line-height: 1;
    display: inline-block;
    min-width: 18px;
    text-align: center;
    z-index: 1; 
}
/* دعم RTL */
body.rtl .header-style-centered .left-icons .icon-link.icon-cart .cart-count {
    right: auto; 
    left: -8px;  
}
/* تأكد من أن أيقونة البحث لا تتأثر */
.header-style-centered .left-icons .icon-link.icon-search .cart-count {
    display: none; /* إخفاء العداد إذا ظهر خطأً على أيقونة البحث */
}
</style>

