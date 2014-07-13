<?php

/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */

/**
 * Provides default values for the Social Options.
 */
function elr_theme_default_social_options() {
        
    $defaults = array(
        'google_plus_url' => '',
        'google_verification' => '',
        'pinterest_validation' => ''
    );
    
    return apply_filters( 'elr_theme_default_social_options', $defaults );
        
} // end elr_theme_default_social_options

function elr_theme_intialize_social_options() {

    if( false == get_option( 'elr_theme_social_options' ) ) {        
        add_option( 'elr_theme_social_options', apply_filters( 'elr_theme_default_social_options', elr_theme_default_social_options() ) );
    } // end if
    
    add_settings_section(
        'social_settings_section',            // ID used to identify this section and with which to register options
        __( 'Social Options', 'elr' ),        // Title to be displayed on the administration page
        'elr_social_options_callback',        // Callback used to render the description of the section
        'elr_theme_social_options'            // Page on which to add this section of options
    );
    
    add_settings_field(        
        'google_plus_url',                                                
        'Google Plus URL',                                                        
        'elr_google_plus_url_callback',        
        'elr_theme_social_options',        
        'social_settings_section'                        
    );
    
    add_settings_field(        
        'google_verification',                                                
        'Google Verification',                                                        
        'elr_google_verification_callback',        
        'elr_theme_social_options',        
        'social_settings_section'                        
    );
    
    add_settings_field(        
        'pinterest_validation',                                                
        'Pinterest Validation',                                                        
        'elr_pinterest_validation_callback',        
        'elr_theme_social_options',        
        'social_settings_section'                        
    );
    
    register_setting(
        'elr_theme_social_options',
        'elr_theme_social_options'
        //'elr_theme_validate_social_options'
    );
        
} // end elr_theme_intialize_social_options
add_action( 'admin_init', 'elr_theme_intialize_social_options' );

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function provides a simple description for the Social Options page. 
 *
 * It's called from the 'elr_theme_intialize_social_options' function by being passed as a parameter
 * in the add_settings_section function.
 */

function elr_social_options_callback() {
    echo '<p>' . __( 'Provide social information for your business', 'elr' ) . '</p>';
} // end elr_social_options_callback

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function renders the interface elements for toggling the visibility of the header element.
 * 
 * It accepts an array or arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */   

function elr_google_plus_url_callback() {
        
    // First, we read the social options collection
    $options = get_option( 'elr_theme_social_options' );
        
    // Render the output
    echo '<input type="url" class="widefat" id="google_plus_url" name="elr_theme_social_options[google_plus_url]" value="' . esc_attr($options['google_plus_url']) . '" />';
        
} // end elr_google_plus_url_callback

function elr_google_verification_callback() {
        
    // First, we read the social options collection
    $options = get_option( 'elr_theme_social_options' );
        
    // Render the output
    echo '<input type="text" class="widefat" id="google_verification" name="elr_theme_social_options[google_verification]" value="' . esc_attr($options['google_verification']) . '" />';
        
} // end elr_google_verification_callback

function elr_pinterest_validation_callback() {
        
    // First, we read the social options collection
    $options = get_option( 'elr_theme_social_options' );
        
    // Render the output
    echo '<input type="text" class="widefat" id="pinterest_validation" name="elr_theme_social_options[pinterest_validation]" value="' . esc_attr($options['pinterest_validation']) . '" />';
        
} // end elr_pinterest_validation_callback

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

// function elr_theme_validate_social_options( $input ) {

//         // Create our array for storing the validated options
//         $output = array();
        
//         // Loop through each of the incoming options
//         foreach( $input as $key => $value ) {
                
//                 // Check to see if the current option has a value. If so, process it.
//                 if( isset( $input[$key] ) ) {
                
//                         // Strip all HTML and PHP tags and properly handle quoted strings
//                         $output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
                        
//                 } // end if
                
//         } // end foreach
        
//         // Return the array processing any additional functions filtered by this action
//         return apply_filters( 'elr_theme_validate_social_options', $output, $input );

// } // end elr_theme_validate_social_options