<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="Stylesheet" href="<?php bloginfo('template_directory'); ?>/fonts/stylesheet.css" type="text/css" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body>
<div id="container">
<div id="header">
<p class="left"><a href="http://ischool.syr.edu"><img src="<?php bloginfo('template_directory') ?>/images/ischoolLogo.png"/></a><a href="http://facultycenter.ischool.syr.edu"><img src="<?php bloginfo('template_directory') ?>/images/facultyCenterLogo.png"/></a></p>
<div id="search">
<?php get_search_form(); ?>
</div><!--/search-->
</div><!--/header-->
<div id="nav">
<ul>
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
</div><!--/nav-->
<?php
global $wp_query;
if( empty($wp_query->post->post_parent) ) {
$parent = $wp_query->post->ID;
} else {
$parent = $wp_query->post->post_parent;
} ?>
