<section class="front-box-3 <?php echo $post_type . '-box' ?>">
    <?php
        elr_front_thumbnail();
        elr_front_title();
        elr_front_content( $post->ID );
        elr_front_more();
    ?>
</section>