<?php get_header(); ?>
    <div class="row">
        <div class="twelve columns">
            <?php if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" class="post post-item">
                        <div class="post-title">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php edit_post_link(__('Edit', THEME_TEXTDOMAIN), '<p>', '</p>'); ?>
                <?php endwhile;
            else: ?>
                <h2>Oooopppsss...</h2> <p><?php _e('Sorry but what you\'re looking for is not here...', THEME_TEXTDOMAIN); ?></p>
                <?php include (TEMPLATEPATH . "/searchform.php");
            endif; ?>
        </div>
    </div>
<?php get_footer(); ?>