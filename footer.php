    </div>
</div>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="four columns"><?php dynamic_sidebar('footer_1'); ?></div>
            <div class="four columns"><?php dynamic_sidebar('footer_2'); ?></div>
            <div class="four columns"><?php dynamic_sidebar('footer_3'); ?></div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <div class="credits">
                    <p> Copyright &#169; <?php print(date(Y)); ?> - <?php bloginfo('name'); ?>
                        - <a href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Posts RSS feed', THEME_TEXTDOMAIN); ?></a>
                        - <a href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments RSS feed', THEME_TEXTDOMAIN); ?></a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>