<?php

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_loop() {

    if ( have_posts() ) {

        while ( have_posts() ) : the_post();
            // since its a custom function we need to make sure it exists
            if ( function_exists( 'elr_is_custom_post_type' ) ) {

                if ( elr_is_custom_post_type() ) {

                    get_template_part( 'content/content', get_post_type() );

                } else {

                    get_template_part( 'content/content', get_post_format() );
                }

            } else {

                get_template_part( 'content/content', get_post_format() );
            }

        endwhile;

        get_template_part( 'partials/pagination' );

    } else {

        get_template_part( 'content/content', 'none' );
    }
}

function elr_page_loop() {
    while ( have_posts() ) : the_post();
    echo '<article>';
        elr_page_title();
        elr_post_thumbnail();
        the_content();
        elr_link_pages();
        elr_edit_link();
    echo '</article>';
    endwhile;
}

function elr_normal_loop() {
    echo '<div class="content-holder elr-col-two-thirds">';
    elr_loop();
    echo '</div>';
    echo '<aside class="sidebar elr-col-third" id="sidebar">';
    get_sidebar();
    echo '</aside>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_post_thumbnail( $holder = 'post-image-holder', $thumbnail_size = array( 400, 9999 ) ) {

    if ( has_post_thumbnail() ) {

        echo '<div class="' . $holder . '">';

            if ( is_single() || is_page() ) {
                the_post_thumbnail( $thumbnail_size );

            } else {
                echo '<a href="';
                    the_permalink();
                echo '">';
                    the_post_thumbnail( $thumbnail_size );
                echo '</a>';
            }

            $caption = get_post(get_post_thumbnail_id())->post_excerpt;

            if ( $caption ) {

                echo '<figcaption class="post-image-caption">';
                    echo esc_html( $caption );
                echo '</figcaption>';
            }

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

function elr_archive_link( $post_type, $text = 'See More' ) {

    $cpt_archive = get_post_type_archive_link( $post_type );
    $post_name = get_post_type_object( $post_type )->label;

    echo '<a href="' . $cpt_archive . '" class="archive-link">' . $text . '</a>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_single_loop($archive_link = false, $archive_link_text = null) {

    while ( have_posts() ) : the_post();

        if ( function_exists( 'elr_is_custom_post_type' ) ) {

            if ( elr_is_custom_post_type() ) {

                get_template_part( 'content/content', get_post_type() );

            } else {

                get_template_part( 'content/content', get_post_format() );
            }

        } else {

            get_template_part( 'content/content', get_post_format() );
        }

        elr_link_pages();

        get_template_part( 'partials/post-nav' );

        if ( elr_is_custom_post_type() && $archive_link_text ) {
            elr_archive_link( get_post_type(), $archive_link_text );
        }

    endwhile;
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_post_category() {
    the_category(', ');
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_post_author() {
    the_author_posts_link();
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_post_tags() {
    the_tags(' <li class="post-tag"><i class="fa fa-tags"></i> ', ', ', '</li>');
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_post_comments() {

    if ( comments_open() ) {
        comments_popup_link( __( '0 Comments', 'elr' ), __( '1 Comment', 'elr' ), __( '% Comments', 'elr') );
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

function elr_post_meta( $id ) {

    echo '<ul class="post-meta elr-inline-list">';
        echo '<li class="post-date"><i class="fa fa-calendar"></i> ';
            elr_post_date();
        echo '</li>';
        echo '<li class="post-author"><i class="fa fa-user"></i> ';
            elr_post_author();
        echo '</li>';
        echo '<li class="post-category"><i class="fa fa-folder"></i> ';
            elr_post_category();
        echo '</li>';
        elr_post_tags();
        if ( comments_open() ) {
            echo '<li class="post-comment"><i class="fa fa-comment"></i> ';
            elr_post_comments();
            echo '</li>';
        }
    echo '</ul>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_post_title() {

    if ( is_single() || is_page() ) {
        echo '<h1 class="post-title" role="heading">';
            the_title();
        echo '</h1>';
    } else {
        echo '<h1 class="post-title" role="heading"><a href="';
        the_permalink();
        echo '">';
        the_title();
        echo '</a></h1>';
    }
}

function elr_page_title() {
    echo '<h1 class="page-title" role="heading">';
        the_title();
    echo '</h1>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param
 * @return void
 */

function elr_post_content( $id, $excerpt = true ) {

    if ( is_single() || is_page() ) {
        the_content();
    } elseif ( $excerpt === true ) {
        echo '<div class="post-excerpt-' . $id . '">';
            the_excerpt();
        echo '</div>';
    } else {
        the_content();
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

function elr_post_actions_nav( $id ) {
    edit_post_link( __( '<i class="fa fa-pencil-square-o"></i>', 'elr' ) );

    if ( current_user_can( 'publish_posts' ) ) {
        echo ' <a href="/wp-admin/post-new.php?post_type=';
        echo get_post_type();
        echo '"><i class="fa fa-plus"></i></a> ';
    }

    if ( current_user_can( 'delete_posts' ) ) {
        echo '<a href="';
        echo get_delete_post_link( $id );
        echo '"><i class="fa fa-trash-o"></i></a>';
    }
}

function elr_edit_link($text = 'Edit') {
    edit_post_link( __( $text, 'elr' ) );
}

function elr_link_pages() {
    wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
}

function elr_post_query($post_type = 'post', $num = 3, $sort = 'date') {
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $num,
        'post_status' => 'publish',
        'orderby' => $sort
    );
    $query = new WP_Query( $args );

    return $query;
}

function elr_get_posts($post_type = 'post', $num = 3, $sort = 'date', $thumb = true, $excerpt_length = 40, $container = 'elr-col-third') {
    $query = elr_post_query($post_type, $num, $sort);
    if ( $query->have_posts() ) {
        $content = '';
        while ( $query->have_posts() ) : $query->the_post();
            global $post;
            $content .= '<div class="';
            $content .= $container;
            $content .= '">';
            $content .= '<div class="post-box post-box-';
            $content .= strtolower(str_replace(' ', '-', $post_type));
            $content .= '">';

            if ($thumb) {
                $content .= '<figure class="post-box-image"><a href="';
                $content .= get_the_permalink();
                $content .= '">';
                $content .= get_the_post_thumbnail();
                $content .= '</a></figure>';
            }

            $content .= '<h2 class="post-box-title"><a href="';
            $content .= get_the_permalink();
            $content .= '">';
            $content .= get_the_title();
            $content .= '</a></h2><p class="post-box-excerpt">';
            $content .= esc_html( elr_trim_content( $excerpt_length ) );
            $content .= '</p><a href="';
            $content .= get_the_permalink();
            $content .= '" class="post-box-learn-more">Read More</a></div></div>';
        endwhile;
        wp_reset_postdata();
        return $content;
    } else {
        return null;
    }
}