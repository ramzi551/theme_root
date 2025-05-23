/**
 * تفعيل محرر CSS المتقدم في لوحة التخصيص
 */
(function($) {
    'use strict';
    
    // تفعيل محرر CSS المتقدم عند تحميل لوحة التخصيص
    wp.customize.bind('ready', function() {
        var cssFields = [
            'custom_css_global',
            'custom_css_header',
            'custom_css_footer',
            'custom_css_home',
            'custom_css_shop',
            'custom_css_mobile',
            'custom_css_tablet',
            'custom_css_desktop',
            'custom_css_rtl'
        ];
        
        // تفعيل محرر CSS المتقدم لكل حقل
        cssFields.forEach(function(fieldId) {
            var control = wp.customize.control(fieldId);
            
            if (control) {
                var textarea = control.container.find('textarea')[0];
                
                if (textarea) {
                    var editor = wp.codeEditor.initialize(textarea, {
                        codemirror: {
                            mode: 'css',
                            lineNumbers: true,
                            lineWrapping: true,
                            indentUnit: 4,
                            indentWithTabs: true,
                            theme: 'default'
                        }
                    });
                    
                    // تحديث قيمة الحقل عند تغيير المحرر
                    editor.codemirror.on('change', function() {
                        textarea.value = editor.codemirror.getValue();
                        $(textarea).trigger('change');
                    });
                }
            }
        });
    });
})(jQuery);