<?php require 'includes/required/template-top.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
<?php
$icon = get_option(PADD_NAME_SPACE . '_favicon_url','');

wp_enqueue_script('jquery');
wp_enqueue_script('jquery-corners', get_template_directory_uri() . '/js/jquery.corners.js');
wp_enqueue_script('jquery-supersubs', get_template_directory_uri() . '/js/jquery.supersubs.js');
wp_enqueue_script('jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js');
wp_enqueue_script('jquery-cycle', get_template_directory_uri() . '/js/jquery.cycle.js');
wp_enqueue_script('main-loading', get_template_directory_uri() . '/js/main.loading.js');
wp_enqueue_script('share-facebook','http://static.ak.fbcdn.net/connect.php/js/FB.Share');
wp_enqueue_script('share-twitter','http://platform.twitter.com/widgets.js')
?>
<?php wp_head(); ?>
<?php
$tracker = get_option(PADD_NAME_SPACE . '_tracker_head','');
if (!empty($tracker)) {
	echo stripslashes($tracker);
}
?>

</head>

<body <?php body_class(); ?>>
<?php
$tracker = get_option(PADD_NAME_SPACE . '_tracker_top','');
if (!empty($tracker)) {
	echo stripslashes($tracker);
}
?>
<div id="container">

	<p class="no-display"><a href="#skip-to-content">Skip to content</a></p>	

	<div id="header">
		<div class="pad append-clear">		
			<div class="box box-masthead">
				<?php $tag = (is_home()) ? 'h1' : 'p'; ?>
				<<?php echo $tag; ?> class="title">
					<a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>
				</<?php echo $tag; ?>>
				<p class="description"><?php bloginfo('description'); ?></p>
			</div>
			
			<div id="menubar" class="box box-mainmenu">
				<h3>Main Menu</h3>
				<div class="interior">
					<?php 
						wp_nav_menu(array(
							'theme_location' => 'main',
							'container' => null,
						));
					?>
				</div>
			</div>
		</div>
	</div>

	<a name="skip-to-content"></a>
	
	<?php if (is_home()) : ?>
	
	

	<?php endif; ?>	
	
	<div id="body">
		<div class="pad append-clear">
		
		


