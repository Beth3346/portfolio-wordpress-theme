<?php get_header(); ?>
<main class="main-content elr-container">
    <?php elr_cpt_grid($wp_query, 'publication', array('genre', 'format'), false, false); ?>
</main>
<?php get_footer(); ?>