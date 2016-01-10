<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
    <div>
        <input class="u-full-width" type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Search' ,THEME_TEXTDOMAIN); ?>" />
        <input class="button-primary" type="submit" id="searchsubmit" value="<?php _e('Search', THEME_TEXTDOMAIN); ?>" />
    </div>
</form>