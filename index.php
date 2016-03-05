<?php get_header(); ?>
<main class="main-content elr-container">
    <div class="elr-row">
        <?php get_template_part( 'partials/announcements'); ?>
        <div class="content-holder elr-col-two-thirds">
            <?php elr_loop(); ?>
        </div>
        <aside class="sidebar elr-col-third" id="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</main>
<?php get_footer(); ?>