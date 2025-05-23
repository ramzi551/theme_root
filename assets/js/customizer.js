/**
 * سكربت المخصص
 *
 * يحتوي على وظائف لتحسين تجربة المستخدم في صفحة التخصيص
 *
 * @package ProfessionalTheme
 */

( function( $ ) {
    'use strict';

    // تحسين عرض صفحة التخصيص
    $(window).on('load', function() {
        // إصلاح مشكلة العرض في صفحة تخصيص الهيدر
        if ($('body').hasClass('wp-customizer')) {
            // تطبيق الأنماط على الإطار الرئيسي
            var mainFrame = $('.wp-full-overlay-main');
            
            // التأكد من أن الإطار يأخذ العرض الكامل
            mainFrame.css({
                'width': '100%',
                'height': '100%',
                'position': 'absolute',
                'top': '0',
                'left': '0',
                'right': '0',
                'bottom': '0'
            });
            
            // تحسين عرض الإطار في وضع الجوال
            $('.preview-mobile .wp-full-overlay-main').css({
                'max-width': '100%',
                'max-height': '100%'
            });
            
            // تحسين عرض الإطار في وضع التابلت
            $('.preview-tablet .wp-full-overlay-main').css({
                'max-width': '100%',
                'max-height': '100%'
            });
            
            // تحسين عرض الإطار في وضع سطح المكتب
            $('.preview-desktop .wp-full-overlay-main').css({
                'max-width': '100%',
                'max-height': '100%'
            });
        }
    });

    // تحديث العرض المباشر عند تغيير إعدادات الهيدر
    wp.customize('header_style', function(value) {
        value.bind(function(newval) {
            // تحديث نمط الهيدر
            $('body').removeClass('header-style-1 header-style-2 header-style-3 header-style-4')
                    .addClass('header-style-' + newval);
        });
    });

    // تحديث العرض المباشر عند تغيير إعدادات الهيدر المخصص للمستخدم
    wp.customize('enable_user_header', function(value) {
        value.bind(function(newval) {
            if (newval) {
                // إذا تم تفعيل الهيدر المخصص للمستخدم
                $('.site-header').addClass('user-header-enabled');
            } else {
                // إذا تم تعطيل الهيدر المخصص للمستخدم
                $('.site-header').removeClass('user-header-enabled');
            }
        });
    });

    // تحديث العرض المباشر عند تغيير لون خلفية الهيدر
    wp.customize('user_header_bg_color', function(value) {
        value.bind(function(newval) {
            $('.user-header').css('--header-bg', newval);
        });
    });

    // تحديث العرض المباشر عند تغيير لون نص الهيدر
    wp.customize('user_header_text_color', function(value) {
        value.bind(function(newval) {
            $('.user-header').css('--header-text', newval);
        });
    });

    // تحديث العرض المباشر عند تغيير لون خلفية الشريط العلوي
    wp.customize('user_header_topbar_bg_color', function(value) {
        value.bind(function(newval) {
            $('.user-topbar').css('background-color', newval);
        });
    });

    // تحديث العرض المباشر عند تغيير لون نص الشريط العلوي
    wp.customize('user_header_topbar_text_color', function(value) {
        value.bind(function(newval) {
            $('.user-topbar').css('color', newval);
        });
    });

    // تحديث العرض المباشر عند تغيير روابط مواقع التواصل الاجتماعي
    wp.customize('user_header_facebook_url', function(value) {
        value.bind(function(newval) {
            $('.social-icons .facebook-link').attr('href', newval);
        });
    });

    wp.customize('user_header_twitter_url', function(value) {
        value.bind(function(newval) {
            $('.social-icons .twitter-link').attr('href', newval);
        });
    });

    wp.customize('user_header_instagram_url', function(value) {
        value.bind(function(newval) {
            $('.social-icons .instagram-link').attr('href', newval);
        });
    });

    wp.customize('user_header_youtube_url', function(value) {
        value.bind(function(newval) {
            $('.social-icons .youtube-link').attr('href', newval);
        });
    });

    wp.customize('user_header_linkedin_url', function(value) {
        value.bind(function(newval) {
            $('.social-icons .linkedin-link').attr('href', newval);
        });
    });

    wp.customize('user_header_whatsapp_number', function(value) {
        value.bind(function(newval) {
            $('.social-icons .whatsapp-link').attr('href', 'https://wa.me/' + newval);
        });
    });

    // تحسين تجربة المستخدم في صفحة التخصيص
    $(document).ready(function() {
        // إضافة فئة للجسم للتحكم في أنماط CSS
        $('body').addClass('customizer-active');
        
        // تحسين عرض صفحة التخصيص على الأجهزة المحمولة
        if ($(window).width() < 768) {
            $('.wp-full-overlay-sidebar').css('width', '100%');
            $('.wp-full-overlay.expanded').css('margin-left', '0');
        }
        
        // تحديث العرض عند تغيير حجم النافذة
        $(window).resize(function() {
            if ($(window).width() < 768) {
                $('.wp-full-overlay-sidebar').css('width', '100%');
                $('.wp-full-overlay.expanded').css('margin-left', '0');
            } else {
                $('.wp-full-overlay-sidebar').css('width', '300px');
                $('.wp-full-overlay.expanded').css('margin-left', '300px');
            }
        });
    });

} )( jQuery );
