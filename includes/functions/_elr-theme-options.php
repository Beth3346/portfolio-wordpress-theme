<?php

/**
 * This function introduces the theme options into the 'Appearance' menu and into a top-level 
 * 'DRW Theme' menu.
 */
function drw_theme_menu() {

	add_theme_page(
		'DRW Theme', 					// The title to be displayed in the browser window for this page.
		'DRW Theme',					// The text to be displayed for this menu item
		'administrator',					// Which type of users can see this menu item
		'drw_theme_options',			// The unique ID - that is, the slug - for this menu item
		'drw_theme_display'				// The name of the function to call when rendering this menu's page
	);

	add_menu_page(
		'DRW Theme',					// The value used to populate the browser's title bar when the menu page is active
		'DRW Theme',					// The text of the menu in the administrator's sidebar
		'administrator',					// What roles are able to access the menu
		'drw_theme_menu',				// The ID used to bind submenu items to this menu 
		'drw_theme_display'				// The callback function used to render this menu
	);

	add_submenu_page(
		'drw_theme_menu',				// The ID of the top-level menu page to which this submenu item belongs
		__( 'Display Options', 'drw' ),			// The value used to populate the browser's title bar when the menu page is active
		__( 'Display Options', 'drw' ),					// The label of this submenu item displayed in the menu
		'administrator',					// What roles are able to access this submenu item
		'drw_theme_display_options',	// The ID used to represent this submenu item
		'drw_theme_display'				// The callback function used to render the options for this submenu item
	);


} // end drw_theme_menu
add_action( 'admin_menu', 'drw_theme_menu' );

/**
 * Renders a simple page to display for the theme menu defined above.
 */
function drw_theme_display() {
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">
	
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'DRW Theme Options', 'drw' ); ?></h2>
		<?php settings_errors(); ?>

		<h2 class="nav-tab-wrapper"><?php _e( 'Display Options', 'drw' ); ?></h2>
		
		<form method="post" action="options.php">
			<?php
				settings_fields( 'drw_theme_display_options' );
				do_settings_sections( 'drw_theme_display_options' );

				submit_button(); 
			?>
		</form>
		
	</div><!-- /.wrap -->
<?php
} // end drw_theme_display

/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */ 

/**
 * Provides default values for the Display Options.
 */
function drw_theme_default_display_options() {

	$defaults = array(
		'show_testimonials'		=>	''
	);

	return apply_filters( 'drw_theme_default_display_options', $defaults );

} // end drw_theme_default_display_options

/**
 * Initializes the theme's display options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function drw_initialize_theme_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'drw_theme_display_options' ) ) {	
		add_option( 'drw_theme_display_options', apply_filters( 'drw_theme_default_display_options', drw_theme_default_display_options() ) );
	} // end if

	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'general_settings_section',			// ID used to identify this section and with which to register options
		__( 'Display Options', 'drw' ),		// Title to be displayed on the administration page
		'drw_general_options_callback',	// Callback used to render the description of the section
		'drw_theme_display_options'		// Page on which to add this section of options
	);

	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field(	
		'show_testimonials',						// ID used to identify the field throughout the theme
		__( 'Testimonials', 'drw' ),							// The label to the left of the option interface element
		'drw_toggle_testimonial_callback',	// The name of the function responsible for rendering the option interface
		'drw_theme_display_options',	// The page on which this option will be displayed
		'general_settings_section',			// The name of the section to which this field belongs
		array(								// The array of arguments to pass to the callback. In this case, just a description.
			__( 'Activate this setting to display testimonials on front page.', 'drw' ),
		)
	);

	// Finally, we register the fields with WordPress
	register_setting(
		'drw_theme_display_options',
		'drw_theme_display_options'
	);

} // end drw_initialize_theme_options
add_action( 'admin_init', 'drw_initialize_theme_options' );

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function provides a simple description for the General Options page. 
 *
 * It's called from the 'drw_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function drw_general_options_callback() {
	echo '<p>' . __( 'Select which areas of content you wish to display.', 'drw' ) . '</p>';
} // end drw_general_options_callback

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function renders the interface elements for toggling the visibility of the header element.
 * 
 * It accepts an array or arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function drw_toggle_testimonial_callback($args) {

	// First, we read the options collection
	$options = get_option('drw_theme_display_options');

	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_testimonials element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="show_testimonials" name="drw_theme_display_options[show_testimonials]" value="1" ' . checked( 1, isset( $options['show_testimonials'] ) ? $options['show_testimonials'] : 0, false ) . '/>'; 

	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="show_testimonials">&nbsp;'  . $args[0] . '</label>'; 

	echo $html;

} // end drw_toggle_header_callback

/* ------------------------------------------------------------------------ *
 * Setting Callbacks
 * ------------------------------------------------------------------------ */ 
 
/**
 * Sanitization callback for the social options. Since each of the social options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */


?>