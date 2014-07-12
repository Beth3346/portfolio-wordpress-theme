<?php

// Hide WordPress Version
if ( ! function_exists( 'elr_remove_wp_version' ) ) {
    function elr_remove_wp_version() {
       return '';
    }
}

add_filter('the_generator', 'elr_remove_wp_version'); 