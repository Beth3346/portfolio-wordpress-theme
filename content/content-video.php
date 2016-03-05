<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header>
        <?php elr_post_title(); ?>
        <?php elr_post_meta( $post->ID ); ?>
    </header>
    <div><?php the_content(); ?></div>
    <footer><?php elr_edit_link(); ?></footer>
</article>