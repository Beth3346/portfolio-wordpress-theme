<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <meta name="robots" content="index, follow" />
    <?php
        $social_options = (array)get_option('elr_theme_social_options');
        $pinterest = $social_options['pinterest_validation'];
        $google_verification = $social_options['google_verification'];
        $google_plus_url = $social_options['google_plus_url'];
    ?>
    <?php if( $google_verification ) : ?>
        <meta name="google-site-verification" content="<?php echo esc_attr( $google_verification ); ?>" />
    <?php endif; ?>
    <?php if( $pinterest ) : ?>
        <meta name="p:domain_verify" content="<?php echo esc_attr( $pinterest ); ?>" />
    <?php endif; ?>
    <?php if( $google_plus_url ) : ?>
        <link rel="author" href="<?php echo esc_attr( $google_plus_url ); ?>">
    <?php endif; ?>
    <!-- saved from url=(0014)about:internet-->
    <title><?php echo wp_title( '&nbsp;&ndash;&nbsp;', true, 'right' ) . bloginfo('name'); ?></title>

<?php

    //register styles and scripts

    function elr_register_stuff() {
        wp_register_script( 'respond', SCRIPTS . '/vendor/respond.min.js', array(), null );
        wp_register_script( 'main', SCRIPTS . '/elr-theme-boilerplate.2.0.0.js', array( 'jquery' ), null, true );
        wp_register_script( 'modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), null );
        wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), null, 'screen' );
        wp_register_style( 'style', get_template_directory_uri() . '/style.css', array(), null, 'screen' );
        wp_register_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans', array(), null, 'screen' );
        // register any google fonts
    }

    add_action( 'wp_enqueue_scripts', 'elr_register_stuff');

    function elr_enqueue_stuff() {
        // wp_enqueue_script( 'respond' );
        wp_enqueue_script( 'modernizr' );
        wp_enqueue_script( 'main' );
        wp_enqueue_style( 'font-awesome' );
        wp_enqueue_style( 'open-sans' );
        wp_enqueue_style( 'style' );
    }

    add_action( 'wp_enqueue_scripts', 'elr_enqueue_stuff');
?>

<!-- wp_header -->
<?php wp_head(); ?>
</head>
<?php get_template_part('partials/header'); ?>