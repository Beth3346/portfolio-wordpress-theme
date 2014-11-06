<?php
    if( !is_single() ) : global $more; $more = 0; endif; //enable more link
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

    $bus_hours = array(
        'sun_open' => get_post_meta( $post->ID, '_location_sun_open', true ),
        'mon_open' => get_post_meta( $post->ID, '_location_mon_open', true ),
        'tue_open' => get_post_meta( $post->ID, '_location_tue_open', true ),
        'wed_open' => get_post_meta( $post->ID, '_location_wed_open', true ),
        'thu_open' => get_post_meta( $post->ID, '_location_thu_open', true ),
        'fri_open' => get_post_meta( $post->ID, '_location_fri_open', true ),
        'sat_open' => get_post_meta( $post->ID, '_location_sat_open', true ),
        'sun_close' => get_post_meta( $post->ID, '_location_sun_close', true ),
        'mon_close' => get_post_meta( $post->ID, '_location_mon_close', true ),
        'tue_close' => get_post_meta( $post->ID, '_location_tue_close', true ),
        'wed_close' => get_post_meta( $post->ID, '_location_wed_close', true ),
        'thu_close' => get_post_meta( $post->ID, '_location_thu_close', true ),
        'fri_close' => get_post_meta( $post->ID, '_location_fri_close', true ),
        'sat_close' => get_post_meta( $post->ID, '_location_sat_close', true )
    );
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header>
        <ul class="post-meta">
            <?php if ( get_the_terms( $post->ID, 'location_type' ) ) : ?>
                <li>Location Type: <?php elr_taxonomy_terms( 'location_type', $post->ID ); ?></li>
            <?php endif; ?>

            <?php if ( get_the_terms( $post->ID, 'organization' ) ) : ?>
                <li>Organization: <?php elr_taxonomy_terms( 'organization', $post->ID ); ?></li>
            <?php endif; ?>

            <?php elr_post_comments(); ?>
        </ul>
    </header>

    <!-- display business contact infomation -->
    <div itemscope itemtype="http://schema.org/Corporation">
        <?php if ( is_single() || is_page() ) : ?>
            <h1 itemprop="name" class="post-title" role="heading"><?php the_title(); ?></h1>
        <?php else : ?>
            <h1 itemprop="name" class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>

        <?php elr_address( $address ); ?>
        <ul class="post-info">
            <?php if ( $phone ) : ?><li><?php elr_phone( $phone ) ?></li><?php endif; ?>
            <?php if ( $email ) : ?><li><?php elr_email( $email ) ?></li><?php endif; ?>
        </ul>
    </div>
    <div class="drm-row">
        <?php elr_post_thumbnail( 'location-image-holder' ); ?>
        <?php if ( $map ) : ?>
            <div class="location-map-holder">
                <?php elr_map( $map ); ?>
            </div>
        <?php endif; ?>        
    </div>
    <?php if ( $bus_hours ) : ?>
        <h2>Business Hours</h2>
        <?php elr_bus_hours( $bus_hours ); ?>
    <?php endif; ?>
    
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>