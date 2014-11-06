<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<?php if ( is_single() || is_page() ) : ?>

    <article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?> >
        <!-- display the post content -->
        <h1 class="post-title" role="heading"><?php the_title(); ?></h1>

        <?php elr_post_content( $post->ID, false ); ?>

        <!-- display custom post info -->
        <ul class="post-info">
            <?php elr_post_comments(); ?>
            <?php if ( get_the_terms( $post->ID, 'faq_category' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'faq_category', $post->ID ); ?></li>
            <?php endif; ?>
        </ul>

        <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>   
    </article>

<?php elseif ( is_post_type_archive( 'location' ) || is_tax() ) : ?>

    <article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?> >
        <!-- display the post content -->
        <h1 class="post-title role="heading"><?php the_title(); ?></h1>
        
        <div>
            <?php elr_post_content( $post->ID, false ); ?>

            <!-- display custom post info -->
            <ul class="post-info">
                <?php elr_post_comments(); ?>
                <?php if ( get_the_terms( $post->ID, 'faq_category' ) ) : ?>
                    <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'faq_category', $post->ID ); ?></li>
                <?php endif; ?>
            </ul>

            <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
        </div>    
    </article>

<?php else : ?>

    <article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post"); ?> >
        <!-- display the post content -->
        <h1 class="post-title" role="heading"><?php the_title(); ?></h1>
        
        <div class="faq-content">
            <?php elr_post_content( $post->ID, false ); ?>

            <!-- display custom post info -->
            <ul class="post-info">
                <?php elr_post_comments(); ?>
                <?php if ( get_the_terms( $post->ID, 'faq_category' ) ) : ?>
                    <li><i class="fa fa-cube"></i> <?php elr_taxonomy_terms( 'faq_category', $post->ID ); ?></li>
                <?php endif; ?>
            </ul>

            <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
        </div>    
    </article>

<?php endif; ?>