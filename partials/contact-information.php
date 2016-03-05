<?php
    $args = array(
        'post_type' => 'organization',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'ASC'
    );

    $query = new WP_Query( $args );
?>
<?php
if ( $query->have_posts() ):
    while ( $query->have_posts() ) : $query->the_post();
        global $post;
        $post_id = $post->ID;
        $address = array(
            'street_address' => get_post_meta( $post_id, '_organization_street_address', true ),
            'city' => get_post_meta( $post_id, '_organization_city', true ),
            'state' => get_post_meta( $post_id, '_organization_state', true ),
            'zip_code' => get_post_meta( $post_id, '_organization_zip_code', true ),
            'country' => get_post_meta( $post_id, '_organization_country', true )
        );

        $phone = get_post_meta( $post_id, '_organization_phone', true );
        $email = get_post_meta( $post_id, '_organization_email', true );
        $url = get_post_meta( $post_id, '_organization_url', true );
        $map = get_post_meta( $post_id, '_organization_map', true );

        ?>
        <div class="organization-contact-info">
            <div itemscope itemtype="http://schema.org/LocalBusiness">
                <p itemprop="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                <?php elr_address( $address ); ?>
                <?php if ( $phone ) : ?><p><?php elr_phone( $phone ) ?></p><?php endif; ?>
                <?php if ( $email ) : ?><p><?php elr_email( $email ) ?></p><?php endif; ?>
            </div>
            <?php if ( $map ) : ?>
                <div class="google-map-holder"><?php elr_map( $map ); ?></div>
            <?php endif; ?>
            <div class="elr-text-center"><?php elr_post_actions_nav( $post_id ); ?></div>
        </div>
        <?php
    endwhile;
endif; ?>
<?php wp_reset_postdata(); ?>