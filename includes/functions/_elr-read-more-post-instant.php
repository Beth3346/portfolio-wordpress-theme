<?php

///////////////////////////////////////////////////////////////////////////////////////////////////
// Load the rest of a post using AJAX
///////////////////////////////////////////////////////////////////////////////////////////////////

global $drm_rmpi_needjs;

$drm_rmpi_needjs = false;

// enque the script, in the footer

add_action( 'template_redirect', 'drm_rmpi_add_js' );

function drm_rmpi_add_js() {

	// enqueue the script
	wp_register_script('main', get_template_directory_uri() . '/js/elr-theme-boilerplate.1.0.0.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'main' );

	// get current page protocol
	
	$protocol = isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://';

	// output admin-ajax.php URL with same protocol as current page
	
	$params = array( 'ajaxurl' => admin_url( 'admin-ajax.php', $protocol ) );

	wp_localize_script( 'main', 'main', $params );
}

// don't add the script if actually not needed

add_action( 'wp_print_footer_scripts', 'drm_rmpi_footer_maybe_remove', 1 );

function drm_rmpi_footer_maybe_remove() {
	global $drm_rmpi_needjs;
	if( !drm_rmpi_needjs ) {
		wp_deregister_script( 'main' );
	}
}

// inspect each post to check if there's a "read more" tag

add_action( 'the_post', 'drm_rmpi_check_single' );

function drm_rmpi_check_single( $post ) {
	if ( !is_single() ) {
		global $drm_rmpi_needjs;
		$drm_rmpi_needjs = true;
	}
}

// ajax handler

add_action('wp_ajax_nopriv_drm_rmpi_ajax', 'drm_rmpi_ajax');

add_action('wp_ajax_drm_rmpi_ajax', 'drm_rmpi_ajax');

function drm_rmpi_ajax() {

	// modify the way WP gets post content
	
	add_filter( 'the_content', 'drm_rmpi_get_2nd_half' );

		// setup the main Query again
		
		query_posts( 'p=' . absint( $_REQUEST['post_id'] ) );

		// "The Loop"
		
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			the_content();

			endwhile; else: 
				echo "post not found";
			endif;

		// reset Query
		
		wp_reset_query();

		// always die() in functions echoing content for Ajax requests
		
		die();	
}

// get the second part of a post after the "more" jump 

function drm_rmpi_get_2nd_half( $content ) {
	return $content;
}