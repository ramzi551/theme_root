<?php
/**
 * القالب الجزئي لهيدر المستخدم المخصص (نسخة محسنة v4.3)
 *
 * @package ProfessionalTheme
 * @version 4.3 - إزالة نموذج البحث الدائم، الاعتماد على الأيقونة والنافذة المنبثقة فقط
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// --- إعدادات الهيدر ---
$show_topbar        = get_theme_mod( 'user_header_show_topbar', true );
$header_layout      = get_theme_mod( 'user_header_layout', 'logo_left_menu_center_icons_right' );
$show_tagline       = get_theme_mod( 'user_header_show_tagline', false );
$show_menu          = get_theme_mod( 'user_header_show_menu', true );
$show_search        = get_theme_mod( 'user_header_show_search', true ); // التحكم في ظهور أيقونة البحث
$show_account       = get_theme_mod( 'user_header_show_account', true );
$show_wishlist      = get_theme_mod( 'user_header_show_wishlist', false );
$show_cart          = get_theme_mod( 'user_header_show_cart', true );
$show_custom_button = get_theme_mod( 'user_header_show_custom_button', false );
$custom_button_text = get_theme_mod( 'user_header_custom_button_text', __( 'اتصل بنا', 'professional-theme' ) );
$custom_button_link = get_theme_mod( 'user_header_custom_button_link', '#' );
$logo_position      = get_theme_mod( 'user_header_logo_position', 'left' );

// إعدادات المظهر المتقدمة
$is_sticky         = get_theme_mod( 'user_header_sticky', false );
$is_transparent    = get_theme_mod( 'user_header_transparent', false );
$show_border       = get_theme_mod( 'user_header_show_border', true );
$show_shadow       = get_theme_mod( 'user_header_show_shadow', false );
$font_size         = get_theme_mod( 'user_header_font_size', 16 );
$border_radius     = get_theme_mod( 'user_header_border_radius', 0 );
$logo_height       = get_theme_mod( 'user_logo_height', 65 );
$custom_logo_id    = get_theme_mod( 'user_header_logo' );
$custom_logo_url   = wp_get_attachment_url( $custom_logo_id );
$transparent_logo  = get_theme_mod( 'user_header_transparent_logo' );

// --- الكلاسات ---
$header_classes = ['site-header', 'header-style-user', 'header-layout-' . $header_layout];
if ( $is_sticky ) $header_classes[] = 'user-sticky-header';
if ( $is_transparent && ( is_front_page() || is_home() ) ) $header_classes[] = 'is-transparent';
if ( ! $show_border ) $header_classes[] = 'no-border';
if ( $show_shadow ) $header_classes[] = 'has-shadow';

?>

<header id="masthead" class="<?php echo esc_attr( implode( ' ', $header_classes ) ); ?>" style="font-size: <?php echo esc_attr( $font_size ); ?>px; border-radius: <?php echo esc_attr( $border_radius ); ?>px;">

    <?php if ( $show_topbar ) :
        // الكود الأصلي للشريط العلوي
        $email = get_theme_mod( 'user_header_email', 'info@example.com' );
        $phone = get_theme_mod( 'user_header_phone', '+1234567890' );
        $social_networks = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'whatsapp', 'snapchat', 'tiktok', 'telegram'];
        $social_links_html = '';
        foreach ( $social_networks as $network ) {
            $url = get_theme_mod( "user_header_social_{$network}" );
            if ( ! empty( $url ) ) {
                $social_links_html .= '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $network ) . '"><i class="fab fa-' . esc_attr( $network ) . '"></i></a>';
            }
        }
    ?>
    <div class="user-topbar">
        <div class="container">
            <div class="user-topbar-left">
               <?php if ( $email ) : ?>
                   <a href="mailto:<?php echo esc_attr( $email ); ?>" aria-label="<?php esc_attr_e('البريد الإلكتروني', 'professional-theme'); ?>"><i class="fas fa-envelope"></i></a>
               <?php endif; ?>
               <?php if ( $phone ) : ?>
                   <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" aria-label="<?php esc_attr_e('رقم الهاتف', 'professional-theme'); ?>"><i class="fas fa-phone"></i></a>
               <?php endif; ?>
            </div>
            <?php if ( ! empty( $social_links_html ) ) : ?>
            <div class="user-topbar-right social-icons">
                <?php echo $social_links_html; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="main-header-area">
        <div class="container">
            <div class="main-header-wrapper">

                <!-- الشعار -->
                <div class="site-branding logo-<?php echo esc_attr( $logo_position ); ?>">
                    <?php 
                    // الكود الأصلي للشعار
                    if ( $custom_logo_url ) {
                        echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
                        echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="custom-logo" style="max-height: ' . esc_attr( $logo_height ) . 'px;">';
                        echo '</a>';
                    } else {
                        if ( display_header_text() ) {
                            echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></h1>';
                        }
                    }
                    if ( $show_tagline && display_header_text() ) {
                        echo '<p class="site-description">' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
                    }
                    ?>
                </div>

                <?php if ( $show_menu && strpos( $header_layout, '_menu_below' ) === false ) : ?>
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="user-menu" aria-expanded="false">
                        <span class="menu-icon"></span>
                        <span class="menu-text"><?php esc_html_e( 'القائمة', 'professional-theme' ); ?></span>
                    </button>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'user-menu',
                        'container'      => false,
                        'fallback_cb'    => 'professional_theme_primary_menu_fallback',
                    ) );
                    ?>
                </nav>
                <?php endif; ?>

                <div class="header-actions">
                    <?php // ✅ عرض أيقونة البحث المنبثقة إذا كانت مفعلة ?>
                    <?php if ( $show_search ) : ?>
                    <div class="header-search-icon">
                        <?php // ✅ التأكد من استخدام الكلاس الصحيح لتشغيل النافذة المنبثقة ?>
                        <a href="#" class="icon-link icon-search search-popup-trigger" aria-label="<?php esc_attr_e( 'بحث', 'professional-theme' ); ?>"><i class="fas fa-search"></i></a>
                    </div>
                    <?php endif; ?>

                    <?php 
                    // ✅ استدعاء باقي الأيقونات (الحساب، المفضلة، السلة) 
                    get_template_part( 'template-parts/header/components/header-icons', '', array(
                        'wrapper_class' => 'header-icons-component', 
                        'icons' => array(
                            'search'   => false, // مهم: لا تستدعي أيقونة البحث هنا مرة أخرى
                            'account'  => $show_account,
                            'wishlist' => $show_wishlist,
                            'cart'     => $show_cart,
                        ),
                        'show_icon_text' => false,
                    ) ); 
                    ?>

                    <?php if ( $show_custom_button && $custom_button_text && $custom_button_link ) : ?>
                    <a href="<?php echo esc_url( $custom_button_link ); ?>" class="custom-button button">
                        <?php echo esc_html( $custom_button_text ); ?>
                    </a>
                    <?php endif; ?>
                </div>

            </div><!-- .main-header-wrapper -->
        </div>
    </div>

    <?php if ( $show_menu && strpos( $header_layout, '_menu_below' ) !== false ) : ?>
    <div class="menu-below-area">
        <div class="container">
            <nav id="site-navigation-below" class="main-navigation">
                <button class="menu-toggle" aria-controls="user-menu-below" aria-expanded="false">
                    <span class="menu-icon"></span>
                    <span class="menu-text"><?php esc_html_e( 'القائمة', 'professional-theme' ); ?></span>
                </button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'user-menu-below',
                    'container'      => false,
                    'fallback_cb'    => 'professional_theme_primary_menu_fallback',
                ) );
                ?>
            </nav>
        </div>
    </div>
    <?php endif; ?>

    <?php // ✅ الإبقاء على نافذة البحث المنبثقة المخفية ?>
    <?php if ( $show_search && get_theme_mod( 'enable_search_popup', true ) ) : ?>
    <!-- نافذة البحث المنبثقة -->
    <div class="search-popup">
        <div class="search-popup-content">
            <button class="search-close" aria-label="<?php esc_attr_e( 'إغلاق البحث', 'professional-theme' ); ?>">
                <i class="fas fa-times"></i>
            </button>
            <?php 
            // ✅ تحميل نموذج البحث هنا داخل النافذة المنبثقة
            get_template_part( 'template-parts/header/components/search-form', '', array(
                'form_id' => 'popup-search-form-user', 
                'input_id' => 'popup-search-input-user',
                'placeholder' => __( 'ابحث في الموقع...', 'professional-theme' ),
                'wrapper_class' => 'search-form-component popup-search-form',
                'button_text' => __( 'بحث', 'professional-theme' )
            ) ); 
            ?>
        </div>
    </div>
    <?php endif; ?>

</header><!-- #masthead -->

<?php
// عرض قسم الهيرو (الكود الأصلي)
if ( is_front_page() && get_theme_mod( 'user_header_show_hero', false ) ) {
    get_template_part( 'template-parts/header/hero-section' ); 
}
?>

