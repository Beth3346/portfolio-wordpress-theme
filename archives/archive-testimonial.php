<?php $front_page_options = ( array )get_option( 'elr_theme_front_page_options' ); ?>
<?php get_header(); ?>
<main class="main-content">
    <div class="content-holder">
        <?php if ( $front_page_options['testimonials_heading'] ) : ?>
            <h1 class="page-title" role="heading"><?php echo esc_html( $front_page_options['testimonials_heading'] ); ?></h1>
        <?php endif; ?>
        <?php elr_get_loop(); ?>
    </div>
    <?php get_sidebar(); ?>
</main>
<?php elr_get_contact(); ?>
<?php get_footer(); ?>