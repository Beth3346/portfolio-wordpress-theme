<?php

function theme_queue_js(){
	if ( (!is_admin()) && is_single() && comments_open() && get_option('thread_comments') ) {
  		wp_enqueue_script( 'comment-reply' );
	}
}

add_action('wp_print_scripts', 'theme_queue_js');

///////////////////////////////////////
// Custom Theme Comment List Markup
///////////////////////////////////////
if ( ! function_exists( 'custom_theme_comment' ) ) {
	function custom_theme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; 
	   ?>

		<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
		<section>
			<p class="comment-author"> 
				<?php echo get_avatar($comment,$size='48'); ?> <?php printf('<cite>%s</cite>', get_comment_author_link()) ?><br />
				<small class="comment-time"><strong>
				<?php comment_date('M d, Y'); ?>
				</strong> @
				<?php comment_time('H:i:s'); ?>
				<?php edit_comment_link( __('Edit', 'elr'),' [',']') ?>
				</small>
			</p>
			<div class="commententry">
				<?php if ($comment->comment_approved == '0') : ?>
				<p>
					<em><?php _e('Your comment is awaiting moderation.', 'elr') ?></em>
				</p>
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
			<p class="reply">
				<?php comment_reply_link(
					array_merge( 
						$args, array(
							'add_below' => 'comment',
							'depth' => $depth,
							'reply_text' => __( 'Reply', 'elr' ),
							'max_depth' => $args['max_depth']
						)
					)
				) ?>
			</p>			
		</section>
	
	<?php }
}