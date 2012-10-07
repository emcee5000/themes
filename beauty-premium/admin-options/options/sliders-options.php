<?php    
                         
$slider = get_option( $shortname . '_slider_choosen', 'none' );
	
$sliders = $GLOBALS['sliders_type'];
$sliders['none'] = '';                 

$options['sliders'] = array (         
    
    /* =================== ARROW FADE SLIDER =================== */
    "title" => array(    
        array( "name" => __('Sliders Manager', TEXTDOMAIN),
        	   "type" => "title"),
    ),        
	        
    "config" => array(    
        array( "name" => __("Select slider to show or configure", TEXTDOMAIN),
        	   "type" => "section",
			   "effect" => 0),
        array( "type" => "open"),         
        
        array( "name" => __("Default Header image type", TEXTDOMAIN),
        	   "desc" => __("Select the default header type for homepage pages.", TEXTDOMAIN) . ' <br />NB: ' . sprintf( __("for 'Fixed Image', you can configure it on %s -> %s.", TEXTDOMAIN ), __( 'Appearance' ), __( 'Header' ) ),
        	   "id" => $shortname."_slider_type",
        	   "type" => "radio",
        	   "options" => $GLOBALS['sliders_type'],
        	   "std" => __("fixed-image", TEXTDOMAIN)),             
         
        array( "name" => __("Configure slider.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_choosen",       
        	   "desc" => __("Choose a slider and save, to configure below your slider choosen.", TEXTDOMAIN),
        	   "type" => "select",
			   "options" => $sliders,
        	   "button" => __( "Configure", TEXTDOMAIN ),
			   "std" => 'none' ),	  
        	
        array( "type" => "close")
    ),
    
    "settings" => array(    
        array( "name" => __("Slider Settings", TEXTDOMAIN),
        	   "type" => "section"),
        array( "type" => "open"),  
         
        array( "name" => __("Effect", TEXTDOMAIN),
        	   "desc" => __("Select the effect you want for slides transiction.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_{$slider}_effect",
        	   "type" => "select",
        	   "options" => $GLOBALS['fxs'],
			   "std" => 'fade'),	
         
        array( "name" => __("Easing", TEXTDOMAIN),
        	   "desc" => __("Select the easing for effect transition.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_{$slider}_easing",
        	   "type" => "select",
        	   "options" => $GLOBALS['easings'],
			   "std" => FALSE ),	
        	
        array( "name" => __("Speed (s)", TEXTDOMAIN),
        	   "desc" => __("Select the speed of transiction between slides, expressed in seconds.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_{$slider}_speed",
        	   "min" => 0,
        	   "max" => 5,
        	   "step" => 0.1,
        	   "type" => "slider_control",
        	   "std" => 0.5),  
        	
        array( "name" => __("Timeout (s)", TEXTDOMAIN),
        	   "desc" => __("Select the delay between slides, expressed in seconds.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_{$slider}_timeout",
        	   "min" => 0,
        	   "max" => 20,
        	   "step" => 0.5,
        	   "type" => "slider_control",
        	   "std" => 5),     
         
        array( "name" => __("More text", TEXTDOMAIN),
        	   "desc" => __("Write what you want to show on more link, if you have selected 'YES' on option above.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_{$slider}_more_text",
        	   "type" => "text",
			   "std" => __( 'Read more...', TEXTDOMAIN ) ),
        	
        array( "type" => "close")
    ),
	        
    "slides" => array(    
        array( "name" => __("Slides", TEXTDOMAIN),
        	   "type" => "section",
        	   "valueButton" => __("Add/Edit Slide", TEXTDOMAIN),
			   "effect" => 0),
        array( "type" => "open"),  
         
        array( "id" => $shortname."_slider_{$slider}_slides",
        	   "data" => "array",
        	   "type" => "slides-table",
			   "config" => ( $slider == 'content' ) ? "title, image, caption, link" : "title, image, link",
			   "max-height" => ( $slider == 'content' ) ? 180 : 110 ),	
        	
        array( "type" => "close")
    )        
    /* =================== END ARROW FADE SLIDER =================== */
 
);          

if ( $slider == '' OR $slider == 'none' OR $slider == 'fixed-image' )
	unset( $options['sliders']['settings'], $options['sliders']['slides'] );     

if ( $slider == 'fullimages' ) {
	$options['sliders']['settings'] = array(
        array( "name" => __("Slider Settings", TEXTDOMAIN),
        	   "type" => "section"),
        array( "type" => "open"),  
         
        array( "name" => __("Effect", TEXTDOMAIN),
        	   "desc" => __("Select the effect you want for slides transiction.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_{$slider}_effect",
        	   "type" => "select",
        	   "options" => $GLOBALS['nivo_fxs'],
			   "std" => 'zipper'),	
        	
        array( "name" => __("Speed (s)", TEXTDOMAIN),
        	   "desc" => __("Select the speed of transiction between slides, expressed in seconds.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_{$slider}_speed",
        	   "min" => 0,
        	   "max" => 5,
        	   "step" => 0.1,
        	   "type" => "slider_control",
        	   "std" => 0.5),  
        	
        array( "name" => __("Timeout (s)", TEXTDOMAIN),
        	   "desc" => __("Select the delay between slides, expressed in seconds.", TEXTDOMAIN),
        	   "id" => $shortname."_slider_{$slider}_timeout",
        	   "min" => 0,
        	   "max" => 20,
        	   "step" => 0.5,
        	   "type" => "slider_control",
        	   "std" => 5),     
        	
        array( "type" => "close")
	);
}   
?>