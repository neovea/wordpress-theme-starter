<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Ne pas t&eacute;l&eacute;charger cette page directement, merci !');
if (!empty($post->post_password)): ?> <!-- if there's a password -->
    <?php if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password): ?>  <!-- and it doesn't match the cookie -->

        <h2><?php _e('Prot&eacute;g&eacute; par mot de passe'); ?></h2>
        <p><?php _e('Entrer le mot de passe pour voir les commentaires'); ?></p>

        <?php return;
    endif;
endif;
/* This variable is for alternating comment background */
$oddcomment = 'alt'; ?>

    <!-- You can start editing here. -->

    <div id="comments" class="comments">
        <?php if ($comments) : ?>
            <h3><?php comments_number(__('No comments', THEME_TEXTDOMAIN), __('One comment', THEME_TEXTDOMAIN), __('% comments', THEME_TEXTDOMAIN) );?> <?php _e('for', THEME_TEXTDOMAIN); ?> &#8220;<?php the_title(); ?>&#8221;</h3>

            <ol class="comments-list">
                <?php foreach ($comments as $comment) : ?>
                    <li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
                        <div class="commentmetadata">
                            <strong><?php comment_author_link() ?></strong>, <?php _e('On', THEME_TEXTDOMAIN); ?> <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('j F, Y') ?> <?php _e('at', THEME_TEXTDOMAIN);?> <?php comment_time() ?></a> <?php _e('Wrote', THEME_TEXTDOMAIN); ?> <?php edit_comment_link(__('Edit Comment', THEME_TEXTDOMAIN),'',''); ?>
                            <?php if ($comment->comment_approved == '0') : ?>
                                <em><?php _e('Your comment is under moderation', THEME_TEXTDOMAIN); ?></em>
                            <?php endif; ?>
                        </div>
                        <?php comment_text() ?>
                    </li>

                    <?php /* Changes every other comment to a different class */
                    if ('alt' == $oddcomment) $oddcomment = '';
                    else $oddcomment = 'alt';
                    ?>

                <?php endforeach; /* end for each comment */ ?>
            </ol>

        <?php else : // this is displayed if there are no comments so far ?>

            <?php if ('open' == $post->comment_status) : ?>
                <!-- If comments are open, but there are no comments. -->
            <?php else : // comments are closed ?>

                <!-- If comments are closed. -->
                <p class="nocomments"><?php _e('Comments are closed', THEME_TEXTDOMAIN); ?></p>

            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php if ('open' == $post->comment_status) : ?>

    <h3 id="respond"><?php _e('Leave a comment', THEME_TEXTDOMAIN); ?></h3>

    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('Loggin to post comments', THEME_TEXTDOMAIN); ?></p>

    <?php else : ?>

        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
            <?php if ( $user_ID ) : ?>

                <p><?php _e('Logged in as', THEME_TEXTDOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Logout', THEME_TEXTDOMAIN); ?>"><?php _e('Logout', THEME_TEXTDOMAIN); ?></a></p>

            <?php else : ?>

                <p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="40" tabindex="1" />
                    <label for="author"><small><?php _e('Name', THEME_TEXTDOMAIN); ?> <?php if ($req) _e('Required', THEME_TEXTDOMAIN); ?></small></label></p>

                <p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="40" tabindex="2" />
                    <label for="email"><small><?php _e('Email (won\'t be published', THEME_TEXTDOMAIN); ?> <?php if ($req) _e('Required', THEME_TEXTDOMAIN); ?></small></label></p>

                <p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="40" tabindex="3" />
                    <label for="url"><small><?php _e('Website', THEME_TEXTDOMAIN); ?></small></label></p>

            <?php endif; ?>

            <!--<p><small><strong>XHTML:</strong> <?php _e('Vous pouvez utiliser ces tags&#58;'); ?> <?php echo allowed_tags(); ?></small></p>-->

            <p><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea></p>

            <p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Send', THEME_TEXTDOMAIN); ?>" />
                <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
            </p>

            <?php do_action('comment_form', $post->ID); ?>

        </form>

    <?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>