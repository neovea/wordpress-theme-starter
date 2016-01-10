<?php get_header(); ?>
    <div class="row">
        <div class="nine columns">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" class="post post-item">
                    <div class="post-title">
                        <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                    </div>
                    <div class="post-meta">
                        <p>
                            <span class="post-data"><?php _e('Posted on', THEME_TEXTDOMAIN); ?> <?php the_time('j F Y') ?></span>
                            <span class="post-author"><?php _e('by', THEME_TEXTDOMAIN); ?> <?php the_author() ?></span> |
                            <span class="post-categories"><?php _e('Categories', THEME_TEXTDOMAIN); ?> <?php the_category(', ') ?></span> |
                            <span class="post-comments-link"><?php comments_popup_link(__('Pas de commentaires', THEME_TEXTDOMAIN), __('1 Commentaire', THEME_TEXTDOMAIN), __('% Commentaires', THEME_TEXTDOMAIN)); ?></span>
                            <span class="post-edit-link"><?php edit_post_link(__('Edit', THEME_TEXTDOMAIN), ' &#124; ', ''); ?></span>
                        </p>
                    </div>
                    <div class="post-content post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
        <div class="three columns">
            <div class="sidebar">
                <?php dynamic_sidebar('blog'); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>