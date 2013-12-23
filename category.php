<?php get_header(); ?>
<div class="main-content">
	<article class="article" role="article">		
		<?php // the loop ?>
		<?php if (have_posts()) : ?>
		
			<?php while (have_posts()) : the_post(); ?>
	
				<?php get_template_part( 'includes/template-parts/_loop' , 'index'); ?>
	
			<?php endwhile; ?>
							
			<?php get_template_part( 'includes/template-parts/_pagination'); ?>
		
		<?php else : ?>
	
			<p><?php _e( 'Sorry, nothing found.', 'elr' ); ?></p>
	
		<?php endif; ?>			

	</article>		
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>