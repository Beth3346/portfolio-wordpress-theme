<?php get_header(); ?>
<main class="main-content">
    <div class="content-holder">
        <?php elr_get_single_loop(); ?>
    </div>
    <!-- /#content -->
    <?php get_sidebar(); ?>
</main>
<?php elr_get_contact(); ?>
<?php get_footer(); ?>