<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $completion_time = get_post_meta( $post->ID, '_tutorial_completion_time', true );
    $url = get_post_meta( $post->ID, '_tutorial_url', true );
?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header>
        <?php elr_post_title(); ?>
        <ul class="post-meta">
            <?php elr_post_comments(); ?>
        </ul>
    </header>
    <div class="drm-row">
        <?php elr_post_thumbnail( 'cpt-image-holder' ); ?>
        <!-- display custom post info -->
        <ul class="cpt-info">
            <?php if ( get_the_terms( $post->ID, 'lesson' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'lesson', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( get_the_terms( $post->ID, 'difficulty' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'difficulty', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( $completion_time ) : ?><li><?php echo esc_html( $completion_time ); ?></li><?php endif; ?>
        </ul>    
    </div>    
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>