<?php

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
        require_once( FRAMEWORK . '/custom-posts/_elr-right-now-custom-posts.php' );
        require_once( FRAMEWORK . '/custom-posts/_elr-social-media.php' );
    }

    add_action( 'after_setup_theme', 'elr_custom_posts' );
}

if ( ! function_exists( 'elr_custom_functions' ) ) {
    function elr_custom_functions() {
        require_once( FRAMEWORK . '/post-enhancements/_elr-show-related-posts.php' );
    }

    add_action( 'after_setup_theme', 'elr_custom_functions' );
}

$options = get_option( 'elr_theme_display_options' );
$status = $options['ajax_posts'];

if ( !(function_exists( 'elr_ajax_posts_functions' )) && ($status == true) ) {
    function elr_ajax_posts_functions() {
        require_once( FRAMEWORK . '/post-enhancements/_elr-read-more-post-instant.php' );
    }

    add_action( 'after_setup_theme', 'elr_ajax_posts_functions' );
}

if ( ! function_exists( 'elr_vendor_functions' ) ) {
    function elr_vendor_functions() {
        require_once( FRAMEWORK . '/vendor/_tgm-plugin-activation.php' );
    }

    add_action( 'after_setup_theme', 'elr_vendor_functions' );
}

if ( ! function_exists( 'elr_theme_options' ) ) {
    function elr_theme_options() {
        require_once( FRAMEWORK . '/theme-options/_elr-theme-options.php' );
    }

    add_action( 'after_setup_theme', 'elr_theme_options' );
}