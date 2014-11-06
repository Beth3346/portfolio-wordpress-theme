<?php
    if( !is_single() ) : global $more; $more = 0; endif; //enable more link
    global $post;
    $first_name = get_post_meta( $post->ID, '_person_first_name', true );
    $last_name = get_post_meta( $post->ID, '_person_last_name', true );
    $suffix = get_post_meta( $post->ID, '_person_suffix', true );
    $job_title = get_post_meta($post->ID, '_person_job_title', true);
    $work_phone = get_post_meta($post->ID, '_person_work_phone', true);
    
    $social_media = array(
        'work_email' => get_post_meta($post->ID, '_person_work_email', true),
        'facebook' => get_post_meta($post->ID, '_person_facebook', true),
        'twitter' => get_post_meta($post->ID, '_person_twitter', true),
        'google_plus' => get_post_meta($post->ID, '_person_google_plus', true),
        'pinterest' => get_post_meta($post->ID, '_person_pinterest', true),
        'github' => get_post_meta($post->ID, '_person_github', true),
        'linkedin' => get_post_meta($post->ID, '_person_linkedin', true)
    )
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header>
        <?php elr_post_title(); ?>
    </header>
    <div class="drm-row">
        <?php elr_post_thumbnail( 'person-image-holder', array( 400, 9999 ) ); ?>
        <!-- display custom post info -->
        <ul class="person-info">
            <?php if ( $job_title ) : ?><li><?php echo esc_html( $job_title ) ?></li><?php endif; ?>
            <?php if ( $work_phone ) : ?><li><i class="fa fa-phone"></i> <?php echo esc_html( $work_phone ) ?></li><?php endif; ?>
            <?php elr_social_media( $social_media ); ?>
            <?php if ( get_the_terms( $post->ID, 'person_role' ) ) : ?>
                <li><i class="fa fa-users"></i> <?php elr_taxonomy_terms( 'person_role', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( get_the_terms( $post->ID, 'department' ) ) : ?>
                <li><i class="fa fa-building"></i> <?php elr_taxonomy_terms( 'department', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( get_the_terms( $post->ID, 'hobby' ) ) : ?>
                <li><i class="fa fa-paw"></i> <?php elr_taxonomy_terms( 'hobby', $post->ID ); ?></li>
            <?php endif; ?>
        </ul>
    </div>    
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>