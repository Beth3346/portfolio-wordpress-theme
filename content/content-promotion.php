<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $url = get_post_meta($post->ID, '_promotion_url', true);
    $action_call = get_post_meta($post->ID, '_promotion_call_to_action', true);
    $expiry_datetime = get_post_meta($post->ID, '_promotion_expire_datetime', true);
    $expiry_datetime ? $datetime = $expiry_datetime : $datetime = null;
?>
<!-- check to see if promo is expired -->
<?php if ( ! elr_is_expired( $datetime ) ) : ?>
    <article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
        <header><?php elr_post_title(); ?></header>
        <div class="drm-row">
            <?php elr_post_thumbnail( 'cpt-image-holder' ); ?>
            <!-- display custom post info -->
            <ul class="cpt-info">
                <?php if ( get_the_terms( $post->ID, 'promotion_type' ) ) : ?>
                    <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'promotion_type', $post->ID ); ?></li>
                <?php endif; ?>
                <?php elr_post_comments(); ?>
                <?php if ( $datetime ) : ?><li>Ends: <?php echo mysql2date( 'l, F j, Y', $datetime ); ?></li><?php endif; ?>
                <?php elr_time_diff( $datetime ); ?>
                <?php if ( $url ) : ?>
                    <li><a class="cpt-button-link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $action_call ); ?></a></li>
                <?php endif; ?>
            </ul>    
        </div>    
        <?php elr_post_content( $post->ID ); ?>
        <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
    </article>
<?php endif; ?>