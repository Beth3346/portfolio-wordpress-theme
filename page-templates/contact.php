<?php 
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>

<main class="contact-template">      
    <?php while ( have_posts() ) : the_post(); ?>
    <article>
        <h1 class="page-title"><?php the_title(); ?></h1>

        <!-- if we have a featured image then display it -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-image">
                <?php the_post_thumbnail(); ?>
    
                <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt; ?>
                <?php if ( $caption ) : ?>
                    <p class="post-image-caption"><?php echo esc_html( $caption ); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="contact-content"><?php elr_post_content( $post->ID ); ?></div>

        <div class="drm-grid-2 contact-info-holder">
            <div class="social-media">
                <h2 class="drm-text-center">Connect With Us</h2>
                <?php get_template_part( 'partials/social-media'); ?>                
            </div>
            <div class="conact-info">
                <h2>Contact Me</h2>
                <?php get_template_part( 'partials/contact-information'); ?>                
            </div>
        </div>

        <div class="drm-grid-2 contact-form">
            <h2>Ask Us a Question</h2>
            <?php get_template_part( 'partials/contact-form'); ?> 
        </div>
        
        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        
        <?php edit_post_link(__('Edit', 'elr')); ?>
    </article>   
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>