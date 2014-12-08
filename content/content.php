<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post clearfix"); ?>>
    <header>
        <?php if ( is_single() || is_page() ) : ?>
            <h1 class="post-title" role="heading"><?php the_title(); ?></h1>
        <?php else : ?>
            <h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>

        <?php elr_post_meta( $post->ID ); ?>
    </header>

    <!-- if we have a featured image then display it -->
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-image">
        <?php $thumbnail_size = array( 400, 9999 ); ?>
        <?php if ( is_single() || is_page() ) : ?>
            <?php the_post_thumbnail( $thumbnail_size ); ?>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumbnail_size ); ?></a>
        <?php endif; ?>
        
        <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt; ?>
        <?php if ( $caption ) : ?>
            <p class="post-image-caption"><?php echo esc_html( $caption ); ?></p>
        <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <!-- display the post content -->
    <div><?php elr_post_content( $post->ID ); ?></div>

    <footer>
        <?php edit_post_link(__('Edit', 'elr')); ?>    
    </footer>

    
</article>