<?php

///////////////////////////////////////////////////////////////////////////////////////////
// Define Constants
///////////////////////////////////////////////////////////////////////////////////////////

define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/images' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'TEMPLATES', 'includes/template-parts' );
define( 'FUNCTIONS', 'includes/functions' );
define( 'FRAMEWORK', get_template_directory() . '/framework' );

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
        locate_template( array( FUNCTIONS . '/_elr-theme-languages.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-post-thumbnails.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-feed-links.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-post-formats.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-main-navigation.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-register-sidebars.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-page-navigation.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-custom-theme-comment.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-read-more.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-theme-options.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-read-more-post-instant.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-remove-wp-version.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-right-now-custom-posts.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-social-media.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_elr-show-related-posts.php' ), true, true );
        locate_template( array( FUNCTIONS . '/_tgm-plugin-activation.php' ), true, true );
    }

    add_action( 'after_setup_theme', 'elr_setup' );
}

///////////////////////////////////////////////////////////////////////////////////////////
// You may add your custom functions here
///////////////////////////////////////////////////////////////////////////////////////////