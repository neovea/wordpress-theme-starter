<?php

/**
 * Created by PhpStorm.
 * User: FLE
 * Date: 11/01/2016
 * Time: 14:46
 */
class BydInit
{


    static function byd_init()
    {

        add_action( 'add_meta_boxes', [new BydMetabox, 'byd_add_metabox'] );
        add_action( 'save_post', [new BydMetabox, 'byd_save_metaboxes'] );
    }
}