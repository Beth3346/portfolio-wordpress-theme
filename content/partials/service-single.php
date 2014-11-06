<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $availability = get_post_meta( $post->ID, '_service_availability', true );
    $price = get_post_meta($post->ID, '_service_price', true);
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
            <?php if ( get_the_terms( $post->ID, 'service_type' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'service_type', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( $availability ) : ?><li><?php echo esc_html( $availability ); ?></li><?php endif; ?>
            <?php if ( $price ) : ?><li>$<?php echo esc_html( $price ); ?></li><?php endif; ?>
        </ul>    
    </div>    
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>