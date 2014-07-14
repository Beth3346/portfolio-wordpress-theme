<footer id="footer">	
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
        <section class="footer-widget widget">
            <h1 class="widget-title"><?php _e('Pages','elr'); ?></h1>
            <ul>
            <?php wp_list_pages('title_li=' ); ?>
            </ul>
        </section>
        <section class="footer-widget widget">
            <h1 class="widget-title"><?php _e('Category','elr'); ?></h1>
            <ul>
            <?php wp_list_categories('title_li='); ?>
            </ul>
        </section>
    <?php endif; ?>
</footer>
<!-- wp_footer -->
<?php wp_footer(); ?>        
        <small class="copyright">
            <?php bloginfo(); ?> &copy; 2012 - <?php echo date( 'Y' ); ?> 
            <a href="http://www.dynamicresponsemedia.com">Dynamic Response Media</a> 
            All Rights Reserved. 
            <!-- Insert Google Plus Link Here --> - 
            <a href="sitemap.html">Site Map</a> - 
            <a href="/privacy/">Privacy</a> - 
            <a href="/disclaimer/">Disclaimer</a> - 
            <?php
                $social_options = ( array )get_option( 'elr_theme_social_options' );
                $google_plus_url = $social_options['google_plus_url'];
            ?>
            <?php if( $google_plus_url ) : ?>
                <a href="<?php echo $google_plus_url; ?>">Google+</a>
            <?php endif; ?>
            WordPress Theme by: <a href="http://www.elizabeth-rogers.com">Elizabeth Rogers</a>
        </small>
	<!--end wrapper-->
	</div>
</body>
</html>
