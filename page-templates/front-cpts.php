<?php
/*
Template Name: Front-CPTs
*/
?>
<?php get_header(); ?>
<main class="main-content cpt-content">
    <?php get_template_part( 'partials/announcements'); ?>
    <?php
        $post_types = get_post_types();
    ?>
    <?php foreach ( $post_types as $post_type ) : ?>
        <?php
            $post_name = get_post_type_object( $post_type )->label;
            $published_posts = wp_count_posts( $post_type )->publish;
            $labels = get_post_type_object( $post_type )->labels;
            $title = 'Recent ' . ucwords( $labels->name );
            $cpt_archive = ( $post_type === 'post' ) ? '\/blog\/' : get_post_type_archive_link( $post_type );

            if ( $post_type === 'post' || $post_type == 'project' ) {
                $num = 6;
            } else {
                $num = 3;
            }

            $args = array(
                'post_type' => $post_type,
                'post_status' => 'publish',
                'posts_per_page' => $num,
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query( $args );
        ?>
        <?php if ( $post_type !== 'faq' && $cpt_archive ) : ?>
            <?php if ( $published_posts >= 3 || $post_type === 'testimonial' ) : ?>
                <?php if ( $query->have_posts() ) : ?>
                    <article class="front-section elr-container-full <?php echo $post_type ?>-section">
                        <div class="elr-row">
                            <?php elr_front_section_heading( $title ); ?>
                            <?php if ( $post_type === 'testimonial' ) : ?>
                                <div class="testimonial-slider elr-col-full">
                                    <div class="testimonial-slide-holder">
                                        <?php while ( $query->have_posts() ) : $query->the_post();
                                            global $post;
                                        ?>
                                            <?php get_template_part( 'partials/front-content/front-testimonials' ); ?>
                                        <?php endwhile; ?>
                                        <?php wp_reset_postdata(); ?>
                                    </div>
                                    <div class="testimonial-slider-nav">
                                        <button class="prev" data-dir="prev"><i class="fa fa-chevron-left"></i></button>
                                        <button class="next" data-dir="next"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="front-holder elr-col-full">
                                <?php while ( $query->have_posts() ) : $query->the_post();
                                    global $post;
                                    ?>
                                    <?php include( locate_template( 'partials/front-content/front-posts.php' ) ); ?>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</main>
<?php get_footer(); ?>