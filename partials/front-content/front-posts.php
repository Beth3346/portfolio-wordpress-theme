<?php
    $post_types = get_post_types();
    //$front_page_options = (array)get_option('elr_front_page_options');
    //$num_posts = str_ireplace( '"', '', trim( $front_page_options['num_posts'] ) );

    // if ( empty( $num_posts ) ) {
    //     $num_posts = 3;
    // }
?>

<?php foreach ( $post_types as $post_type ) { ?>
    <?php 
        //$cpt_archive = get_post_type_archive_link( $post_type );
        $post_name = get_post_type_object( $post_type )->label;
        $published_posts = wp_count_posts( $post_type )->publish;
        $title = 'Recent ' . ucwords( $post_type ) . 's';
        $cpt_archive = ( $post_type === 'post' ) ? '\/blog\/' : get_post_type_archive_link( $post_type );
        
        if ( $post_type === 'post' ) {
            $num = 6;
            $front_box_class = 'front-box-3';
        } else if ( $post_type === 'testimonial' ) {
            $num = 3;
            $front_box_class = 'front-box-1';
        } else {
            $num = 3;
            $front_box_class = 'front-box-3';
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
                <article class="front-section posts-section">
                    <?php elr_front_section_heading( $title ) ?>
                    <div class="front-holder">
                    <?php while ( $query->have_posts() ) : $query->the_post();
                        global $post;
                        ?>
                        <section class="<?php echo $front_box_class; ?> <?php echo $post_type . '-box' ?>">
                            <?php
                                if ( $post_type === 'testimonial' ) {
                                    get_template_part( 'partials/front-content/front-testimonial' );
                                } else {
                                    elr_front_thumbnail();
                                    elr_front_title();
                                    elr_front_content( $post->ID );
                                    elr_front_more();
                                }
                            ?>
                        </section>  
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    </div>
                </article>
            <?php endif; ?>
        <?php endif; ?>    
    <?php endif; ?>
<?php } ?>