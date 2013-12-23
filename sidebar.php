<aside class="sidebar" id="sidebar">

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>

		<section class="sidebar-widget widget">
			<h1 class="widget-title"><?php _e('Pages','elr'); ?></h1>
			<ul>
			<?php wp_list_pages('title_li=' ); ?>
			</ul>
		</section>

		<section class="sidebar-widget widget">
			<h1 class="widget-title"><?php _e('Category','elr'); ?></h1>
			<ul>
			<?php wp_list_categories('show_count=1&title_li='); ?>
			</ul>
		</section>

	<?php endif; ?>

</aside>
<!-- /#sidebar -->
