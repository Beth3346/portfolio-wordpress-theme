<?php

// Hide WordPress Version

function elr_remove_wp_version() {  
   return '';  
} 

add_filter('the_generator', 'elr_remove_wp_version'); 