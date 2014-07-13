<?php

///////////////////////////////////////////////////////////////////////////////////////////
// Define Constants
///////////////////////////////////////////////////////////////////////////////////////////

define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/images' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'FRAMEWORK', get_template_directory() . '/framework' );
define( 'TEMPLATES', FRAMEWORK . '/template-parts' );
define( 'FUNCTIONS', FRAMEWORK . '/functions' );

///////////////////////////////////////////////////////////////////////////////////////////
// Load framework
///////////////////////////////////////////////////////////////////////////////////////////

require_once( FRAMEWORK . '/init.php' );

///////////////////////////////////////////////////////////////////////////////////////////
// Set Up Content Width Value
///////////////////////////////////////////////////////////////////////////////////////////

if ( ! isset( $content_width ) ) {
    $content_width = 1100;
}

///////////////////////////////////////////////////////////////////////////////////////////
// Set up theme default and register various supported features
///////////////////////////////////////////////////////////////////////////////////////////

if ( ! function_exists( 'elr_setup' ) ) {
    function elr_setup() {
        require_once( FUNCTIONS . '/_elr-theme-languages.php' );
        require_once( FUNCTIONS . '/_elr-post-thumbnails.php' );
        require_once( FUNCTIONS . '/_elr-feed-links.php' );
        require_once( FUNCTIONS . '/_elr-post-formats.php' );
        require_once( FUNCTIONS . '/_elr-main-navigation.php' );
        require_once( FUNCTIONS . '/_elr-register-sidebars.php' );
        require_once( FUNCTIONS . '/_elr-page-navigation.php' );
        require_once( FUNCTIONS . '/_elr-custom-theme-comment.php' );
        require_once( FUNCTIONS . '/_elr-read-more.php' );
        require_once( FUNCTIONS . '/_elr-theme-options.php' );
        require_once( FUNCTIONS . '/_elr-read-more-post-instant.php' );
        require_once( FUNCTIONS . '/_elr-remove-wp-version.php' );
        require_once( FUNCTIONS . '/_elr-right-now-custom-posts.php' );
        require_once( FUNCTIONS . '/_elr-social-media.php' );
        require_once( FUNCTIONS . '/_elr-show-related-posts.php' );
        require_once( FUNCTIONS . '/_tgm-plugin-activation.php' );
    }

    add_action( 'after_setup_theme', 'elr_setup' );
}

///////////////////////////////////////////////////////////////////////////////////////////
// You may add your custom functions here
///////////////////////////////////////////////////////////////////////////////////////////