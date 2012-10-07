<?php
// define the color folder
define("COLORS_FOLDER", 'colors');

define("ACTIVE_COLOR_PICKER", 0);     

$root = get_template_directory_uri() . '/images/';      

$color_theme = get_color_scheme( DEFAULT_COLOR_SET );                        
    
// default colors set    
$default_color = array(
    'main-color' => '#A10404',
    'color-text' => '#545252',   
    'links' => '#A10404',
    'links-hover' => '#d14007',  
); 
    
$default_images = array(
    'nav-list-item-hover'	=> "$root/red/nav-list-item-hover.png",
    'pagination-slider'		=> "$root/red/pagination-slider.png",     
    'pagination-testimonial'=> "$root/red/pagination-testimonial.png"
);

function yiw_add_custom_css()
{
    wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/css/custom.php' );
}
add_action( 'wp_print_styles', 'yiw_add_custom_css' );

// return the color of the theme
function get_color_scheme( $default = null )
{
    global $shortname;
    
	$color_theme = $default; 
	
	if ( get_option( 'aa_active_colorpicker' ) ) {
        if ( isset( $_POST['color_switch'] ) )
            $style = $_POST['color_switch'];    
	    elseif ( isset( $_GET['style'] ) )        
            $style = $_GET['style'];
        else
            $style = false;
           
        if ( $style != false )
        {
            setcookie( $shortname . '_color_theme', $style, time()-3600 );
            if ( in_array( $style, get_list_colors() ) )
            {
                setcookie( $shortname . '_color_theme', $style, time() + 3600, '/' );
                $color_theme = $style;           
            }
        }
        elseif ( isset( $_COOKIE[$shortname . '_color_theme'] ) )
            $color_theme = $_COOKIE[$shortname . '_color_theme']; 
	}
	
    if ( get_option($shortname . '_color_theme') != '' AND $color_theme == $default ) 
	    $color_theme = get_option($shortname . '_color_theme');   
	
	return $color_theme;    	
}

// add additional style for color, if it exists
function add_style_color()
{
	global $color_theme;
	
	if ( substr( 'abcdef', 0, 1 ) == '#' )
		return;
	
	$path = dirname(__FILE__) .'/../';
    
    $path_css = "/css/colors/$color_theme.css";
    
    if( file_exists( $path . $path_css ) )
	    wp_enqueue_style( "color-$color_theme", get_template_directory_uri() . $path_css );
}
add_action( 'wp_head', 'add_style_color' );

/**
 * In questa funzione cosa viene fatto?
 * - viene richiamato il colore globale che viene scelto;
 * - viene inserito un array con delle path di default per ogni immagine che potrà essere modificata, in base al colore, specificandone soltanto la cartella in cui si troverà di default
 * - viene passato in parametro il nome dell'immagine che si intende controllare.
 * 
 * E cosa fa?
 * - controlla se il nome dell'immagine passato in parametro (compreso di estensione) esista nella cartella dedicata al colore
 * - Se esiste, allora ritornerà il path assoluto di quell'immagine, prelevata dalla cartella colore
 * - Altrimenti, se non esiste alcune immagine nella cartella del colore, farà riferimento all'array $default per prendere la directory di default, da cui prendere l'immagine.
 * 
 *  
 **/        
function get_image($img, $echo = TRUE)
{
    global $color_theme, $default_images;
    
    $root = get_template_directory_uri() . '/images';
    $root_dir = dirname(__FILE__) . '/../images';
    $exts = explode(';', '.gif;.png;.jpg');
    
    $path = "$root_dir/".COLORS_FOLDER."/$color_theme/$img";
    
    $path_ext = FALSE;
    foreach($exts as $ext)
    {
        if( file_exists($path.$ext) ) 
        {
            $path_ext = $ext;
            break;
        }
    }
          
    if(!$path_ext)
    {
        $url = $default_images[$img];
    }            
    else
    {
        $url = "$root/".COLORS_FOLDER."/$color_theme/$img{$path_ext}";
    } 
    
    if( $img == 'logo' AND $logo = get_option($shortname . '_logo') AND $logo != '' ) 
	{
		$the_ = unserialize( $logo );       
		if( $the_['url'] != '' ) $url = $the_['url'];
	}           
        
    if($echo) echo 'background-image:url(\'' . $url . '\');';
    return $url;
}     

function get_color($name, $echo = TRUE, $default = FALSE)
{
    global $default_color, $color_theme;
    
    $codes_color = get_colors();
    
    $color = '';
    if( get_option($shortname . '_color_' . $name . '_' . $color_theme) != '' )
        $color = get_option($shortname . '_color_' . $name . '_' . $color_theme);          
    elseif( ! empty( $codes_color ) AND array_key_exists( $name, $codes_color ) )
		$color = $codes_color[$name];
    else
		$default = TRUE;  
    
    if( $default )
    	$color = $default_color[$name];
    
    if($echo) echo $color;
    return $color;
}

function css_color( $name, $prop, $important = '' )
{                          
    if( substr( $name, 0, 1) == '#' )
        $color = $name;
    else
        $color = get_color( $name, false );
    
    if( $important === true )
        $important = '!important';
        
	//echo $prop, ':', $color, ';';
	echo "$prop:$color$important;";
}

