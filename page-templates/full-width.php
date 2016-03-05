<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
<main class="main-content elr-container">
    <div class="content-holder article-full elr-row">
        <?php while ( have_posts() ) : the_post(); ?>
        <article class="elr-col-full">
            <?php elr_page_title(); ?>
            <?php elr_post_thumbnail(); ?>
            <?php the_content(); ?>
            <?php elr_link_pages(); ?>
            <?php elr_edit_link(); ?>
        </article>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>