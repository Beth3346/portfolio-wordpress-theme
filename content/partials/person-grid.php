<?php
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

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post cpt-grid-box"); ?>>

    <?php elr_post_thumbnail( 'cpt-grid-image-holder', array( 9999, 200 ) ); ?>

    <!-- display custom post info -->
    <ul>
        <li><h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>
        <?php if ( $job_title ) : ?><li><?php echo esc_html( $job_title ); ?></li><?php endif; ?>
        <?php if ( $work_phone ) : ?><li><?php elr_phone( $work_phone ); ?></li><?php endif; ?>
        <?php elr_social_media( $social_media ); ?>
        <li><a class="cpt-button-link" href="<?php the_permalink(); ?>">See More</a></li>
        <li><?php elr_post_actions_nav( $post->ID ); ?></li>
    </ul>
</article>