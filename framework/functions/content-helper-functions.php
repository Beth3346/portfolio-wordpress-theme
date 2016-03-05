<?php

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_map( $map, $width = 500, $height = 450 ) {
    echo '<iframe src="';
    echo esc_url( $map );
    echo '"width="';
    echo $width;
    echo '" height="';
    echo $height;
    echo '" frameborder="0" style="border:0;"></iframe>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_remove_quotes( $content ) {
    return str_ireplace( '"', '', $content );
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_trim_title( $title_length = 75 ) {
    $title = get_the_title();

    if ( strlen( $title ) > $title_length ) {

        return substr( elr_remove_quotes( $title ), 0, $title_length ) . '...';

    } else {

        return substr( elr_remove_quotes( $title ), 0, $title_length );
    }

}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_trim_content( $content_length = 200 ) {
    $content = get_the_content();

    if ( strlen( $content ) > $content_length ) {

        return wp_trim_words( elr_remove_quotes( $content ), $content_length, "..." );

    } else {

        return elr_remove_quotes( $content );
    }

}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_video( $video, $width = 560, $height = 349 ) {

    if ( $video ) {
        echo '<div class="video-holder">';
        echo '<iframe src="//';
        echo esc_attr( $video );
        echo '" width=';
        echo $width;
        echo "' height='";
        echo $height;
        echo "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen>";
        echo '</iframe>';
        echo '</div>';
    }
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_address( $address ) {
    if ( array_filter( $address ) ) {
        echo '<ul class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';

        if ( array_key_exists( 'street_address', $address ) ) {
            if ( $address['street_address'] ) {
                echo '<li itemprop="streetAddress">';
                echo esc_html( $address['street_address'] );
                echo '</li>';
            }
        }

        echo '<li>';

        if ( array_key_exists( 'city', $address ) ) {
            if ( $address['city'] ) {
                echo '<span itemprop="addressLocality">';
                echo esc_html( $address['city'] );
                echo ', </span>';
            }
        }

        if ( array_key_exists( 'state', $address ) ) {
            if ( $address['state'] ) {
                echo '<span itemprop="addressRegion">';
                echo esc_html( $address['state'] );
                echo ', </span>';
            }
        }

        if ( array_key_exists( 'zip_code', $address ) ) {
            if ( $address['zip_code'] ) {
                echo '<span itemprop="postalCode">';
                echo esc_html( $address['zip_code'] );
                echo ', </span>';
            }
        }

        if ( array_key_exists( 'country', $address ) ) {
            if ( $address['country'] ) {
                echo '<span itemprop="country">';
                echo esc_html( $address['country'] );
                echo '</span><br>';
            }
        }

        echo '</li>';
        echo '</ul>';
    }
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_email( $email ) {

    if ( $email ) {
        echo '<a href="mailto:';
        echo antispambot( $email );
        echo '">';
        echo antispambot( $email );
        echo '</a>';
    }
}

function elr_phone( $phone ) {

    if ( $phone ) {
        echo '<a href="tel:' . $phone . '">' . $phone . '</a>';
    }
}

function elr_breadcrumbs() {
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">','</p>');
    }
}

function elr_author_archive_title() {
    /*
     * Queue the first post, that way we know what author
     * we're dealing with (if that is the case).
     *
     * We reset this later so we can run the loop properly
     * with a call to rewind_posts().
     */
    the_post();

    printf( __( 'All posts by %s', 'elr' ), get_the_author() );
}

function elr_author_archive_description() {
    if ( get_the_author_meta( 'description' ) ) {
        echo '<div class="author-description">';
        echo get_the_author_meta( 'description' );
        echo '</div>';
    }
}

function elr_category_archive_title() {
    printf( __( 'Category: %s', 'elr' ), single_cat_title( '', false ) );
}

function elr_category_archive_description() {
    $term_description = term_description();
    if ( ! empty( $term_description ) ) :
        printf( '<div class="taxonomy-description">%s</div>', $term_description );
    endif;
}

function elr_search_archive_title() {
    printf( __( 'Search Results for: %s', 'elr' ), '<span>' . get_search_query() . '</span>' );
}

function elr_tag_archive_title() {
    printf( __( 'Tag: %s', 'elr' ), single_tag_title( '', false ) );
}

function elr_tag_archive_description() {
    // Show an optional term description.
    $term_description = term_description();
    if ( ! empty( $term_description ) ) :
        printf( '<div class="taxonomy-description">%s</div>', $term_description );
    endif;
}

function elr_related_posts( $taxonomy = 'category', $post_type = 'current', $num_posts = 3 ) {
    $id = get_the_ID();

    // config
    if ( $taxonomy === 'category' ) {
        $term_name = $taxonomy;
        $term_id = 'cat_ID';
    } else if ( $taxonomy === 'tag' ) {
        $term_name = 'post_tag';
        $term_id = 'term_id';
    } else {
        $term_name = $taxonomy;
        $term_id = 'term_id';
    }

    if ( $post_type == 'current' ) {
        $post_type = get_post_type();
    }

    $terms = get_the_terms($id, $term_name);
    $related = array();

    // TODO: need to check if term exists
    if ( !empty( $terms ) ) {
        foreach( $terms as $term ) {
            $related[] = $term->$term_id;
            $related_name[]['name'] = $term->name;
        }
    } else {
        return;
    }

    $loop = new WP_Query(
        array(
            'posts_per_page' => $num_posts,
            $taxonomy. '__in' => $related,
            'orderby' => 'rand',
            'post__not_in' => array( $id ),
            'post_type' => $post_type
        )
    );

    if ( $loop->have_posts() ) {
        $related_posts = '<h3>' . $term_name . ': ' . $terms[0]->name . '</h3>' .
        '<ul class="related-category-posts">';
        while( $loop->have_posts() ) {
            $loop->the_post();
            $related_posts .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $related_posts .= '</ul>';
        wp_reset_query();
    }

    return $related_posts;
}