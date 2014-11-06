<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
?>

<?php if ( is_single() || is_page() ) : ?>
    <?php get_template_part( 'content/partials/person-single' ); ?>
<?php elseif ( is_post_type_archive( 'person' ) || is_tax() ) : ?>
    <?php get_template_part( 'content/partials/person-grid' ); ?>
<?php else : ?>
    <?php get_template_part( 'content/partials/person-single' ); ?>
<?php endif; ?>