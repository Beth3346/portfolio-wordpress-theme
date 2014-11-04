<?php 

///////////////////////////////////////////////////////////////////////////////////////////////
// init.php
///////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Test to see if the page is a date based archive page cpt archive
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return boolean
 */

function elr_is_cpt_archive() {
    if ( is_category() || is_author() || is_tag() || is_date() ) {
        return false;
    } else {
        return true;
    }
}

/**
 * Test to find out if post type is cpt
 *
 * @since  3.0.0
 * @access public
 * @param  string $post post to test optional
 * @return void
 */

function elr_is_custom_post_type( $post = NULL ) {
    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );

    // there are no custom post types
    if ( empty ( $all_custom_post_types ) ) {
        return FALSE;
    }

    $custom_types = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );

    // could not detect current type
    if ( ! $current_post_type ) {
        return FALSE;
    }

    return in_array( $current_post_type, $custom_types );
}

/**
 * Updates the number of posts that display on each archive page
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

if ( ! function_exists( 'elr_number_of_cpts' ) ) {

    function elr_number_of_cpts( $query ) {

        $cpts = array( 'faq', 'product', 'person', 'location', 'video', 'project', 'service' );
        $num = 20;

        if ( is_post_type_archive( $cpts, $num ) ) {

            $query->set( 'posts_per_page', $num );
        }

        return $query;
    }
     
    add_filter( 'pre_get_posts', 'elr_number_of_cpts' );
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_get_current_tax( $query ) {

    if ( is_tax() ) {

        $tax_term = $query->queried_object;
        return $tax_term->name;

    } else {

        return null;
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

function elr_get_loop() {

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

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_archive_link( $post_type ) {

    $cpt_archive = get_post_type_archive_link( $post_type );
    $post_name = get_post_type_object( $post_type )->label;

    echo '<a href="' . $cpt_archive . '" class="archive-link">See More ' . $post_name . '</a>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_get_single_loop() {

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

        wp_link_pages(array('before' => '<p><strong>'.__('Pages:','elr').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));

        get_template_part( 'partials/post-nav' );
        elr_archive_link( get_post_type() );
        comments_template();

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

function elr_get_cpt_loop() {

    if ( have_posts() ) {

        while ( have_posts() ) : the_post();

            get_template_part( 'content/content', get_post_type() );

        endwhile;

        get_template_part( 'partials/pagination' );

    } else {

        get_template_part( 'content/content', 'none' );
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

function elr_get_contact() {
    $front_page_options = (array)get_option('elr_theme_front_page_options');

    if( isset( $front_page_options['show_contact'] ) ) : get_template_part( 'partials/front-contact'); endif;
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_tax_nav( $taxonomy, $current_term = null ) {

    $tax_args = array(
        'orderby'           => 'name',
        'order'             => 'ASC',
        'hide_empty'        => true
    );

    $tax_name = ucwords( str_replace( '_' , ' ', $taxonomy ) );
    $terms = get_terms( array( $taxonomy ), $tax_args );
    $term_names = array();

    // create an array of term names
    foreach ( $terms as $term ) {
        array_push( $term_names, $term->name );
    }

    if ( $terms ) {
        echo '<nav class="taxonomy-nav">';
        echo '<h4>' . $tax_name . ': </h4>';
        echo '<ul data-tax="' . $taxonomy . '">';

        if ( $current_term && in_array( $current_term, $term_names ) ) {
            echo '<li><a href="/products/" data-term="all">All</a></li>';
        } else {
            echo '<li><a href="/products/" class="active" data-term="all">All</a></li>';
        }
    
            // list all terms
            foreach ( $terms as $term ) {
                $term_link = get_term_link( $term );
                echo '<li>';
                    echo '<a href="';
                    echo esc_url( $term_link ) . '"';

                        if ( $term->name === $current_term ) {
                            echo 'class="active"';
                        }

                        echo 'data-term="' . $term->slug . '"';
                    echo '>';
                    echo( ucwords( $term->name ) );
                echo '</a></li>';
            }
        echo '</ul></nav>';        
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

                echo '<figcaption>';
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

function elr_post_date() {
    $options = get_option( 'elr_theme_display_options' );

    if ( isset( $options['relative_publish_dates'] ) ) {
        $relative_publish_dates = $options['relative_publish_dates'];
    } else {
        $relative_publish_dates = NULL;
    }
    
    echo '<li class="post-date">';

    if ( $relative_publish_dates ) {
        echo '<i class="fa fa-calendar"></i> ';
        echo '<time datetime="';
            the_time('o-m-d');
        echo '" pubdate>';
            echo 'Posted ';
            echo human_time_diff( get_the_time('U'), current_time('timestamp') );
            echo ' ago ';
        echo '</time>';
    } else {
        echo '<i class="fa fa-calendar"></i> ';
        echo '<time datetime="';
            the_time('o-m-d');
        echo '" pubdate>';
        the_time('F j, Y');
        echo '</time>';
    }

    echo '</li>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_post_category( $id ) {

    if ( get_the_category( $id ) ) {
        echo '<li class="post-category"><i class="fa fa-folder"></i> ';
            the_category(', ');
        echo '</li>';
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

function elr_post_author() {
    echo '<li class="post-author"><i class="fa fa-user"></i> ';
    the_author_posts_link();
    echo '</li>';
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

        echo '<li class="post-comment"><i class="fa fa-comment"></i> ';
            comments_popup_link( __( '0 Comments', 'elr' ), __( '1 Comment', 'elr' ), __( '% Comments', 'elr' ) );
        echo '</li>';
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

    echo '<ul class="post-meta">';
        elr_post_date();
        elr_post_author();
        elr_post_category( $id );
        elr_post_tags();
        elr_post_comments();
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

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_post_content( $id, $excerpt = true ) {

    echo '<div>';

        if ( is_single() || is_page() ) {
            the_content();
        } elseif ( $excerpt === true ) {
            echo '<div class="post-excerpt' . $id . '">';
                the_excerpt();
            echo '</div>';
        } else {
            the_content();
        }

    echo '</div>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_time_diff( $datetime ) {
    $current_time = current_time('timestamp') ;

    if ( $datetime ) {

        $datetime = strtotime( $datetime );
        echo '<li>';

        if ( $datetime > $current_time ) {

            echo 'in about ' . human_time_diff( $datetime, current_time('timestamp') );

        } else if ( $datetime = $current_time ) {

            echo 'Right Now';

        } else {

            echo 'about ' . human_time_diff( $datetime, current_time('timestamp') ) . ' ago';
        }

        echo '</li>';
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

function elr_start_end( $start_date, $start_time, $end_date, $end_time ) {

    if ( $start_date === $end_date ) {

        echo '<li>';
            echo mysql2date( 'l, F j, Y', $start_date );
            echo '</span><br>';
            echo mysql2date( 'g:i a', $start_time );
            echo '</span> to ';
            echo mysql2date( 'g:i a', $end_time );
            echo '</span>';
        echo '</li>';

    } else {

        echo '<li>';
            echo mysql2date( 'l, F j, Y', $start_date );
            echo '</span> at ';
            echo mysql2date( 'g:i a', $start_time );
            echo '</span><br /> to ';
            echo mysql2date( 'l, F j, Y', $end_date );
            echo '</span> at ';
            echo mysql2date( 'g:i a', $end_time );
            echo '</span>';
        echo '</li>';
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

function elr_map( $map ) {
    echo '<iframe src="';
    echo esc_url( $map );
    echo '"width="1000" height="450" frameborder="0" style="border:0; pointer-events:none;"></iframe>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_bus_hours( $bus_hours ) {

    echo '<ul class="business-hours">';

    if( array_key_exists( 'sun_open', $bus_hours ) ) {
        if ( $bus_hours['sun_open'] ) {
            echo '<li><span class="bus-hour-label">Sunday:</span> ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['sun_open'] ) );
            echo ' - ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['sun_close'] ) );
            echo '</li>';
        }
    }

    if( array_key_exists( 'mon_open', $bus_hours ) ) {
        if ( $bus_hours['mon_open'] ) {
            echo '<li><span class="bus-hour-label">Monday:</span> ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['mon_open'] ) );
            echo ' - ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['mon_close'] ) );
            echo '</li>';
        }
    }

    if( array_key_exists( 'tue_open', $bus_hours ) ) {
        if ( $bus_hours['tue_open'] ) {
            echo '<li><span class="bus-hour-label">Tuesday:</span> ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['tue_open'] ) );
            echo ' - ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['tue_close'] ) );
            echo '</li>';
        }
    }

    if( array_key_exists( 'wed_open', $bus_hours ) ) {
        if ( $bus_hours['wed_open'] ) {
            echo '<li><span class="bus-hour-label">Wednesday:</span> ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['wed_open'] ) );
            echo ' - ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['wed_close'] ) );
            echo '</li>';
        }
    }

    if( array_key_exists( 'thu_open', $bus_hours ) ) {
        if ( $bus_hours['thu_open'] ) {
            echo '<li><span class="bus-hour-label">Thursday:</span> ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['thu_open'] ) );
            echo ' - ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['thu_close'] ) );
            echo '</li>';
        }
    }

    if( array_key_exists( 'fri_open', $bus_hours ) ) {
        if ( $bus_hours['fri_open'] ) {
            echo '<li><span class="bus-hour-label">Friday:</span> ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['fri_open'] ) );
            echo ' - ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['fri_close'] ) );
            echo '</li>';
        }
    }

    if( array_key_exists( 'sat_open', $bus_hours ) ) {
        if ( $bus_hours['sat_open'] ) {
            echo '<li><span class="bus-hour-label">Saturday:</span> ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['sat_open'] ) );
            echo ' - ';
            echo esc_html( mysql2date( 'g:i a', $bus_hours['sat_close'] ) );
            echo '</li>';
        }
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

function elr_is_expired( $datetime = null ) {
    $current_time = strtotime( current_time( 'Y-m-d H:i' ) );

    if ( $datetime ) {
        $datetime = strtotime( $datetime );
        return $datetime >= $current_time ? false : true;

    } else {

        return false;
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

        return wp_trim_words( elr_remove_quotes( $content ), 30, "..." );

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

    if ( $address ) {
        echo '<ul class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';

            if ( $address['street_address'] ) {
                echo '<li class="drm-text-center" itemprop="streetAddress">';
                echo esc_html( $address['street_address'] );
                echo '</li>';
            }

            echo '<li class="drm-text-center">';

            if ( $address['city'] ) {
                echo '<span itemprop="addressLocality">';
                echo esc_html( $address['city'] );
                echo ', </span>';
            }

            if ( $address['state'] ) {
                echo '<span itemprop="addressRegion">';
                echo esc_html( $address['state'] );
                echo ' </span>';
            }

            if ( $address['zip_code'] ) {
                echo '<span itemprop="postalCode">';
                echo esc_html( $address['zip_code'] );
                echo ', </span>';
            }

            if ( $address['country'] ) { 
                echo '<span itemprop="country">';
                echo esc_html( $address['country'] );
                echo '</span><br>';
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
        echo '<i class="fa fa-envelope"></i> <span itemprop="email"><a href="mailto:';
        echo antispambot( $email );
        echo '">';
        echo antispambot( $email );
        echo '</a></span>';
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

function elr_phone( $phone ) {

    if ( $phone ) {
        echo '<i class="fa fa-phone-square"></i> <span itemprop="telephone">';
        echo esc_html( $phone );
        echo '</span>';
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

function elr_front_section_heading( $heading_name ) {

    $front_page_options = (array)get_option('elr_theme_front_page_options');
    $heading = str_ireplace( '"', '', trim( $front_page_options[$heading_name] ) );

    if ( $heading ) {
        echo '<h1 class="section-heading">';
        echo esc_html( $heading );
        echo '</h1>';
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

function elr_front_thumbnail( $shape = 'rectangle', $title_length = 75, $url = null ) {

    $shape === 'circle' ? $class = 'circle-box' : $class = 'rectangle-box';
    $url ? $url = esc_url( $url ) : $url = get_the_permalink();

    if ( has_post_thumbnail() ) {
        echo '<figure class="' . $class . '">';
            echo '<a href="';
            echo $url;
            echo '" title="' . elr_trim_title( $title_length ) . '">';
            the_post_thumbnail( array( 9999, 196 ) );
            echo '</a>';
        echo '</figure>';
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

function elr_front_title( $length = 75, $url = null ) {

    $url ? $url = esc_url( $url ) : $url = get_the_permalink();
    echo '<h1><a href="';
    echo $url;
    echo '" title="';
    echo esc_attr( elr_trim_title( $length ) );
    echo '">';
    echo esc_html( elr_trim_title( $length ) );
    echo '</a></h1>';
}

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_front_content( $id, $length = 200 ) {

    if ( get_the_content() ) {
        echo '<p class="front-content">';
        echo esc_html( elr_trim_content( $length ) );
        echo '</p>';
    }

    echo '<div class="front-post-actions">';
    elr_post_actions_nav( $id );
    echo '</div>';
}

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

/**
 * TODO: Function Description
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_front_more( $text = 'Read More', $url = null ) {

    $url ? $url = esc_url( $url ) : $url = get_the_permalink();
    echo '<a href="';
    echo $url;
    echo '" class="button-link">';
    echo $text;
    echo '</a>';
}

/**
 * Echos comma separated taxonomy term links
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_taxonomy_terms( $taxonomy, $id ) {
    $terms = get_the_terms( $id, $taxonomy );
    $last_key = array_search( end( $terms ), $terms );

    foreach ( $terms as $key => $value ) {
        $term_link = get_term_link( $value );

        echo '<a href="';
        echo $term_link;
        echo '">';
        echo ucwords( $value->name );

        if ( $key === $last_key ) {
            echo '</a> ';
        } else {
            echo '</a>, ';
        }    
    }
}

/**
 * Echos a li with social media icons
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_social_media( $social_media ) {

    if ( $social_media ) {

        echo '<li class="social-media-icons">';

            if( array_key_exists( 'work_email', $social_media ) ) {
                if( $social_media['work_email'] ) {
                    echo '<a href="mailto:' . antispambot( $social_media['work_email'] ) . '"><i class="fa fa-envelope"></i></a>';
                }                
            }

            if( array_key_exists( 'email', $social_media ) ) {
                if( $social_media['email'] ) {    
                    echo '<a href="mailto:' . antispambot( $social_media['email'] ) . '"><i class="fa fa-envelope"></i></a>';
                }
            }

            if( array_key_exists( 'facebook', $social_media ) ) {
                if( $social_media['facebook'] ) {    
                    echo '<a href="' . esc_url( $social_media['facebook'] ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
                }
            }

            if( array_key_exists( 'twitter', $social_media ) ) {
                if( $social_media['twitter'] ) {    
                    echo '<a href="' . esc_url( $social_media['twitter'] ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
                }
            }

            if( array_key_exists( 'google_plus', $social_media ) ) {
                if( $social_media['google_plus'] ) {    
                    echo '<a href="' . esc_url( $social_media['google_plus'] ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
                }
            }

            if( array_key_exists( 'pinterest', $social_media ) ) {
                if( $social_media['pinterest'] ) {    
                    echo '<a href="' . esc_url( $social_media['pinterest'] ) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
                }
            }

            if( array_key_exists( 'github', $social_media ) ) {
                if( $social_media['github'] ) {    
                    echo '<a href="' . esc_url( $social_media['github'] ) . '" target="_blank"><i class="fa fa-github"></i></a>';
                }
            }

            if( array_key_exists( 'linkedin', $social_media ) ) {
                if( $social_media['linkedin'] ) {    
                    echo '<a href="' . esc_url( $social_media['linkedin'] ) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
                }
            }

            if( array_key_exists( 'yelp', $social_media ) ) {
                if( $social_media['yelp'] ) {    
                    echo '<a href="' . esc_url( $social_media['yelp'] ) . '" target="_blank"><i class="fa fa-yelp"></i></a>';
                }
            }

        echo '</li>';
    }
}