<?php

add_action( 'init', 'elr_add_social_media_type' );
add_action( 'add_meta_boxes', 'elr_add_social_media_meta_boxes' );
add_action( 'save_post', 'elr_save_social_media' );

if ( ! function_exists( 'elr_add_social_media_type' ) ) {
    function elr_add_social_media_type() {
        // TODO:    Adds a custom post type for Social Media
            // Add custom post type
            // 
        $labels = array(
            'name'               => _x( 'Social Media', 'post type general name' ),
            'singular_name'      => _x( 'Social Media', 'post type singular name' ),
            'add_new'            => _x( 'Add New', 'social media' ),
            'add_new_item'       => __( 'Add New Social Media' ),
            'edit_item'          => __( 'Edit Social Media' ),
            'new_item'           => __( 'New Social Media' ),
            'all_items'          => __( 'All Social Media' ),
            'view_item'          => __( 'View Social Media' ),
            'search_items'       => __( 'Search Social Media' ),
            'not_found'          => __( 'No social media found' ),
            'not_found_in_trash' => __( 'No social media found in the Trash' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Social Media'
        );

        $args = array(
            'labels'        => $labels,
            'description'   => 'Holds our social media specific data',
            'public'        => true,
            'menu_position' => 5,
            'supports'      => array( 'title', 'thumbnail' ),
            'has_archive'   => true,
        );

        register_post_type( 'social_media' , $args );

    } // end add_social_media_type
}

if ( ! function_exists( 'elr_add_social_media_meta_boxes' ) ) {
    function elr_add_social_media_meta_boxes() {
        // TODO:    Adds a custom post type for Social Media
            add_meta_box(
                'elr_social_media_info',
                'Social Media Info',
                'elr_social_media_info_cb',
                'social_media',
                'normal',
                'high'
            );

        function elr_social_media_info_cb() {
            global $post;
            $social_media_url = get_post_meta($post->ID, 'elr_social_media_url', true);
            
            //implement security
            wp_nonce_field(__FILE__, 'elr_nonce');
            ?>
            <label for="elr_social_media_url">Social Media URL: </label>

            <input 
                type="url" id="elr_social_media_url" 
                name="elr_social_media_url" 
                placeholder="http://twitter.com" 
                value="<?php echo esc_attr( $social_media_url ); ?>" 
                class="widefat" 
            />

        <?php
        } // elr_social_media_info_cb
    } // end add_social_media_meta_boxes
}

if ( ! function_exists( 'elr_save_social_media' ) ) {
    function elr_save_social_media() {
    // TODO:    Saves Social Media

        global $post;

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
        //security check - nonce
        if ( isset($_POST['elr_nonce']) && $_POST && !wp_verify_nonce($_POST['elr_nonce'], __FILE__) ) {
            return;
        }
        
        if ( isset($_POST['elr_social_media_url'] ) ) {
            update_post_meta($post->ID, 'elr_social_media_url', $_POST['elr_social_media_url']);
        }

    } // end save_social_media
}