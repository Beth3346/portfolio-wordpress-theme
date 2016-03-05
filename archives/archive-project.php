<?php get_header(); ?>
<main class="main-content elr-container">
    <?php elr_cpt_grid($wp_query, 'project', array('technology', 'portfolio'), true, true); ?>
</main>
<?php get_footer(); ?>