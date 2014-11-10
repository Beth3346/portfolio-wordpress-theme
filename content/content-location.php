<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
    $published_posts = wp_count_posts( 'location' )->publish;
?>

<?php if ( is_single() || is_page() ) : ?>
    <?php get_template_part( 'content/partials/location-single' ); ?>
<?php elseif ( is_post_type_archive( 'location' ) ) : ?>
    <?php if ( $published_posts >= 4  ) : ?>
        <?php get_template_part( 'content/partials/location-grid' ); ?>
    <?php else : ?>
        <?php get_template_part( 'content/partials/location-archive' ); ?>
    <?php endif; ?>
<?php elseif ( is_tax() ) : ?>
    <?php get_template_part( 'content/partials/location-archive' ); ?>
<?php else : ?>
    <?php get_template_part( 'content/partials/location-single' ); ?>
<?php endif; ?>