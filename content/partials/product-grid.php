<?php
    global $post;
    $price = get_post_meta( $post->ID, '_product_price', true );
    $purchase_url = get_post_meta( $post->ID, '_product_purchase_url', true );
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post cpt-grid-box"); ?>>

    <?php elr_post_thumbnail( 'cpt-grid-image-holder', array( 9999, 200 ) ); ?>

    <!-- display custom post info -->
    <ul>
        <li><h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>

        <?php if ( get_the_terms( $post->ID, 'brand' ) ) : ?>
            <li><?php elr_taxonomy_terms( 'brand', $post->ID ); ?></li>
        <?php endif; ?>

        <?php if ( $price ) : ?>
            <li>$<?php echo esc_html( $price ); ?></li>
        <?php endif; ?>

        <?php if ( $purchase_url ) : ?>
            <li><a class="cpt-button-link" href="<?php echo esc_url( $purchase_url ); ?>"><i class="fa fa-shopping-cart"></i> Buy Now</a></li>
        <?php endif; ?>

        <li><?php elr_post_actions_nav( $post->ID ); ?></li>
    </ul>
</article>