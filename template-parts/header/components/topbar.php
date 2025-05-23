<?php
/**
 * القالب الجزئي لمكون الشريط العلوي (Topbar)
 *
 * @package ProfessionalTheme
 * @version 2.3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// التحقق من تفعيل شريط التوب بار
$topbar_enabled = get_theme_mod( 'topbar_enabled', true );
if ( ! $topbar_enabled ) return;

// إعدادات البريد
$show_email     = get_theme_mod( 'topbar_show_email', true );
$email_address  = get_theme_mod( 'topbar_email_address', 'info@yourdomain.com' );

// إعدادات التواصل الاجتماعي
$show_social            = get_theme_mod( 'topbar_show_social', true );
$icon_size              = get_theme_mod( 'topbar_social_icon_size', '18px' );
$icon_align             = get_theme_mod( 'topbar_social_icon_alignment', 'right' );
$social_bar_bg_color    = get_theme_mod( 'header_social_bar_bg_color', '#eeeeee' );
$social_bar_icon_color  = get_theme_mod( 'header_social_bar_icon_color', '#555555' );

$social_links = [
    'facebook'  => get_theme_mod( 'social_facebook_url', '' ),
    'twitter'   => get_theme_mod( 'social_twitter_url', '' ),
    'instagram' => get_theme_mod( 'social_instagram_url', '' ),
    'linkedin'  => get_theme_mod( 'social_linkedin_url', '' ),
    'youtube'   => get_theme_mod( 'social_youtube_url', '' ),
    'whatsapp'  => get_theme_mod( 'social_whatsapp_url', '' ),
    'telegram'  => get_theme_mod( 'social_telegram_url', '' ),
    'snapchat'  => get_theme_mod( 'social_snapchat_url', '' ),
    'tiktok'    => get_theme_mod( 'social_tiktok_url', '' ),
];

// إعدادات شريط الترحيب
$show_welcome_bar     = get_theme_mod( 'header_welcome_text_enabled', true );
$welcome_text         = get_theme_mod( 'header_welcome_text', 'مرحبًا بك في متجرنا – شحن مجاني فوق 200 ريال!' );
$whatsapp_button      = get_theme_mod( 'header_show_whatsapp_button', false );
$whatsapp_number      = preg_replace( '/\D/', '', get_theme_mod( 'header_whatsapp_number', '' ) );
$whatsapp_text        = get_theme_mod( 'header_whatsapp_button_text', 'طلب سريع' );
$welcome_bar_bg_color = get_theme_mod( 'header_topbar_bg_color', '#f8f9fa' );
$welcome_bar_text_color = get_theme_mod( 'header_topbar_text_color', '#333333' );
?>

<?php if ( $show_welcome_bar ) : ?>
<div class="topbar-welcome-bar"
     style="background-color: <?php echo esc_attr( $welcome_bar_bg_color ); ?>;
            color: <?php echo esc_attr( $welcome_bar_text_color ); ?>;">
  <div class="container">
    <span class="welcome-text"><?php echo esc_html( $welcome_text ); ?></span>
    <?php if ( $whatsapp_button && $whatsapp_number ) : ?>
      <a class="whatsapp-button"
         href="https://wa.me/<?php echo esc_attr( $whatsapp_number ); ?>"
         target="_blank">
        <?php echo esc_html( $whatsapp_text ); ?>
      </a>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>

<?php if ( $show_social || $show_email ) : ?>
<div class="universal-topbar social-bar"
     style="text-align: <?php echo esc_attr( $icon_align ); ?>;
            background-color: <?php echo esc_attr( $social_bar_bg_color ); ?>;
            color: <?php echo esc_attr( $social_bar_icon_color ); ?>;">
  <div class="container">

    <?php if ( $show_email && ! empty( $email_address ) ) : ?>
      <div class="topbar-left">
        <a href="mailto:<?php echo esc_attr( $email_address ); ?>"
           class="icon-email"
           aria-label="البريد الإلكتروني"
           style="color: <?php echo esc_attr( $social_bar_icon_color ); ?>;">
          <i class="fas fa-envelope"></i>
        </a>
      </div>
    <?php endif; ?>

    <?php if ( $show_social ) : ?>
    <div class="topbar-right">
      <?php foreach ( $social_links as $network => $url ) : ?>
        <?php if ( ! empty( $url ) && $url !== '#' ) : ?>
          <a href="<?php echo esc_url( $url ); ?>" 
             class="social social-<?php echo esc_attr( $network ); ?>"
             target="_blank"
             style="color: <?php echo esc_attr( $social_bar_icon_color ); ?>;">
            <i class="fab fa-<?php
                echo esc_attr(
                    $network === 'whatsapp' ? 'whatsapp' :
                    ( $network === 'telegram' ? 'telegram-plane' :
                    ( $network === 'snapchat'  ? 'snapchat-ghost' : $network ))
                );
            ?>"></i>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</div>
<?php endif; ?>

<style>
  .social-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
  }

  .social-bar .social i,
  .social-bar .icon-email i {
    font-size: <?php echo esc_attr( $icon_size ); ?>;
    transition: transform 0.3s ease, opacity 0.3s ease;
  }

  .social-bar .social:hover i {
    transform: scale(1.15);
    opacity: 0.85;
  }

  .topbar-left,
  .topbar-right {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .topbar-welcome-bar {
    text-align: center;
    font-weight: 500;
    font-size: 15px;
    padding: 6px 0;
  }

  .topbar-welcome-bar .whatsapp-button {
    background-color: #25d366;
    color: #fff;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    margin-right: 10px;
    transition: background-color 0.3s ease;
  }

  .topbar-welcome-bar .whatsapp-button:hover {
    background-color: #1ebe5d;
  }
</style>
