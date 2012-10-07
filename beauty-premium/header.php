<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'yiw' ), max( $paged, $page ) );

	?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <!--[if IE]> 
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" type="text/css" media="screen, projection" /> 
    <![endif]-->
    <!--[if IE 7]>                
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" type="text/css" media="screen" />
    <![endif]-->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <?php
		global $color_theme, $actual_font, $shortname; 
		          
        // styles
        wp_enqueue_style ( 'prettyPhoto',    get_template_directory_uri()."/css/prettyPhoto.css" );    
        wp_enqueue_style ( 'tipsy',    		 get_template_directory_uri()."/css/tipsy.css" );   
        
        $if_logo = get_option( $shortname . '_show_logo' );
                                                                                
	    if( !$if_logo or $actual_font != 'default' )
        {                      
	        wp_enqueue_script('cufon', get_template_directory_uri()."/js/cufon-yui.js");  
		}   
	    
        if( !$if_logo )
        {                      
	        wp_enqueue_script('cufon-halo', get_template_directory_uri()."/js/halo.cufon.js");    
		}            
        
        if( $actual_font != 'default' )
        {                      
	        wp_enqueue_script('cufon-' . $actual_font, get_template_directory_uri()."/fonts/{$actual_font}.font.js");  
	        wp_enqueue_script('cufon-' . $actual_font . '-replace', get_template_directory_uri()."/js/cufon-replaces.php");  
		}          
                                             
		// scripts                            
    	wp_enqueue_script( 'jquery-cycle',       get_template_directory_uri()."/js/jquery.cycle.min.js", array('jquery'), "2.88");
        wp_enqueue_script( 'jquery-easing',      get_template_directory_uri()."/js/jquery.easing.1.3.js", array('jquery'), "1.3");
        wp_enqueue_script( 'jquery-prettyPhoto', get_template_directory_uri()."/js/jquery.prettyPhoto.js", array('jquery'), "3.0");
        wp_enqueue_script( 'jquery-tipsy',       get_template_directory_uri()."/js/jquery.tipsy.js", array('jquery'));  
        wp_enqueue_script( 'jquery-tweetable',   get_template_directory_uri()."/js/jquery.tweetable.js", array('jquery'));            
    	wp_enqueue_script( 'jquery-carousel',    get_template_directory_uri()."/js/jquery.jcarousel.min.js", array('jquery') );      
    	wp_enqueue_script( 'jquery-nivo', 		 get_template_directory_uri()."/js/jquery.nivo.slider.pack.js", array('jquery') ); 
         
        wp_enqueue_script( 'jquery-custom',      get_template_directory_uri()."/js/jquery.custom.js", array('jquery', 'jquery-ui-tabs'), '1.0', true);  
		                   
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );    
		
		wp_enqueue_style( 'jquery-jCarousel', get_template_directory_uri() . '/css/jCarousel.css' );                                                     
    ?>         

    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php get_favicon(); ?>" />
    <link rel="icon" type="image/x-icon" href="<?php get_favicon(); ?>" />
    <!-- [favicon] end -->   
    
    <?php wp_head() ?>
</head>

<body <?php body_class( "no_js font_$actual_font" ) ?>>              
        
    <!-- START WRAPSHADOW -->
    <div id="wrapShadow">       
                             
		<!-- START WRAPPER -->
		<div id="wrapper">          
		    
		    <!-- START HEADER -->
		    <div id="header">            
		        
		        <!-- START LOGO -->
		        <div id="logo">
		            
		            <a href="<?php echo home_url() ?>" title="<?php bloginfo('name') ?>"> 
		                
		                <?php if( $if_logo ) : ?>
		                <img src="<?php get_logo() ?>" alt="Logo <?php bloginfo('name') ?>" />
		                <?php else : ?>
		                <span class="name"><?php bloginfo('name') ?></span>
		                <span class="description"><?php bloginfo('description') ?></span>
		                <?php endif ?>
		            
		            </a>              
		        
		        </div>
		        <!-- END LOGO -->  
		    
		        <!-- START NAV -->
		        <div id="nav" class="group">
		            <?php  
						$options = array(
		                    'theme_location' => 'nav',
		                    'container' => 'none',
		                    'menu_class' => 'level-1',
		                    'depth' => 3,   
		                    //'fallback_fb' => false,
		                    //'walker' => new description_walker()
		                );
		                
		                wp_nav_menu( $options ); 
		            ?>    
		        </div>
		        <!-- END NAV -->     
		    
		    </div>   
		    <!-- END HEADER -->
		    
		    <!-- START SLOGAN -->
		    <?php get_template_part( 'title', 'slogan' ) ?>
		    <!-- END SLOGAN -->