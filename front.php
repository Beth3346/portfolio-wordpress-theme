<?php
/*
Template Name: Static-Home
*/
?>
<?php get_header(); ?>
<main class="main-content">
	<div class="content-holder">
		<?php while ( have_posts() ) : the_post(); ?>
						
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			<?php edit_post_link(__('Edit','elr'), '[', ']'); ?>
			<?php comments_template(); ?>		
		<?php endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>