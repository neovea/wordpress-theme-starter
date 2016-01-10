<ul>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
    <li id="search">
        <?php include(TEMPLATEPATH . '/searchform.php'); ?>
    </li>
    <li>
        <h2><?php _e('Subscribe RSS', THEME_TEXTDOMAIN); ?></h2>
        <ul>
            <li><a href="<?php bloginfo('rss2_url'); ?>" title="Flux RSS des articles">Flux RSS des articles</a></li>
            <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="Flux RSS des commentaires">Flux RSS des commentaires</a></li>
        </ul>
    </li>
    <li id="calendar">
        <h2><?php _e('Calendar', THEME_TEXTDOMAIN); ?></h2>
        <?php get_calendar(); ?>
    </li>
    <li>
        <h2><?php _e('Categories', THEME_TEXTDOMAIN); ?></h2>
        <ul>
            <?php
            $args = array(
                'show_option_all' => '',
                'orderby' => 'name',
                'order' => 'ASC',
                'style' => 'list',
                'show_count' => 0,
                'hide_empty' => 1,
                'use_desc_for_title' => 1,
                'child_of' => 0,
                'feed' => '',
                'feed_type' => '',
                'feed_image' => '',
                'exclude' => '',
                'exclude_tree' => '',
                'include' => '',
                'hierarchical' => 1,
                'title_li' => 0,
                'show_option_none' => __('No category available', THEME_TEXTDOMAIN),
                'number' => null,
                'echo' => 1,
                'depth' => 0,
                'current_category' => 0,
                'pad_counts' => 0,
                'taxonomy' => 'category',
                'walker' => null
            );
            wp_list_categories($args);
            ?>
        </ul>
    </li>
    <li>
        <h2><?php _e('Archives', THEME_TEXTDOMAIN); ?></h2>
        <ul>
            <?php
            $args = array(
                'type' => 'monthly',
                'limit' => '',
                'format' => 'html',
                'before' => '',
                'after' => '',
                'show_post_count' => false,
                'echo' => 1,
                'order' => 'DESC',
                'post_type' => 'post'
            );
            wp_get_archives($args);
            ?>
        </ul>
    </li>
    <?php endif; ?>
</ul>

