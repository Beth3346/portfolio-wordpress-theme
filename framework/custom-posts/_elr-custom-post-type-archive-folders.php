<?php
//////////////////////////////////////////////////////////////////////////
// Selects Custom Post Type Templates for single and archive pages
//////////////////////////////////////////////////////////////////////////

add_filter( 'template_include', 'elr_custom_template_include' );

/**
 * Check if a post is a custom post type.
 * @param  mixed $post Post object or ID
 * @return boolean
 */

function elr_custom_template_include( $template ) {
    $custom_template_location = '/archives/';
    $cpt_tmp = NULL;
    if ( elr_is_cpt_archive() ) {
        
        if ( is_archive() ) {
            $cpt_tmp = get_stylesheet_directory() . $custom_template_location . 'archive-' . get_post_type() . '.php';
        } else if ( is_single() ) {
            $cpt_tmp = get_stylesheet_directory() . $custom_template_location . 'single-' . get_post_type() . '.php';
        }

        if ( file_exists( $cpt_tmp ) ) {
            return $cpt_tmp;
        }
    }
    return $template;
}