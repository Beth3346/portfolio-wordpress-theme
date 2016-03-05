<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
?>

<?php if ( is_single() || is_page() ) : ?>
    <?php get_template_part( 'content/partials/publication-single' ); ?>
<?php elseif ( is_post_type_archive( 'publication' ) || is_tax() ) : ?>
    <?php get_template_part( 'content/partials/publication-grid' ); ?>
<?php else : ?>
    <?php get_template_part( 'content/partials/publication-single' ); ?>
<?php endif; ?>