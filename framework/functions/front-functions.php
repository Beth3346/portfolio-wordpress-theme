<?php

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_front_section_heading( $heading = 'Recent Articles' ) {

    if ( $heading ) {
        echo '<h1 class="section-heading elr-text-center">';
        echo esc_html( $heading );
        echo '</h1>';
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

function elr_front_thumbnail( $shape = 'rectangle', $title_length = 50, $url = null ) {

    $shape === 'circle' ? $class = 'circle-box' : $class = 'rectangle-box';
    $url ? $url = esc_url( $url ) : $url = get_the_permalink();

    if ( has_post_thumbnail() ) {
        echo '<figure class="' . $class . '">';
            echo '<a href="';
            echo $url;
            echo '" title="' . elr_trim_title( $title_length ) . '">';
            the_post_thumbnail( array( 9999, 196 ) );
            echo '</a>';
        echo '</figure>';
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

function elr_front_title( $length = 50, $url = null ) {

    $url ? $url = esc_url( $url ) : $url = get_the_permalink();
    echo '<h1><a href="';
    echo $url;
    echo '" title="';
    echo esc_attr( elr_trim_title( $length ) );
    echo '">';
    echo esc_html( elr_trim_title( $length ) );
    echo '</a></h1>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_front_content( $id, $length = 50 ) {

    if ( get_the_content() ) {
        echo '<p class="front-content">';
        echo esc_html( elr_trim_content( $length ) );
        echo '</p>';
    }

    echo '<div class="front-post-actions">';
    elr_post_actions_nav( $id );
    echo '</div>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_front_more( $text = 'Read More', $url = null ) {

    $url ? $url = esc_url( $url ) : $url = get_the_permalink();
    echo '<a href="';
    echo $url;
    echo '" class="elr-button elr-button-info">';
    echo $text;
    echo '</a>';
}