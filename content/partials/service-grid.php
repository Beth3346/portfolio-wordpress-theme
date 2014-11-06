<?php
    global $post;
    $availability = get_post_meta( $post->ID, '_service_availability', true );
    $price = get_post_meta($post->ID, '_service_price', true);
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post cpt-grid-box"); ?>>

    <?php elr_post_thumbnail( 'cpt-grid-image-holder', array( 9999, 200 ) ); ?>

    <!-- display custom post info -->
    <ul>
        <li><h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>
        <?php if ( $price ) : ?><li>$<?php echo esc_html( $price ); ?></li><?php endif; ?>
        <li><a class="cpt-button-link" href="<?php the_permalink(); ?>">See More</a></li>
        <li><?php elr_post_actions_nav( $post->ID ); ?></li>
    </ul>
</article>