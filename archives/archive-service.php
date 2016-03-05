<?php get_header(); ?>
<main class="main-content elr-container">
    <?php elr_cpt_grid($wp_query, 'service', array('service_type'), true, true); ?>
</main>
<?php get_footer(); ?>