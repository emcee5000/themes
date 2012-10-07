<?php
/**
 * @package WordPress
 * @subpackage Kassyopea
 * 
 * Here the first hentry of theme, when all theme will be loaded.
 * On new update of theme, you can not replace this file.
 * You will write here all your custom functions, they remain after upgrade.
 */                                                                               

require_once dirname(__FILE__) . '/includes/functions.php';

/*-----------------------------------------------------------------------------------*/
/* End Theme Load Functions - You can add custom functions below */
/*-----------------------------------------------------------------------------------*/         

if ( is_admin() && 'themes.php' == basename( $_SERVER['PHP_SELF'] ) && isset( $_GET['activated'] ) ) {
     
     // contact form
     update_option( $shortname . '_contact_fields_default', get_option( $shortname . '_default_contact_form' ) );
     
     // portfolio
     update_option( $shortname . '_portfolio_type', '3cols' );
}

// sidebars
function yiw_register_additional_sidebars()
{
	register_sidebar( sidebar_args( 'Home Sidebar', __( 'Sidebar for template "Home"', TEXTDOMAIN ), 'widget', 'h2' ) );  
	register_sidebar( sidebar_args( 'About Sidebar', __( 'Sidebar for template "About"', TEXTDOMAIN ), 'widget', 'h2' ) );  
	register_sidebar( sidebar_args( 'Contact Sidebar', __( 'Sidebar for template "Contact"', TEXTDOMAIN ), 'widget', 'h2' ) );       
}
add_action( 'after_setup_theme', 'yiw_register_additional_sidebars' );  

?>