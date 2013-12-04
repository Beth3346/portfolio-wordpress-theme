<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<section id="post-<?php the_ID(); ?>" <?php post_class("post clearfix $class"); ?>>
	
	<h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

	<p class="post-date"><time datetime="<?php the_time('o-m-d') ?>" pubdate><?php the_time('M j, Y') ?></time></p>

	<div class="post-meta"> 
		<p class="post-author"><?php the_author_posts_link() ?></p>
		<p class="post-category"><?php the_category(', ') ?></p>
		<?php the_tags(' <p class="post-tag">', ', ', '</p>'); ?>
		<?php if ( comments_open() ) : ?>
			<p class="post-comment"><?php comments_popup_link( __( '0 Comments', 'themify' ), __( '1 Comment', 'themify' ), __( '% Comments', 'themify' ) ); ?></p>
		<?php endif; ?>
	</div>

	<div>	
	<?php if ( is_single() || is_page() ) { ?>
		<div class="custom-post-image"><?php the_post_thumbnail(); ?></div>
		<?php the_content(); ?>
	<?php } else {?>
		<div class="post-excerpt<?php echo $post->ID ?>">
			<div class="custom-post-image"><?php the_post_thumbnail(); ?></div>
			<?php the_excerpt(); ?>
		</div>
	<?php } ?>
	</div>

	<?php edit_post_link(__('Edit', 'themify'), '[', ']'); ?>
	
</section>