<?php get_header(); ?>
<main class="main-content elr-container">
    <?php elr_cpt_grid($wp_query, 'publication', array('genre', 'format'), true, true); ?>
</main>
<?php get_footer(); ?>