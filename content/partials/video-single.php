<?php
    if( !is_single() ) : global $more; $more = 0; endif; //enable more link
    global $post;
    $video = str_ireplace( '"', '', trim( get_post_meta( $post->ID, '_video_url', true ) ) );
    $length = str_ireplace( '"', '', trim(  get_post_meta( $post->ID, '_video_length', true ) ) );
    $creator = str_ireplace( '"', '', trim(  get_post_meta( $post->ID, '_video_creator', true ) ) );
?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post post-video"); ?>>
    <header>
        <?php elr_post_title(); ?>
        <ul class="post-meta">
            <?php elr_post_date(); ?>
            <?php elr_post_comments(); ?>
        </ul>
    </header>
    <div>
        <?php elr_video( $video, 560, 349 ); ?>
        <ul class="video-info">
            <?php if ( get_the_terms( $post->ID, 'lesson' ) ) : ?>
                <li><i class="fa fa-folder"></i> <?php the_terms( $post->ID, 'lesson', ' ' ); ?></li>
            <?php endif; ?>
            <?php if ( get_the_terms( $post->ID, 'video_type' ) ) : ?>
                <li><i class="fa fa-cube"></i> <?php the_terms( $post->ID, 'video_type', ' ' ); ?></li>
            <?php endif; ?>
            <?php elr_post_category( $post->ID ); ?>
            <?php elr_post_tags(); ?>
            <?php if ( $length ) : ?>
                <li><i class="fa fa-film"></i> <?php echo esc_html( $length ); ?></li>
            <?php endif; ?>
            <?php if ( $creator ) : ?>
                <li><i class="fa fa-user"></i> <?php echo esc_html( $creator ); ?></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>