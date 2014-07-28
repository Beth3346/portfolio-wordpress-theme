<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Custom Post Type Content Sample
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    global $post;
    // $position = get_post_meta($post->ID, 'elr_employee_position', true);
    // add custom meta info here
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post clearfix"); ?>>
    <header>
        <?php if ( is_single() || is_page() ) : ?>
            <h1 class="post-title" role="heading"><?php the_title(); ?></h1>
        <?php else : ?>
            <h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>
    </header>

    <!-- if we have a featured image then display it -->
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-image-holder">
            <?php $thumbnail_size = array( 400, 9999 ); ?>
            <?php if ( is_single() || is_page() ) : ?>
                <?php the_post_thumbnail( $thumbnail_size ); ?>
            <?php else : ?>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumbnail_size ); ?></a>
            <?php endif; ?>
            
            <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt; ?>
            <?php if ( $caption ) : ?>
                <figcaption><?php echo esc_html( $caption ); ?></figcaption>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- display custom post info -->
    <ul class="post-info">
        <!-- <?php if ( $position ) : ?><li><?php echo esc_html( $position ) ?></li><?php endif; ?> -->
    </ul>
    
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