<footer id="footer">	
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
        <section class="footer-widget">
            <h1 class="widgettitle"><?php _e('Pages','themify'); ?></h1>
            <ul>
            <?php wp_list_pages('title_li=' ); ?>
            </ul>
        </section>
        <section class="footer-widget">
            <h1 class="widgettitle"><?php _e('Category','themify'); ?></h1>
            <ul>
            <?php wp_list_categories('show_count=1&title_li='); ?>
            </ul>
        </section>
    <?php endif; ?>
</footer>
<!-- wp_footer -->
<?php wp_footer(); ?>        
    	<small class="copyright">
        <?php bloginfo(); ?> &copy; 2012 - <?php echo date( 'Y' ); ?> 
        <a href="http://www.dynamicresponsewebsites.net">Dynamic Response Media</a> 
        All rights reserved. 
        <!-- Insert Google Plus Link Here -->
        <a href="sitemap.html">Site Map</a> 
        WordPress Theme by: <a href="http://www.elizabeth-rogers.com">Elizabeth Rogers</a></small>
	<!--end wrapper-->
	</div>
</body>
</html>
