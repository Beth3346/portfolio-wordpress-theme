<body <?php body_class(); ?>>
    <header class="main-header elr-container" role="banner">
        <div class="elr-row">
            <div class="logo elr-col-half">
                <!-- add logo background image images/logo.png -->
                <h2 class="site-name"><a href="<?php bloginfo('url'); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
                <?php if ( get_bloginfo('description') ) : ?>
                    <h3 class="site-description" ><?php bloginfo('description'); ?></h3>
                <?php endif; ?>
            </div>
            <div class="navigation-holder elr-col-half">
                <div class="social-media-holder">
                    <?php get_template_part( 'partials/social-media'); ?>
                </div>
                <nav id="main-nav" class="main-nav elr-clearfix" role="navigation">
                    <?php wp_nav_menu(
                        array(
                            'theme_location' => 'main-nav',
                            'fallback_cb' => 'default_main_nav',
                            'container'  => 'main-nav-wrapper',
                            'menu_id' => 'main-menu',
                            'menu_class' => 'main-menu elr-inline-list elr-text-right'
                        )
                    ); ?>
                </nav>
            </div>
        </div>
    </header>