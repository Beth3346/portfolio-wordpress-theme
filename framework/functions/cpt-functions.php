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
    if ( is_category() || is_author() || is_tag() || is_date() || is_front_page() || is_home() ) {
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

function elr_number_of_cpts( $query, $num = -1, $post_types = array('project', 'video', 'publication', 'skill', 'tutorial'), $taxonomies = array('technology', 'portfolio') ) {

    if ( $query->is_main_query() ) {

        foreach ($post_types as $post_type) {
            if ( is_post_type_archive( $post_type, $num ) ) {
                $query->set( 'posts_per_page', $num );
            }
        }

        foreach ($taxonomies as $tax) {
            if ( is_tax( $tax ) ) {
                $query->set( 'posts_per_page', $num );
            }
        }

        return $query;
    }
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_cpt_loop() {

    if ( have_posts() ) {

        while ( have_posts() ) : the_post();

            get_template_part( 'content/content', get_post_type() );

        endwhile;

        get_template_part( 'partials/pagination' );

    } else {

        get_template_part( 'content/content', 'none' );
    }
}

function elr_get_post_count($post_type = 'post') {
    $posts = wp_count_posts( $post_type );
    return $posts->publish;
}

function elr_cpt_filters($taxonomies, $post_archive, $tax_term) {
    foreach ( $taxonomies as $tax ) {
        elr_tax_nav_filter( $post_archive, $tax, $tax_term );
    }
}

function elr_cpt_limit_filters($post_archive) {
    echo '<nav class="num-results-nav">';
    echo '<ul class="elr-inline-list num-results-menu">';
    echo '<li><a class="active" href="/' . $post_archive . '/" data-num="5">5</a></li>';
    echo '<li><a href="/' . $post_archive . '/" data-num="10">10</a></li>';
    echo '<li><a href="/' . $post_archive . '/" data-num="-1">All</a></li>';
    echo '</ul>';
    echo '</nav>';
}

function elr_post_count($query, $num_posts) {
    echo '<p class="post-count">Showing '. $query->post_count . ' of ' . $num_posts . '</p>';
}

function elr_cpt_grid($query, $post_type, $taxonomies, $show_count = false, $show_limit = false) {

    $tax_term = elr_get_current_tax( $query );

    // make sure post type actually exists
    if ( post_type_exists( $post_type ) ) {
        $num_posts = elr_get_post_count( $post_type );
        $post_archive = strtolower(get_post_type_object($post_type)->labels->name);

        // if project archive or project custom taxonomy show grid
        if ( elr_is_cpt_archive() || is_tax() ) {
            echo '<div class="cpt-grid elr-row">';
            if ( $show_limit || !empty($taxonomies) ) {
                echo '<div class="cpt-grid-nav elr-col-full">';

                if ( $show_limit ) {
                    echo '<h3 class="filter-heading">Limit Results:</h3>';
                    elr_cpt_limit_filters($post_archive);
                }

                if ( !empty($taxonomies) ) {
                    echo '<h3 class="filter-heading">Filter Results:</h3>';
                    elr_cpt_filters($taxonomies, $post_archive, $tax_term);
                }
                echo '</div>';
            }

            echo '<div class="cpt-grid-content elr-row" data-post-type="' . $post_type . '">';
            elr_loop();

            if ( $show_count ) {
                elr_post_count($query, $num_posts);
            }

            echo '</div>';
            echo '</div>';
        } else {
            // if category/tag/author/date archive show normal loop
            elr_normal_loop();
        }
    } else {
        $num_posts = 0;
        echo '<p>This post type does not exist</p>';
    }
}