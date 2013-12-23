<?php get_header(); ?>
<div class="main-content">
	<?php while ( have_posts() ) : the_post(); ?>	
	<article class="article" role="article">
		
		<?php get_template_part( 'includes/template-parts/_loop' , 'single'); ?>

		<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		<?php get_template_part( 'includes/template-parts/_post-nav'); ?>

		<?php comments_template(); ?>
	</article>	
	<!-- /#content -->
	<?php endwhile; ?>
	<?php get_sidebar(); ?>
</div>	
<?php get_footer(); ?>