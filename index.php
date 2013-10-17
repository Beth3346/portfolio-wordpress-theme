<?php get_header(); ?>	
	<article class="article" role="article">		
		<?php // the loop ?>
		<?php if (have_posts()) : ?>
		
			<?php while (have_posts()) : the_post(); ?>
	
				<?php get_template_part( 'includes/template-parts/loop' , 'index'); ?>
	
			<?php endwhile; ?>
							
			<?php get_template_part( 'includes/template-parts/pagination'); ?>
		
		<?php else : ?>
	
			<p><?php _e( 'Sorry, nothing found.', 'themify' ); ?></p>
	
		<?php endif; ?>			

	</article>
<!-- /#content -->
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>