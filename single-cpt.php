<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Custom Post Type Single Sample
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<?php get_header(); ?>
<main class="main-content">
    <div class="content-holder">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content/content', get_post_type() ); ?>

        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

        <?php get_template_part( 'partials/post-nav' ); ?>
        <a href="/TODO/" class="archives-button-link">TODO</a>

        <?php comments_template(); ?>
    <?php endwhile; ?>
    </div>
    <!-- /#content -->
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>