<?php if(function_exists('elr_pagenav')){ ?>
	<?php elr_pagenav(); ?> 
<?php } else { ?>
	<div class="post-nav">
		<span class="prev"><?php next_posts_link(__('&laquo; Older Entries', 'elr')) ?></span>
		<span class="next"><?php previous_posts_link(__('Newer Entries &raquo;', 'elr')) ?></span>
	</div>
<?php } ?>