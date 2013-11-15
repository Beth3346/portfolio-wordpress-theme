<?php

// Hide WordPress Version

function drm_remove_wp_version() {  
   return '';  
} 

add_filter('the_generator', 'drm_remove_wp_version'); 