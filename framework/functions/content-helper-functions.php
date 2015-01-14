<?php

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

function elr_bus_hours( $bus_hours ) {

    if ( array_filter( $bus_hours ) ) {
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
    if ( array_filter( $address ) ) {
        echo '<ul class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';

        if ( array_key_exists( 'street_address', $address ) ) {
            if ( $address['street_address'] ) {
                echo '<li class="drm-text-center" itemprop="streetAddress">';
                echo esc_html( $address['street_address'] );
                echo '</li>';
            }
        }

        echo '<li class="drm-text-center">';

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
 * Echos a li with social media icons
 *
 * @since  3.0.0
 * @access public
 * @param  
 * @return void
 */

function elr_social_media( $social_media ) {

    if ( array_filter( $social_media ) ) {

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