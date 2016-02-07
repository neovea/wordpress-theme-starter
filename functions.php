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

    wp_register_script( 'parallax', get_template_directory_uri() . '/js/jquery-parallax.js', ['jquery'], '1.1.3', TRUE );
    wp_register_script( 'beyonf', get_template_directory_uri() . '/js/main.js', ['jquery','parallax'], '1.0', TRUE );

    wp_enqueue_style( 'normalize' );
    wp_enqueue_style( 'skeleton' );
    wp_enqueue_style( 'style' );

    wp_enqueue_script( 'parallax' );
    wp_enqueue_script( 'beyonf' );
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