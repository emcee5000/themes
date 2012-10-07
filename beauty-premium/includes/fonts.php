<?php                  

// sizes for fonts
$sizes_fonts = array (
	
	'default' => array (         
			'p'				=> 12,
			'h1' 			=> 31,  
			'h2' 			=> 26,  
			'h3' 			=> 22,  
			'h4' 			=> 18,  
			'h5' 			=> 14,  
			'h6' 			=> 11,
			'nav'			=> 12, 
			'slogan'		=> 19, 
			'project-widget'=> 16 
	)
);

function get_list_fonts()
{
    $folder = get_template_directory_uri() . '/fonts/';
	
	$folder = dirname(__FILE__) . '/../fonts/';
	
    $files = array();
	$files['default'] = 'No font';        
    
    if ( file_exists($folder) && $handle = opendir($folder) ) 
    {                                
       while (false !== ($file = readdir($handle))) 
       { 
	        if ( $file == ".." || $file == "." || $file[0] == '.' ) {
	            continue;
	        }
	        
	        $file = preg_replace( '/(.*).font.(.*)/', '$1', $file );

           $files[$file] = ucfirst( str_replace( '_', ' ', $file ) );
       }
    
       closedir($handle); 
    } 
    
    return $files;
}        

function get_fontsize( $font, $element )
{
	global $sizes_fonts;
	
	if( isset( $sizes_fonts[$font][$element] ) )
		$size = $sizes_fonts[$font][$element];
	else
		$size = $sizes_fonts['default'][$element];
	
	return $size;
}

function get_option_fontsize( $el )
{
	global $actual_font, $shortname;
	
	$if_font = get_option( "{$shortname}_{$el}_size_{$actual_font}", get_fontsize( $actual_font, $el ) );
	
	if( !$if_font )
		return '';
	
	return $if_font;
}
?>
