<?php
/*
Template Name: Front-CPTs
*/
?>
<?php get_header(); ?>
<main class="cpt-content">
	<?php get_template_part( 'partials/announcements'); ?>
    <?php get_template_part( 'partials/front-content/front-posts'); ?>
</main>

<?php get_footer(); ?>