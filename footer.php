    <footer class="main-footer elr-container-full">
        <div class="elr-row">
            <nav id="footer-nav" class="footer-nav elr-clearfix" role="navigation">
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'footer-nav',
                        'fallback_cb' => 'default_footer_nav',
                        'container'  => 'footer-nav-wrapper',
                        'menu_id' => 'footer-menu',
                        'menu_class' => 'footer-menu elr-inline-list elr-text-center'
                    )
                ); ?>
            </nav>
        </div>
    </footer>
    <div class="copyright elr-container-full">
        <div class="elr-row">
            <div class="elr-col-full elr-text-center">
                <small>
                    <?php bloginfo(); ?> &copy;<?php echo date( 'Y' ); ?>
                    All Rights Reserved.
                    Built with Care by: <a href="http://www.elizabeth-rogers.com">Elizabeth Rogers</a>
                    <!-- Insert Google Plus Link Here --> -
                    <a href="sitemap.html">Site Map</a> -
                    <a href="/privacy/">Privacy</a> -
                    <a href="/disclaimer/">Disclaimer</a>
                </small>
            </div>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>