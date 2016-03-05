<?php
    global $post;
    $start_date = get_post_meta( $post->ID, '_project_start_date', true );
    $end_date = get_post_meta( $post->ID, '_project_end_date', true );
    $client = get_post_meta( $post->ID, '_project_client', true );
    $url = get_post_meta( $post->ID, '_project_url', true );
    $location = get_post_meta( $post->ID, '_project_location', true );
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class("post post-project"); ?>>
    <header>
        <?php elr_post_title(); ?>
        <ul class="post-meta">
            <?php elr_post_category( $post->ID ); ?>
            <?php elr_post_tags(); ?>
            <?php elr_post_comments(); ?>
        </ul>
    </header>
    <div>
        <?php elr_post_thumbnail( 'cpt-image-holder' ); ?>
        <ul class="cpt-info">
            <?php if ( get_the_terms( $post->ID, 'portfolio' ) ) : ?>
                <li><i class="fa fa-folder"></i> <?php elr_taxonomy_terms( 'portfolio', $post->ID ); ?></li>
            <?php endif; ?>

            <?php if ( get_the_terms( $post->ID, 'technology' ) ) : ?>
                <li><i class="fa fa-cogs"></i> <?php elr_taxonomy_terms( 'technology', $post->ID ); ?></li>
            <?php endif; ?>

            <?php if ( get_the_terms( $post->ID, 'tool' ) ) : ?>
                <li><i class="fa fa-wrench"></i> <?php elr_taxonomy_terms( 'tool', $post->ID ); ?></li>
            <?php endif; ?>

            <?php if ( get_the_terms( $post->ID, 'project_type' ) ) : ?>
                <li><i class="fa fa-picture-o"> </i><?php elr_taxonomy_terms( 'project_type', $post->ID ); ?></li>
            <?php endif; ?>

            <?php if ( $start_date ) : ?>
                <li>
                <i class="fa fa-calendar"></i>
                <?php echo esc_html( mysql2date( 'F Y', $start_date ) ); ?>
                <?php if ( $end_date ) : ?> - <?php echo esc_html( mysql2date( 'F Y', $end_date ) ); ?><?php endif; ?></li>
            <?php endif; ?>

            <?php if ( $client ) : ?>
                <li><i class="fa fa-building"></i> <?php echo esc_html( $client ); ?></li>
            <?php endif; ?>

            <?php if ( $location ) : ?>
                <li><i class="fa fa-globe"></i> <?php echo esc_html( $location ); ?></li>
            <?php endif; ?>

            <?php if ( $url ) : ?>
                <li><a class="cpt-button-link" href="<?php echo esc_url( $url ); ?>">View Project</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php elr_post_content( $post->ID ); ?>
    <footer><?php elr_post_actions_nav( $post->ID ); ?></footer>
</article>