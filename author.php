<?php get_header(); ?>
<main class="main-content">
	<div class="content-holder">
        <?php // the loop ?>
        <?php if (have_posts()) : ?>
            <header class="archive-header">
                <h1 class="archive-title">
                    <?php
                        /*
                         * Queue the first post, that way we know what author
                         * we're dealing with (if that is the case).
                         *
                         * We reset this later so we can run the loop properly
                         * with a call to rewind_posts().
                         */
                        the_post();

                        printf( __( 'All posts by %s', 'elr' ), get_the_author() );
                    ?>
                </h1>
                <?php if ( get_the_author_meta( 'description' ) ) : ?>
                <div class="author-description"><?php the_author_meta( 'description' ); ?></div>
                <?php endif; ?>
            </header><!-- .archive-header -->

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