<?php

///////////////////////////////////////////////////////////////////////////////////////////////////
// Load the rest of a post using AJAX
///////////////////////////////////////////////////////////////////////////////////////////////////

// enque the script, in the footer

add_action( 'template_redirect', 'drm_rmpi_add_js' );

function drm_rmpi_add_js() {

	// enqueue the script
	wp_register_script( 'main', SCRIPTS . '/elr-theme-boilerplate.1.0.0.js', array( 'jquery' ), null, true );

	// get current page protocol
	
	$protocol = isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://';

	// output admin-ajax.php URL with same protocol as current page
	
	$params = array( 'ajaxurl' => admin_url( 'admin-ajax.php', $protocol ) );

	wp_localize_script( 'main', 'drm_rmpi', $params );
	wp_enqueue_script( 'main' );
}

// ajax handler

// add_action('wp_ajax_nopriv_drm_rmpi_ajax', 'drm_rmpi_ajax');

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