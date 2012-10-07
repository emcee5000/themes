<?php
/**
 * @package WordPress
 * @subpackage Kassyopea
 */                                                                               

// define the text domain location for the theme
define( 'TEXTDOMAIN', 'yiw' );
define( 'ENABLE_IMPORT', 1 );
define( 'DEFAULT_COLOR_SET', '#A10404' );  
define( 'DEFAULT_FONT', 'champagne' );      

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain(TEXTDOMAIN, TEMPLATEPATH . '/languages');   

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 558;      

function warning_version_wp() {
	global $theme_update_notice, $pagenow;
	//if ( $pagenow == "themes.php") {
?>
		<div id="message" class="error fade">
		<?php _e( 'The theme you are using requires WordPress version 3.0 or higher. So, many features of it will not perform correctly.', TEXTDOMAIN ) ?>
		</div>
<?php
	//}
}               

$shortname = "bc";          

if( version_compare($wp_version, "3.0", "<") )
	add_action('admin_notices', 'warning_version_wp');	    

$color_theme = (get_option('theme_color') != '') ? get_option('theme_color') : "red";   
if(isset($_COOKIE['color_theme_bc'])) $color_theme = strtolower($_COOKIE['color_theme_bc']);           

$actual_font = get_option( $shortname . '_font', DEFAULT_FONT );                                          

// default theme setup
function beauty_setup() {
    global $wp_version;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( 'css/editor-style.css' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );  

	// This theme uses the menues
	add_theme_support( 'menus' );          

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Post Format support.                      
	//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );  
	
	if ( ! defined( 'BACKGROUND_IMAGE' ) )
		define( 'BACKGROUND_IMAGE', '%s/images/bg.jpg' );
	
	if ( ! defined( 'BACKGROUND_COLOR' ) )
		define( 'BACKGROUND_COLOR', 'F0F1F1' );
	
	if ( ! get_theme_mod( 'background_repeat', false ) )
		set_theme_mod( 'background_repeat', 'no-repeat' );
		
	if ( ! get_theme_mod( 'background_position_x', false ) )
		set_theme_mod( 'background_position_x', 'center' );

	// This theme allows users to set a custom background   
    if( version_compare( $wp_version, '3.4', ">=" ) )
        add_theme_support( 'custom-background' );
    else
        add_custom_background();

	// Your changeable header business starts here
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/images/slideshow/005.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yiw_header_image_width', 864 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yiw_header_image_height', 319 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	//set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
    if( version_compare( $wp_version, '3.4', ">=" ) )
        add_theme_support( 'custom-header', array( 'admin-head-callback' => 'yiw_admin_header_style' ) );
    else
        add_custom_image_header( '', 'yiw_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'sea' => array(
			'url' => '%s/images/slideshow/001.jpg',
			'thumbnail_url' => '%s/images/slideshow/001-thumb.png',
			/* translators: header image description */
			'description' => __( 'Sea', TEXTDOMAIN )
		),
		'flowers' => array(
			'url' => '%s/images/slideshow/002.jpg',
			'thumbnail_url' => '%s/images/slideshow/002-thumb.png',
			/* translators: header image description */
			'description' => __( 'Flowers', TEXTDOMAIN )
		),
		'portrait' => array(
			'url' => '%s/images/slideshow/003.jpg',
			'thumbnail_url' => '%s/images/slideshow/003-thumb.png',
			/* translators: header image description */
			'description' => __( 'Portrait', TEXTDOMAIN )
		),
		'hearth' => array(
			'url' => '%s/images/slideshow/004.jpg',
			'thumbnail_url' => '%s/images/slideshow/004-thumb.png',
			/* translators: header image description */
			'description' => __( 'Heart', TEXTDOMAIN )
		),
		'black-white' => array(
			'url' => '%s/images/slideshow/005.jpg',
			'thumbnail_url' => '%s/images/slideshow/005-thumb.png',
			/* translators: header image description */
			'description' => __( 'Black & White', TEXTDOMAIN )
		)
	) );

	$locale = get_locale();      
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file ); 
    
	// This theme uses wp_nav_menu() in more locations.
	register_nav_menus(
        array(
            'nav'           => __( 'Navigation' )
        )
    );
    
    // images size
    add_image_size( 'team-thumb', 100, 100 );           
	add_image_size( 'thumb-recentposts', 55, 55, true );   // for shortcode
    add_image_size( 'portfolio-thumb', 280, 149 );
	add_image_size( 'portfolio-thumb-slider', 193, 118, true );
	add_image_size( 'portfolio-thumb-gallery', 179, 179, true ); 
    
    // sidebars registers            
	register_sidebar( sidebar_args( 'Blog Sidebar', __( 'The sidebar showed on page with Blog template', TEXTDOMAIN ) ) );  
	register_sidebar( sidebar_args( 'Home Row', __( 'The row below home content.', TEXTDOMAIN ), 'one-third', 'h2' ) );            
	
	// add sidebar created from plugin
	if( get_option( $GLOBALS['shortname'] . '_sidebars' ) )
	{
		$sidebars = unserialize( get_option( $GLOBALS['shortname'] . '_sidebars' ) );
		foreach( $sidebars AS $sidebar )
		{
			register_sidebar( sidebar_args( $sidebar, '', 'widget', 'h2' ) );
		}
	}                                                           
	
	// add custom style
	add_action( 'wp_head', 'yiw_custom_style', 999 );
	
	// add custom js
	add_action( 'wp_footer', 'yiw_custom_js', 999 );     
}
add_action( 'after_setup_theme', 'beauty_setup' );     

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function yiw_page_menu_args( $args ) {
	$args['show_home'] = true;
	$args['menu_class'] = 'menu';
	return $args;
}
add_filter( 'wp_page_menu_args', 'yiw_page_menu_args' );  

