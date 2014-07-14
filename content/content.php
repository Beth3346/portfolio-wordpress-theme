<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post clearfix $class"); ?>>
    <header>
        <?php if ( is_single() || is_page() ) : ?>
            <h1 class="post-title" role="heading"><?php the_title(); ?></h1>
        <?php else : ?>
            <h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>

        <p class="post-date"><time datetime="<?php the_time('o-m-d') ?>" pubdate><?php the_time('M j, Y') ?></time></p>

        <div class="post-meta"> 
            <p class="post-author"><?php the_author_posts_link() ?></p>
            <p class="post-category"><?php the_category(', ') ?></p>
            <?php the_tags(' <p class="post-tag">', ', ', '</p>'); ?>
            <?php if ( comments_open() ) : ?>
                <p class="post-comment"><?php comments_popup_link( __( '0 Comments', 'elr' ), __( '1 Comment', 'elr' ), __( '% Comments', 'elr' ) ); ?></p>
            <?php endif; ?>
        </div>
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
            <p class="post-image-caption"><?php echo $caption; ?></p>
        <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <!-- display the post content -->
    <div>
        <?php if ( is_single() || is_page() ) : ?>
            <?php the_content(); ?>
        <?php else : ?>
        <div class="post-excerpt<?php echo $post->ID ?>">
            <?php the_excerpt(); ?>
        </div>
        <?php endif; ?>
    </div>

    <footer>
        <?php edit_post_link(__('Edit', 'elr')); ?>    
    </footer>

    
</article>