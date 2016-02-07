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
            <div class="three columns">
                <p class="blogname"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p>
                <?php bloginfo('description'); ?>
                <?php  ?>
            </div>
            <div class="nine columns">
                <?php wp_nav_menu(); ?>
            </div>
        </div>
    </div>
</div>
<?php
$parallax_bg = get_post_meta($post->ID, '_beyond_parallax_background', TRUE);

if ( has_post_thumbnail() && (is_page() || is_single()) ) {
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    $style = "background: url(" . $large_image_url[0] . ") no-repeat center 0 fixed;height: " . $large_image_url[2] . "px;";
/*    if ( $parallax_bg == 1 )
        $style .= " ";*/
    if ( ! empty( $large_image_url[0] ) ) : ?>
    <div id="parallax" class="page-header-bg" style="<?php echo $style; ?>">
        <div class="header-bg">
            <?php if ((is_page() || is_single())): ?>
                <div class="container" style="height: 100%;">
                    <h1 style="position:absolute; top: 50%; -webkit-transform: translate(0 -50%);-moz-transform: translate(0 -50%) ;-ms-transform: translate(0 -50%) ;-o-transform: translate(0 -50%) ;transform: translate(0 -50%) ;">
                        <?php the_title(); ?>
                    </h1>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif;
}
?>
<div id="content">
    <div class="container">
