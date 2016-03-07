<?php get_header(); ?>
<main class="main-content elr-container">
    <?php elr_cpt_grid($wp_query, 'tutorial', array('lesson', 'difficulty'), false, false); ?>
</main>
<?php get_footer(); ?>