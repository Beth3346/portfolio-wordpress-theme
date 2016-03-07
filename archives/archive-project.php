<?php get_header(); ?>
<main class="main-content elr-container">
    <?php elr_cpt_grid($wp_query, 'project', array('technology', 'portfolio'), false, false); ?>
</main>
<?php get_footer(); ?>