<?php get_header(); ?>
<main class="main-content">		
	<div class="content-holder">
		
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'elr' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		
		<?php if (have_posts()) : ?>
		
			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'content/content', get_post_format() ); ?>

			<?php endwhile; ?>
							
			<?php get_template_part( 'partials/pagination' ); ?>
		
		<?php else : ?>

	    	<?php get_template_part( 'content/content', 'none' ); ?>		

		<?php endif; ?>			

	</div>			
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>