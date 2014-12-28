<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $client = get_post_meta( $post->ID, '_testimonial_client', true );
    $project_url = get_post_meta( $post->ID, '_testimonial_project_url', true );
    $title = get_post_meta( $post->ID, '_testimonial_title', true );
    $author = get_post_meta( $post->ID, '_testimonial_author', true );
?>
<?php elr_post_thumbnail( 'post-image-holder' ); ?>    
<!-- display the post content -->
<blockquote>            
    <?php elr_post_content( $post->ID, false ); ?>
    <?php if ( $author ) : ?>
        <cite>
            <span><?php echo esc_html( $author ); ?></span>
            <span><?php if ( $client ) : ?><?php echo esc_html( $client );?><?php endif; ?>
            <?php if ( $client ) : ?> - <?php echo esc_html( $title ); ?><?php endif; ?></span>
        </cite>
    <?php endif; ?>
</blockquote>