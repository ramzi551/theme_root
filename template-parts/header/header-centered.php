<?php
/**
 * القالب الجزئي للهيدر المتمركز
 *
 * @package ProfessionalTheme
 * @version 2.2 - معدل لضمان عرض الأيقونات بشكل صحيح في الهيدر المتمركز فقط
 */

if ( ! defined( 'ABSPATH' ) ) exit; // الخروج إذا تم الوصول مباشرة

// --- جلب إعدادات الألوان من المخصص ---
$main_header_bg_color = get_theme_mod( 'main_header_bg_color', '#ffffff' );
$main_header_text_color = get_theme_mod( 'main_header_text_color', '#000000' );

?>

<header class="site-header header-style-centered" id="masthead" style="color: <?php echo esc_attr( $main_header_text_color ); ?>;">
    
    <?php get_template_part( 'template-parts/topbar' ); ?>

    <div class="header-mid" style="background-color: <?php echo esc_attr( $main_header_bg_color ); ?>;">
        <div class="container">
            <div class="centered-header">
                <!-- أيقونات البحث والسلة على اليسار -->
                <div class="left-icons">
                    <?php 
                    get_template_part( 'template-parts/header/components/header-icons', '', array(
                        'wrapper_class' => '',
                        'icons' => array(
                            'search'   => true,
                            'cart'     => true,
                            'account'  => false, // مهم: تحديد الأيقونات التي لا نريدها بـ false
                            'wishlist' => false  // مهم: تحديد الأيقونات التي لا نريدها بـ false
                        ),
                        'show_icon_text' => false,
                        'icon_color' => $main_header_text_color
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
                    get_template_part( 'template-parts/header/components/header-icons', '', array(
                        'wrapper_class' => '',
                        'icons' => array(
                            'search'   => false, // مهم: تحديد الأيقونات التي لا نريدها بـ false
                            'cart'     => false, // مهم: تحديد الأيقونات التي لا نريدها بـ false
                            'account'  => true,
                            'wishlist' => true
                        ),
                        'show_icon_text' => false,
                        'icon_color' => $main_header_text_color
                    ) ); 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- 4) قسم الفئات -->
    <div class="header-bot" style="background-color: <?php echo esc_attr( $main_header_bg_color ); ?>; border-top: 1px solid <?php echo esc_attr( professional_theme_adjust_brightness($main_header_bg_color, -20) ); ?>;">
        <div class="container">
            <div class="wrap">
                <button class="cat-btn" style="color: <?php echo esc_attr( $main_header_text_color ); ?>;">
                    <i class="fas fa-bars"></i><span>فئات المنتجات</span><i class="fas fa-chevron-down"></i>
                </button>
                <div class="cat-menu" style="background-color: <?php echo esc_attr( $main_header_bg_color ); ?>;">
                    <?php
                    if ( class_exists( 'WooCommerce' ) ) {
                        echo '<ul>';
                        wp_list_categories( [ 'taxonomy' => 'product_cat', 'title_li' => '', 'hide_empty' => 0 ] );
                        echo '</ul>';
                    } else {
                        echo '<ul><li><a href="#">فئة 1</a></li><li><a href="#">فئة 2</a></li></ul>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->

