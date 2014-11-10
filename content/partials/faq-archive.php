<?php
    $args = array(
    'numberposts' => 1,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'faq',
    'post_status' => 'publish',
    'suppress_filters' => true );

    $recent_posts = wp_get_recent_posts( $args );
    $latest_id = $recent_posts[0]['ID'];

    if ( $post->ID === $latest_id ) {
        $state = 'expanded';
    } else {
        $state = 'collapsed';
    }

?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?> >
    <!-- display the post content -->
    <h1 class="post-title drm-accordion-label" role="heading"><?php the_title(); ?></h1>
    
    <div class="faq-content drm-accordion-content" data-state="<?php echo $state; ?>">
        <?php elr_post_content( $post->ID, false ); ?>

        <!-- display custom post info -->
        <ul class="faq-info">
            <?php elr_post_comments(); ?>
            <?php if ( get_the_terms( $post->ID, 'faq_category' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'faq_category', $post->ID ); ?></li>
            <?php endif; ?>
        </ul>

        <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
    </div>    
</article>