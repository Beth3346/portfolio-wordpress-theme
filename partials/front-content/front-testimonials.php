<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $post_id = $post->ID;
    $client = get_post_meta( $post_id, '_testimonial_client', true );
    $project_url = get_post_meta( $post_id, '_testimonial_project_url', true );
    $title = get_post_meta( $post_id, '_testimonial_title', true );
    $author = get_post_meta( $post_id, '_testimonial_author', true );
?>
<div class="testimonial-slide">
    <?php elr_post_thumbnail( 'testimonial-image-holder circle-box' ); ?>
    <!-- display the post content -->
    <blockquote>
        <?php elr_post_content( $post_id, false ); ?>
        <?php if ( $author ) : ?>
            <cite>
                <span><?php echo esc_html( $author ); ?></span>
                <span><?php if ( $client ) : ?><?php echo esc_html( $client );?><?php endif; ?>
                <?php if ( $client ) : ?> - <?php echo esc_html( $title ); ?><?php endif; ?></span>
            </cite>
        <?php endif; ?>
    </blockquote>
</div>