<?php get_header(); ?>
<main class="main-content elr-container">
    <div class="elr-row">
        <div class="content-holder elr-col-two-thirds">
            <header class="archive-header">
                <h1 class="archive-title"><?php elr_author_archive_title(); ?></h1>
                <?php elr_author_archive_description(); ?>
            </header>
            <?php elr_loop(); ?>
        </div>
        <aside class="sidebar elr-col-third" id="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</main>
<?php get_footer(); ?>