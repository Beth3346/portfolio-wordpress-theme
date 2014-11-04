<?php

//////////////////////////////////////////////////////////////////////
// Register Custom Menu Function
//////////////////////////////////////////////////////////////////////

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus( array(
		'main-nav' => __( 'Main Navigation', 'elr' ),
	) );
}

// $defaults = array(
//     'theme_location'  => 'main-nav',
//     'menu'            => '',
//     'container'       => 'nav',
//     'container_class' => '',
//     'container_id'    => '',
//     'menu_class'      => 'menu',
//     'menu_id'         => '',
//     'echo'            => true,
//     'fallback_cb'     => 'wp_page_menu',
//     'before'          => '',
//     'after'           => '',
//     'link_before'     => '',
//     'link_after'      => '',
//     'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
//     'depth'           => 0,
//     'walker'          => ''
// );

// wp_nav_menu( $defaults );

//wp_nav_menu( array( 'theme_location' => 'main-nav') );

//////////////////////////////////////////////////////////////////////
// Default Main Nav Function
//////////////////////////////////////////////////////////////////////

if ( ! function_exists( 'default_main_nav' ) ) {
    function default_main_nav() {
    	echo '<ul id="main-nav" class="main-nav row">';
    	   wp_list_pages( 'title_li=' );
    	echo '</ul>';
    }
}