<?php

// Show posts of custom post types post types on blog loop
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
add_action( 'pre_get_posts', 'add_my_post_types_to_category' );
add_action( 'pre_get_posts', 'add_my_post_types_to_tag' );
add_action( 'pre_get_posts', 'add_my_post_types_to_archive' );
add_action( 'pre_get_posts', 'add_my_post_types_to_author' );

function add_my_post_types_to_query( $query ) {
    $post_types = array( 'post' );

	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', $post_types );
	return $query;
}

function add_my_post_types_to_category( $query ) {
    $post_types = array( 'post' );

    if ( is_category() && $query->is_main_query() )
        $query->set( 'post_type', $post_types );
    return $query;
}

function add_my_post_types_to_tag( $query ) {
    $post_types = array( 'post' );

    if ( is_tag() && $query->is_main_query() )
        $query->set( 'post_type', $post_types );
    return $query;
}

function add_my_post_types_to_author( $query ) {
    $post_types = array( 'post' );

    if ( is_author() && $query->is_main_query() )
        $query->set( 'post_type', $post_types );
    return $query;
}

function add_my_post_types_to_archive( $query ) {
    $post_types = array( 'post' );

    if ( is_archive() && !is_post_type_archive() && !is_tag() && !is_category() && !is_author() && $query->is_main_query() )
        $query->set( 'post_type', $post_types );
    return $query;
}