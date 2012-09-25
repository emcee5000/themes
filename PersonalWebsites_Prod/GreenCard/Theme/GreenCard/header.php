<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?></title>
        
        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
        
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        
        <?php wp_head(); ?>
        
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />       
</head>

<body <?php body_class(); ?>>
<div id="wildHeader">
	<div id="wildHeaderLinks">
    	<div class="headerBlock">
    		<div id="checkUsOut">
			<span><a href="<?php echo get_settings('home'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/iconHome.png" alt="Home" /></a></span>
    			<span style="padding-right:5px;">
    				<img src="<?php bloginfo('template_directory'); ?>/images/topBannerCheckOut.png" alt="Check Us Out" />
    			</span>
			<a href="http://www.facebook.com/pages/KickPoint-Studios/251102718241700" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/topBannerFacebook.png" alt="Facebook" /></a>
    			<a href="http://twitter.com/#!/kickpointstudio" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/topBannerTwitter.png" alt="Twitter" /></a>
    		</div>
    	</div>
        <div class="headerBlock">
 
  </div>
        <div class="headerBlockSearch"><?php get_search_form(); ?></div>
        </div>
        <div style="clear:both;"></div>
     </div>
    </div>
</span>
</div>
<div id="main">
<div id="wrapper" class="hfeed">
        