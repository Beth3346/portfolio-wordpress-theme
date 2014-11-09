<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $expire_datetime = get_post_meta( $post->ID, '_announcement_expire_datetime', true );
    $expected_response = get_post_meta( $post->ID, '_announcement_expected_response', true );
    $url = get_post_meta( $post->ID, '_announcement_url', true );
    $priority = get_post_meta( $post->ID, '_announcement_priority', true );
    $type = get_post_meta( $post->ID, '_announcement_type', true );

    $expire_datetime ? $datetime = $expire_datetime : $datetime = null;
            
    if ( $type ) {
        $announcement_class = $type . '-alert';
    } else {
        $announcement_class = 'muted-alert';
    }
?>
<!-- check to see if announcement is expired -->
<?php if ( ! elr_is_expired( $expire_datetime ) ) : ?>
    <article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
        <div class="drm-dismissible-alert <?php echo esc_attr( $announcement_class ); ?>">
            <button class="close">x</button>
            <header class="header">
                <?php if ( $type === 'danger' ) : ?>
                    <i class="fa fa-exclamation-triangle"></i>
                <?php elseif ( $type === 'warning' ) : ?>
                    <i class="fa fa-bomb"></i>
                <?php elseif ( $type === 'success' ) : ?>
                    <i class="fa fa-thumbs-up"></i>
                <?php elseif ( $type === 'information' ) : ?>
                    <i class="fa fa-bullhorn"></i>
                <?php else : ?>
                    <i class="fa fa-circle-o"></i>
                <?php endif; ?>
                <?php elr_post_title(); ?>
            </header>
            <?php elr_post_content( $post->ID ); ?>
            <a href="<?php the_permalink(); ?>">Read More</a>
            <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
        </div>
    </article>
<?php endif; ?>