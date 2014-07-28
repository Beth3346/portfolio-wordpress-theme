<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Custom Post Type Archive Sample
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<?php get_header(); ?>
<main class="main-content">
    <div class="content-holder">
        <?php // the loop ?>
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part( 'content/content', get_post_type() ); ?>
                
            <?php endwhile; ?>  

            <?php get_template_part( 'partials/pagination' ); ?>

        <?php else : ?>

            <?php get_template_part( 'content/content', 'none' ); ?>

        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
</main>
<!--Check to see if contact should be displayed -->

<?php get_footer(); ?>