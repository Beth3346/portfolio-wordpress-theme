<?php

/**
 * Test to see if the page is a date based archive page cpt archive
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return boolean
 */

function elr_is_cpt_archive() {
    if ( is_category() || is_author() || is_tag() || is_date() ) {
        return false;
    } else {
        return true;
    }
}

/**
 * Test to find out if post type is cpt
 *
 * @since  3.0.0
 * @access public
 * @param  string $post post to test optional
 * @return void
 */

function elr_is_custom_post_type( $post = NULL ) {
    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );

    // there are no custom post types
    if ( empty ( $all_custom_post_types ) ) {
        return FALSE;
    }

    $custom_types = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );

    // could not detect current type
    if ( ! $current_post_type ) {
        return FALSE;
    }

    return in_array( $current_post_type, $custom_types );
}

/**
 * Updates the number of posts that display on each archive page
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

if ( ! function_exists( 'elr_number_of_cpts' ) ) {

    function elr_number_of_cpts( $query ) {

        $cpts = array( 'faq', 'product', 'person', 'location', 'video', 'project', 'service' );
        $num = 20;

        if ( $query->is_main_query() ) {
            if ( is_post_type_archive( $cpts, $num ) ) {
                $query->set( 'posts_per_page', $num );
            }

            return $query;
        }
    }
     
    add_filter( 'pre_get_posts', 'elr_number_of_cpts' );
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_get_cpt_loop() {

    if ( have_posts() ) {

        while ( have_posts() ) : the_post();

            get_template_part( 'content/content', get_post_type() );

        endwhile;

        get_template_part( 'partials/pagination' );

    } else {

        get_template_part( 'content/content', 'none' );
    }
}