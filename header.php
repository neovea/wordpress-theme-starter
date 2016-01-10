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
<div id="content">
    <div class="container">
