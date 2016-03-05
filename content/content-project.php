<?php
    if(!is_single()) : global $more; $more = 0; endif; //enable more link
?>

<?php if ( is_single() || is_page() ) : ?>
    <?php get_template_part( 'content/partials/project-single' ); ?>
<?php elseif ( is_post_type_archive( 'project' ) || is_tax() ) : ?>
    <?php get_template_part( 'content/partials/project-grid' ); ?>
<?php else : ?>
    <?php get_template_part( 'content/partials/project-single' ); ?>
<?php endif; ?>