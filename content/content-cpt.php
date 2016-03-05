<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Custom Post Type Content Sample
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header><?php elr_post_title(); ?></header>
    <!-- if we have a featured image then display it -->
    <?php elr_post_thumbnail(); ?>
    <!-- display the post content -->
    <div>
        <?php if ( is_single() || is_page() ) : ?>
            <?php the_content(); ?>
        <?php else : ?>
        <div class="post-excerpt<?php echo $post->ID ?>">
            <?php the_excerpt(); ?>
        </div>
        <?php endif; ?>
    </div>
    <footer><?php elr_edit_link(); ?></footer>
</article>