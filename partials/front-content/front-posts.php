<section class="elr-col-third front-post-box elr-text-center <?php echo 'front-' . $post_type . '-box'; ?>">
    <?php
        elr_front_thumbnail();
        elr_front_title();
        elr_front_content( $post->ID, 40 );
        elr_front_more();
    ?>
</section>