$theme_modules = array(
    dirname(__FILE__) . '/../includes/colors.php',
    dirname(__FILE__) . '/../includes/fonts.php',
    dirname(__FILE__) . '/../admin-options/yiw_panel.php',
    dirname(__FILE__) . '/../admin-options/notifier/update-notifier.php',
    dirname(__FILE__) . '/../admin-options/backend.php',
    dirname(__FILE__) . '/../admin-options/metaboxes.php',
    dirname(__FILE__) . '/../admin-options/dashboard.php',
    //dirname(__FILE__) . '/../admin-options/tinymce/tinymce.php',
    dirname(__FILE__) . '/../includes/widgets/widgets.php',
    dirname(__FILE__) . '/../includes/shortcodes.php',
    dirname(__FILE__) . '/../includes/sendemail.php'
);

function yiw_custom_style()
{
	string_( '<style type="text/css">', stripslashes_deep( get_option( $GLOBALS['shortname'] . '_custom_style', '' ) ), '</style>' );
}

function yiw_custom_js()
{
	string_( '<script type="text/javascript">', stripslashes_deep( get_option( $GLOBALS['shortname'] . '_custom_js', '' ) ), '</script>' );
}

function sidebar_args( $name, $description = '', $widget_class = 'widget', $title = 'h3' )
{   
	$id = strtolower( str_replace( ' ', '-', $name ) );
	
    return array(
        'name' => $name,
        'id' => $id,
        'description' => $description,
		'before_widget' => '<div id="%1$s" class="' . $widget_class . ' %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . $title . '>',
		'after_title' => '</' . $title . '>',
    );
}                            

