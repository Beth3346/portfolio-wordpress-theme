<?php

global $elr_rmpi_needjs;

$elr_rmpi_needjs = false;

// enque the script, in the footer

add_action( 'template_redirect', 'elr_rmpi_add_js' );

function elr_rmpi_add_js() {

	// enqueue the script
	
	wp_enqueue_script( 'elr_rmpi', get_template_directory_uri() . '/js/elr-wp-theme-boilerplate.1.0.0.min.js', array( 'jquery' ), true );

	// get current page protocol
	
	$protocol = isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://';

	// output admin-ajax.php URL with same protocol as current page
	
	$params = array( 'ajaxurl' => admin_url( 'admin-ajax.php', $protocol ) );

	wp_localize_script( 'elr_rmpi', 'elr_rmpi', $params );
}

// don't add the script if actually not needed

add_action( 'wp_print_footer_scripts', 'elr_rmpi_footer_maybe_remove', 1 );

function elr_rmpi_footer_maybe_remove() {
	global $elr_rmpi_needjs;
	if( !elr_rmpi_needjs ) {
		wp_deregister_script( 'elr_rmpi' );
	}
}

// inspect each post to check if there's a "read more" tag

add_action( 'the_post', 'elr_rmpi_check_single' );

function elr_rmpi_check_single( $post ) {
	if ( !is_single() ) {
		global $elr_rmpi_needjs;
		$elr_rmpi_needjs = true;
	}
}

// ajax handler

add_action('wp_ajax_nopriv_elr_rmpi_ajax', 'elr_rmpi_ajax');

add_action('wp_ajax_elr_rmpi_ajax', 'elr_rmpi_ajax');

function elr_rmpi_ajax() {

	// modify the way WP gets post content
	
	add_filter( 'the_content', 'elr_rmpi_get_2nd_half' );

		// setup the main Query again
		
		query_posts( 'p=' . absint( $_REQUEST['post_id'] ) );

		// "The Loop"
		
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			echo '<div class="custom-post-image">';
				the_post_thumbnail();
			echo '</div>';
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

function elr_rmpi_get_2nd_half( $content ) {
	return $content;
}