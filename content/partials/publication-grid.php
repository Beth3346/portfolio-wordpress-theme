<?php
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

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post cpt-grid-box"); ?>>

    <?php elr_post_thumbnail( 'cpt-grid-image-holder', array( 9999, 200 ) ); ?>

    <!-- display custom post info -->
    <ul>
        <li><h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>
        <?php if ( $author ) : ?><li><?php echo esc_html( $author ); ?></li><?php endif; ?>
        <li><a class="cpt-button-link" href="<?php the_permalink(); ?>">See More</a></li>
        <li><?php elr_post_actions_nav( $post->ID ); ?></li>
    </ul>
</article>