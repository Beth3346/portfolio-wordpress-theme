<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $item = get_post_meta( $post->ID, '_review_item', true );
    $url = get_post_meta( $post->ID, '_review_url', true );
    $creator = get_post_meta( $post->ID, '_review_creator', true );
    $rating = get_post_meta( $post->ID, '_review_rating', true );
    $format = get_post_meta( $post->ID, '_review_format', true );
?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post post-review"); ?>>
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
            <?php if ( get_the_terms( $post->ID, 'review_type' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'review_type', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( $item ) : ?><li><?php echo esc_html( $item ); ?></li><?php endif; ?>
            <?php if ( $creator ) : ?><li><?php echo esc_html( $creator ); ?></li><?php endif; ?>
            <?php if ( $format ) : ?><li><?php echo esc_html( $format ); ?></li><?php endif; ?>
            <?php if ( $rating ) : ?><li><?php echo esc_html( $rating ); ?> Stars</li><?php endif; ?>
        </ul>
    </div>
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>