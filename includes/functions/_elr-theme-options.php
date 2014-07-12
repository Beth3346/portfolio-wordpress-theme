<?php

/**
 * This function introduces the theme options into the 'Appearance' menu and into a top-level 
 * 'ELR Theme' menu.
 */
if ( ! function_exists( 'elr_theme_menu' ) ) {
    function elr_theme_menu() {

            add_theme_page(
                'ELR Theme',                                         // The title to be displayed in the browser window for this page.
                'ELR Theme',                                        // The text to be displayed for this menu item
                'administrator',                                        // Which type of users can see this menu item
                'elr_theme_options',                        // The unique ID - that is, the slug - for this menu item
                'elr_theme_display'                                // The name of the function to call when rendering this menu's page
            );
        
            add_menu_page(
                'ELR Theme',                                        // The value used to populate the browser's title bar when the menu page is active
                'ELR Theme',                                        // The text of the menu in the administrator's sidebar
                'administrator',                                        // What roles are able to access the menu
                'elr_theme_menu',                                // The ID used to bind submenu items to this menu 
                'elr_theme_display'                                // The callback function used to render this menu
            );
            
            add_submenu_page(
                'elr_theme_menu',                                // The ID of the top-level menu page to which this submenu item belongs
                __( 'Display Options', 'elr' ),                        // The value used to populate the browser's title bar when the menu page is active
                __( 'Display Options', 'elr' ),                                        // The label of this submenu item displayed in the menu
                'administrator',                                        // What roles are able to access this submenu item
                'elr_theme_display_options',        // The ID used to represent this submenu item
                'elr_theme_display'                                // The callback function used to render the options for this submenu item
            );
            
            add_submenu_page(
                'elr_theme_menu',
                __( 'Social Options', 'elr' ),
                __( 'Social Options', 'elr' ),
                'administrator',
                'elr_theme_social_options',
                create_function( null, 'elr_theme_display( "social_options" );' )
            );


    } // end elr_theme_menu
}
add_action( 'admin_menu', 'elr_theme_menu' );

/**
 * Renders a simple page to display for the theme menu defined above.
 */

if ( ! function_exists( 'elr_theme_display' ) ) {
    function elr_theme_display( $active_tab = '' ) {
    ?>
            <!-- Create a header in the default WordPress 'wrap' container -->
            <div class="wrap">
            
                    <div id="icon-themes" class="icon32"></div>
                    <h2><?php _e( 'ELR Theme Options', 'elr' ); ?></h2>
                    <?php settings_errors(); ?>
                    
                    <?php if( isset( $_GET[ 'tab' ] ) ) {
                        $active_tab = $_GET[ 'tab' ];
                    } else if( $active_tab == 'social_options' ) {
                        $active_tab = 'social_options';
                    } else {
                        $active_tab = 'display_options';
                    } // end if/else ?>
                    
                    <h2 class="nav-tab-wrapper">
                        <a href="?page=elr_theme_options&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Display Options', 'elr' ); ?></a>
                        <a href="?page=elr_theme_options&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Social Options', 'elr' ); ?></a>
                    </h2>
                    
                    <form method="post" action="options.php">
                    <?php                    
                        if ( $active_tab == 'display_options' ) {

                            settings_fields( 'elr_theme_display_options' );
                            do_settings_sections( 'elr_theme_display_options' );

                        } else {

                            settings_fields( 'elr_theme_social_options' );
                            do_settings_sections( 'elr_theme_social_options' );

                        }
                        
                        submit_button();                    
                    ?>
                    </form>
                    
            </div><!-- /.wrap -->
    <?php
    } // end elr_theme_display
}

require_once( get_template_directory().'/includes/functions/theme-options/_elr-theme-display-options.php' );
require_once( get_template_directory().'/includes/functions/theme-options/_elr-theme-social-options.php' );