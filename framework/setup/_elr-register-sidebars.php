<?php

///////////////////////////////////////
// Register Widgets
///////////////////////////////////////

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	));

	register_sidebar(array(
		'name' => 'Footer 1',
		'id' => 'footer',
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	));
}