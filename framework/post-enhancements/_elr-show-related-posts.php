<?php

///////////////////////////////////////////////////////////////////////////////////
// Adds a list of related posts at the end of the content
// Can choose related posts by category or tag
///////////////////////////////////////////////////////////////////////////////////

$display_options = (array)get_option('elr_theme_display_options');
$taxonomy = $display_options['related_posts_taxonomy'];
// add a default if no taxonomy is supplied
if ( !$taxonomy ) {
    $taxonomy = 'category';
}

add_filter( 'the_content', function( $content ) use ( $taxonomy ) {
        return elr_show_related_posts( $content, $taxonomy );
    }, 12
);

if ( ! function_exists( 'elr_show_related_posts' ) ) {
    function elr_show_related_posts($content, $taxonomy) {
        $id = get_the_id();

        if (!is_singular('post') ) {
            return $content;
        }

        // config
        if ( $taxonomy === 'category' ) {
            $term_name = $taxonomy;
            $term_id = 'cat_ID';
        } else if ( $taxonomy === 'tag' ) {
            $term_name = 'post_tag';
            $term_id = 'term_id';
        }

        $terms = get_the_terms($id, $term_name);
        $related = array();

        foreach( $terms as $term ) {
            $related[] = $term->$term_id;
            $related_name[]['name'] = $term->name;
        }

        $loop = new WP_Query(
            array(
                'posts_per_page' => 3,
                $taxonomy. '__in' => $related,
                'orderby' => 'rand',
                'post__not_in' => array($id)
            )
        );

        if ( $loop->have_posts() ) {
            $content .= '
            <section class="related-posts">
            <h1>More Articles About ' . $related_name[0]['name'] . '</h1>
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
    }
}