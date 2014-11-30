<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable 
    $legal_name = get_post_meta( $post->ID, '_organization_legal_name', true );
    $industry = get_post_meta( $post->ID, '_organization_industry', true );
    $founder = get_post_meta( $post->ID, '_organization_founder', true );
    $year_founded = get_post_meta( $post->ID, '_organization_year_founded', true );
    $year_dissolved = get_post_meta( $post->ID, '_organization_year_dissolved', true );
    $status = get_post_meta( $post->ID, '_organization_status', true );
    
    $address = array(
        'street_address' => get_post_meta( $post->ID, '_organization_street_address', true ),
        'city' => get_post_meta( $post->ID, '_organization_city', true ),
        'state' => get_post_meta( $post->ID, '_organization_state', true ),
        'zip_code' => get_post_meta( $post->ID, '_organization_zip_code', true ),
        'country' => get_post_meta( $post->ID, '_organization_country', true )
    );

    $map = get_post_meta( $post->ID, '_organization_map', true );
    $phone = get_post_meta( $post->ID, '_organization_phone', true );
    $url = get_post_meta( $post->ID, '_organization_url', true );
    
    $social_media = array(
        'email' => get_post_meta($post->ID, '_organization_email', true),
        'facebook' => get_post_meta($post->ID, '_organization_facebook', true),
        'twitter' => get_post_meta($post->ID, '_organization_twitter', true),
        'google_plus' => get_post_meta($post->ID, '_organization_google_plus', true),
        'yelp' => get_post_meta($post->ID, '_organization_yelp', true)
    )
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
            <?php if ( get_the_terms( $post->ID, 'brand_name' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'brand_name', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( get_the_terms( $post->ID, 'membership' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'membership', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( get_the_terms( $post->ID, 'license' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'license', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( get_the_terms( $post->ID, 'industry' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'industry', $post->ID ); ?></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="drm-row">
        <?php elr_address( $address ); ?>
        <ul class="cpt-info-center">
            <?php if ( $phone ) : ?><li><?php elr_phone( $phone ) ?></li><?php endif; ?>
            <?php if ( $url ) : ?><li><a href="<?php echo esc_url( $url ) ?>"><?php echo esc_url( $url ) ?></a></li><?php endif; ?>
            <?php elr_social_media( $social_media ); ?>
        </ul>
        <ul class="cpt-info">            
            <?php if ( $legal_name ) : ?><li><?php echo esc_html( $legal_name ); ?></li><?php endif; ?>
            <?php if ( $industry ) : ?><li><span class="drm-bold">Primary Industry:</span> <?php echo esc_html( $industry ); ?></li><?php endif; ?>
            <?php if ( $founder ) : ?><li><span class="drm-bold">Founder(s):</span> <?php echo esc_html( $founder ); ?></li><?php endif; ?>
            <?php if ( $year_founded ) : ?><li><?php echo esc_html( $year_founded ); ?> - <?php if ( $year_dissolved ) : echo esc_html( $year_dissolved ); else : echo 'Present'; endif; ?></li><?php endif; ?>            
            <?php if ( $status ) : ?><li><?php echo esc_html( $status ); ?></li><?php endif; ?>
        </ul>
    </div>
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>