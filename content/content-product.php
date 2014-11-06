<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
?>

<?php if ( is_single() || is_page() ) : ?>
    <?php get_template_part( 'content/partials/product-single' ); ?>

<?php elseif ( is_post_type_archive( 'product' ) || is_tax() ) : ?>
    <?php get_template_part( 'content/partials/product-grid' ); ?>

<?php else : ?>
    <?php get_template_part( 'content/partials/product-single' ); ?>
<?php endif; ?>