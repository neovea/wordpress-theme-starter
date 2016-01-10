<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body>
<div id="header">
    <div class="container">
        <div class="row">
            <div class="twelve columns">
                <p class="blogname"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p>
                <?php bloginfo('description'); ?>
                <?php  ?>
            </div>
        </div>
    </div>
</div>
<div class="page-header-bg">
    <?php
    if ( has_post_thumbnail() && (is_page() || is_single()) ) {
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        if ( ! empty( $large_image_url[0] ) ) : ?>
            <div style="background: url(<?php echo $large_image_url[0] ?>) no-repeat center center; -webkit-background-size: cover;background-size: cover; height: <?php echo $large_image_url[2]; ?>px;">
                <?php if (!is_front_page() && (is_page() || is_single())): ?>
                    <div class="container" style="height: 100%;">
                        <h1 style="position:absolute; top: 50%; -webkit-transform: translate(0 -50%);-moz-transform: translate(0 -50%) ;-ms-transform: translate(0 -50%) ;-o-transform: translate(0 -50%) ;transform: translate(0 -50%) ;">
                            <?php the_title(); ?>
                        </h1>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif;
    }
    ?>
</div>
<div id="content">
    <div class="container">
