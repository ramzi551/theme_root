<?php
/**
 * القالب الجزئي لمكون الشعار (Logo)
 *
 * @package ProfessionalTheme
 * @version 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // الخروج إذا تم الوصول مباشرة

$wrapper_class = isset( $args['wrapper_class'] ) ? esc_attr( $args['wrapper_class'] ) : 'site-branding';
$show_tagline = isset( $args['show_tagline'] ) ? $args['show_tagline'] : true; // الافتراضي هو إظهار الوصف

?>
<div class="<?php echo $wrapper_class; ?>">
    <?php
    if ( has_custom_logo() ) {
        echo '<div class="logo-wrapper">';
        the_custom_logo();
        echo '</div>';
    } else {
        if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php else : ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php endif;
    }
    
    if ( $show_tagline ) {
        $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
        <?php endif;
    }
    ?>
</div><!-- .<?php echo $wrapper_class; ?> -->

