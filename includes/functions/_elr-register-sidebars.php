<?php

///////////////////////////////////////
// Register Widgets
///////////////////////////////////////

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h1 class="widgettitle">',
		'after_title' => '</h1>',
	));

	register_sidebar(array(
		'name' => 'Footer 1',
		'id' => 'footer',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h1 class="widgettitle">',
		'after_title' => '</h1>',
	));
}