<?php get_header(); ?>
    <div class="row">
        <div class="nine columns">
            <?php if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" class="post post-item">
                        <div class="post-title">
                            <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                        </div>
                        <div class="post-meta">
                            <p>
                                <span class="post-data"><?php _e('Posted on', THEME_TEXTDOMAIN); ?> <?php the_time('j F Y') ?></span>
                                <span class="post-author"><?php _e('by', THEME_TEXTDOMAIN); ?> <?php the_author() ?></span> |
                                <span class="post-categories"><?php _e('Categories', THEME_TEXTDOMAIN); ?> <?php the_category(', ') ?></span> |
                                <span class="post-edit-link"><?php edit_post_link(__('Edit', THEME_TEXTDOMAIN), ' &#124; ', ''); ?></span>
                            </p>
                        </div>
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php edit_post_link(__('Edit', THEME_TEXTDOMAIN), '<p>', '</p>'); ?>
                    <div class="comments-template">
                        <?php comments_template(); ?>
                    </div>
                <?php endwhile; ?>
            <?php previous_post_link() ?> <?php next_post_link() ?>
            <?php else: ?>
                <h2>Oooopppsss...</h2> <p><?php _e('Sorry but what you\'re looking for is not here...', THEME_TEXTDOMAIN); ?></p>
                <?php include (TEMPLATEPATH . "/searchform.php");
            endif; ?>
        </div>
        <div class="three columns">
            <div class="sidebar">
                <?php if ( is_active_sidebar('blog') ) dynamic_sidebar('blog'); else get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>