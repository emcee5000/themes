<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }?>
    </title>
        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>        
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700' rel='stylesheet' type='text/css'>
	<meta name="google-site-verification" content="fL9w82eYy9jvOMvnNhiBU-VQDsnPHAhCF2Dczi-nXcs" />
</head>
<body>
<div id="ischoolHeader">
	<div id="ischoolHeaderLinks">
    	<div class="headerBlock">
    		<a href="http://ischool.syr.edu/" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/ischoolHeaderLogo.gif" alt="iSchool Logo" /></a>
    	</div>
        <div class="headerBlock">
	    <div id="shareButtons">
		<a href="http://twitter.com/ischoolsu" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/infospaceHeaderSocialTwitter.gif" atl="Twitter" /></a>
		<a href="http://www.facebook.com/su.ischool" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/infospaceHeaderSocialFacebook.gif" atl="Facebook" /></a>
		<a href="https://plus.google.com/u/0/104899321458342683787/posts" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/infospaceHeaderSocialGplus.gif" atl="Google Plus" /></a>
		<a href="http://www.linkedin.com/groups?home=&gid=74275&trk=anet_ug_hm" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/infospaceHeaderSocialLinkedin.gif" atl="Linkedin" /></a>
		<a href="http://www.youtube.com/user/SyracuseiSchool" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/infospaceHeaderSocialYouTube.gif" atl="YouTube" /></a>
		<a href="http://www.flickr.com/photos/61561181@N06/" target="_blank"><img src="<?php bloginfo('template_directory');?>/images/infospaceHeaderSocialFlickr.gif" atl="Flickr" /></a>
		<a href="<?php bloginfo('rss2_url'); ?> " target="_blank"><img src="<?php bloginfo('template_directory');?>/images/infospaceHeaderSocialRss.gif" atl="Rss" /></a>      
	    </div>
	</div>
	<div class="headerBlockSearch">
	    <?php get_search_form(); ?>
    	</div>
    </div>	
</div>
<div id="wrapper">
    <div id="header">
        <div id="masthead">         
            <div id="branding">
                <div id="logo">
		    <a href="<?php echo get_settings('home'); ?>" title="<?php bloginfo('name'); ?>">
		    <img src="<?php bloginfo('template_directory');?>/images/headerInfospaceV3.jpg" alt="Information Space" /></a>
		</div>
	    </div><!-- #branding -->                                 
        </div><!-- #masthead -->   
        </div><!-- #header -->
	<div class="postDivider"></div>
        