<?php get_header(); ?>
<main class="main-content">		
	<article class="article" role="article">
		<?php if (have_posts()) : ?>
		
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'elr' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		
			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part( TEMPLATES . '/_loop' , 'search'); ?>

			<?php endwhile; ?>
							
			<?php get_template_part( TEMPLATES . '/_pagination'); ?>
		
		<?php else : ?>

			<p><?php _e( 'Sorry, nothing found. Please try again with a different keyword.', 'elr' ); ?></p>

		<?php endif; ?>			

	</article>			
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>