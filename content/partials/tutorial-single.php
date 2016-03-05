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
    <div>
        <?php elr_post_thumbnail( 'cpt-image-holder' ); ?>
        <!-- display custom post info -->
        <ul class="cpt-info">
            <?php if ( get_the_terms( $post->ID, 'lesson' ) ) : ?>
                <li><i class="fa fa-cube"></i> <span class="elr-bold">Lesson:</span> <?php elr_taxonomy_terms( 'lesson', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( get_the_terms( $post->ID, 'difficulty' ) ) : ?>
                <li><i class="fa fa-wrench"></i> <span class="elr-bold">Difficulty Level:</span> <?php elr_taxonomy_terms( 'difficulty', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( $completion_time ) : ?><li><i class="fa fa-clock-o"></i> <span class="elr-bold">Est. Completion Time:</span> <?php echo esc_html( $completion_time ); ?></li><?php endif; ?>
            <?php if ( $url ) : ?><li><a class="cpt-button-link" target="_blank" href="<?php echo esc_url( $url ); ?>">See Completed Demo</a></li><?php endif; ?>
        </ul>
    </div>
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>