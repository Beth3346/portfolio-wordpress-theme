<?php
    global $post;
    $address = array(
        'street_address' => get_post_meta( $post->ID, '_location_street_address', true ),
        'city' => get_post_meta( $post->ID, '_location_city', true ),
        'state' => get_post_meta( $post->ID, '_location_state', true ),
        'zip_code' => get_post_meta( $post->ID, '_location_zip_code', true ),
        'country' => get_post_meta( $post->ID, '_location_country', true )
    );

    $phone = get_post_meta( $post->ID, '_location_phone', true );
    $email = get_post_meta( $post->ID, '_location_email', true );
    $url = get_post_meta( $post->ID, '_location_url', true );
    $map = get_post_meta( $post->ID, '_location_map', true );
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post cpt-grid-box"); ?>>

    <?php elr_post_thumbnail( 'cpt-grid-image-holder', array( 9999, 200 ) ); ?>

    <!-- display custom post info -->
    <ul>
        <li><h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>
        <li><?php elr_address( $address ); ?></li>        
        <?php if ( $phone ) : ?><li><?php elr_phone( $phone ) ?></li><?php endif; ?>
        <li><a class="cpt-button-link" href="<?php the_permalink(); ?>">See More</a></li>
        <li><?php elr_post_actions_nav( $post->ID ); ?></li>
    </ul>
</article>