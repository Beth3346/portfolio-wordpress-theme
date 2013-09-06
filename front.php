<?php
/*
Template Name: Static-Home
*/
?>
<?php get_header(); ?>

<article class="article">

		<?php while ( have_posts() ) : the_post(); ?>
					
		<?php the_content(); ?>
		<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','themify').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		
		<?php edit_post_link(__('Edit','themify'), '[', ']'); ?>
		
		<?php //get comment template (comments.php) ?>
		<?php comments_template(); ?>
		
	
	<?php endwhile; ?>
</article>
<!-- /#content -->
		
<?php get_sidebar(); ?>

<?php get_footer(); ?>