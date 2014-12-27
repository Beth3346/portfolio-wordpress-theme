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

        $cpt_archive = ( $post_type === 'post' ) ? '\/blog\/' : get_post_type_archive_link( $post_type );

        $args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => '3',
            'ignore_sticky_posts' => true
        );

        $query = new WP_Query( $args );
    ?>
    <?php if ( $published_posts >= 3 && $post_type !== 'faq' ) : ?>
        <?php if ( $cpt_archive ) : ?>
            <?php if ( $query->have_posts() ) : ?>
                <article class="front-section posts-section">
                    <?php elr_front_section_heading( 'Recent ' . ucwords( $post_type ) ) ?>
                    <div class="front-holder">
                    <?php while ( $query->have_posts() ) : $query->the_post();
                        global $post;
                        ?>
                        <section class="front-box-3 post-box">
                            <?php elr_front_thumbnail(); ?>
                            <?php elr_front_title(); ?>
                            <?php elr_front_content( $post->ID ); ?>
                            <?php elr_front_more(); ?>
                        </section>  
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    </div>
                </article>
            <?php endif; ?>
        <?php endif; ?>    
    <?php endif; ?>
<?php } ?>