<?php get_header(); ?>		
<article class="article">	
	
	<?php // the loop ?>
	<?php if (have_posts()) : ?>
	
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'themify' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	
		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'includes/loop' , 'search'); ?>

		<?php endwhile; ?>
						
		<?php get_template_part( 'includes/pagination'); ?>
	
	<?php else : ?>

		<p><?php _e( 'Sorry, nothing found. Please try again with a different keyword.', 'themify' ); ?></p>

	<?php endif; ?>			

</article>
<!-- /#content -->
		
<?php //get_sidebar(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>