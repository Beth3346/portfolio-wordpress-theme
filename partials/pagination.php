<?php if(function_exists('elr_pagenav')){ ?>
    <?php elr_pagenav(); ?>
<?php } else { ?>
    <?php get_template_part('partials/post-nav'); ?>
<?php } ?>