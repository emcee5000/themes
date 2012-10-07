<?php                       

$prefix = 'color';  

$options['colors'] = array (         
	    
    /* =================== COLORS =================== */
    "title" => array(    
        array( "name" => __('Colors Settings', TEXTDOMAIN),
        	   "type" => "title"),   
    ),
                                                    
    "scheme" => array( 
        array( "name" => __("Color Scheme", TEXTDOMAIN),
        	   "type" => "section",
			   "effect" => 0),
        array( "type" => "open"),  
         
        array( "name" => __("Colour Choose", TEXTDOMAIN),
        	   "desc" => __("Select the colour you want, of all common elements.", TEXTDOMAIN),
        	   "id" => $shortname."_{$prefix}_theme",
        	   "type" => "color-picker",
        	   "std" => "#A10404"),
        
        array( "type" => "close") 
    ),
                                                    
    "extra-config" => array( 
        array( "name" => __("Various", TEXTDOMAIN),
        	   "type" => "section",
			   "effect" => 0),
        array( "type" => "open"),  
         
        array( "name" => __("Text color", TEXTDOMAIN),
        	   "desc" => __("Select the color of general text.", TEXTDOMAIN) . '<br />' . __("Leave empty to retrive the default value.", TEXTDOMAIN),
        	   "id" => $shortname."_{$prefix}_text",
        	   "type" => "color-picker",
        	   "std" => $default_color['color-text'] ),
         
        array( "name" => __("Links color", TEXTDOMAIN),
        	   "desc" => __("Select the color of all links.", TEXTDOMAIN) . '<br />' . __("Leave empty to retrive the default value.", TEXTDOMAIN),
        	   "id" => $shortname."_{$prefix}_links",
        	   "type" => "color-picker",
        	   "std" => get_option( $shortname."_{$prefix}_theme", $default_color['links'] ) ),
         
        array( "name" => __("Links hover color", TEXTDOMAIN),
        	   "desc" => __("Select the color of all links, on hover.", TEXTDOMAIN) . '<br />' . __("Leave empty to retrive the default value.", TEXTDOMAIN),
        	   "id" => $shortname."_{$prefix}_links_hover",
        	   "type" => "color-picker",
        	   "std" => compareColor( get_option( $shortname."_{$prefix}_theme", $default_color['links-hover'] ), $default_color['links-hover'], $default_color['main-color'] ) ),
        
        array( "type" => "close") 
    )
 
);  

?>