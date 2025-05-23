<?php
/**
 * قالب تذييل الموقع (الفوتر)
 *
 * @package ProfessionalTheme
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1) الحصول على نمط الفوتر وخيار الإظهار
$footer_style     = get_theme_mod( 'footer_style', 'standard' );
$footer_show_menu = get_theme_mod( 'footer_show_menu', true );

// 2) خروج مبكر إذا تم إلغاء إظهار قائمة الفوتر
if ( ! $footer_show_menu ) {
    ?></div><!-- #content -->
    <!-- تم إلغاء عرض الفوتر بحسب الإعداد -->
    </footer><!-- #colophon -->
</div><!-- #page -->
<?php
    wp_footer();
    echo "\n</body>\n</html>";
    return;
}
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer footer-style-<?php echo esc_attr( $footer_style ); ?>">
        <?php
// ===== منامنامن تعريف روابط الشبكات الاجتماعية مرة واحدة =====
$social_networks = array(
    'facebook'  => array( 'icon' => 'fab fa-facebook-f',  'url' => get_theme_mod( 'social_facebook' ) ),
    'twitter'   => array( 'icon' => 'fab fa-twitter',     'url' => get_theme_mod( 'social_twitter' ) ),
    'instagram' => array( 'icon' => 'fab fa-instagram',   'url' => get_theme_mod( 'social_instagram' ) ),
    'linkedin'  => array( 'icon' => 'fab fa-linkedin-in',  'url' => get_theme_mod( 'social_linkedin' ) ),
    'youtube'   => array( 'icon' => 'fab fa-youtube',     'url' => get_theme_mod( 'social_youtube' ) ),
    'pinterest' => array( 'icon' => 'fab fa-pinterest-p',  'url' => get_theme_mod( 'social_pinterest' ) ),
    'tiktok'    => array( 'icon' => 'fab fa-tiktok',      'url' => get_theme_mod( 'social_tiktok' ) ),
);
?>

        <?php
        
        // 3) تحديد نمط الفوتر بناءً على الإعدادات
        switch ( $footer_style ) {

            case 'multi-tier':
                // نمط الفوتر متعدد الطبقات (ثابت 4 أعمدة)
                ?>
                <div class="footer-top">
                    <div class="container">
                        <div class="footer-widgets-wrapper">
                            <?php
                            // عرض 4 أعمدة ثابتة
                            for ( $i = 1; $i <= 4; $i++ ) {
                                if ( is_active_sidebar( 'footer-' . $i ) ) {
                                    echo '<div class="footer-widget-area">';
                                    dynamic_sidebar( 'footer-' . $i );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="footer-middle">
                    <div class="container">
                        <div class="footer-info-wrapper">
                            <?php if ( get_theme_mod( 'footer_show_logo', true ) ) : ?>
                                <div class="footer-logo">
                                    <?php
                                    $footer_logo_id = get_theme_mod( 'footer_logo' );
                                    if ( $footer_logo_id ) {
                                        echo wp_get_attachment_image( $footer_logo_id, 'medium', false, array( 'class' => 'custom-footer-logo' ) );
                                    } else {
                                        the_custom_logo();
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'footer_show_social', true ) ) : ?>
                                <div class="footer-social-icons">
                                    <?php
                                    $social_networks = array(
                                        'facebook'  => array( 'icon' => 'fab fa-facebook-f', 'url' => get_theme_mod( 'social_facebook' ) ),
                                        'twitter'   => array( 'icon' => 'fab fa-twitter', 'url' => get_theme_mod( 'social_twitter' ) ),
                                        'instagram' => array( 'icon' => 'fab fa-instagram', 'url' => get_theme_mod( 'social_instagram' ) ),
                                        'linkedin'  => array( 'icon' => 'fab fa-linkedin-in', 'url' => get_theme_mod( 'social_linkedin' ) ),
                                        'youtube'   => array( 'icon' => 'fab fa-youtube', 'url' => get_theme_mod( 'social_youtube' ) ),
                                        'pinterest' => array( 'icon' => 'fab fa-pinterest-p', 'url' => get_theme_mod( 'social_pinterest' ) ),
                                        'tiktok'    => array( 'icon' => 'fab fa-tiktok', 'url' => get_theme_mod( 'social_tiktok' ) ),
                                    );
                                    
                                    foreach ( $social_networks as $data ) {
                                        if ( ! empty( $data['url'] ) ) {
                                            printf(
                                                '<a href="%1$s" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="%2$s"></i></a>',
                                                esc_url( $data['url'] ),
                                                esc_attr( $data['icon'] )
                                            );
                                        }
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <div class="container">
                        <div class="footer-bottom-wrapper">
                            <div class="copyright">
                                <?php
                                $copyright_text = get_theme_mod(
                                    'footer_copyright_text',
                                    sprintf( __( '© %s - جميع الحقوق محفوظة', 'professional-theme' ), date( 'Y' ) . ' ' . get_bloginfo( 'name' ) )
                                );
                                echo wp_kses_post( str_replace( '{year}', date( 'Y' ), $copyright_text ) );
                                ?>
                            </div>
                            
                            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                                <nav class="footer-navigation">
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'footer',
                                        'menu_id'        => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                        'fallback_cb'    => false,
                                    ) );
                                    ?>
                                </nav>
                            <?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'footer_show_payment_icons', true ) ) : ?>
                                <div class="payment-methods">
                                    <?php
                                    $payment_methods = array(
                                        'visa'       => array( 'icon' => 'fab fa-cc-visa',       'name' => 'Visa' ),
                                        'mastercard' => array( 'icon' => 'fab fa-cc-mastercard', 'name' => 'MasterCard' ),
                                        'amex'       => array( 'icon' => 'fab fa-cc-amex',       'name' => 'American Express' ),
                                        'paypal'     => array( 'icon' => 'fab fa-paypal',        'name' => 'PayPal' ),
                                        'mada'       => array( 'icon' => 'fas fa-credit-card',   'name' => 'مدى' ),
                                        'applepay'   => array( 'icon' => 'fab fa-apple-pay',     'name' => 'Apple Pay' ),
                                    );
                                    
                                    foreach ( $payment_methods as $id => $method ) {
                                        if ( get_theme_mod( 'payment_method_' . $id, true ) ) {
                                            printf(
                                                '<div class="payment-method" title="%1$s"><i class="%2$s"></i></div>',
                                                esc_attr( $method['name'] ),
                                                esc_attr( $method['icon'] )
                                            );
                                        }
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'minimal':
                // نمط الفوتر المصغر
                ?>
                <div class="footer-minimal">
                    <div class="container">
                        <div class="footer-minimal-wrapper">
                            <?php if ( get_theme_mod( 'footer_show_logo', true ) ) : ?>
                                <div class="footer-logo">
                                    <?php
                                    $footer_logo_id = get_theme_mod( 'footer_logo' );
                                    if ( $footer_logo_id ) {
                                        echo wp_get_attachment_image( $footer_logo_id, 'medium', false, array( 'class' => 'custom-footer-logo' ) );
                                    } else {
                                        the_custom_logo();
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                                <nav class="footer-navigation">
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'footer',
                                        'menu_id'        => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                        'fallback_cb'    => false,
                                    ) );
                                    ?>
                                </nav>
                            <?php endif; ?>

                            <div class="copyright">
                                <?php
                                $copyright_text = get_theme_mod(
                                    'footer_copyright_text',
                                    sprintf( __( '© %s - جميع الحقوق محفوظة', 'professional-theme' ), date( 'Y' ) . ' ' . get_bloginfo( 'name' ) )
                                );
                                echo wp_kses_post( str_replace( '{year}', date( 'Y' ), $copyright_text ) );
                                ?>
                            </div>

                            <?php if ( get_theme_mod( 'footer_show_social', true ) ) : ?>
                                <div class="footer-social-icons">
                                    <?php
                                    $social_networks = array(
                                        'facebook'  => array( 'icon' => 'fab fa-facebook-f',  'url' => get_theme_mod( 'social_facebook' ) ),
                                        'twitter'   => array( 'icon' => 'fab fa-twitter',     'url' => get_theme_mod( 'social_twitter' ) ),
                                        'instagram' => array( 'icon' => 'fab fa-instagram',   'url' => get_theme_mod( 'social_instagram' ) ),
                                        'linkedin'  => array( 'icon' => 'fab fa-linkedin-in',  'url' => get_theme_mod( 'social_linkedin' ) ),
                                        'youtube'   => array( 'icon' => 'fab fa-youtube',     'url' => get_theme_mod( 'social_youtube' ) ),
                                    );
                                    foreach ( $social_networks as $data ) {
                                        if ( ! empty( $data['url'] ) ) {
                                            printf(
                                                '<a href="%1$s" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="%2$s"></i></a>',
                                                esc_url( $data['url'] ),
                                                esc_attr( $data['icon'] )
                                            );
                                        }
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( get_theme_mod( 'footer_show_payment_icons', true ) ) : ?>
                                <div class="payment-methods">
                                    <?php
                                    foreach ( $payment_methods as $id => $method ) {
                                        if ( get_theme_mod( 'payment_method_' . $id, true ) ) {
                                            printf(
                                                '<div class="payment-method" title="%1$s"><i class="%2$s"></i></div>',
                                                esc_attr( $method['name'] ),
                                                esc_attr( $method['icon'] )
                                            );
                                        }
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'newsletter':
                // نمط الفوتر مع نموذج اشتراك (يظهر فقط هنا)
                ?>
                <div class="footer-newsletter">
                    <div class="container">
                        <div class="newsletter-wrapper">
                            <div class="newsletter-content">
                                <h3 class="newsletter-title">
                                    <?php echo esc_html( get_theme_mod( 'newsletter_title', __( 'اشترك في نشرتنا البريدية', 'professional-theme' ) ) ); ?>
                                </h3>
                                <p class="newsletter-description">
                                    <?php echo esc_html( get_theme_mod( 'newsletter_description', __( 'احصل على آخر الأخبار والعروض الحصرية مباشرة إلى بريدك الإلكتروني.', 'professional-theme' ) ) ); ?>
                                </p>
                            </div>
                            <div class="newsletter-form">
                                <?php
                                $newsletter_form_id = get_theme_mod( 'newsletter_form_id' );
                                if ( ! empty( $newsletter_form_id ) && function_exists( 'wpcf7_contact_form' ) ) {
                                    echo do_shortcode( '[contact-form-7 id="' . esc_attr( $newsletter_form_id ) . '"]' );
                                } else {
                                ?>
                                    <form class="newsletter-default-form" action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" name="email"
                                                placeholder="<?php esc_attr_e( 'أدخل بريدك الإلكتروني', 'professional-theme' ); ?>"
                                                required>
                                            <button type="submit" class="newsletter-submit">
                                                <i class="fas fa-paper-plane"></i>
                                                <?php esc_html_e( 'اشترك', 'professional-theme' ); ?>
                                            </button>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-widgets">
                    <div class="container">
                        <div class="footer-widgets-wrapper">
                            <?php
                            // 4 أعمدة ثابتة بعد النموذج
                            for ( $i = 1; $i <= 4; $i++ ) {
                                if ( is_active_sidebar( 'footer-' . $i ) ) {
                                    echo '<div class="footer-widget-area">';
                                    dynamic_sidebar( 'footer-' . $i );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="footer-bottom-wrapper">
                            <div class="copyright">
                                <?php
                                echo wp_kses_post( str_replace( '{year}', date( 'Y' ), get_theme_mod(
                                    'footer_copyright_text',
                                    sprintf( __( '© %s - جميع الحقوق محفوظة', 'professional-theme' ), date( 'Y' ) . ' ' . get_bloginfo( 'name' ) )
                                ) ) );
                                ?>
                            </div>

                            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                                <nav class="footer-navigation">
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'footer',
                                        'menu_id'        => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                        'fallback_cb'    => false,
                                    ) );
                                    ?>
                                </nav>
                            <?php endif; ?>

                            <?php if ( get_theme_mod( 'footer_show_social', true ) ) : ?>
                                <div class="footer-social-icons">
                                    <?php
                                    foreach ( $social_networks as $data ) {
                                        if ( ! empty( $data['url'] ) ) {
                                            printf(
                                                '<a href="%1$s" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="%2$s"></i></a>',
                                                esc_url( $data['url'] ),
                                                esc_attr( $data['icon'] )
                                            );
                                        }
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'map':
                // نمط الفوتر مع خريطة
                $api_key   = get_theme_mod( 'google_maps_api_key', '' );
                $latitude  = get_theme_mod( 'map_latitude', '24.7136' );
                $longitude = get_theme_mod( 'map_longitude', '46.6753' );
                $zoom      = get_theme_mod( 'map_zoom', '15' );
                $map_title = get_theme_mod( 'map_title', get_bloginfo( 'name' ) );
                $social_networks = array(
    'facebook'  => array( 'icon' => 'fab fa-facebook-f', 'url' => get_theme_mod( 'social_facebook' ) ),
    'twitter'   => array( 'icon' => 'fab fa-twitter', 'url' => get_theme_mod( 'social_twitter' ) ),
    'instagram' => array( 'icon' => 'fab fa-instagram', 'url' => get_theme_mod( 'social_instagram' ) ),
    'linkedin'  => array( 'icon' => 'fab fa-linkedin-in', 'url' => get_theme_mod( 'social_linkedin' ) ),
    'youtube'   => array( 'icon' => 'fab fa-youtube', 'url' => get_theme_mod( 'social_youtube' ) ),
    'pinterest' => array( 'icon' => 'fab fa-pinterest-p', 'url' => get_theme_mod( 'social_pinterest' ) ),
    'tiktok'    => array( 'icon' => 'fab fa-tiktok', 'url' => get_theme_mod( 'social_tiktok' ) ),
);

$payment_methods = array(
    'visa'       => array( 'icon' => 'fab fa-cc-visa',       'name' => 'Visa' ),
    'mastercard' => array( 'icon' => 'fab fa-cc-mastercard', 'name' => 'MasterCard' ),
    'amex'       => array( 'icon' => 'fab fa-cc-amex',       'name' => 'American Express' ),
    'paypal'     => array( 'icon' => 'fab fa-paypal',        'name' => 'PayPal' ),
    'mada'       => array( 'icon' => 'fas fa-credit-card',   'name' => 'مدى' ),
    'applepay'   => array( 'icon' => 'fab fa-apple-pay',     'name' => 'Apple Pay' ),
);

                ?>
<div class="footer-map">
    <div class="footer-map-wrapper container">
        <div class="map-container" id="footer-map">
            <?php if ( $api_key ) : ?>
                <div id="google-map" style="height:100%;width:100%;"></div>
                <script>
                    function initFooterMap() {
                        var opts = {
                            center: { lat: <?php echo esc_js( $latitude ); ?>, lng: <?php echo esc_js( $longitude ); ?> },
                            zoom: <?php echo esc_js( $zoom ); ?>,
                            mapTypeControl: false,
                            streetViewControl: false
                        };
                        var map = new google.maps.Map(document.getElementById('google-map'), opts);
                        new google.maps.Marker({
                            position: opts.center,
                            map: map,
                            title: '<?php echo esc_js( $map_title ); ?>'
                        });
                    }
                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( $api_key ); ?>&callback=initFooterMap"></script>
            <?php else : ?>
                <div class="map-placeholder">
                    <div class="map-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <p><?php esc_html_e( 'يرجى إضافة مفتاح Google Maps API لعرض الخريطة.', 'professional-theme' ); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer-info-right">
            <?php if ( get_theme_mod( 'footer_show_social', true ) ) : ?>
                <div class="footer-social-icons">
                    <?php foreach ( $social_networks as $data ) {
                        if ( ! empty( $data['url'] ) ) {
                            printf(
                                '<a href="%1$s" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="%2$s"></i></a>',
                                esc_url( $data['url'] ),
                                esc_attr( $data['icon'] )
                            );
                        }
                    } ?>
                </div>
            <?php endif; ?>

            <?php if ( get_theme_mod( 'footer_show_payment_icons', true ) ) : ?>
                <div class="payment-methods">
                    <?php foreach ( $payment_methods as $id => $method ) {
                        if ( get_theme_mod( 'payment_method_' . $id, true ) ) {
                            printf(
                                '<div class="payment-method" title="%1$s"><i class="%2$s"></i></div>',
                                esc_attr( $method['name'] ),
                                esc_attr( $method['icon'] )
                            );
                        }
                    } ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


                <div class="footer-widgets">
                    <div class="container">
                        <div class="footer-widgets-wrapper">
                            <?php
                            for ( $i = 1; $i <= 4; $i++ ) {
                                if ( is_active_sidebar( 'footer-' . $i ) ) {
                                    echo '<div class="footer-widget-area">';
                                    dynamic_sidebar( 'footer-' . $i );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="footer-bottom-wrapper">
                            <?php if ( get_theme_mod( 'footer_show_logo', true ) ) : ?>
                                <div class="footer-logo">
                                    <?php
                                    $footer_logo_id = get_theme_mod( 'footer_logo' );
                                    if ( $footer_logo_id ) {
                                        echo wp_get_attachment_image( $footer_logo_id, 'medium', false, array( 'class' => 'custom-footer-logo' ) );
                                    } else {
                                        the_custom_logo();
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>

                            <div class="copyright">
                                <?php
                                echo wp_kses_post( str_replace( '{year}', date( 'Y' ), get_theme_mod(
                                    'footer_copyright_text',
                                    sprintf( __( '© %s - جميع الحقوق محفوظة', 'professional-theme' ), date( 'Y' ) . ' ' . get_bloginfo( 'name' ) )
                                ) ) );
                                ?>
                            </div>

                            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                                <nav class="footer-navigation">
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'footer',
                                        'menu_id'        => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                        'fallback_cb'    => false,
                                    ) );
                                    ?>
                                </nav>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'standard':
            default:
                // نمط الفوتر القياسي (4 أعمدة ثابتة)
                ?>
                <div class="footer-widgets">
                    <div class="container">
                        <div class="footer-widgets-wrapper">
                            <?php
                            for ( $i = 1; $i <= 4; $i++ ) {
                                if ( is_active_sidebar( 'footer-' . $i ) ) {
                                    echo '<div class="footer-widget-area">';
                                    dynamic_sidebar( 'footer-' . $i );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <div class="container">
                        <div class="footer-bottom-wrapper">
                            <?php if ( get_theme_mod( 'footer_show_logo', true ) ) : ?>
                                <div class="footer-logo">
                                    <?php
                                    $footer_logo_id = get_theme_mod( 'footer_logo' );
                                    if ( $footer_logo_id ) {
                                        echo wp_get_attachment_image( $footer_logo_id, 'medium', false, array( 'class' => 'custom-footer-logo' ) );
                                    } else {
                                        the_custom_logo();
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="copyright">
                                <?php
                                echo wp_kses_post( str_replace( '{year}', date( 'Y' ), get_theme_mod(
                                    'footer_copyright_text',
                                    sprintf( __( '© %s - جميع الحقوق محفوظة', 'professional-theme' ), date( 'Y' ) . ' ' . get_bloginfo( 'name' ) )
                                ) ) );
                                ?>
                            </div>
                            
                            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                                <nav class="footer-navigation">
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'footer',
                                        'menu_id'        => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                        'fallback_cb'    => false,
                                    ) );
                                    ?>
                                </nav>
                            <?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'footer_show_social', true ) ) : ?>
                                <div class="footer-social-icons">
                                    <?php
                                    foreach ( $social_networks as $data ) {
                                        if ( ! empty( $data['url'] ) ) {
                                            printf(
                                                '<a href="%1$s" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="%2$s"></i></a>',
                                                esc_url( $data['url'] ),
                                                esc_attr( $data['icon'] )
                                            );
                                        }
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
                break;
        }
        ?>

        <?php if ( get_theme_mod( 'footer_show_back_to_top', true ) ) : ?>
            <button id="toTop" aria-label="<?php esc_attr_e( 'العودة للأعلى', 'professional-theme' ); ?>">
                <i class="fas fa-chevron-up"></i>
            </button>
        <?php endif; ?>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
