<?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'content', get_post_format() ); ?>

    <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

    <?php get_template_part( TEMPLATES . '/_post-nav'); ?>

    <?php comments_template(); ?>
<?php endwhile; ?>