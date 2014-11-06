<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $expire_datetime = get_post_meta( $post->ID, '_announcement_expire_datetime', true );
    $expected_response = get_post_meta( $post->ID, '_announcement_expected_response', true );
    $url = get_post_meta( $post->ID, '_announcement_url', true );
    $priority = get_post_meta( $post->ID, '_announcement_priority', true );
    $type = get_post_meta( $post->ID, '_announcement_type', true );

    $expire_datetime ? $datetime = $expire_datetime : $datetime = null;
?>
<!-- check to see if announcement is expired -->
<?php if ( ! elr_is_expired( $datetime ) ) : ?>
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
                <?php if ( $type ) : ?><li><?php echo esc_html( $type ); ?></li><?php endif; ?>
                <?php if ( $priority ) : ?><li><?php echo esc_html( $priority ); ?></li><?php endif; ?>
                <?php if ( $expected_response ) : ?><li><?php echo esc_html( $expected_response ); ?></li><?php endif; ?>
            </ul>
        </div>

        <?php elr_post_content( $post->ID ); ?>

        <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
    </article>
<?php endif; ?>