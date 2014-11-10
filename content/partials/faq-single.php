<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?> >
    <!-- display the post content -->
    <h1 class="post-title" role="heading"><?php the_title(); ?></h1>

    <?php elr_post_content( $post->ID, false ); ?>

    <!-- display custom post info -->
    <ul class="faq-info">
        <?php elr_post_comments(); ?>
        <?php if ( get_the_terms( $post->ID, 'faq_category' ) ) : ?>
            <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'faq_category', $post->ID ); ?></li>
        <?php endif; ?>
    </ul>

    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>   
</article>