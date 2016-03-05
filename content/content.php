<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header>
        <?php elr_post_title(); ?>
        <?php elr_post_meta( $post->ID ); ?>
    </header>

    <!-- if we have a featured image then display it -->
    <?php elr_post_thumbnail(); ?>

    <!-- display the post content -->
    <div><?php elr_post_content( $post->ID ); ?></div>

    <footer><?php elr_edit_link(); ?></footer>

    <?php comments_template(); ?>

</article>