<?php
    global $post;
    $id = get_post_meta( $post->ID, '_product_id', true );
    $color = get_post_meta( $post->ID, '_product_color', true );
    $weight = get_post_meta( $post->ID, '_product_weight', true );
    $height = get_post_meta( $post->ID, '_product_height', true );
    $width = get_post_meta( $post->ID, '_product_width', true );
    $size = get_post_meta( $post->ID, '_product_size', true );
    $condition = get_post_meta( $post->ID, '_product_condition', true );
    $country = get_post_meta( $post->ID, '_product_country', true );
    $creator = get_post_meta( $post->ID, '_product_creator', true );
    $price = get_post_meta( $post->ID, '_product_price', true );
    $availability = get_post_meta( $post->ID, '_product_availability', true );
    $purchase_url = get_post_meta( $post->ID, '_product_purchase_url', true );
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header>
        <ul class="post-meta">
            <?php elr_post_comments(); ?>
        </ul>

        <h1 class="post-title" role="heading"><?php the_title(); ?></h1>
    </header>

    <div class="drm-row">
    
        <?php elr_post_thumbnail( 'cpt-image-holder' ); ?>

        <!-- display custom post info -->
        <ul class="cpt-info">

            <?php if ( get_the_terms( $post->ID, 'product_type' ) ) : ?>
                <li><i class="fa fa-gift"></i> <?php elr_taxonomy_terms( 'product_type', $post->ID ); ?></li>
                <li><i class="fa fa-tag"></i> <?php elr_taxonomy_terms( 'product_tag', $post->ID ); ?></li>
            <?php endif; ?>

            <?php if ( $id ) : ?>
                <li>
                    <span class="drm-bold">#: </span>
                    <?php echo esc_html( $id ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $color ) : ?>
                <li>
                    <span class="drm-bold">Color: </span>
                    <?php echo esc_html( $color ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $weight ) : ?>
                <li>
                    <span class="drm-bold">Weight: </span>
                    <?php echo esc_html( $weight ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $height ) : ?>
                <li>
                    <span class="drm-bold">Height: </span>
                    <?php echo esc_html( $height ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $width ) : ?>
                <li>
                    <span class="drm-bold">Width: </span>
                    <?php echo esc_html( $width ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $size ) : ?>
                <li>
                    <span class="drm-bold">Size: </span>
                    <?php echo esc_html( $size ); ?>
                </li>
            <?php endif; ?>

            <?php if ( get_the_terms( $post->ID, 'brand' ) ) : ?>
                <li>
                    <span class="drm-bold">Brand: </span>
                    <?php elr_taxonomy_terms( 'brand', $post->ID ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $condition ) : ?>
                <li>
                    <span class="drm-bold">Condition: </span>
                    <?php echo esc_html( $condition ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $country ) : ?>
                <li>
                    <span class="drm-bold">Made in: </span>
                    <?php echo esc_html( $country ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $creator ) : ?>
                <li>
                    <span class="drm-bold">Made by: </span>
                    <?php echo esc_html( $creator ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $availability ) : ?>
                <li>
                    <span class="drm-bold">Availability: </span>
                    <?php echo esc_html( $availability ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $price ) : ?>
                <li>
                    <span class="drm-bold">$</span>
                    <?php echo esc_html( $price ); ?>
                </li>
            <?php endif; ?>

            <?php if ( $purchase_url ) : ?>
                <li><a class="cpt-buy-link" href="<?php echo esc_url( $purchase_url ); ?>"><i class="fa fa-shopping-cart"></i> Buy Now</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <?php elr_post_content( $post->ID, false ); ?>

    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>