<?php
/**
 * القالب الجزئي للهيدر الكلاسيكي
 *
 * @package ProfessionalTheme
 * @version 2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // الخروج إذا تم الوصول مباشرة

$main_header_bg_color = get_theme_mod( 'main_header_bg_color', '#ffffff' );
$main_header_text_color = get_theme_mod( 'main_header_text_color', '#000000' );

?>

<header class="site-header header-style-classic" id="masthead" style="background-color: <?php echo esc_attr( $main_header_bg_color ); ?>; color: <?php echo esc_attr( $main_header_text_color ); ?>;">
    <div class="container">
        <div class="header-wrapper">
            <?php 
            // تحميل مكون الشعار
            get_template_part( 'template-parts/header/components/logo', '', array(
                'wrapper_class' => 'site-branding',
                'show_tagline' => true
            ) ); 
            ?>

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-icon"></span>
                </button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'professional_theme_primary_menu_fallback',
                ) );
                ?>
            </nav><!-- #site-navigation -->

            <?php 
            // تحميل مكون أيقونات الهيدر
            get_template_part( 'template-parts/header/components/header-icons', '', array(
                'wrapper_class' => 'header-icons-component',
                'icons' => array(
                    'search' => true,
                    'account' => true,
                    'wishlist' => true,
                    'cart' => true
                ),
                'show_icon_text' => false
            ) ); 
            ?>
        </div>
    </div>

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
                'form_id' => 'popup-search-form',
                'input_id' => 'popup-search-input',
                'placeholder' => __( 'ابحث في الموقع...', 'professional-theme' ),
                'wrapper_class' => 'search-form-component popup-search-form',
                'button_text' => __( 'بحث', 'professional-theme' )
            ) ); 
            ?>
        </div>
    </div>
    <?php endif; ?>
</header><!-- #masthead -->
