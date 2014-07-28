<?php get_header(); ?>
<main class="main-content">
	<div class="content-holder">
        <?php while ( have_posts() ) : the_post(); ?>
        <article>
            <h1 class="page-title"><?php the_title(); ?></h1>

            <!-- if we have a featured image then display it -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-image">
                    <?php the_post_thumbnail(); ?>
        
                    <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt; ?>
                    <?php if ( $caption ) : ?>
                        <p class="post-image-caption"><?php echo esc_html( $caption; ) ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php the_content(); ?>
            
            <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            
            <?php edit_post_link(__('Edit', 'elr')); ?>
        </article>   
        <?php endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</main>	
<?php get_footer(); ?>