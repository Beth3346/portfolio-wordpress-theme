<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
?>

<?php if ( is_single() || is_page() ) : ?>
    <?php get_template_part( 'content/partials/tutorial-single' ); ?>
<?php elseif ( elr_is_cpt_archive() || is_tax() ) : ?>
    <?php get_template_part( 'content/partials/tutorial-grid' ); ?>
<?php else : ?>
    <?php get_template_part( 'content/partials/tutorial-single' ); ?>
<?php endif; ?>