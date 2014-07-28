<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post clearfix"); ?>>
    <header>
        <?php if ( is_single() || is_page() ) : ?>
            <h1 class="post-title" role="heading"><?php the_title(); ?></h1>
        <?php else : ?>
            <h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>

        <p class="post-date"><time datetime="<?php the_time('o-m-d') ?>" pubdate><?php the_time('M j, Y') ?></time></p>

        <div class="post-meta">
            <p class="post-category"><?php the_category(', ') ?></p>
            <?php the_tags(' <p class="post-tag">', ', ', '</p>'); ?>
            <?php if ( comments_open() ) : ?>
                <p class="post-comment"><?php comments_popup_link( __( '0 Comments', 'elr' ), __( '1 Comment', 'elr' ), __( '% Comments', 'elr' ) ); ?></p>
            <?php endif; ?>
        </div>
    </header>

    <div>
        <?php the_content(); ?>
    </div>

    <footer>
        <?php edit_post_link(__('Edit', 'elr')); ?>    
    </footer>
    
</article>