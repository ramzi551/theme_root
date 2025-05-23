( function( $ ) {
    wp.customize.bind( 'ready', function() {

        // Function to toggle user header sections based on the main checkbox
        function toggleUserHeaderSections( enableSetting ) {
            var isEnabled = enableSetting.get();
            // Target the panel's content area, or individual sections if needed
            // Note: Panel ID is 'professional_theme_user_header_panel'
            // Section IDs are like 'professional_theme_user_header_topbar', 'professional_theme_user_header_main', etc.
            var sectionsToToggle = [
                '#accordion-section-professional_theme_user_header_topbar',
                '#accordion-section-professional_theme_user_header_main',
                '#accordion-section-professional_theme_user_header_appearance'
                // Add other section IDs if necessary
            ];

            $.each( sectionsToToggle, function( index, selector ) {
                $( selector ).toggle( isEnabled );
            });
        }

        // Listen for changes on the 'enable_user_header' setting
        wp.customize( 'enable_user_header', function( setting ) {
            // Initial check on load
            toggleUserHeaderSections( setting );

            // Toggle on change
            setting.bind( function( newValue ) {
                toggleUserHeaderSections( setting );
            });
        });

        // --- Optional: Add similar logic for controls within sections if needed ---
        // Example: Toggle social URL fields based on 'user_header_show_topbar'
        function toggleTopbarControls( enableTopbarSetting ) {
             var isTopbarEnabled = enableTopbarSetting.get();
             var controlsToToggle = [
                '#customize-control-user_header_email',
                '#customize-control-user_header_phone',
                // Add social network controls dynamically if needed, or list them
                '#customize-control-user_header_social_facebook',
                '#customize-control-user_header_social_twitter',
                // ... other social controls
                '#customize-control-user_header_topbar_bg_color',
                '#customize-control-user_header_topbar_text_color'
             ];
             $.each( controlsToToggle, function( index, selector ) {
                // Check if the main user header is also enabled
                if (wp.customize('enable_user_header').get()) {
                     $( selector ).toggle( isTopbarEnabled );
                } else {
                    $( selector ).hide(); // Ensure they are hidden if main toggle is off
                }
            });
        }

        wp.customize( 'user_header_show_topbar', function( setting ) {
            // Check dependency on main toggle first
            wp.customize( 'enable_user_header', function( mainSetting ) {
                if (mainSetting.get()) {
                    toggleTopbarControls( setting );
                    setting.bind( function( newValue ) {
                        toggleTopbarControls( setting );
                    });
                }
                // Re-check when main toggle changes
                mainSetting.bind(function(mainValue) {
                     if (mainValue) {
                         toggleTopbarControls(wp.customize('user_header_show_topbar'));
                     } else {
                         // Hide all dependent controls if main toggle is off
                         toggleTopbarControls(wp.customize('user_header_show_topbar'));
                     }
                });
            });
        });

        // Add similar logic for user_header_show_custom_button, user_header_transparent etc.

    });
} )( jQuery );

