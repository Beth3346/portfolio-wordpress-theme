<?php

///////////////////////////////////////
// You may add your custom functions here
///////////////////////////////////////

	///////////////////////////////////////
	// Load theme languages
	///////////////////////////////////////
	load_theme_textdomain( 'themify', TEMPLATEPATH.'/languages' );

	///////////////////////////////////////
	// Enable WordPress feature image
	///////////////////////////////////////
	add_theme_support( 'post-thumbnails');

	///////////////////////////////////////
	// Register Custom Menu Function
	///////////////////////////////////////
	if (function_exists('register_nav_menus')) {
		register_nav_menus( array(
			'mainNav' => __( 'Main Navigation', 'themify' ),
		) );
	}

	///////////////////////////////////////
	// Default Main Nav Function
	///////////////////////////////////////
	function default_main_nav() {
		echo '<ul id="mainNav" class="mainNav clearfix">';
		wp_list_pages('title_li=');
		echo '</ul>';
	}

	///////////////////////////////////////
	// Register Widgets
	///////////////////////////////////////
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Sidebar',
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => 'Footer 1',
			'id' => 'footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => 'Header',
			'id' => 'header-widgets',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
	}

	///////////////////////////////////////
	// Page navigation
	///////////////////////////////////////
	function themify_pagenav($before = '', $after = '') {
		global $wpdb, $wp_query;
	
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
	
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = apply_filters('themify_filter_pages_to_show', 8);
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
	
		if ($max_page > 1) {
			echo $before.'<div class="pagenav clearfix">';
			if ($start_page >= 2 && $pages_to_show < $max_page) {
				$first_page_text = "&laquo;";
				echo '<a href="'.get_pagenum_link().'" title="'.$first_page_text.'" class="number">'.$first_page_text.'</a>';
			}
			//previous_posts_link('&lt;');
			for($i = $start_page; $i  <= $end_page; $i++) {
				if($i == $paged) {
					echo ' <span class="number current">'.$i.'</span> ';
				} else {
					echo ' <a href="'.get_pagenum_link($i).'" class="number">'.$i.'</a> ';
				}
			}
			//next_posts_link('&gt;');
			if ($end_page < $max_page) {
				$last_page_text = "&raquo;";
				echo '<a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'" class="number">'.$last_page_text.'</a>';
			}
			echo '</div>'.$after;
		}
	}

	///////////////////////////////////////
	// Add wmode transparent and post-video container for responsive purpose
	///////////////////////////////////////	
	function themify_add_video_wmode_transparent($html, $url, $attr) {
		
		$html = '<div class="post-video">' . $html . '</div>';
		if (strpos($html, "<embed src=" ) !== false) {
			$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
			return $html;
		}
		else {
			if(strpos($html, "wmode=transparent") == false){
				if(strpos($html, "?fs=" ) !== false){
					$search = array('?fs=1', '?fs=0');
					$replace = array('?fs=1&wmode=transparent', '?fs=0&wmode=transparent');
					$html = str_replace($search, $replace, $html);
					return $html;
				}
				else{
					$youtube_embed_code = $html;
					$patterns[] = '/youtube.com\/embed\/([a-zA-Z0-9._-]+)/';
					$replacements[] = 'youtube.com/embed/$1?wmode=transparent';
					return preg_replace($patterns, $replacements, $html);
				}
			}
			else{
				return $html;
			}
		}
	}
	add_filter('embed_oembed_html', 'themify_add_video_wmode_transparent');

	///////////////////////////////////////
	// Custom Theme Comment List Markup
	///////////////////////////////////////
	function custom_theme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; 
	   ?>

	<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
		<p class="comment-author"> 
			<?php echo get_avatar($comment,$size='48'); ?> <?php printf('<cite>%s</cite>', get_comment_author_link()) ?><br />
			<small class="comment-time"><strong>
			<?php comment_date('M d, Y'); ?>
			</strong> @
			<?php comment_time('H:i:s'); ?>
			<?php edit_comment_link( __('Edit', 'themify'),' [',']') ?>
			</small>
		</p>
		<div class="commententry">
			<?php if ($comment->comment_approved == '0') : ?>
			<p>
				<em><?php _e('Your comment is awaiting moderation.', 'themify') ?></em>
			</p>
			<?php endif; ?>
			<?php comment_text() ?>
		</div>
		<p class="reply">
			<?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'depth' => $depth, 'reply_text' => __( 'Reply', 'themify' ), 'max_depth' => $args['max_depth']))) ?>
		</p>
	<?php
	}

	/////////////////////////////////////////////////////////////////////////////////////
	// make read more link to post
	/////////////////////////////////////////////////////////////////////////////////////

	function new_excerpt_more($more) {
       global $post;
	return '<p><a href="'. get_permalink($post->ID) . '">Read More...</a></p>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

	function custom_excerpt_length( $length ) {
	return 55;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	/////////////////////////////////////////////////////////////////////////////////////
	// add shortcode to display a call to action within a post
	/////////////////////////////////////////////////////////////////////////////////////
		
	//add_shortcode('action_call', function() {
		//$spa1_option = spa1_get_global_options(); 
		//$phone = $spa1_option['spa1_phone'];
		//return "<h3>Call us at $phone</h3>";
	//});
	
	/////////////////////////////////////////////////////////////////////////////////////
	// TGM Plugin Activation
	/////////////////////////////////////////////////////////////////////////////////////

	require_once('includes/class-tgm-plugin-activation.php');
	
	add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name, slug and required.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'                  => 'Bookmark Lovers', // The plugin name
            'slug'                  => 'BLPremiumRevised', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/BLPremiumRevised/', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 About Widget', // The plugin name
            'slug'                  => 'spa1-about-widget', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-about-widget/', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 Business Hours', // The plugin name
            'slug'                  => 'spa1-bus-hours', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-bus-hours/', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 Filter', // The plugin name
            'slug'                  => 'spa1-filter', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-filter/', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 Services', // The plugin name
            'slug'                  => 'spa1-services', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-services/', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 Show Related Posts', // The plugin name
            'slug'                  => 'spa1-show-rel-posts', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/show-rel-posts/', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 Slider', // The plugin name
            'slug'                  => 'spa1-slider', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-slider/', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 Social Media Widget', // The plugin name
            'slug'                  => 'spa1-social-media-widget', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-social-media-widget/', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 Theme Options', // The plugin name
            'slug'                  => 'spa1-theme-options', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-theme-options/', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 V-Card Widget', // The plugin name
            'slug'                  => 'spa1-v-card-widget', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-v-card-widget/', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Spa1 Feature Boxes', // The plugin name
            'slug'                  => 'spa1-feature-boxes', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/spa1-feature-boxes/', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Silobuilder', // The plugin name
            'slug'                  => 'silobuilder', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/silobuilder/', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Link Daemon', // The plugin name
            'slug'                  => 'linkdaemon', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/linkdaemon/', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
 
        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      => 'All in One SEO Pack',
            'slug'      => 'all-in-one-seo-pack',
            'required'  => false,
        ),
        array(
            'name'      => 'Jetpack',
            'slug'      => 'jetpack',
            'required'  => false,
        ),
        array(
            'name'      => 'Google Analyticator',
            'slug'      => 'google-analyticator',
            'required'  => false,
        ),
        array(
            'name'      => 'Google XML Sitemap for Images',
            'slug'      => 'google-image-sitemap',
            'required'  => false,
        ),
        array(
            'name'      => 'Google XML Sitemaps',
            'slug'      => 'google-sitemap-generator',
            'required'  => false,
        ),
        array(
            'name'      => 'Quick Adsense',
            'slug'      => 'quick-adsense',
            'required'  => false,
        ),
        array(
            'name'      => 'underConstruction',
            'slug'      => 'underconstruction',
            'required'  => false,
        ), 
        array(
            'name'      => 'cbnet Ping Optimizer',
            'slug'      => 'cbnet-ping-optimizer',
            'required'  => false,
        ), 
        array(
            'name'      => 'WP Security Scan',
            'slug'      => 'wp-security-scan',
            'required'  => false,
        ), 
        array(
            'name'      => 'Bullet Proof Security',
            'slug'      => 'bulletproof-security',
            'required'  => false,
        ), 
        array(
            'name'      => 'BackUpWordPress',
            'slug'      => 'backupwordpress',
            'required'  => false,
        ), 
        array(
            'name'      => 'WP Super Cache',
            'slug'      => 'wp-super-cache',
            'required'  => false,
        ), 
    );
 
    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'elizabeth-rogers.com';
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        )
    );
 
    tgmpa( $plugins, $config );
 
}

// Hide WordPress Version

function wpt_remove_version() {  
   return '';  
}  
add_filter('the_generator', 'wpt_remove_version');  