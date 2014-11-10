<?php get_header(); ?>
<main class="main-content">
    <div class="content-holder">
        <div class="faq-accordion">
            <h1 class="cpt-archive-title">Frequently Asked Questions</h1>
            <?php elr_get_loop(); ?>        
        </div>    
    </div>
    <?php get_sidebar(); ?>
</main>
<?php elr_get_contact(); ?>
<?php get_footer(); ?>