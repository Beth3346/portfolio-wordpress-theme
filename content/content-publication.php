<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $author = get_post_meta( $post->ID, '_publication_author', true );
?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
    <header>
        <?php elr_post_meta( $post->ID ); ?>
        <?php elr_post_title(); ?>
    </header>
    <div class="drm-row">
        <?php elr_post_thumbnail( 'cpt-image-holder' ); ?>
        <!-- display custom post info -->
        <ul class="cpt-info">
            <?php if ( get_the_terms( $post->ID, 'genre' ) ) : ?>
                <li><i class="fa fa-wrench"></i> <span class="drm-bold">Genre:</span> <?php elr_taxonomy_terms( 'genre', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( $author ) : ?>
                <li>
                    <i class="fa fa-user"></i> 
                    <span class="drm-bold">Author:</span> 
                    <?php echo esc_html( $author ); ?>
                </li>
            <?php endif; ?>
        </ul>    
    </div>    
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>