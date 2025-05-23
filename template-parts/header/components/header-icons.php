<?php
/**
 * القالب الجزئي لمكون أيقونات الهيدر (Header Icons)
 *
 * @package ProfessionalTheme
 * @version 2.1 - معدل لعرض الأيقونات دائمًا
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ألوان مخصصة مباشرة داخل الصفحة
echo '<style>
.header-icons-component .icon-link {
  background: none !important;
  box-shadow: none !important;
  width: auto !important;
  height: auto !important;
  padding: 0;
}

.icon-link.icon-cart i     { color: #f97316; }  /* برتقالي */
.icon-link.icon-wishlist i { color: #e91e63; }  /* وردي */
.icon-link.icon-account i  { color: #10b981; }  /* أخضر */
.icon-link.icon-search i   { color: #2563eb; }  /* أزرق */

.header-icons-component .icon-link:hover i {
  opacity: 0.8;
  transform: scale(1.1);
}
</style>';

// الإعدادات الافتراضية
$default_icons = [
    'search'   => true,
    'account'  => true,
    'wishlist' => true,
    'cart'     => true
];

$icons_to_show = isset( $args['icons'] ) ? wp_parse_args( $args['icons'], $default_icons ) : $default_icons;
$wrapper_class = isset( $args['wrapper_class'] ) ? esc_attr( $args['wrapper_class'] ) : 'header-icons-component';
$show_text     = isset( $args['show_icon_text'] ) && $args['show_icon_text'];

$account_url  = function_exists('wc_get_page_permalink') ? wc_get_page_permalink( 'myaccount' ) : '#';
$wishlist_url = class_exists( 'YITH_WCWL' ) ? YITH_WCWL()->get_wishlist_url() : '#';
$cart_url     = function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#';
$search_url   = '#';
$search_trigger_class = 'search-popup-trigger';

// ✅ إخفاء أيقونة البحث في الهيدر الحديث فقط
$active_header_style = get_theme_mod( 'header_style', 'classic' );
if ( $active_header_style === 'modern' ) {
    $icons_to_show['search'] = false;
}
?>

<div class="<?php echo $wrapper_class; ?>">

    <?php if ( $icons_to_show['search'] ) : ?>
        <a href="<?php echo esc_url( $search_url ); ?>" class="icon-link icon-search <?php echo esc_attr( $search_trigger_class ); ?>" aria-label="<?php esc_attr_e( 'بحث', 'professional-theme' ); ?>">
            <i class="fas fa-search"></i>
            <?php if ( $show_text ) : ?><span class="icon-text"><?php esc_html_e( 'بحث', 'professional-theme' ); ?></span><?php endif; ?>
        </a>
    <?php endif; ?>

    <?php if ( $icons_to_show['account'] ) : ?>
        <a href="<?php echo esc_url( $account_url ); ?>" class="icon-link icon-account" aria-label="<?php esc_attr_e( 'حسابي', 'professional-theme' ); ?>">
            <i class="fas fa-user"></i>
            <?php if ( $show_text ) : ?><span class="icon-text"><?php esc_html_e( 'حسابي', 'professional-theme' ); ?></span><?php endif; ?>
        </a>
    <?php endif; ?>

    <?php if ( $icons_to_show['wishlist'] ) : ?>
        <a href="<?php echo esc_url( $wishlist_url ); ?>" class="icon-link icon-wishlist" aria-label="<?php esc_attr_e( 'المفضلة', 'professional-theme' ); ?>">
            <i class="fas fa-heart"></i>
            <?php if ( $show_text ) : ?><span class="icon-text"><?php esc_html_e( 'المفضلة', 'professional-theme' ); ?></span><?php endif; ?>
        </a>
    <?php endif; ?>

    <?php if ( $icons_to_show['cart'] ) : ?>
        <a href="<?php echo esc_url( $cart_url ); ?>" class="icon-link icon-cart" aria-label="<?php esc_attr_e( 'سلة التسوق', 'professional-theme' ); ?>">
            <i class="fas fa-shopping-cart"></i>
            <?php if ( $show_text ) : ?><span class="icon-text"><?php esc_html_e( 'السلة', 'professional-theme' ); ?></span><?php endif; ?>
            <?php if ( function_exists('WC') && WC()->cart ) : ?>
                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            <?php endif; ?>
        </a>
    <?php endif; ?>

</div>
