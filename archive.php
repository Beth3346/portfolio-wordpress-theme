<?php get_header(); ?>
<main class="main-content">
    <div class="content-holder">
        <?php // the loop ?>
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <!-- since its a custom function we need to make sure it exists -->
                <?php if ( function_exists( 'is_custom_post_type' ) ) : ?>

                    <?php if ( is_custom_post_type() ) : ?>

                        <?php get_template_part( 'content/content', get_post_type() ); ?>

                    <?php else : ?>

                        <?php get_template_part( 'content/content', get_post_format() ); ?>

                    <?php endif; ?>
                
                <?php else : ?>

                    <?php get_template_part( 'content/content', get_post_format() ); ?>

                <?php endif; ?>
                
            <?php endwhile; ?>  

            <?php get_template_part( 'partials/pagination' ); ?>

        <?php else : ?>

            <?php get_template_part( 'content/content', 'none' ); ?>

        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>