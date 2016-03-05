<?php
/*
Template Name: Expertise
*/
?>
<?php get_header(); ?>
<main class="main-content resume elr-container">
    <div class="elr-row">
        <?php get_template_part( 'partials/announcements'); ?>
        <div class="content-holderl expertise elr-col-full">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php elr_link_pages(); ?>
                <?php elr_edit_link(); ?>
                <?php comments_template(); ?>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>