<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>
<main class="contact-template elr-container">
    <?php while ( have_posts() ) : the_post(); ?>
    <article class="elr-row">
        <?php elr_page_title(); ?>
        <?php elr_post_thumbnail(); ?>
        <div class="contact-content"><?php elr_post_content( $post->ID ); ?></div>
        <div class="elr-col-half contact-info-holder">
            <div class="social-media">
                <h2 class="elr-text-center">Connect With Us</h2>
                <?php get_template_part( 'partials/social-media'); ?>
            </div>
            <div class="conact-info">
                <h2>Contact Me</h2>
                <?php get_template_part( 'partials/contact-information'); ?>
            </div>
        </div>
        <div class="elr-col-half contact-form">
            <h2>Ask Us a Question</h2>
            <?php get_template_part( 'partials/contact-form'); ?>
        </div>
        <?php elr_link_pages(); ?>
        <?php elr_edit_link(); ?>
    </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>