<?php get_header(); ?>
	<?php while ( have_posts() ) : the_post(); ?>
	
	<article class="article">
		
		<?php // get loop.php ?>
		<?php get_template_part( 'includes/loop' , 'single'); ?>

		<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','themify').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		<?php // get post-nav.php (next/prev post link) ?>
		<?php get_template_part( 'includes/post-nav'); ?>

		<?php // get comment template (comments.php) ?>
		<?php comments_template(); ?>
	</article>	
	<!-- /#content -->

<?php endwhile; ?>

<?php get_sidebar(); ?>
	
<?php get_footer(); ?>