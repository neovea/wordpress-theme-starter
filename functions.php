<?php
/**
 * Created by PhpStorm.
 * User: Franck
 * Date: 09/01/2016
 * Time: 13:02
 */

define('THEME_TEXTDOMAIN', 'beyond');

function byd_scripts() {
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', [], '3.0.2', 'all');
    wp_register_style('skeleton', get_template_directory_uri() . '/css/skeleton.css', [], '2.0.4', 'all');

    wp_enqueue_style('normalize');
    wp_enqueue_style('skeleton');
}
add_action('wp_enqueue_scripts', 'byd_scripts');


function byd_sidebars($names) {
    foreach ( $names as $name ) {
        $title = $name;
        $id = strtolower(str_replace(' ', '_', $name));
        register_sidebar([
            'name' => $name,
            'id' => $id,
            'class' => 'byd_sidebar'
        ]);
    }
}

byd_sidebars(['Footer 1', 'Footer 2', 'Footer 3', 'Blog']);