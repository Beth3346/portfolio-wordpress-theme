<?php
/*
Template Name: Static-Home
*/
?>
<?php get_header(); ?>
<div class="main-content">
	<article class="article" role="article">
			<?php while ( have_posts() ) : the_post(); ?>
						
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','themify').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			<?php edit_post_link(__('Edit','themify'), '[', ']'); ?>
			<?php comments_template(); ?>		
		<?php endwhile; ?>
	</article>	
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>