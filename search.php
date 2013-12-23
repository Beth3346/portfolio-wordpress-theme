<?php get_header(); ?>
<div class="main-content">		
	<article class="article" role="article">
		<?php if (have_posts()) : ?>
		
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'elr' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		
			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'includes/template-parts/_loop' , 'search'); ?>

			<?php endwhile; ?>
							
			<?php get_template_part( 'includes/template-parts/_pagination'); ?>
		
		<?php else : ?>

			<p><?php _e( 'Sorry, nothing found. Please try again with a different keyword.', 'elr' ); ?></p>

		<?php endif; ?>			

	</article>			
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>