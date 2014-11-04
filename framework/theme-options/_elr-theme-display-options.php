<?php

/**
 * Provides default values for the Display Options.
 */
function elr_theme_default_display_options() {
        
    $defaults = array(
        'color_schemes' => 'default',
        'ajax_posts' => true,
        'relative_publish_dates' => false,
        'post_revisions' => false
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
    
    add_settings_field(
        'ajax_posts',
        __( 'AJAX Posts:', 'elr' ),
        'elr_ajax_posts_callback',
        'elr_theme_display_options',
        'general_settings_section',
        array(
            __( 'Load the rest of the post without leaving the current page.', 'elr' ),
        )
    );
    
    add_settings_field(
        'relative_publish_dates',
        __( 'Relative Publish Dates:', 'elr' ),
        'elr_relative_publish_dates_callback',
        'elr_theme_display_options',
        'general_settings_section',
        array(
            __( 'Display relative post dates.', 'elr' ),
        )
    );
    
    add_settings_field(
        'post_revisions',
        __( 'Disable Post Revisions:', 'elr' ),
        'elr_post_revisions_callback',
        'elr_theme_display_options',
        'general_settings_section',
        array(
            __( 'Disable post revisions.', 'elr' ),
        )
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

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function renders the interface elements for toggling the visibility of the header element.
 * 
 * It accepts an array or arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */

function elr_ajax_posts_callback() {
        
    // First, we read the social options collection
    $options = get_option( 'elr_theme_display_options' );
    $status = $options['ajax_posts'];
        
    // Render the output
    ?>
    <?php if ( $status ) : ?>
        <input type="checkbox" class="widefat" id="ajax-posts" checked name="elr_theme_display_options[ajax_posts]">
    <?php else : ?>
        <input type="checkbox" class="widefat" id="ajax-posts" name="elr_theme_display_options[ajax_posts]">
    <?php endif; ?>

    <small>Load the rest of the post without leaving the current page.</small>
        
<?php } // end elr_ajax_posts_callback

function elr_relative_publish_dates_callback() {
        
    // First, we read the social options collection
    $options = get_option( 'elr_theme_display_options' );
    $status = $options['relative_publish_dates'];
        
    // Render the output
    ?>
    <?php if ( $status ) : ?>
        <input type="checkbox" class="widefat" id="relative-publish-dates" checked name="elr_theme_display_options[relative_publish_dates]">
    <?php else : ?>
        <input type="checkbox" class="widefat" id="relative-publish-dates" name="elr_theme_display_options[relative_publish_dates]">
    <?php endif; ?>

    <small>Display Twitter like relative timestamps instead of post dates.</small>
        
<?php } // end elr_relative_publish_dates_callback

function elr_post_revisions_callback() {
        
    // First, we read the social options collection
    $options = get_option( 'elr_theme_display_options' );
    $status = $options['post_revisions'];
        
    // Render the output
    ?>
    <?php if ( $status ) : ?>
        <input type="checkbox" class="widefat" id="post-revisions" checked name="elr_theme_display_options[post_revisions]">
    <?php else : ?>
        <input type="checkbox" class="widefat" id="post-revisions" name="elr_theme_display_options[post_revisions]">
    <?php endif; ?>

    <small>Disable post revisions. Caution: will remove all previous revisions.</small>
        
<?php } // end elr_relative_publish_dates_callback

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