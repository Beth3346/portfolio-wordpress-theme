<?php

/////////////////////////////////////////////////////////////////////////////////////
// make read more link to post
// add a data-post attribute to make it easy for script to find and use
/////////////////////////////////////////////////////////////////////////////////////

if ( ! function_exists( 'custom_excerpt_more' ) ) {
    function custom_excerpt_more($more) {
    	global $post;

    	return '...<p><a href="'. get_permalink( get_the_ID() ) . '"' . 'data-post="' . get_the_ID() . '" class="more-link">Read More</a></p>';
    }
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );

if ( ! function_exists( 'custom_excerpt_length' ) ) {
    function custom_excerpt_length( $length ) {
    	return 100;
    }
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );