<?php
    global $post;
    $url = get_post_meta( $post->ID, '_project_url', true );
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post cpt-grid-box"); ?>>

    <?php elr_post_thumbnail( 'cpt-grid-image-holder', array( 9999, 200 ) ); ?>

    <!-- display custom post info -->
    <ul>
        <li><h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>

        <li><a class="cpt-button-link" href="<?php the_permalink(); ?>">See More</a></li>
        <li><?php elr_post_actions_nav( $post->ID ); ?></li>
    </ul>
</article>