<aside class="sidebar" id="sidebar">

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>

		<section class="widget">
			<h1 class="widgettitle"><?php _e('Pages','themify'); ?></h1>
			<ul>
			<?php wp_list_pages('title_li=' ); ?>
			</ul>
		</section>

		<section class="widget">
			<h1 class="widgettitle"><?php _e('Category','themify'); ?></h1>
			<ul>
			<?php wp_list_categories('show_count=1&title_li='); ?>
			</ul>
		</section>

	<?php endif; ?>

</aside>
<!-- /#sidebar -->
