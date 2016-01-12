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
     * Posts and pages options
     */
    static function byd_meta_box_options()
    {
        $meta_box_options = [
            'beyond-page-options' => [
                'id'          => 'beyond-meta-box-options',
                'title'       => __( 'Beyond options', THEME_TEXTDOMAIN ),
                'description' => __( '', THEME_TEXTDOMAIN ),
                'context'     => 'normal',
                'priority'    => 'high',
                'fields'      => [
                    [
                        'name' => __( 'Use parallax effect on featured image', THEME_TEXTDOMAIN ),
                        'desc' => __( 'Check this option if you want to use the parallax background effect.', THEME_TEXTDOMAIN ),
                        'id'   => '_beyond_parallax_background',
                        'type' => 'checkbox'
                    ],
                    [
                        'name' => __( 'Display slider ?', THEME_TEXTDOMAIN ),
                        'desc' => __( 'Check this option if you want the slider to be displayed on top of the content.', THEME_TEXTDOMAIN ),
                        'id'   => '_beyond_display_slider',
                        'type' => 'checkbox'
                    ],
                    [
                        'name' => __( 'Display navigation ?', THEME_TEXTDOMAIN ),
                        'desc' => __( 'Check this option if you want the navigation on the page.', THEME_TEXTDOMAIN ),
                        'id'   => '_beyond_display_navigation',
                        'type' => 'checkbox'
                    ],
                    [
                        'name' => __( 'Display sidebar ?', THEME_TEXTDOMAIN ),
                        'desc' => __( 'Check this option if you want the sidebar to be displayed on the page.', THEME_TEXTDOMAIN ),
                        'id'   => '_beyond_display_sidebar',
                        'type' => 'checkbox'
                    ]
                ]
            ]
        ];

        return $meta_box_options;
    }

    /**
     * Adds a box to the main column on the Post and Page edit screens.
     */
    static function byd_add_metabox()
    {
        $post_types = ['post', 'page'];
        $options = self::byd_meta_box_options();

        foreach ( $options as $key => $option ) {
            add_meta_box(
                $option[ 'id' ],
                $option[ 'title' ],
                [__CLASS__, 'byd_display_metabox'],
                NULL,
                $option[ 'context' ],
                $option[ 'priority' ],
                [
                    'description' => $option[ 'description' ],
                    'fields'      => $option[ 'fields' ]
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
    static function byd_display_metabox( $post, $meta_box_option )
    {
        $values = get_post_meta( $post->ID );
        //new dBug($values);
        ?>
        <table>
            <?php foreach ( $meta_box_option[ 'args' ][ 'fields' ] as $key => $field ):
                $value = get_post_meta( $post->ID, $field[ 'id' ], TRUE );
                $cond = get_post_meta( $post->ID, $field[ 'id' ], FALSE );
                ?>
                <tr>
                    <td valign="top">
                        <label
                            for="<?php echo $field[ 'id' ]; ?>"><strong><?php echo $field[ 'name' ]; ?></strong></label>

                        <p><em><?php echo $field[ 'desc' ]; ?></em></p>
                    </td>
                    <td valign="top">
                        <?php if ( $field[ 'type' ] == 'checkbox' ): ?>
                            <input type='checkbox'
                                   id='<?php echo $field[ 'id' ] ?>'
                                   name="'_beyond_parallax_background'"
                                   value="1"
                                <?php checked( $value, 0 ); ?>>
                        <?php elseif ( $field[ 'type' ] == 'textarea' ): ?>
                            <textarea
                                id='<?php echo $field[ 'id' ] ?>'
                                name="<?php echo $field[ 'id' ] ?>"
                                ><?php echo esc_attr( $value ); ?></textarea>
                        <?php elseif ( $field[ 'type' ] == 'richtext' ):
                            wp_editor( $value, $field[ 'id' ], [
                                'wpautop'       => TRUE,
                                'textarea_name' => "beyond_meta[" . $field[ 'id' ] . "]",
                                'teeny'         => TRUE,
                                'textarea_rows' => 10
                            ] );
                        elseif ( $field[ 'type' ] == 'select' && is_array( $field[ 'options' ] ) ): ?>
                            <select id="<?php echo $field[ 'id' ]; ?>" name="<?php echo $field[ 'id' ] ?>">
                                <?php foreach ( $field[ 'options' ] as $key => $val ): ?>
                                    <option <?php selected( $field[ 'id' ], $val, 1 ); ?>
                                        value="<?php echo $val; ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif ( $field[ 'type' ] == 'text' ): ?>
                            <input type="text"
                                   id="<?php echo $field[ 'id' ] ?>"
                                   name="<?php echo $field[ 'id' ] ?>"
                                   value="<?php echo $value ?>"/>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php
    }

    static function check($cible,$test){
        if(in_array($test,$cible)){return ' checked="checked" ';}
    }


    static function byd_save_metaboxes( $post_ID )
    {
        foreach ( $_POST as $key => $value ) {
            if ( strstr( $key, '_beyond' ) ) {
                var_dump( $_POST[ $key ] );
                //die();
                $val = sanitize_text_field( $value );
                $def = get_post_meta( $post_ID, $v[ 'id' ], TRUE );
                if ( !empty( $def ) ) {
                    //var_dump($default); die();
                    update_post_meta( $post_ID, $key, $val );
                } else {
                    delete_post_meta( $post_ID );
                    add_post_meta( $post_ID, $key, $val );
                }
            }
        }

    }

}