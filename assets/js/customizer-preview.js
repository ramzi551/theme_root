( function( $ ) {
    "use strict";

    // --- Live Preview for Extended Colors ---
    const extendedColors = [
        'primary_color',
        'primary_dark_color',
        'secondary_color',
        'accent_color',
        'text_color',
        'background_color'
    ];

    extendedColors.forEach(function(settingId) {
        wp.customize(settingId, function(value) {
            value.bind(function(newval) {
                // Update CSS Custom Property (recommended)
                document.documentElement.style.setProperty('--' + settingId.replace(/_/g, '-'), newval);
                
                // Direct updates for some common elements as a fallback or for immediate effect
                if (settingId === 'text_color') {
                    $('body').css('color', newval);
                }
                if (settingId === 'background_color') {
                    $('body').css('background-color', newval);
                }
            });
        });
    });

    // --- Live Preview for Header Specific Colors ---
    const headerColors = [
        'header_topbar_bg_color',
        'header_topbar_text_color',
        'header_social_bar_bg_color',
        'header_social_bar_icon_color',
        'main_header_bg_color',
        'main_header_text_color',
        // Add 'header_link_color' if it's a separate setting in customizer.php
        // For now, assuming main_header_text_color might cover links or they are derived
    ];

    headerColors.forEach(function(settingId) {
        wp.customize(settingId, function(value) {
            value.bind(function(newval) {
                document.documentElement.style.setProperty('--' + settingId.replace(/_/g, '-'), newval);
                // Example direct updates (if needed beyond CSS variables)
                if (settingId === 'main_header_bg_color') {
                    $('.site-header').css('background-color', newval);
                }
                if (settingId === 'main_header_text_color') {
                    $('.site-header, .site-header p, .site-header .site-description, .site-header a, .site-header .main-navigation a').css('color', newval);
                }
            });
        });
    });

    // --- Live Preview for User Header Colors ---
    const userHeaderColors = [
        'user_header_bg_color',
        'user_header_text_color',
        'user_header_link_hover_color',
        'user_header_topbar_bg_color',
        'user_header_topbar_text_color'
    ];

    userHeaderColors.forEach(function(settingId) {
        wp.customize(settingId, function(value) {
            value.bind(function(newval) {
                // تحديث متغيرات CSS
                let cssVar = '--' + settingId.replace(/user_header_/g, 'user-header-').replace(/_/g, '-');
                document.documentElement.style.setProperty(cssVar, newval);
                
                // تطبيق مباشر على العناصر للتأثير الفوري
                if (settingId === 'user_header_bg_color') {
                    $('.header-style-user .main-header-area').css('background-color', newval);
                }
                if (settingId === 'user_header_text_color') {
                    $('.header-style-user, .header-style-user p, .header-style-user .site-description, .header-style-user a, .header-style-user .main-navigation a').css('color', newval);
                }
                if (settingId === 'user_header_link_hover_color') {
                    document.documentElement.style.setProperty('--user-header-accent', newval);
                }
                if (settingId === 'user_header_topbar_bg_color') {
                    $('.header-style-user .user-topbar').css('background-color', newval);
                }
                if (settingId === 'user_header_topbar_text_color') {
                    $('.header-style-user .user-topbar, .header-style-user .user-topbar a').css('color', newval);
                }
            });
        });
    });

    // --- Live Preview for User Header Typography and Border Radius ---
    wp.customize('user_header_font_size', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--user-header-font-size', newval + 'px');
            $('.header-style-user').css('font-size', newval + 'px');
        });
    });

    wp.customize('user_header_border_radius', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--user-header-radius', newval + 'px');
            $('.header-style-user').css('border-radius', newval + 'px');
        });
    });

    // --- Live Preview for User Header Tagline ---
    wp.customize('user_header_show_tagline', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('.header-style-user .site-description').show();
            } else {
                $('.header-style-user .site-description').hide();
            }
        });
    });

    // --- Live Preview for Typography --- 
    wp.customize('headings_font_family', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--font-headings', "'" + newval + "', sans-serif");
            $('h1, h2, h3, h4, h5, h6, .site-title, .widget-title').css('font-family', "'" + newval + "', sans-serif");
        });
    });

    wp.customize('body_font_family', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--font-body', "'" + newval + "', sans-serif");
            $('body, p, li, td, th, span, div:not([class*="icon"]):not(i)').css('font-family', "'" + newval + "', sans-serif");
        });
    });

    wp.customize('base_font_size', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--font-size-base', newval);
            $('body').css('font-size', newval);
        });
    });

    wp.customize('headings_font_weight', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--font-weight-headings', newval);
            $('h1, h2, h3, h4, h5, h6, .site-title, .widget-title').css('font-weight', newval);
        });
    });

    wp.customize('body_font_weight', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--font-weight-body', newval);
            $('body, p, li, td, th, span, div:not([class*="icon"]):not(i)').css('font-weight', newval);
        });
    });

    // --- Live Preview for Layout (Example) ---
    // wp.customize('container_width', function(value) {
    //     value.bind(function(newval) {
    //         document.documentElement.style.setProperty('--container-width', newval + 'px');
    //         $('.container').css('max-width', newval + 'px'); 
    //     });
    // });

    // Ensure the professionalThemeCustomizer object exists if you plan to use it for header style switching
    // window.professionalThemeCustomizer = window.professionalThemeCustomizer || {};
    // professionalThemeCustomizer.headerStyles = ['classic', 'modern', 'centered', 'user']; // Example

} )(jQuery);
