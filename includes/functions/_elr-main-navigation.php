<?php

///////////////////////////////////////
// Register Custom Menu Function
///////////////////////////////////////

if (function_exists('register_nav_menus')) {
	register_nav_menus( array(
		'main-nav' => __( 'Main Navigation', 'themify' ),
	) );
}

///////////////////////////////////////
// Default Main Nav Function
///////////////////////////////////////

function default_main_nav() {
	echo '<ul id="main-nav" class="main-nav row">';
	wp_list_pages('title_li=');
	echo '</ul>';
}