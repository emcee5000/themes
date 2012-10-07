<?php 
require_once '../../../../wp-load.php';  
header("Content-type: text/css");

$color = get_option( $shortname . '_color_theme', $default_color['main-color'] );
?>

/* Main Layout */

a, h1, h2, h3, h4, h5, h6, .pagination a.activeSlide, #nav a:hover, #nav .current_page_item a,
h1 span, h2 span, h3 span, h4 span, h5 span, h6 span, body #sidebar .testimonial-widget li p a,
#sidebar .box li a:hover, .sidebar-nav a:hover, #portfolio li h5 a:hover, #portfolio li h5 span, body #latest-news a.title,
.contact-form .error label, #content .contact-form ul li .msg-error, #content .contact-form ul li.error label, #sidebar .testimonial-text li a
 { <?php css_color( $color, 'color' ) ?> }     
 
a:hover, #sidebar .widget li a:hover, .last-news a.title:hover
 { <?php css_color( compareColor( $color, $default_color['links-hover'], $default_color['main-color'] ), 'color' ) ?> } 

body .contact-form .error input, body .contact-form .error textarea, body .contact-form .error select
{ <?php css_color( $color, 'border-color', true ) ?> }

.p-slider a.activeSlide, .p-testimonial a.activeSlide
{ <?php css_color( $color, 'background-color' ) ?><?php css_color( $color, 'color' ) ?> }

/* USER CONFIGURATION */

<?php string_( 'p, li, address { color:', get_option( $shortname . '_color_text' ), ' }' ); ?>

<?php string_( 'a { color:', get_option( $shortname . '_color_links' ), ' }' ); ?>

<?php string_( 'a:hover { color:', get_option( $shortname . '_color_links_hover' ), ' }' ); ?>

/*typography*/
p, li, address, td, th { <?php string_( 'font-size:', get_option_fontsize( 'p' ), 'px;' ) ?> }
h1 { <?php string_( 'font-size:', get_option_fontsize( 'h1' ), 'px;' ) ?> }
h2 { <?php string_( 'font-size:', get_option_fontsize( 'h2' ), 'px;' ) ?> }
h3 { <?php string_( 'font-size:', get_option_fontsize( 'h3' ), 'px;' ) ?> }
h4 { <?php string_( 'font-size:', get_option_fontsize( 'h4' ), 'px;' ) ?> }
h5 { <?php string_( 'font-size:', get_option_fontsize( 'h5' ), 'px;' ) ?> }
h6 { <?php string_( 'font-size:', get_option_fontsize( 'h6' ), 'px;' ) ?> }
#nav a { <?php string_( 'font-size:', get_option_fontsize( 'nav' ), 'px;' ) ?> }