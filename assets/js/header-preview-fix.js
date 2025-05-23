/**
 * تعديلات مخصصة لحل مشكلة عرض صفحة أنماط الهيدر
 * 
 * هذا الملف يحتوي على تعديلات جذرية لحل مشكلة عرض صفحة أنماط الهيدر
 * بحيث تملأ الشاشة بالكامل في صفحة التخصيص
 * 
 * @package ProfessionalTheme
 */

(function($) {
    'use strict';

    // التأكد من تحميل jQuery
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded');
        return;
    }

    // انتظار تحميل الصفحة بالكامل
    $(window).on('load', function() {
        // التحقق من أننا في صفحة التخصيص
        if ($('body').hasClass('wp-customizer')) {
            console.log('Customizer page detected - applying header preview fixes');
            
            // إصلاح مشكلة عرض صفحة أنماط الهيدر
            fixHeaderPreviewDisplay();
            
            // مراقبة التغييرات في نمط الهيدر
            watchHeaderStyleChanges();
        }
    });

    /**
     * إصلاح مشكلة عرض صفحة أنماط الهيدر
     */
    function fixHeaderPreviewDisplay() {
        // الحصول على إطار المعاينة
        var previewFrame = $('.wp-full-overlay-main iframe');
        
        if (previewFrame.length === 0) {
            console.error('Preview frame not found');
            return;
        }
        
        console.log('Preview frame found - applying fixes');
        
        // تطبيق الأنماط على إطار المعاينة
        previewFrame.css({
            'width': '100%',
            'height': '100%',
            'max-width': '100%',
            'max-height': '100%',
            'position': 'absolute',
            'top': '0',
            'left': '0',
            'right': '0',
            'bottom': '0'
        });
        
        // تطبيق الأنماط على حاوية المعاينة
        $('.wp-full-overlay-main').css({
            'width': '100%',
            'height': '100%',
            'max-width': '100%',
            'max-height': '100%',
            'position': 'absolute',
            'top': '0',
            'left': '0',
            'right': '0',
            'bottom': '0'
        });
        
        // إضافة أنماط CSS مباشرة إلى الصفحة
        $('head').append(`
            <style id="header-preview-fixes">
                .wp-full-overlay-main {
                    width: 100% !important;
                    height: 100% !important;
                    max-width: 100% !important;
                    max-height: 100% !important;
                    position: absolute !important;
                    top: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    bottom: 0 !important;
                }
                
                .wp-full-overlay-main iframe {
                    width: 100% !important;
                    height: 100% !important;
                    max-width: 100% !important;
                    max-height: 100% !important;
                    position: absolute !important;
                    top: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    bottom: 0 !important;
                }
                
                .preview-desktop .wp-full-overlay-main {
                    position: absolute !important;
                    width: 100% !important;
                    height: 100% !important;
                    top: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    bottom: 0 !important;
                }
                
                .preview-tablet .wp-full-overlay-main {
                    position: absolute !important;
                    width: 100% !important;
                    height: 100% !important;
                    top: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    bottom: 0 !important;
                }
                
                .preview-mobile .wp-full-overlay-main {
                    position: absolute !important;
                    width: 100% !important;
                    height: 100% !important;
                    top: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    bottom: 0 !important;
                }
                
                /* إصلاح مشكلة العرض في صفحة تخصيص الهيدر */
                .wp-customizer .preview-desktop .wp-full-overlay-main,
                .wp-customizer .preview-tablet .wp-full-overlay-main,
                .wp-customizer .preview-mobile .wp-full-overlay-main {
                    position: absolute !important;
                    width: 100% !important;
                    height: 100% !important;
                    top: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    bottom: 0 !important;
                }
                
                /* إصلاح مشكلة العرض في صفحة تخصيص الهيدر على الأجهزة المحمولة */
                @media (max-width: 1024px) {
                    .wp-customizer .preview-desktop .wp-full-overlay-main,
                    .wp-customizer .preview-tablet .wp-full-overlay-main,
                    .wp-customizer .preview-mobile .wp-full-overlay-main {
                        position: absolute !important;
                        width: 100% !important;
                        height: 100% !important;
                        top: 0 !important;
                        left: 0 !important;
                        right: 0 !important;
                        bottom: 0 !important;
                    }
                }
            </style>
        `);
        
        // إضافة الأنماط إلى إطار المعاينة
        injectStylesIntoPreviewFrame(previewFrame[0]);
        
        // مراقبة تغيير حجم النافذة
        $(window).on('resize', function() {
            // تطبيق الأنماط مرة أخرى عند تغيير حجم النافذة
            previewFrame.css({
                'width': '100%',
                'height': '100%',
                'max-width': '100%',
                'max-height': '100%'
            });
            
            // إعادة حقن الأنماط في إطار المعاينة
            injectStylesIntoPreviewFrame(previewFrame[0]);
        });
        
        // مراقبة تغيير وضع المعاينة (سطح المكتب، الجهاز اللوحي، الجوال)
        $('.wp-full-overlay').on('preview-ready', function() {
            console.log('Preview mode changed - reapplying fixes');
            
            // تطبيق الأنماط مرة أخرى عند تغيير وضع المعاينة
            previewFrame.css({
                'width': '100%',
                'height': '100%',
                'max-width': '100%',
                'max-height': '100%'
            });
            
            // إعادة حقن الأنماط في إطار المعاينة
            injectStylesIntoPreviewFrame(previewFrame[0]);
        });
    }
    
    /**
     * حقن الأنماط في إطار المعاينة
     */
    function injectStylesIntoPreviewFrame(iframe) {
        if (!iframe || !iframe.contentWindow) {
            console.error('Invalid iframe or contentWindow');
            return;
        }
        
        try {
            var iframeDoc = iframe.contentWindow.document;
            
            // التحقق من وجود العنصر head في إطار المعاينة
            if (!iframeDoc || !iframeDoc.head) {
                console.error('Invalid iframe document or head');
                return;
            }
            
            // إنشاء عنصر style جديد
            var style = iframeDoc.createElement('style');
            style.id = 'header-preview-iframe-fixes';
            style.textContent = `
                html, body {
                    width: 100% !important;
                    height: 100% !important;
                    max-width: 100% !important;
                    max-height: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    overflow-x: hidden !important;
                }
                
                #page, .site {
                    width: 100% !important;
                    max-width: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }
                
                .site-header, header {
                    width: 100% !important;
                    max-width: 100% !important;
                }
                
                .container, .wrap {
                    width: 100% !important;
                    max-width: 1280px !important;
                    margin-left: auto !important;
                    margin-right: auto !important;
                    padding-left: 15px !important;
                    padding-right: 15px !important;
                    box-sizing: border-box !important;
                }
            `;
            
            // إضافة عنصر style إلى head في إطار المعاينة
            var existingStyle = iframeDoc.getElementById('header-preview-iframe-fixes');
            if (existingStyle) {
                existingStyle.textContent = style.textContent;
            } else {
                iframeDoc.head.appendChild(style);
            }
            
            console.log('Styles injected into preview frame');
        } catch (error) {
            console.error('Error injecting styles into preview frame:', error);
        }
    }
    
    /**
     * مراقبة التغييرات في نمط الهيدر
     */
    function watchHeaderStyleChanges() {
        // مراقبة التغييرات في نمط الهيدر
        wp.customize('header_style', function(value) {
            value.bind(function(newval) {
                console.log('Header style changed to:', newval);
                
                // الحصول على إطار المعاينة
                var previewFrame = $('.wp-full-overlay-main iframe');
                
                if (previewFrame.length === 0) {
                    console.error('Preview frame not found');
                    return;
                }
                
                // إعادة تطبيق الأنماط بعد تغيير نمط الهيدر
                setTimeout(function() {
                    previewFrame.css({
                        'width': '100%',
                        'height': '100%',
                        'max-width': '100%',
                        'max-height': '100%'
                    });
                    
                    // إعادة حقن الأنماط في إطار المعاينة
                    injectStylesIntoPreviewFrame(previewFrame[0]);
                }, 500);
            });
        });
    }
    
    // تنفيذ الإصلاحات عند تحميل المخصص
    $(document).on('customize-preview-menu-refreshed', function() {
        console.log('Customizer menu refreshed - reapplying fixes');
        
        // الحصول على إطار المعاينة
        var previewFrame = $('.wp-full-overlay-main iframe');
        
        if (previewFrame.length === 0) {
            console.error('Preview frame not found');
            return;
        }
        
        // تطبيق الأنماط مرة أخرى
        previewFrame.css({
            'width': '100%',
            'height': '100%',
            'max-width': '100%',
            'max-height': '100%'
        });
        
        // إعادة حقن الأنماط في إطار المعاينة
        injectStylesIntoPreviewFrame(previewFrame[0]);
    });
    
    // تنفيذ الإصلاحات عند تحميل المخصص
    $(document).on('customize-preview-init', function() {
        console.log('Customizer preview initialized - applying fixes');
        
        // إصلاح مشكلة عرض صفحة أنماط الهيدر
        setTimeout(fixHeaderPreviewDisplay, 500);
    });
    
})(jQuery);
