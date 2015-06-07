<?php
    $short_excerpt_length = 200;
    $front_page_options = (array)get_option('elr_theme_front_page_options');

    $args = array(
        'post_type' => 'announcement',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_announcement_expire_datetime',
                'value' => NULL
            ),
            array(
                'key' => '_announcement_expire_datetime',
                'value' => current_time( 'Y-m-d H:i' ),
                'compare' => '>',
                'type' => 'DATETIME,'
            ),
        ),
    );
    $query = new WP_Query( $args );
?>
<?php if ( $query->have_posts() ) : ?>
    <article class="announcement">
        <?php while ( $query->have_posts() ) : $query->the_post();
            global $post;
            $expected_response = get_post_meta( $post->ID, '_announcement_expected_response', true );
            $url = get_post_meta( $post->ID, '_announcement_url', true );
            $priority = get_post_meta( $post->ID, '_announcement_priority', true );
            $type = get_post_meta( $post->ID, '_announcement_type', true );
            
            if ( $type ) {
                $announcement_class = $type . '-alert';
            } else {
                $announcement_class = 'muted-alert';
            }

            ?>
            <div class="drm-dismissible-alert <?php echo esc_attr( $announcement_class ); ?>">
                <button class="close">x</button>
                <div class="header">
                    <?php if ( $type === 'danger' ) : ?>
                        <i class="fa fa-exclamation-triangle"></i>
                    <?php elseif ( $type === 'warning' ) : ?>
                        <i class="fa fa-bomb"></i>
                    <?php elseif ( $type === 'success' ) : ?>
                        <i class="fa fa-thumbs-up"></i>
                    <?php elseif ( $type === 'information' ) : ?>
                        <i class="fa fa-bullhorn"></i>
                    <?php else : ?>
                        <i class="fa fa-circle-o"></i>
                    <?php endif; ?>
                    <?php elr_post_title(); ?>
                </div>
                <?php if ( get_the_content( $post->ID ) ) : ?>
                    <p><?php echo esc_html( elr_trim_content( $short_excerpt_length ) ); ?></p>
                <?php endif; ?> 
                <div>
                    <a href="<?php the_permalink(); ?>">Read More</a>
                    <div><?php elr_post_actions_nav( $post->ID ); ?></div>                    
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </article>
<?php endif; ?>