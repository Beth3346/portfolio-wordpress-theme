<?php
/*
Template Name: Front-Basic
*/
?>
<?php get_header(); ?>
<main class="main-content elr-container">
    <?php get_template_part( 'partials/announcements'); ?>
    <div class="elr-row">
        <div class="content-holder elr-col-two-thirds">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php elr_link_pages(); ?>
                <?php elr_edit_link(); ?>
                <?php comments_template(); ?>
            <?php endwhile; ?>
        </div>
        <aside class="sidebar elr-col-third" id="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</main>
<?php get_footer(); ?>