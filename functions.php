<?php

///////////////////////////////////////////
// You may add your custom functions here
///////////////////////////////////////////

function elr_theme_languages()
{
    locate_template( array( 'includes/functions/_elr-theme-languages.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_theme_languages' );

function elr_post_thumbnails()
{
    locate_template( array( 'includes/functions/_elr-post-thumbnails.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_post_thumbnails' );

function elr_main_navigation()
{
    locate_template( array( 'includes/functions/_elr-main-navigation.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_main_navigation' );

function elr_register_sidebars()
{
    locate_template( array( 'includes/functions/_elr-register-sidebars.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_register_sidebars' );

function elr_page_navigation()
{
    locate_template( array( 'includes/functions/_elr-page-navigation.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_page_navigation' );

function elr_custom_theme_comment()
{
    locate_template( array( 'includes/functions/_elr-custom-theme-comment.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_custom_theme_comment' );

function elr_read_more()
{
    locate_template( array( 'includes/functions/_elr-read-more.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_read_more' );

function elr_theme_options()
{
    locate_template( array( 'includes/functions/_elr-theme-options.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_theme_options' );

function tgm_plugin_activation()
{
    locate_template( array( 'includes/functions/_tgm-plugin-activation.php' ), true, true );
}
add_action( 'after_setup_theme', 'tgm_plugin_activation' );

function elr_filter()
{
    locate_template( array( 'includes/functions/_elr-filter.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_filter' );

function elr_read_more_post_instant()
{
    locate_template( array( 'includes/functions/_elr-read-more-post-instant.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_read_more_post_instant' );

function elr_remove_wordpress_version()
{
    locate_template( array( 'includes/functions/_elr-remove-wp-version.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_remove_wordpress_version' );

function elr_right_now_custom_posts()
{
    locate_template( array( 'includes/functions/_elr-right-now-custom-posts.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_right_now_custom_posts' );

function elr_social_media()
{
    locate_template( array( 'includes/functions/_elr-social-media.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_social_media' );

function elr_show_rel_posts()
{
    locate_template( array( 'includes/functions/_elr-show-related-posts.php' ), true, true );
}
add_action( 'after_setup_theme', 'elr_show_rel_posts' );