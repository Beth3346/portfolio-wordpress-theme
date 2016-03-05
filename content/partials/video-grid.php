<?php
    global $post;
    $video = str_ireplace( '"', '', trim( get_post_meta( $post->ID, '_video_url', true ) ) );
    $length = str_ireplace( '"', '', trim(  get_post_meta( $post->ID, '_video_length', true ) ) );
    $creator = str_ireplace( '"', '', trim(  get_post_meta( $post->ID, '_video_creator', true ) ) );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class("post cpt-grid-box elr-col-third"); ?>>
    <?php elr_video( $video ); ?>
    <!-- display custom post info -->
    <ul class="cpt-meta-list">
        <li><h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>
        <?php if ( $length ) : ?>
            <li><i class="fa fa-film"></i> <?php echo esc_html( $length ); ?></li>
        <?php endif; ?>
        <?php if ( $creator ) : ?>
            <li><i class="fa fa-user"></i> <?php echo esc_html( $creator ); ?></li>
        <?php endif; ?>
        <li><a class="elr-button elr-button-info"  href="<?php the_permalink(); ?>">See More</a></li>
        <li><?php elr_post_actions_nav( $post->ID ); ?></li>
    </ul>
</div>