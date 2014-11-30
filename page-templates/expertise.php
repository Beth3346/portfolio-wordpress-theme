<?php
/*
Template Name: Expertise
*/
?>
<?php get_header(); ?>
<main class="main-content resume">
    <?php get_template_part( 'partials/announcements'); ?>
    <div class="content-holder article-full expertise">
        <?php while ( have_posts() ) : the_post(); ?>
                        
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            
            <?php edit_post_link(__('Edit', 'elr')); ?>
            <?php comments_template(); ?>       
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>