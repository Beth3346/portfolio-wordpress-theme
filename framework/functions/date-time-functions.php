<?php

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_post_date() {
    $options = get_option( 'elr_theme_display_options' );

    if ( isset( $options['relative_publish_dates'] ) ) {
        $relative_publish_dates = $options['relative_publish_dates'];
    } else {
        $relative_publish_dates = NULL;
    }
    
    echo '<li class="post-date">';

    if ( $relative_publish_dates ) {
        echo '<i class="fa fa-calendar"></i> ';
        echo '<time datetime="';
            the_time('o-m-d');
        echo '" pubdate>';
            echo 'Posted ';
            echo human_time_diff( get_the_time('U'), current_time('timestamp') );
            echo ' ago ';
        echo '</time>';
    } else {
        echo '<i class="fa fa-calendar"></i> ';
        echo '<time datetime="';
            the_time('o-m-d');
        echo '" pubdate>';
        the_time('F j, Y');
        echo '</time>';
    }

    echo '</li>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_time_diff( $datetime ) {
    $current_time = current_time('timestamp') ;

    if ( $datetime ) {

        $datetime = strtotime( $datetime );
        echo '<li>';

        if ( $datetime > $current_time ) {

            echo 'in about ' . human_time_diff( $datetime, current_time('timestamp') );

        } else if ( $datetime = $current_time ) {

            echo 'Right Now';

        } else {

            echo 'about ' . human_time_diff( $datetime, current_time('timestamp') ) . ' ago';
        }

        echo '</li>';
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

function elr_start_end( $start_date, $start_time, $end_date, $end_time ) {

    if ( $start_date === $end_date ) {

        echo '<li>';
            echo mysql2date( 'l, F j, Y', $start_date );
            echo '</span><br>';
            echo mysql2date( 'g:i a', $start_time );
            echo '</span> to ';
            echo mysql2date( 'g:i a', $end_time );
            echo '</span>';
        echo '</li>';

    } else {

        echo '<li>';
            echo mysql2date( 'l, F j, Y', $start_date );
            echo '</span> at ';
            echo mysql2date( 'g:i a', $start_time );
            echo '</span><br /> to ';
            echo mysql2date( 'l, F j, Y', $end_date );
            echo '</span> at ';
            echo mysql2date( 'g:i a', $end_time );
            echo '</span>';
        echo '</li>';
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

function elr_is_expired( $datetime = null ) {
    $current_time = strtotime( current_time( 'Y-m-d H:i' ) );

    if ( $datetime ) {
        $datetime = strtotime( $datetime );
        return $datetime >= $current_time ? false : true;

    } else {

        return false;
    }
}