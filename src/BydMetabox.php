<?php

/**
 * Created by PhpStorm.
 * User: FLE
 * Date: 11/01/2016
 * Time: 15:47
 */
class BydMetabox
{

    /**
     * Adds a box to the main column on the Post and Page edit screens.
     */
    public function byd_add_metabox()
    {

        $post_types = ['post', 'page'];
        $options = byd_meta_box_options();

        foreach ( $options as $key => $option ) {
            add_meta_box(
                $option[ 'id' ],
                $option[ 'name' ],
                [$this, 'byd_display_metabox'],
                null,
                'advanced',
                'high',
                [
                    'option' => $options[$key]
                ]
            );
        }
    }

    /**
     * Display meta boxes
     *
     * @param $post
     * @param $option
     */
    public function byd_display_metabox( $post, $option )
    {
        /*$options = byd_meta_box_options();
        foreach ( $options as $key => $option ) {
            new dBug($option);
        }*/

        $value = get_post_meta( $post->ID, $option[ 'id' ], TRUE );
        new dBug($value);
        $type = $option ["args"]["option"]["type"];
        $name = $option ["args"]["option"]["name"];



        if ( $type == 'textarea' ) {
            echo '<label for="' . $option[ 'id' ] . '">' . $name . '</label>';
            echo '<textarea id="' . $option[ 'id' ] . '" name="' . $option[ 'id' ] . '">' . $value . '</textarea>';
        }
        if ( $type == 'richtext' ) {
            echo '<label for="' . $option[ 'id' ] . '">' . $name . '</label>';
            wp_editor( $value, $option[ 'id' ], [
                'wpautop'       => TRUE,
                'textarea_name' => $option[ 'id' ],
                'teeny'         => TRUE,
                'textarea_rows' => 10
            ] );
            echo "<hr />".$value;
        }
        if ( $type == 'checkbox' ) {
            if ( TRUE == $value ) $checked = "checked"; else $checked = "";
            echo '<label for="' . $option[ 'id' ] . '">' . $name . '</label>';
            echo '<input type="' . $type . '" id="' . $option[ 'id' ] . '" name="' . $option[ 'id' ] . '" value="' . $value . '" ' . $checked . ' />';
            echo "<hr />".$value;
        }
        if ( $type == 'select' && is_array( $option[ 'options' ] ) ) {
            echo '<label for="' . $option[ 'id' ] . '">' . $name . '</label>';
            echo '<select id="' . $option[ 'id' ] . '" name="' . $option[ 'id' ] . '">';
            foreach ( $option[ 'options' ] as $key => $val ) {
                if ( $val == $value ) $selected = "selected"; else $selected = "";
                echo '<option value="' . $val . '" ' . $selected . '>' . $val . '</option>';
            }
            echo '</select>';
            echo "<hr />".$value;
        }
        if ( $type == 'text' ) {
            echo '<label for="' . $option[ 'id' ] . '">' . $name . '</label>';
            echo '<input type="' . $type . '" id="' . $option[ 'id' ] . '" name="' . $option[ 'id' ] . '" value="' . $value . '" />';
            echo "<hr />".$value;
        }
    }


    public function byd_save_metaboxes( $post_ID )
    {
        $meta_options = byd_meta_box_options();
        $arr_keys = array_keys( $_POST );
        foreach ( $meta_options as $k => $v ) {
            if ( in_array($k, $arr_keys) )
                update_post_meta( $post_ID, $k, esc_html( $_POST[ $k ] ) );
        }
    }

}