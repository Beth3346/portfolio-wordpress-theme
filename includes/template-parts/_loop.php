<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<section id="post-<?php the_ID(); ?>" <?php post_class("post clearfix $class"); ?>>

	<time datetime="<?php the_time('o-m-d') ?>" class="post-date" pubdate><?php the_time('M j, Y') ?></time>
	
	<h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

	<p class="post-meta"> 
		<span class="post-author"><?php the_author_posts_link() ?></span>
		<span class="post-category"><?php the_category(', ') ?></span>
		<?php the_tags(' <span class="post-tag">', ', ', '</span>'); ?>
		<?php if ( comments_open() ) : ?>
			<span class="post-comment"><?php comments_popup_link( __( '0 Comment', 'themify' ), __( '1 Comment', 'themify' ), __( '% Comments', 'themify' ) ); ?></span>
		<?php endif; //post comment ?>
	</p>
	<section>	
	<?php if ( is_single() || is_page() ) {
			the_content();
		} else {?>
			<?php echo get_post_meta($post->ID, 'post-video', $single=true) ?>
			<?php echo get_post_meta($post->ID, 'post-image', $single=true) ?>
			<?php the_excerpt();
		} ?>
	</section>
	<?php edit_post_link(__('Edit', 'themify'), '[', ']'); ?>
	
</section>
<!-- /.post -->