<?php

add_filter('the_content', function($content) {
	$id = get_the_id();
	if (!is_singular('post') ) {
		return $content;
	}
	$terms = get_the_terms($id, 'category');
	$cats = array();
	foreach( $terms as $term ) {
		$cats[] = $term->cat_ID;
	}
	$loop = new WP_Query(
		array(
			'posts_per_page' => 3,
			'category__in' => $cats,
			'orderby' => 'rand',
			'post__not_in' => array($id)
		)
	);
	if ( $loop->have_posts() ) {
		$content .= '
		<section class="related-posts">
		<h1>You Also Might Like...</h1>
		<ul class="related-category-posts">';
		while( $loop->have_posts() ) {
			$loop->the_post();
			$content .= '
			<li>
				<a href="' . get_permalink() . '">' . get_the_title() . '</a>
			</li>';
		}
		$content .= '</ul></section>';
		wp_reset_query();
	}
	return $content;
});