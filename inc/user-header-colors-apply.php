<?php
/**
 * تطبيق ألوان هيدر المستخدم المخصص
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة CSS ديناميكي لألوان هيدر المستخدم المخصص بناءً على إعدادات التخصيص
 */
function professional_theme_user_header_colors_dynamic_css() {
    // التحقق من تفعيل هيدر المستخدم المخصص
    $enable_user_header = get_theme_mod('enable_user_header', false);
    if (!$enable_user_header) {
        return;
    }

    // ألوان هيدر المستخدم المخصص
    $user_header_bg_color = get_theme_mod('user_header_bg_color', '#ffffff');
    $user_header_text_color = get_theme_mod('user_header_text_color', '#000000');
    $user_header_link_hover_color = get_theme_mod('user_header_link_hover_color', '#007bff');
    $user_header_topbar_bg_color = get_theme_mod('user_header_topbar_bg_color', '#f8f9fa');
    $user_header_topbar_text_color = get_theme_mod('user_header_topbar_text_color', '#6c757d');
    
    // خصائص أخرى للهيدر المخصص
    $user_header_font_size = get_theme_mod('user_header_font_size', 16);
    $user_header_border_radius = get_theme_mod('user_header_border_radius', 0);
    
    // تطبيق الألوان والخصائص على هيدر المستخدم المخصص
    ?>
    <style type="text/css">
        /* متغيرات CSS لهيدر المستخدم المخصص */
        :root {
            --user-header-bg: <?php echo esc_attr($user_header_bg_color); ?>;
            --user-header-text: <?php echo esc_attr($user_header_text_color); ?>;
            --user-header-accent: <?php echo esc_attr($user_header_link_hover_color); ?>;
            --user-header-primary: <?php echo esc_attr($user_header_topbar_bg_color); ?>;
            --user-header-secondary: <?php echo esc_attr($user_header_topbar_text_color); ?>;
            --user-header-font-size: <?php echo esc_attr($user_header_font_size); ?>px;
            --user-header-radius: <?php echo esc_attr($user_header_border_radius); ?>px;
        }
        
        /* تطبيق مباشر للألوان على عناصر الهيدر المخصص */
        .header-style-user {
            color: <?php echo esc_attr($user_header_text_color); ?>;
            font-size: <?php echo esc_attr($user_header_font_size); ?>px;
            border-radius: <?php echo esc_attr($user_header_border_radius); ?>px;
        }
        
        .header-style-user .main-header-area {
            background-color: <?php echo esc_attr($user_header_bg_color); ?>;
        }
        
        .header-style-user .user-topbar {
            background-color: <?php echo esc_attr($user_header_topbar_bg_color); ?>;
            color: <?php echo esc_attr($user_header_topbar_text_color); ?>;
        }
        
        .header-style-user .user-topbar a {
            color: <?php echo esc_attr($user_header_topbar_text_color); ?>;
        }
        
        .header-style-user a, 
        .header-style-user .main-navigation a,
        .header-style-user .site-description,
        .header-style-user .header-search-icon a {
            color: <?php echo esc_attr($user_header_text_color); ?>;
        }
        
        .header-style-user a:hover,
        .header-style-user .main-navigation a:hover,
        .header-style-user .header-search-icon a:hover {
            color: <?php echo esc_attr($user_header_link_hover_color); ?>;
        }
        
        .header-style-user .main-navigation a::after {
            background-color: <?php echo esc_attr($user_header_link_hover_color); ?>;
        }
        
        .header-style-user .custom-button {
            background-color: <?php echo esc_attr($user_header_link_hover_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'professional_theme_user_header_colors_dynamic_css', 25);
