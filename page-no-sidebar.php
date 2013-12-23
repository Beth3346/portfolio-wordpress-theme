<?php 
	/*
	Template Name: Single-Column
	*/
?>

<?php get_header(); ?>
<div class="main-content">
	<article class="article-full" role="article">		
	<?php while ( have_posts() ) : the_post(); ?>
					
		<h1 class="page-title"><?php the_title(); ?></h1>

		<?php the_content(); ?>
		
		<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		
		<?php edit_post_link(__('Edit','elr'), '[', ']'); ?>

	<?php endwhile; ?>	
	</article>
</div>
<?php get_footer(); ?>