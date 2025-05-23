<?php
/**
 * القالب الجزئي لهيدر المستخدم المخصص (نسخة محسنة v4.1)
 *
 * @package ProfessionalTheme
 * @version 4.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// --- إعدادات الهيدر ---
$show_topbar        = get_theme_mod( 'user_header_show_topbar', true );
$header_layout      = get_theme_mod( 'user_header_layout', 'logo_left_menu_center_icons_right' );
$show_tagline       = get_theme_mod( 'user_header_show_tagline', false );
$show_menu          = get_theme_mod( 'user_header_show_menu', true );
$show_search        = get_theme_mod( 'user_header_show_search', true );
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
    <a href="mailto:<?php echo esc_attr( $email ); ?>" aria-label="البريد الإلكتروني"><i class="fas fa-envelope"></i></a>
<?php endif; ?>
<?php if ( $phone ) : ?>
    <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" aria-label="رقم الهاتف"><i class="fas fa-phone"></i></a>
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
                    <?php if ( $custom_logo_url ) : ?>
                        <img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="Logo" class="custom-logo" style="max-height: <?php echo esc_attr( $logo_height ); ?>px;">
                    <?php endif; ?>
                    <?php if ( $show_tagline ) : ?>
                        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                    <?php endif; ?>
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
                    <?php if ( $show_search ) : ?>
                    <div class="header-search-icon">
                        <a href="#" class="search-toggle" aria-label="<?php esc_attr_e( 'فتح البحث', 'professional-theme' ); ?>"><i class="fas fa-search"></i></a>
                    </div>
                    <?php endif; ?>

                    <?php get_template_part( 'template-parts/header/components/header-icons', '', array(
                        'wrapper_class' => 'header-icons-component',
                        'icons' => array(
                            'search'   => false,
                            'account'  => $show_account,
                            'wishlist' => $show_wishlist,
                            'cart'     => $show_cart,
                        ),
                        'show_icon_text' => false,
                    ) ); ?>

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

    <?php if ( get_theme_mod( 'enable_search_popup', true ) ) : ?>
    <div class="search-popup-overlay" style="display: none;">
        <div class="search-popup-content">
            <button class="close-search-popup" aria-label="<?php esc_attr_e( 'إغلاق البحث', 'professional-theme' ); ?>">&times;</button>
            <?php get_search_form(); ?>
        </div>
    </div>
    <?php endif; ?>

</header>

<?php
// عرض قسم الهيرو فقط إذا كان مفعلاً من إعدادات التخصيص **وكانت هذه هي الصفحة الرئيسية**
if ( is_front_page() && get_theme_mod( 'user_header_show_hero', false ) ) {
    // يمكنك أيضًا إضافة شرط WooCommerce هنا إذا أردت:
    // if ( is_front_page() && class_exists('WooCommerce') && get_theme_mod( 'user_header_show_hero', false ) ) {
    get_template_part( 'template-parts/header/hero-section' ); // هذا يستدعي نفس ملف الهيرو العام
                                                                // إذا كان لديك ملف هيرو مختلف لهيدر المستخدم، استدعه هنا
                                                                // مثلاً: get_template_part( 'template-parts/header/hero', 'user-specific' );
}
?>
