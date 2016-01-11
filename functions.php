<?php
/**
 *
 */

define( 'THEME_TEXTDOMAIN', 'beyond' );
define( 'VIEWS', dirname( __FILE__ ) . '/views/' );
require 'BydAutoload.php';

/**
 * Loads the basic scripts
 */
function byd_scripts()
{
    wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', [], '3.0.2', 'all' );
    wp_register_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', [], '2.0.4', 'all' );
    wp_register_style( 'style', get_template_directory_uri() . '/style.css', [], '1.0', 'all' );

    wp_register_script( 'scripts', get_template_directory_uri() . '/js/main.js', ['jquery'], '1.0', TRUE );

    wp_enqueue_style( 'normalize' );
    wp_enqueue_style( 'skeleton' );
    wp_enqueue_style( 'style' );

    wp_enqueue_script( 'scripts' );
}

add_action( 'wp_enqueue_scripts', 'byd_scripts' );


/**
 * Defines sidebars
 *
 * @param array $names
 */
function byd_sidebars( $names )
{
    foreach ( $names as $name ) {
        $id = strtolower( str_replace( ' ', '_', $name ) );
        register_sidebar( [
            'name'  => $name,
            'id'    => $id,
            'class' => 'byd_sidebar'
        ] );
    }
}

byd_sidebars( ['Footer 1', 'Footer 2', 'Footer 3', 'Blog'] );


/**
 * Posts and pages options
 */
function byd_meta_box_options()
{
    $meta_box_options = [
        'sidebar'    => [
            'id'      => '_byd_metabox_display_post_sidebar',
            'name'    => __( 'Display sidebar ?', THEME_TEXTDOMAIN ),
            'default' => FALSE,
            'type'    => 'checkbox'
        ],
        'navigation' => [
            'id'      => '_byd_metabox_display_post_navigation',
            'name'    => __( 'Display navigation ?', THEME_TEXTDOMAIN ),
            'default' => TRUE,
            'type'    => 'checkbox'
        ],
        'slider'     => [
            'id'      => '_byd_metabox_display_post_slider',
            'name'    => __( 'Display slider ?', THEME_TEXTDOMAIN ),
            'default' => TRUE,
            'type'    => 'checkbox'
        ]
    ];

    return $meta_box_options;
}


/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function byd_display_metabox( $post )
{

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'myplugin_save_meta_box_data', 'myplugin_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, '_my_meta_value_key', TRUE );

    echo '<label for="myplugin_new_field">';
    _e( 'Description for this field', 'myplugin_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data( $post_id )
{

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( !isset( $_POST[ 'myplugin_meta_box_nonce' ] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( !wp_verify_nonce( $_POST[ 'myplugin_meta_box_nonce' ], 'myplugin_save_meta_box_data' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST[ 'post_type' ] ) && 'page' == $_POST[ 'post_type' ] ) {

        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if ( !isset( $_POST[ 'myplugin_new_field' ] ) ) {
        return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST[ 'myplugin_new_field' ] );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}

add_action( 'save_post', 'myplugin_save_meta_box_data' );
