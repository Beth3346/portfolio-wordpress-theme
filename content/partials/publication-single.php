<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    $author = get_post_meta( $post->ID, '_publication_author', true );
    $publisher = get_post_meta( $post->ID, '_publication_publisher', true );
    $isbn = get_post_meta( $post->ID, '_publication_isbn', true );
    $url = get_post_meta( $post->ID, '_publication_url', true );
    $length = get_post_meta( $post->ID, '_publication_length', true );
    $published_year = get_post_meta( $post->ID, '_publication_published_year', true );
    $availability = get_post_meta( $post->ID, '_publication_availability', true );
    $language = get_post_meta( $post->ID, '_publication_language', true );
?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post post-publication"); ?>>
    <header>
        <?php elr_post_title(); ?>
        <?php elr_post_meta( $post->ID ); ?>
    </header>
    <div>
        <?php elr_post_thumbnail( 'cpt-image-holder' ); ?>
        <!-- display custom post info -->
        <ul class="cpt-info">
            <?php if ( get_the_terms( $post->ID, 'genre' ) ) : ?>
                <li><i class="fa fa-wrench"></i> <span class="elr-bold">Genre:</span> <?php elr_taxonomy_terms( 'genre', $post->ID ); ?></li>
            <?php endif; ?>
            <?php if ( $author ) : ?>
                <li>
                    <i class="fa fa-user"></i>
                    <span class="elr-bold">Author:</span>
                    <?php echo esc_html( $author ); ?>
                </li>
            <?php endif; ?>
            <?php if ( $publisher ) : ?>
                <li>
                    <i class="fa fa-user"></i>
                    <span class="elr-bold">Publisher:</span>
                    <?php echo esc_html( $publisher ); ?>
                </li>
            <?php endif; ?>
            <?php if ( $isbn ) : ?>
                <li>
                    <i class="fa fa-user"></i>
                    <span class="elr-bold">ISBN:</span>
                    <?php echo esc_html( $isbn ); ?>
                </li>
            <?php endif; ?>
            <?php if ( $length ) : ?>
                <li>
                    <i class="fa fa-user"></i>
                    <span class="elr-bold">Length:</span>
                    <?php echo esc_html( $length ); ?>
                </li>
            <?php endif; ?>
            <?php if ( $published_year ) : ?>
                <li>
                    <i class="fa fa-user"></i>
                    <span class="elr-bold">Year Published:</span>
                    <?php echo esc_html( $published_year ); ?>
                </li>
            <?php endif; ?>
            <?php if ( $availability ) : ?>
                <li>
                    <i class="fa fa-user"></i>
                    <span class="elr-bold">Availability:</span>
                    <?php echo esc_html( $availability ); ?>
                </li>
            <?php endif; ?>
            <?php if ( $language ) : ?>
                <li>
                    <i class="fa fa-user"></i>
                    <span class="elr-bold">Language:</span>
                    <?php echo esc_html( $language ); ?>
                </li>
            <?php endif; ?>
            <?php if ( $url ) : ?>
                <li><a class="cpt-buy-link" href="<?php echo esc_url( $url ); ?>"><i class="fa fa-shopping-cart"></i> Buy Now</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>