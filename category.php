<?php get_header(); ?>
<main class="main-content">
	<div class="content-holder">
        <?php // the loop ?>
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part( 'content', get_post_format() ); ?>
                
            <?php endwhile; ?>  

            <?php get_template_part( 'pagination' ); ?>

        <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>