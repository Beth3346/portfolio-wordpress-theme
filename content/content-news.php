<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header>
        <?php elr_post_meta( $post->ID ); ?>
        <?php elr_post_title(); ?>
    </header>

    <?php elr_post_thumbnail( 'post-image-holder' ); ?>
    <?php elr_post_content( $post->ID ); ?>

    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>