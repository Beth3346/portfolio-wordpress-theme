<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<section id="post-<?php the_ID(); ?>" <?php post_class("post clearfix $class"); ?>>

	<p class="post-date"><time datetime="<?php the_time('o-m-d') ?>" pubdate><?php the_time('M j, Y') ?></time></p>
	
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
	<?php if ( is_single() || is_page() ) { ?>
		<div class="custom-post-image"><?php the_post_thumbnail(); ?></div>
		<?php the_content(); ?>
		<?php
			$action_call_options = ( array )get_option( 'drm_theme_action_call_options' );
			if ( ( $action_call_options['show_action_call'] == true ) && ( $action_call_options['action_call_content'] ) ) { ?>
				<div class="action-call">
					<?php echo $action_call_options['action_call_content']; ?>
				</div>
		<?php } ?>
	<?php } else {?>
		<section class="post-excerpt<?php echo $post->ID ?>">
			<?php echo get_post_meta($post->ID, 'post-video', $single=true) ?>
			<?php echo get_post_meta($post->ID, 'post-image', $single=true) ?>
			<div class="custom-post-image"><?php the_post_thumbnail(); ?></div>
			<?php the_excerpt(); ?>
		</section>
	<?php } ?>
	</section>

	<?php edit_post_link(__('Edit', 'themify'), '[', ']'); ?>
	
</section>