if ( ! function_exists( 'yiw_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function yiw_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;       

// add lightbox to the gallery
function yiw_add_lightbox( $html, $id, $size, $permalink, $icon, $text ) {
	if ( ! $permalink )
		return str_replace( '<a', '<a rel="prettyPhoto[gallery]"', $html );
	else
		return $html;
}
add_filter( 'wp_get_attachment_link', 'yiw_add_lightbox', 10, 6 );

// sort array
function subval_sort($a, $subkey) 
{
	if( is_array($a) AND !empty($a) )
	{
		foreach($a as $k => $v) 
		{
			$b[$k] = strtolower( $v[$subkey] );
		}
		
		asort($b);
		
		foreach($b as $key => $val) 
		{
			$c[] = $a[$key];
		}
		
		return $c;
	}
	
	return $a;
}                          

$message = '';           


// set of icons
$icons_name = array(            
    'bag', 'box', 'bubble', 'bulb',
    'calendar', 'cart', 'chart', 'clipboard', 'coffee',
    'diagram', 'doodles',
    'gear', 'gift', 'globe',
    'info',
    'label', 'letter',
    'moleskine', 'monitor', 'mphone',
    'new',
    'open',
    'pc', 'pencil', 'phone', 'pictures', 'postit',
    'qmark',
    'refresh',
    'shopbag', 'statistics',
    'testimonial', 'tick',
    'bag-grey', 'card-grey', 'cart-grey', 'mail-grey', 'pencil-grey', 'phone-grey', 'users-grey'
);  

// tags for text
$tags_allowed = array(
    'name_site' => get_bloginfo('name'),
    'description_site' => get_bloginfo('description'),
    'site_url' => site_url(),
    'date' => date_i18n( get_option('date_format'), time() )
);
              
// include theme modules           
foreach ( $theme_modules as $module )
    if ( file_exists( $module ) )
        include_once $module;
unset( $module );         

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
      $first_img = get_stylesheet_directory_uri()."/images/default.gif";
    }
    return $first_img;
}                 

