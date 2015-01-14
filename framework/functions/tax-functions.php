<?php

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_get_current_tax( $query ) {

    if ( is_tax() ) {

        $tax_term = $query->queried_object;
        return $tax_term->name;

    } else {

        return null;
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

function elr_tax_nav( $post_type, $taxonomy, $current_term = null ) {

    $tax_args = array(
        'orderby'           => 'name',
        'order'             => 'ASC',
        'hide_empty'        => true
    );

    $tax_name = ucwords( str_replace( '_' , ' ', $taxonomy ) );
    $terms = get_terms( array( $taxonomy ), $tax_args );
    $term_names = array();

    // create an array of term names
    foreach ( $terms as $term ) {
        array_push( $term_names, $term->name );
    }

    if ( $terms ) {
        echo '<nav class="taxonomy-nav">';
        echo '<h4>' . $tax_name . ': </h4>';
        echo '<ul data-tax="' . $taxonomy . '">';

        if ( $current_term && in_array( $post_type, $term_names, $current_term ) ) {
            echo '<li><a href="/' . $post_type . '/" data-term="all">All</a></li>';
        } else {
            echo '<li><a href="/' . $post_type . '/" class="active" data-term="all">All</a></li>';
        }
    
            // list all terms
            foreach ( $terms as $term ) {
                $term_link = get_term_link( $term );
                echo '<li>';
                    echo '<a href="';
                    echo esc_url( $term_link ) . '"';

                        if ( $term->name === $current_term ) {
                            echo 'class="active"';
                        }

                        echo 'data-term="' . $term->slug . '"';
                    echo '>';
                    echo( ucwords( $term->name ) );
                echo '</a></li>';
            }
        echo '</ul></nav>';        
    }
}

/**
 * Echos comma separated taxonomy term links
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_taxonomy_terms( $taxonomy, $id ) {
    $terms = get_the_terms( $id, $taxonomy );
    $last_key = array_search( end( $terms ), $terms );

    foreach ( $terms as $key => $value ) {
        $term_link = get_term_link( $value );

        echo '<a href="';
        echo $term_link;
        echo '">';
        echo mb_convert_case($value->name, MB_CASE_TITLE, "UTF-8");

        if ( $key === $last_key ) {
            echo '</a> ';
        } else {
            echo '</a>, ';
        }    
    }
}