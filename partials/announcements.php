<?php
    $short_excerpt_length = 200;

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
    $announcements = new WP_Query( $args );
?>
<?php if ( $announcements->have_posts() ) : ?>
    <div class="announcement">
        <?php while ( $announcements->have_posts() ) : $announcements->the_post();
            global $post;
            $post_id = $post->ID;
            $expected_response = get_post_meta( $post_id, '_announcement_expected_response', true );
            $url = get_post_meta( $post_id, '_announcement_url', true );
            $priority = get_post_meta( $post_id, '_announcement_priority', true );
            $type = get_post_meta( $post_id, '_announcement_type', true );

            if ( $type ) {
                $announcement_class = $type . '-alert';
            } else {
                $announcement_class = 'muted-alert';
            }

            ?>
            <div class="elr-dismissible-alert <?php echo esc_attr( $announcement_class ); ?>">
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
                    <h1 class="announcement-heading"><?php the_title(); ?></h1>
                </div>
                <?php if ( get_the_content( $post_id ) ) : ?>
                    <p><?php echo esc_html( elr_trim_content( $short_excerpt_length ) ); ?></p>
                <?php endif; ?>
                <div>
                    <a href="<?php the_permalink(); ?>">Read More</a>
                    <div><?php elr_post_actions_nav( $post_id ); ?></div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
<?php endif; ?>