<?php get_header(); ?>
<main class="main-content elr-container">
    <div class="elr-row">
        <div class="content-holder elr-col-two-thirds">
            <h1 class="page-title"><?php _e('404','elr'); ?></h1>
            <p><?php _e( 'Ooops! Something went wrong.', 'elr' ); ?></p>
        </div>
        <aside class="sidebar elr-col-third" id="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</main>
<?php get_footer(); ?>