if ( ! function_exists( 'bolder_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function bolder_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['count'] = $GLOBALS['count']+1;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-container">
    		<div class="comment-author vcard">
    		    <?php $url = get_template_directory_uri() . '/images/noavatar.png'; ?>
    			<?php echo get_avatar( $comment, 75 ); ?>
    			<?php printf( __( '%s ', TEXTDOMAIN ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
    		</div><!-- .comment-author .vcard -->
    		
    		<div class="comment-meta commentmetadata">
                <?php if ( $comment->comment_approved == '0' ) : ?>
        			<em class="moderation"><?php _e( 'Your comment is awaiting moderation.', TEXTDOMAIN ); ?></em>
        			<br />
        		<?php endif; ?>
        		
        		<div class="intro">
            		<div class="commentDate">
            		  <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            			<?php
            				/* translators: 1: date, 2: time */
            				printf( __( '%1$s at %2$s', TEXTDOMAIN ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', TEXTDOMAIN ), ' ' );
            			?>
        			</div>

        			<div class="commentNumber">#&nbsp;<?php echo $GLOBALS['count'] ?></div>
        		</div>
        			
    			<div class="comment-body"><?php comment_text(); ?></div>
    			
    			
    			<div class="reply">
        			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        			<?php clear() ?>
        		</div><!-- .reply -->
    		</div><!-- .comment-meta .commentmetadata -->
    	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', TEXTDOMAIN ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', TEXTDOMAIN), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function get_current_pagename()
{
	global $post;
	
	if ( isset( $post->post_name ) )
		return $post->post_name;
	else
		return '';
}

function plugin_is_activated( $plugin )
{
	return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}         

function get_exclude_categories()
{
    $cats = get_option($GLOBALS['shortname'] . '_blog_cats_exclude_1');
    
    $cats = str_replace(" ", "", $cats);   // tolgo gli spazi che l'utente inserisce
    $cats = explode(",", $cats);           // divido le categorie tramite le virgole inserite
    
    $temp = array();
    foreach($cats as $cat)
    {
        $temp[] = $cat;              // metto tutte le categorie in un array temporaneo
    }
    
    // genero una nuova stringa con l'esclusione delle categorie passate in parametro, aggiugendo un meno davanti ad ogni numero (-1,-4,-7,ecc...)
    $i = 0; $query = '';
    foreach($temp as $c)
    {                                                                                                      
        if($i != 0) $query .= ',';    // aggiunge la virgola, soltanto se non è il primo elemento processato
        $query .= "-$c";
        
        $i++;
    }
    
    return $query;
}
        
//------------------------------------------------------------------------------
// CHECK EMAIL
//------------------------------------------------------------------------------
function checkMail($m) {
	$r = "([A-z0-9]+[\._\-]?){1,3}([A-z0-9])*";
  	$r = "/(?i)^{$r}\@{$r}\.[A-z]{2,6}$/";
  	return preg_match($r, $m);
}

//------------------------------------------------------------------------------
// CHECK GENERIC
//------------------------------------------------------------------------------
Function checkGeneric($str) {
//	if (!preg_match("/^[a-z0-9 '-\^]+$/i", $str)) {
//		Return False;
//	}
	If (strlen($str) <= 2) {
		return False;
	} else {
		Return True;
	}
}

//------------------------------------------------------------------------------------------------
// CHECK TEL
//-----------------------------------------------------------------------------------
Function checktel($str) {
    if ($str == "") {
		$str = 0;
	}
	if (!is_numeric($str)) {
		Return False;
	}
	If (strlen($str) >= 18) {
		return False;
	} else {
		Return True;
	}
}           

//------------------------------------------------------------------------------
// CHECK GENERIC
//------------------------------------------------------------------------------
function get_convertTags($str, $class = '', $after = '') 
{
    global $tags_allowed;
    
	if( $class != '' )
		$class = ' class="' . $class . '"';
		
    $str = str_replace('[', '<span' . $class . '>', $str);
    $str = str_replace(']', '</span>', $str);
    
    foreach( $tags_allowed as $tag => $value )
        $str = str_replace( "%$tag%", $value, $str );
    
    return $str . $after;
}                      

function convertTags($str, $class = '', $after = '') 
{
    echo get_convertTags($str, $class, $after);
}                                 
add_filter( 'widget_title', 'get_convertTags' ); 
add_filter( 'bloginfo', 'get_convertTags' );     

function get_favicon()
{                              
	$favicon = unserialize( get_option($GLOBALS['shortname'] . '_favicon') );    
	echo $favicon['url'];
}

function get_logo()
{
	$logo = unserialize( get_option($GLOBALS['shortname'] . '_logo') ); 
	
	if ( $logo['url'] == '' )
		$logo['url'] = get_template_directory_uri() . '/images/logo.png';
		
	echo $logo['url'];
}

// adjust logo
function add_dynamic_logo_size()
{
    $_show_logo = get_option( $GLOBALS['shortname'] . '_show_logo' );
    $custom_width = get_option( $GLOBALS['shortname'] . '_logo_width', '' );
    $custom_height = get_option( $GLOBALS['shortname'] . '_logo_height', '' );
    
    $margin = 20;
    
    if( get_option( $GLOBALS['shortname'] . '_show_logo' ) AND $custom_width != '' AND $custom_height != '' )
    {
        ?>
        <style type="text/css">
            #logo { width:<?php echo $custom_width ?>px; height:<?php echo $custom_height ?>px; }
            #nav { margin-left:<?php echo $custom_width + $margin ?>px }
        </style>
        <?php
    }
}      
add_action( 'wp_head', 'add_dynamic_logo_size' ); 

function get_layout_page()
{
    $layout = get_post_meta( get_the_ID(), '_layout_page', true );
    return ( !$layout ) ? 'sidebar-right' : $layout;
}  

function get_removeTags($str, $after = '') 
{
    $str = str_replace('[', '', $str);
    $str = str_replace(']', '', $str);
    
    return $str . $after;
}                               
add_filter( 'wp_title', 'get_removeTags' );    

function yiw_curPageURL() {
	$pageURL = 'http';
	if ( isset( $_SERVER["HTTPS"] ) AND $_SERVER["HTTPS"] == "on" ) 
		$pageURL .= "s";
	
	$pageURL .= "://";
	
	if ( isset( $_SERVER["SERVER_PORT"] ) AND $_SERVER["SERVER_PORT"] != "80" ) 
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	
	return $pageURL;
}

function slideshowImages($path, $n = FALSE)
{
    $dir = $path;
    $dir = str_replace("http://$_SERVER[SERVER_NAME]", "$_SERVER[DOCUMENT_ROOT]", $path);
	
    $files = array();        
    $html = ''; $i = 1;
    if ($handle = opendir($dir)) 
    {                                
       while (false !== ($file = readdir($handle))) 
       { 
            list($name, $ext) = explode('.', $file);
            if ( $file == ".." || $file == "." || is_dir($file)) {
                continue;
            }

           if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') 
           {
                $html .= "<img src=\"{$path}{$file}\" alt=\"$name\" />";
                $i++;
           }
           
           if($n AND $i > $n) break;
       }
    
       closedir($handle); 
    }        
    
//     $html = '';
//     for($i = 0; $i < get_option('nums_images_slideshow_home_f'); $i++)
//     {
//         $html .= "<img src=\"{$path}{$file[$i]}\" alt=\"001\" />";
//     } 
    
    echo $html;
}              

function get_url_icon($icon, $size = 32)
{
    global $icons_name;
    
    $path = "/images/icons/{$icon}{$size}.png";
    
    if( file_exists( STYLESHEETPATH . $path ) )
    	return get_template_directory_uri() . "/images/icons/{$icon}{$size}.png";
    else
    	return get_template_directory_uri() . "/images/icons/{$icon}.png";
}           

function list_icons( $selected = false, $echo = TRUE )
{
    global $icons_name;
    
    $html = '';
    foreach($icons_name as $icon)
    {
    	$option_select = '';
    	if( $selected != FALSE AND $selected == $icon )
    		$option_select = ' selected="selected"';
    		
        $html .= '<option value="'.$icon.'"'.$option_select.'>'.$icon.'</option>'."\n";
    }
    
    if($echo) echo $html;
    return $html;
}


// convert a string of categories into excluded categories
function exclude_categories($cats)
{
    $excluded_cats = '-9999';
    $cats = explode(",", $cats);
    
    foreach ($cats as $cat) 
    {
    	$excluded_cats .= ',-' . $cat;
    }
    
    return $excluded_cats;
}                                     

// print the option from db, using do_shortcode, to convert the shortcodes
function option_theme($option)
{
    echo do_shortcode(stripslashes(get_option($option)));
}     

/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 */
function widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}
add_filter('dynamic_sidebar_params','widget_first_last_classes');      

function get_links_sliders( &$a, &$url, $slide )
{
	switch( $slide['link_type'] )
    {
		case 'page':
			$a = TRUE;
			$url = get_permalink( $slide['link_page'] );
		break;
		
		case 'category': 
			$a = TRUE;
			$theCatId = get_category_by_slug( $slide['link_category'] );                              
			$url = get_category_link( $theCatId->term_id );
		break;
		
		case 'url':      
			$a = TRUE;                          
			$url = $slide['link_url'];
		break;
		
		case 'none':     
			$a = FALSE;
			$url = '';
		break;
	}  
}              

function featured_content( $slide, $before = '', $after = '', $container = true )
{
	global $link;                                     
	
	switch( $slide['content_type'] ) { 
				
		case 'image' : ?>                    
        <?php if( $link ) : ?><a href="<?php echo $link_url ?>"><?php endif ?>
		<?php if( $container ) : ?><div class="featured-image"><?php endif; echo $before ?><img src="<?php echo $slide['image_url'] ?>" alt="<?php echo $slide['slide_title'] ?>" /><?php echo $after ?><?php if( $container ) : ?></div><?php endif; ?>  
		<?php if( $link ) : ?></a><?php endif ?>
		<?php break;
		
		case 'video' : ?>
		<div class="video-container"><?php echo stripslashes_deep( $slide['code_video'] ) ?></div>
		<?php break;               
        
	}
}         

function clear( $class = '' )
{
	?><div class="clear<?php echo ' ' . $class ?>"></div><?php
}

// sliders
function split_title( $title, $pattern = '/(.*)\[(.*)\]/' )
{
	$return = array();
	
	if( preg_match($pattern, $title, $t, PREG_OFFSET_CAPTURE) )
	{
    	$return['title'] = $t[1][0];
    	$return['subtitle'] = $t[2][0];
    }
    else
    {
		$return['title'] = $title;
        $return['subtitle'] = '';	
	}
    
    return $return;
}

function string_( $before = '', $string = '', $after = '', $echo = true )
{
    $html = '';
    
	if( $string != '' AND !is_null( $string ) )
		$html = $before . $string . $after;
	
	if( $echo )
		echo $html;
	
	return $html;
}

function get_slides( $option )
{
	return subval_sort( maybe_unserialize( get_option( $option ) ), 'order' );
}          

function pagination( $pages = '', $range = 10 )
{  
     global $paged;
     if( empty( $paged ) ) $paged = 1;

     if( $pages == '' ) {
         global $wp_query;                  
         
		 if ( isset( $wp_query->max_num_pages ) )	
			 $pages = $wp_query->max_num_pages;
         
		 if( !$pages )
             $pages = 1;
     }   

     if( 1 != $pages ) {
         echo "<div class='general-pagination'>";
         if( $paged > 2 ) echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
         if( $paged > 1 ) echo "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";

         for ( $i=1; $i <= $pages; $i++ )
         {
             if( 1 != $pages &&( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) )
             {
                 $class = ( $paged == $i ) ? " class='selected'" : '';
                 echo "<a href='", get_pagenum_link( $i ), "'$class >$i</a>";
             }
         }

         if ( $paged < $pages ) echo "<a href='", get_pagenum_link( $paged + 1 ), "'>&rsaquo;</a>";  
         if ( $paged < $pages - 1 ) echo "<a href='", get_pagenum_link($pages), "'>&raquo;</a>";
         
         clear();
         
         echo "</div>\n";
     }
}              

function echo_list_option( $option = array(), $value_select = false, $echo = true )
{
	if( empty( $option ) )
		return;
	
	foreach( $option as $key => $value )
	{
		$selected = '';
		if( $value_select != FALSE AND $key == $value_select )
			$selected = ' selected="selected"';
			
		$html .= "<option value=\"$key\"$selected>$value</option>\n";
	}
	
	if( $echo )
		echo $html;
		
	return $html;
}

function get_pageID_by_pagename( $page_name )
{
	global $wpdb;
	return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$page_name'");
}                             

function yiw_get_slides( $key = false )
{                 	
	$return = array();
	
	if( $post_types = get_option( $GLOBALS['shortname'] . '_accordion_sliders' ) )
    {
    	foreach( unserialize( $post_types ) as $id => $value )
		{
			switch( $key )
			{
				case 'name' :
					$return[] = $value;
				break;
				
				case 'slug' :
					$return[] = strtolower( str_replace( ' ', '_', $value ) );
				break;
				
				case FALSE :
					$return[$id]['name'] = $value;
					$return[$id]['slug'] = strtolower( str_replace( ' ', '_', $value ) );
				break;
			}
		}
    }
    else
    {
		$return = array();
	}
	
	return $return;
}                      

function url_to_pathname( $url )
{
	return str_replace( 'http://' . $_SERVER['SERVER_NAME'], $_SERVER['DOCUMENT_ROOT'], $url );
}              



// lenghts
function excerpt_length_testimonials_slider()
{
	return get_option( $GLOBALS['shortname'] . '_testimonial_slider_words_split', 13 );
}           
function excerpt_more_testimonials_slider()
{
	return '...';
}           


function yiw_prettyphoto_theme() {
    global $shortname;
    $theme = get_option($shortname . '_portfolio_skin_lightbox', 'default'); ?>
    
    <script type="text/javascript">
        var yiw_prettyphoto_theme = '<?php echo $theme ?>';
    </script>
    
    <?php
}
add_action( 'wp_print_scripts', 'yiw_prettyphoto_theme' );
?>