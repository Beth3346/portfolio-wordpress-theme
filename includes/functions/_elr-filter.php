<?php

add_filter('the_title', wp_strip_all_tags);
add_filter('the_title', ucwords);