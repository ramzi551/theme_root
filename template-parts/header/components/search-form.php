<?php
/**
 * القالب الجزئي لمكون نموذج البحث (Search Form)
 *
 * @package ProfessionalTheme
 * @version 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // الخروج إذا تم الوصول مباشرة

$form_id = isset( $args['form_id'] ) ? esc_attr( $args['form_id'] ) : 'header-search-form';
$input_id = isset( $args['input_id'] ) ? esc_attr( $args['input_id'] ) : 'header-search-input';
$placeholder = isset( $args['placeholder'] ) ? esc_attr( $args['placeholder'] ) : __( 'ابحث عن منتج...', 'professional-theme' );
$wrapper_class = isset( $args['wrapper_class'] ) ? esc_attr( $args['wrapper_class'] ) : 'search-form-component';
$button_text = isset( $args['button_text'] ) ? esc_html( $args['button_text'] ) : '<i class="fas fa-search"></i>'; // Default to icon

?>
<form role="search" method="get" class="<?php echo $wrapper_class; ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="<?php echo $form_id; ?>">
    <label class="screen-reader-text" for="<?php echo $input_id; ?>"><?php echo _x( 'بحث عن:', 'label', 'professional-theme' ); ?></label>
    <input type="search"
           id="<?php echo $input_id; ?>"
           class="search-field"
           placeholder="<?php echo $placeholder; ?>"
           value="<?php echo get_search_query(); ?>"
           name="s"
           title="<?php echo esc_attr_x( 'بحث عن:', 'label', 'professional-theme' ); ?>" />
    <button type="submit" class="search-submit"><?php echo $button_text; // WPCS: XSS ok. ?></button>
    <?php // Add product search hidden field if WooCommerce is active and needed ?>
    <?php if ( class_exists( 'WooCommerce' ) && get_theme_mod('search_only_products', false) ) : ?>
        <input type="hidden" name="post_type" value="product" />
    <?php endif; ?>
</form>

