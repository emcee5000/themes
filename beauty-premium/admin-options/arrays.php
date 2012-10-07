<?php
// items of admin options panel
$submenu_items = array( 
	'general' => __( 'General', TEXTDOMAIN ), 
	'colors' => __( 'Colors', TEXTDOMAIN ),           
	'typography' => __( 'Typography', TEXTDOMAIN ),   
	'sliders' => __( 'Sliders', TEXTDOMAIN ), 
	'sidebars' => __( 'Sidebars', TEXTDOMAIN ), 
	'contact' => __( 'Contact Customize', TEXTDOMAIN ),
	'premium' => __( 'Premium', TEXTDOMAIN )
);    
 
// all slider types
$sliders_type = array( 
	'fixed-image' => __( 'Fixed Image', TEXTDOMAIN ),
	'content' => __( 'Slider Content', TEXTDOMAIN ), 
	'fullimages' => __( 'Slider Full Images', TEXTDOMAIN ), 
	'none' => __( 'None', TEXTDOMAIN ) 
);   

// get all categories created on theme
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) 
{
    $wp_cats[$category_list->category_nicename] = $category_list->cat_name;
}
array_unshift($wp_cats, __("Choose a category"));  

// number of columns for big footer
$columns_footer = array( 'three' => 'Three Columns', 'four' => 'Four Columns', 'five' => 'Five Columns' );

// effects
$fxs = array(
    'blindX' => 'blindX', 		'blindY' => 'blindY', 		'blindZ' => 'blindZ', 		'cover' => 'cover', 		'curtainX' => 'curtainX',
    'curtainY' => 'curtainY', 	'fade' => 'fade', 			'fadeZoom' => 'fadeZoom', 	'growX' => 'growX', 		'growY' => 'growY',
    'scrollUp' => 'scrollUp', 	'scrollDown' => 'scrollDown','scrollLeft' => 'scrollLeft','scrollRight' => 'scrollRight', 	'scrollHorz' => 'scrollHorz',
    'shuffle' => 'shuffle', 	'slideX' => 'slideX', 		'slideY' => 'slideY', 		'toss' => 'toss', 			'turnUp' => 'turnUp',
    'turnLeft' => 'turnLeft', 	'turnRight' => 'turnRight', 'uncover' => 'uncover', 	'wipe' => 'wipe', 			'zoom' => 'zoom',
    'none' => 'none',			'turnDown' => 'turnDown',	'scrollVert' => 'scrollVert'
);

$jqfancy_effect = array(
	'wave' => 'wave',
	'zipper' => 'zipper',
	'curtain' => 'curtain'
);

$jqfancy_position = array(
	'top' => 'top',
	'bottom' => 'bottom',
	'alternate' => 'alternate',
	'curtain' => 'curtain'
);

$jqfancy_direction = array(
	'left' => 'left',
	'right' => 'right',
	'alternate' => 'alternate',
	'random' => 'random',
	'fountain' => 'fountain',
	'fountainAlternate' => 'fountainAlternate',
);

// nivo slider effect
$nivo_fxs = array(
	'sliceDown' => 'sliceDown',
    'sliceDownLeft' => 'sliceDownLeft',
    'sliceUp' => 'sliceUp',
    'sliceUpLeft' => 'sliceUpLeft',
    'sliceUpDown' => 'sliceUpDown',
    'sliceUpDownLeft' => 'sliceUpDownLeft',
    'fold' => 'fold',
    'fade' => 'fade',
    'random' => 'random',
    'slideInRight' => 'slideInRight',
    'slideInLeft' => 'slideInLeft'
);

// easings
$easings = array(
	FALSE => 'none',
	'easeInQuad' => 'easeInQuad',
	'easeOutQuad' => 'easeOutQuad',
	'easeInOutQuad' => 'easeInOutQuad',
	'easeInCubic' => 'easeInCubic',
	'easeOutCubic' => 'easeOutCubic',
	'easeInOutCubic' => 'easeInOutCubic',
	'easeInQuart' => 'easeInQuart',
	'easeOutQuart' => 'easeOutQuart',
	'easeInOutQuart' => 'easeInOutQuart',
	'easeInQuint' => 'easeInQuint',
	'easeOutQuint' => 'easeOutQuint',
	'easeInOutQuint' => 'easeInOutQuint',
	'easeInSine' => 'easeInSine',
	'easeOutSine' => 'easeOutSine',
	'easeInOutSine' => 'easeInOutSine',
	'easeInExpo' => 'easeInExpo',
	'easeOutExpo' => 'easeOutExpo',
	'easeInOutExpo' => 'easeInOutExpo',
	'easeInCirc' => 'easeInCirc',
	'easeOutCirc' => 'easeOutCirc',
	'easeInOutCirc' => 'easeInOutCirc',
	'easeInElastic' => 'easeInElastic',
	'easeOutElastic' => 'easeOutElastic',
	'easeInOutElastic' => 'easeInOutElastic',
	'easeInBack' => 'easeInBack',
	'easeOutBack' => 'easeOutBack',
	'easeInOutBack' => 'easeInOutBack',
	'easeInBounce' => 'easeInBounce',
	'easeOutBounce' => 'easeOutBounce',
	'easeInOutBounce' => 'easeInOutBounce'
);
?>