// get colors from a file text of color theme
function get_colors()
{                            
    global $color_theme;   
    
    $root = get_template_directory_uri() . '/images';
    $root_dir = dirname(__FILE__) . '/../images';
    
    $color_set_file = "$root_dir/".COLORS_FOLDER."/$color_theme/{$color_theme}.txt";
    
    //echo 'URL: '.$color_set_file;
    
    $colors = array();
    if( file_exists($color_set_file) ) $colors = file($color_set_file);
    
    $codes = array();
    foreach($colors as $color_code)
    {
        $color_code = trim($color_code);
        
        // exclude the comments, with // str
        $str = explode("//", $color_code);
        
        // divide tag_name from code color
        list($tag, $code) = explode(":", $str[0]);
        
        $codes[$tag] = $code;
    }
    
    return $codes;
}

function get_list_colors()
{
    $folder = dirname(__FILE__) . '/../images/' . COLORS_FOLDER;
	
    $files = array();        
    
    if ( file_exists($folder) && $handle = opendir($folder) ) 
    {                                
       while (false !== ($file = readdir($handle))) 
       { 
            if ( $file == ".." || $file == "." || preg_match('/([.])/', $file) ) {
                continue;
            }

           $files[$file] = $file;
       }
    
       closedir($handle); 
    } 
    
    return $files;
}
     
// scale: 0 = black, 765 = white     
// $hex_color = color to change
// $hex_pattern = base color
// $default = default color
function compareColor ( $hex_color, $hex_pattern, $default )
{                                            
    if ( $hex_color == $hex_pattern )
        return $hex_color;
    
    $hex_color = str_replace( '#', '', $hex_color ); 
    $hex_pattern = str_replace( '#', '', $hex_pattern );
    $default = str_replace( '#', '', $default );
    
    $dec1 = hexdec( $hex_color );
    $dec2 = hexdec( $hex_pattern );
    $dec_default = hexdec( $default );   

    $diff = $dec1 - $dec_default;  
    
//     echo "
// hex_color: $hex_color;
// hex_pattern: $hex_pattern;
// default: $default;
// 
// dec_color: $dec1;
// dec_pattern: $dec2;
// dec_default: $dec_default;\n\n";
//     
//     echo "diff: $diff;\n\n";
    
    $new_dec = $dec2 + $diff;

    return '#'  . str_pad( dechex( $new_dec ), 2, '0', 0 );
}


/* COLOR PICKER */

add_option( 'aa_active_colorpicker', ACTIVE_COLOR_PICKER );

if( get_option( 'aa_active_colorpicker' ) )
{
    if ( !is_admin() )
	   add_action( 'init', 'yiw_render_header_colorpicker' );
	add_action( 'wp_footer', 'yiw_render_colorpicker' );
}

function yiw_render_header_colorpicker()
{
	wp_enqueue_style( 'color-picker', get_template_directory_uri() . '/css/colorpicker.css' );                          
    wp_enqueue_style( "colorpicker-jquery", get_template_directory_uri() . '/colorpicker/css/colorpicker.css' );      
    wp_enqueue_style( "colorpicker-layout", get_template_directory_uri() . '/colorpicker/css/layout.css' ); 
                                                                                                                                                                                                           
    wp_enqueue_script( "color-picker", get_template_directory_uri() . '/colorpicker/js/colorpicker.js' );                                                                    
    wp_enqueue_script( "color-picker-eye", get_template_directory_uri() . '/colorpicker/js/eye.js' );                                                                    
    wp_enqueue_script( "color-picker-layout", get_template_directory_uri() . '/colorpicker/js/layout.js' );                                                                    
    wp_enqueue_script( "color-picker-utils", get_template_directory_uri() . '/colorpicker/js/utils.js' );      
}

function get_url_color( $col )
{                                                              
	$qs = array();
	
	foreach( $_GET as $key => $value )
		if( $key != 'style' ) 
			$qs[] = "$key=$value";
	
	$qs[] = "style=$col";		
	
	return "?" . implode( '&amp;', $qs );
}

function yiw_render_colorpicker()
{
    global $color_theme;
	?>
	<!-- START COLOR LIVE PICKER -->
    <div id="color-picker">
        
        <div class="label"></div>
        
        <h5>Select color</h5>
        
        <div id="colorSelector">
            <div style="background-color: <?php echo $color_theme ?>"></div>              
        </div>             
        
        <form method="post">
            <input type="submit" value="Change" style="position:absolute;left:50px;top:55px;padding:5px;border:0;background:#ccc;cursor:pointer;" />
            <input type="hidden" id="color_switch_value" name="color_switch" value="<?php echo $color_theme ?>" />
        </form>         
                                        
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($){
                              
            $('#color-picker').show(); 
            $('#color-picker .label').click( function() {
        		if($('#color-picker').css('left') != '-1px')
        		{
     				$('#color-picker').animate({"left": "-1px"}, { duration: 300 });
    	 		}
    	 		else
    	 		{
    	 			$('#color-picker').animate({"left": "-120px"}, { duration: 300 });
    	 		}
        	});              
            
            $('#colorSelector').ColorPicker({
            	color: '<?php echo $color_theme ?>',
            	onShow: function (colpkr) {
            		$(colpkr).fadeIn(300);
            		return false;
            	},
            	onHide: function (colpkr) {
            		$(colpkr).fadeOut(300);
            		return false;
            	},
            	onSubmit: function (hsb, hex, rgb) {    
            	   alert('#' + hex);
            		$('#color_switch_value').val('#' + hex);
            	}      
            });

        });
    </script>
    <!-- END COLOR LIVE PICKER -->
	<?php
}
?>
