<?php

/**
 * Provides default values for the Display Options.
 */
function elr_theme_default_display_options() {
        
    $defaults = array(
    );
    
    return apply_filters( 'elr_theme_default_display_options', $defaults );
        
} // end elr_theme_default_display_options

function elr_initialize_theme_options() {

    // If the theme options don't exist, create them.
    if( false == get_option( 'elr_theme_display_options' ) ) {        
        add_option( 'elr_theme_display_options', apply_filters( 'elr_theme_default_display_options', elr_theme_default_display_options() ) );
    } // end if

    // First, we register a section. This is necessary since all future options must belong to a 
    add_settings_section(
        'general_settings_section',            // ID used to identify this section and with which to register options
        __( 'Display Options', 'elr' ),        // Title to be displayed on the administration page
        'elr_general_options_callback',        // Callback used to render the description of the section
        'elr_theme_display_options'            // Page on which to add this section of options
    );
    
    // Finally, we register the fields with WordPress
    register_setting(
        'elr_theme_display_options',
        'elr_theme_display_options',
        'elr_theme_validate_display_options'
    );
        
} // end elr_initialize_theme_options
add_action( 'admin_init', 'elr_initialize_theme_options' );

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function provides a simple description for the General Options page. 
 *
 * It's called from the 'elr_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function elr_general_options_callback() {
    echo '<p>' . __( 'Choose display options', 'elr' ) . '</p>';
} // end elr_general_options_callback

// Field Callbacks

/* ------------------------------------------------------------------------ *
 * Setting Callbacks
 * ------------------------------------------------------------------------ */ 
 
/**
 * Sanitization callback for the social options. Since each of the social options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *        
 * @params        $input        The unsanitized collection of options.
 *
 * @returns                        The collection of sanitized values.
 */

function elr_theme_validate_display_options( $input ) {

    // Create our array for storing the validated options
    $output = array();
        
    // Loop through each of the incoming options
    foreach( $input as $key => $value ) {
                
        // Check to see if the current option has a value. If so, process it.
        if( isset( $input[$key] ) ) {
                
            // Strip all HTML and PHP tags and properly handle quoted strings
            $output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
                        
        } // end if
                
    } // end foreach
        
    // Return the array processing any additional functions filtered by this action
    return apply_filters( 'elr_theme_validate_display_options', $output, $input );

} // end elr_theme_validate_display_options