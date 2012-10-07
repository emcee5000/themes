<?php
/**
 * Widgets
 * 
 * Main file for manage widget.     
 * 
 * @package WordPress
 * @subpackage Kassyopea
 * @author YIW
 */

// unregister all default WP Widgets
function unregister_default_wp_widgets() 
{ 
	//unregister_widget('WP_Widget_Pages');
	//unregister_widget('WP_Widget_Calendar');
	//unregister_widget('WP_Widget_Archives');
	//unregister_widget('WP_Widget_Links');
	//unregister_widget('WP_Widget_Meta');
	//unregister_widget('WP_Widget_Search');
	//unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	//unregister_widget('WP_Widget_Recent_Comments');
	//unregister_widget('WP_Widget_RSS');
	//unregister_widget('WP_Widget_Tag_Cloud');
}
  
add_action( 'widgets_init', 'unregister_default_wp_widgets', 1); 

add_action( 'widgets_init', 'yiw_register_widgets' ); 

$add_widgets = array(
    'testimonials',
    'almost_all_categories',
    'last_tweets',
    'popular_posts',
    'recent_posts',
    'last_news',
    'google_map',
    'text_image',
    'contact_info',
    'address_info'
);

foreach( $add_widgets as $widget )
    if( file_exists( dirname(__FILE__) . '/' . $widget . '.php' ) )
        include_once $widget . '.php';

function yiw_register_widgets() 
{
    global $add_widgets;
    
    foreach( $add_widgets as $widget )
        if( file_exists( dirname(__FILE__) . '/' . $widget . '.php' ) )
            register_widget( $widget );
}
?>