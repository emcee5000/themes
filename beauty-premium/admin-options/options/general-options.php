<?php                

$options['general'] = array (
	 
    /* =================== GENERAL =================== */
    "general" => array(    
        array( "name" => __('General Settings', TEXTDOMAIN),
        	   "type" => "title"),
    
        array( "name" => __("General", TEXTDOMAIN),
        	   "type" => "section"),
        array( "type" => "open"),
        	
        array( "name" => __("Custom Favicon", TEXTDOMAIN),
        	   "desc" => __("A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image", TEXTDOMAIN),
        	   "id" => $shortname."_favicon",
        	   "data" => "array",
        	   "type" => "upload",
        	   "std" => home_url() ."/favicon.ico"),	  
        	
        array( "name" => __("Date Format", TEXTDOMAIN),
        	   "desc" => __("Set the general date format of theme. Read <a href=\"http://codex.wordpress.org/Formatting_Date_and_Time\">Documentation on date formatting</a>", TEXTDOMAIN),
        	   "id" => $shortname."_date_format",
        	   "type" => "text",
        	   "std" => get_option('date_format') ),	  
        	
        array( "name" => __("Custom Style", TEXTDOMAIN),
        	   "desc" => __("You can write here your custom css, that will replace the default css.", TEXTDOMAIN),
        	   "id" => $shortname."_custom_style",
        	   "type" => "textarea",
        	   "std" => ''),	         
        	
        array( "name" => __("Addtionale JS scripts", TEXTDOMAIN),
        	   "desc" => __("Insert here an optional additional scripts, it will insert on footer. We suggest to start script with <strong>jQuery(document).ready(function(){ // here your script });</strong>", TEXTDOMAIN),
        	   "id" => $shortname."_custom_js",
        	   "type" => "textarea",
        	   "std" => "jQuery(document).ready(function($){\n\t// " . __( 'here your script', TEXTDOMAIN ) . "\n});"),  
        	
        array( "type" => "close")
    ),        
    /* =================== END GENERAL =================== */
    
                                                 
    /* =================== HEADER =================== */
    "header" => array(
        array( "name" => __("Header", TEXTDOMAIN),
        	   "type" => "section"),
        array( "type" => "open"),        
        	
        array( "name" => __("Active Logo Image", TEXTDOMAIN),
        	   "desc" => __("Set if you want to replace the 'Title' and 'description' options of header, with a logo image.", TEXTDOMAIN),
        	   "id" => $shortname."_show_logo", 
        	   "type" => "on-off",
        	   "std" => ""),
        	
        array( "name" => __("Logo URL", TEXTDOMAIN),
        	   "desc" => __("Enter the URL to your logo image", TEXTDOMAIN),
        	   "id" => $shortname."_logo",     
        	   "data" => "array",
        	   "type" => "upload",
        	   "std" => ""),
        	
        array( "name" => __("Logo Width", TEXTDOMAIN),
        	   "desc" => __("Enter the width of logo, expressed in pixel. (Leave empty for default)", TEXTDOMAIN),
        	   "id" => $shortname."_logo_width", 
        	   "type" => "text",
        	   "std" => ""),
        	
        array( "name" => __("Logo Height", TEXTDOMAIN),
        	   "desc" => __("Enter the height of logo, expressed in pixel. (Leave empty for default)", TEXTDOMAIN),
        	   "id" => $shortname."_logo_height", 
        	   "type" => "text",
        	   "std" => ""),
        
        array( "type" => "close")
    ),   
    /* =================== END HEADER =================== */
    
                                                 
    /* =================== portfolio =================== */
    "portfolio" => array(
        array( "name" => __("portfolio", TEXTDOMAIN),
        	   "type" => "section"),
        array( "type" => "open"),
        	
        array( "name" => __("portfolio Type", TEXTDOMAIN),
        	   "desc" => __("Say the layout for your portfolio page.", TEXTDOMAIN),
        	   "id" => $shortname."_portfolio_type",
        	   "type" => "select",
        	   "options" => array('3cols' => __('3 Columns', TEXTDOMAIN), 'slider' => __('With Slider', TEXTDOMAIN)),
        	   "std" => '3cols'),   
        	
        array( "name" => __("More text", TEXTDOMAIN),
        	   "desc" => __("Define what show for more link.", TEXTDOMAIN),
        	   "id" => $shortname."_portfolio_more_text",
        	   "type" => "text",
        	   "std" => __( 'read more &raquo;', TEXTDOMAIN ) ),   
        	
        array( "name" => __("Items", TEXTDOMAIN),
        	   "desc" => __("Select how many items you want to show.", TEXTDOMAIN),
        	   "id" => $shortname."_portfolio_items",
        	   "min" => 1,
        	   "max" => 20,
        	   "type" => "slider_control",
        	   "std" => 6),          
        	
        array( "name" => __("Lightbox Skin", TEXTDOMAIN),
        	   "desc" => __("Specific what skin you want for videos and images lightbox.", TEXTDOMAIN),
        	   "id" => $shortname."_portfolio_skin_lightbox",
        	   "type" => "select",
        	   "options" => array(
                    'default' => 'Default', 
                    'facebook' => 'Facebook', 
                    'light_rounded' => 'Light rounded', 
                    'dark_rounded' => 'Dark rounded semi-transparent',
                    'light_square' => 'Light square',
                    'dark_square' => 'Dark square semi-transparent'
                ),
        	   "std" => 'default'),
        
        array( "type" => "close")
    ),   
    /* =================== END portfolio =================== */
    
                                                 
    /* =================== BLOG =================== */
    "blog" => array(
        array( "name" => __("Blog Settings", TEXTDOMAIN),
        	   "type" => "section"),
        array( "type" => "open"),         
        	
        array( "name" => __("Items", TEXTDOMAIN),
        	   "desc" => __("Select how many items you want to show on Blog Page", TEXTDOMAIN),
        	   "id" => "posts_per_page",
        	   "min" => 1,
        	   "max" => 50,
        	   "type" => "slider_control",
        	   "std" => 10),          
        	
        array( "name" => __("Exclude categories", TEXTDOMAIN),
        	   "desc" => __("Select witch categories you want exlude from blog.", TEXTDOMAIN),
        	   "id" => $shortname."_blog_cats_exclude",
        	   "type" => "cat",
        	   "cols" => 2,          // number of columns for multickecks
        	   "heads" => array(__("Blog Page", TEXTDOMAIN), __("List cat. sidebar", TEXTDOMAIN)),  // in case of multi columns, specific the head for each column
        	   "std" => ''),          
        	
        array( "name" => __("Featured Images Alignment", TEXTDOMAIN),
        	   "desc" => __("Specific the featured images alignment", TEXTDOMAIN),
        	   "id" => $shortname."_blog_image_align",
        	   "type" => "select",
        	   "options" => array(
                    'alignleft' => 'Left', 
                    'alignright' => 'Right', 
                    'aligncenter' => 'Center'
                ),
        	   "std" => 'aligncenter'),
        	
        array( "name" => __("Featured Images Size", TEXTDOMAIN),
        	   "desc" => __("Specific the featured images size", TEXTDOMAIN),
        	   "id" => $shortname."_blog_image_size",
        	   "type" => "select",
        	   "options" => array(
                    'post-thumbnail' => 'Standard', 
                    'thumbnail' => 'Thumbnail', 
                    'medium' => 'Medium',
                    'large' => 'Large',
                    'custom' => 'Custom'
                ),
        	   "std" => 'post-thumbnail'),
        	
        array( "name" => __("Featured Images Width", TEXTDOMAIN),
        	   "desc" => __("Specific the featured images width, <strong>if you have selected custom size on option above.</strong>", TEXTDOMAIN),
        	   "id" => $shortname."_blog_image_width",
        	   "type" => "text",
        	   "std" => ''),
        	
        array( "name" => __("Featured Images Height", TEXTDOMAIN),
        	   "desc" => __("Specific the featured images height, <strong>if you have selected custom size on option above.</strong>", TEXTDOMAIN),
        	   "id" => $shortname."_blog_image_height",
        	   "type" => "text",
        	   "std" => ''),
        
        array( "type" => "close")   
    ),
    /* =================== END BLOG =================== */    
    
                                                      
    /* =================== FOOTER =================== */
    "footer" => array(
        array( "name" => __("Footer", TEXTDOMAIN),
        	   "type" => "section"),
        array( "type" => "open"),   
         
        array( "name" => __("Footer Type", TEXTDOMAIN),
        	   "desc" => __("Select the footer type for the theme", TEXTDOMAIN),
        	   "id" => $shortname."_footer_type",
        	   "type" => "select",
        	   "options" => array(
					"normal" => __( "Two Columns Footer", TEXTDOMAIN ), 
					"centered" => __( "Centered Footer", TEXTDOMAIN )
				),
        	   "std" => "normal"),  
        	
        array( "name" => __("Footer centered text", TEXTDOMAIN),
        	   "desc" => __("Enter text used in <strong>centered footer</strong>. It can be HTML.", TEXTDOMAIN),
        	   "id" => $shortname."_footer_text_centered",
        	   "type" => "textarea",
        	   "std" => "" ),
        	
        array( "name" => __("Footer copyright text Left", TEXTDOMAIN),
        	   "desc" => __("Enter text used in the left side of the footer. It can be HTML. <strong>NB: not figured on 'centered footer'</strong>", TEXTDOMAIN),
        	   "id" => $shortname."_copyright_text_left",
        	   "type" => "textarea",
        	   "std" => 'Copyright <a href="%site_url%"><strong>%name_site%</strong></a> 2010' ),
        	
        array( "name" => __("Footer copyright text Right", TEXTDOMAIN),
        	   "desc" => __("Enter text used in the right side of the footer. It can be HTML. <strong>NB: not figured on 'centered footer'</strong>", TEXTDOMAIN),
        	   "id" => $shortname."_copyright_text_right",
        	   "type" => "textarea",
        	   "std" => 'Powered by <a href="http://www.yourinspirationweb.com/en"><strong>Your Inspiration Web</strong></a>'),
        	
        array( "name" => __("Google Analytics Code", TEXTDOMAIN),
        	   "desc" => __("You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.", TEXTDOMAIN),
        	   "id" => $shortname."_ga_code",
        	   "type" => "textarea",
        	   "std" => ""),
         
        array( "type" => "close")   
    ),           
    /* =================== END FOOTER =================== */  
 
);   
?>