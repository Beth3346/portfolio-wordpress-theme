<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <!-- add pinterest url here --> 
    <!-- saved from url=(0014)about:internet-->
    <title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>

<?php

    //register styles and scripts
            
    function drm_register_stuff() {
        wp_register_script('respond', '//cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js', array(), null, true );
        wp_register_script('main', get_template_directory_uri() . '/js/elr-theme-boilerplate.1.0.0.min.js', array(), null, true );
        wp_register_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), null );
        wp_register_script('twitter-boostrap-scripts', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array(), null );
        wp_register_style('twitter-boostrap-style', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css', array(), null, 'screen' );
        wp_register_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css', array(), null, 'screen' );
        wp_register_style('style', get_template_directory_uri() . '/style.css', array(), null, 'screen' );
        // register any google fonts
    }

    add_action( 'wp_enqueue_scripts', 'drm_register_stuff');

    function drm_enqueue_stuff() {
        wp_enqueue_script( 'respond' );
        wp_enqueue_script( 'modernizr' );
        wp_enqueue_script( 'main' );
        wp_enqueue_script( 'twitter-boostrap-scripts' );
        wp_enqueue_style( 'twitter-boostrap-style' );
        wp_enqueue_style( 'font-awesome' );
        wp_enqueue_style( 'style' );
    }

    add_action( 'wp_enqueue_scripts', 'drm_enqueue_stuff');
?>
    <!-- add google plus url here --> 
    <!-- <link rel="author" href=""> -->
    
<!-- wp_header -->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
    <header role="banner">
        <!--Blog Title-->
        <a class="site-name" href="<?php bloginfo('url'); ?>"><?php bloginfo('name');  ?></a>
        <!--Blog Description-->
        <p class="site-description" ><?php bloginfo('description'); ?></p>

        <!--Main Blog Navigation-->
        <nav id="main-menu" role="navigation">
            <?php wp_nav_menu(array('theme_location' => 'main-nav' , 'fallback_cb' => 'default_main_nav' , 'container'  => 'mainNavWrapper' , 'menu_id' => 'main-nav' , 'menu_class' => 'main-nav')); ?>
        </nav>

        <div class="search-top">
            <div id="searchform-wrap">
                <?php // get searchform.php ?>
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>