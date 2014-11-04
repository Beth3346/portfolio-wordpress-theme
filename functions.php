<?php
$options = get_option( 'elr_theme_display_options' );

if( isset( $options['post_revisions'] ) ) {
    $post_revisions = $options['post_revisions'];
} else {
    $post_revisions = NULL;
}

///////////////////////////////////////////////////////////////////////////////////////////
// Define Constants
///////////////////////////////////////////////////////////////////////////////////////////

define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/images' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'FRAMEWORK', get_template_directory() . '/framework' );

///////////////////////////////////////////////////////////////////////////////////////////
// Load framework
///////////////////////////////////////////////////////////////////////////////////////////

require_once( FRAMEWORK . '/init.php' );

///////////////////////////////////////////////////////////////////////////////////////////
// No post revisions
///////////////////////////////////////////////////////////////////////////////////////////

if ( $post_revisions == true ) {
    $wpdb->query( "DELETE FROM $wpdb->posts WHERE post_type = 'revision'" );
}

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
        require_once( FRAMEWORK . '/setup/_elr-theme-languages.php' );
        require_once( FRAMEWORK . '/setup/_elr-post-thumbnails.php' );
        require_once( FRAMEWORK . '/setup/_elr-feed-links.php' );
        require_once( FRAMEWORK . '/setup/_elr-post-formats.php' );
        require_once( FRAMEWORK . '/setup/_elr-main-navigation.php' );
        require_once( FRAMEWORK . '/setup/_elr-register-sidebars.php' );
        require_once( FRAMEWORK . '/setup/_elr-page-navigation.php' );
        require_once( FRAMEWORK . '/setup/_elr-custom-theme-comment.php' );
        require_once( FRAMEWORK . '/setup/_elr-read-more.php' );
    }

    add_action( 'after_setup_theme', 'elr_setup' );
}

///////////////////////////////////////////////////////////////////////////////////////////
// You may add your custom functions here
///////////////////////////////////////////////////////////////////////////////////////////

if ( ! function_exists( 'elr_security_functions' ) ) {
    function elr_security_functions() {
        require_once( FRAMEWORK . '/security/_elr-remove-wp-version.php' );
    }

    add_action( 'after_setup_theme', 'elr_security_functions' );
}

if ( ! function_exists( 'elr_custom_posts' ) ) {
    function elr_custom_posts() {
        // TODO: fix this function
        require_once( FRAMEWORK . '/custom-posts/_elr-custom-post-type-archive-folders.php' );
    }

    add_action( 'after_setup_theme', 'elr_custom_posts' );
}

if ( ! function_exists( 'elr_vendor_functions' ) ) {
    function elr_vendor_functions() {
        require_once( FRAMEWORK . '/vendor/tgm-plugin-activation.php' );
    }

    add_action( 'after_setup_theme', 'elr_vendor_functions' );
}

if ( ! function_exists( 'elr_theme_options' ) ) {
    function elr_theme_options() {
        require_once( FRAMEWORK . '/theme-options/_elr-theme-options.php' );
    }

    add_action( 'after_setup_theme', 'elr_theme_options' );
}