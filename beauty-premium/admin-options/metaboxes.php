<?php
/* Define the custom box */

// WP 3.0+
add_action('add_meta_boxes', 'admin_add_custom_box');

// backwards compatible
//add_action('admin_init', 'admin_add_custom_box', 1);

// adding some style
function admin_style_init()
{
	wp_enqueue_style('my_meta_css', get_template_directory_uri() . '/admin-options/include/metaboxes.css');
}
add_action( 'admin_init', 'admin_style_init' );

/* Do something with the data entered */
add_action('save_post', 'admin_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function admin_add_custom_box() {
    //add_meta_box( 'admin_sectionid', __( 'My Post Section Title', 'admin_textdomain' ), 'admin_inner_custom_box', 'post' );
    
	// page
	add_meta_box( 'admin_sidebar_page', __( 'Options of page', TEXTDOMAIN ), 'admin_options_page_inner_custom_box', 'page', 'side' );     
    add_meta_box( 'admin_slogan_page', __( 'Slogan Page', TEXTDOMAIN ), 'admin_slogan_page_inner_custom_box', 'post', 'side', 'high' );
    add_meta_box( 'admin_remove_wpautop_page', __( 'Remove WpAutoP filter.', TEXTDOMAIN ), 'admin_remove_wpautop_page_inner_custom_box', 'page', 'normal', 'high' );   
    add_meta_box( 'admin_slogan_page', __( 'Slogan Page', TEXTDOMAIN ), 'admin_slogan_page_inner_custom_box', 'page', 'normal', 'high' );
    add_meta_box( 'admin_slogan_page', __( 'Slogan Page', TEXTDOMAIN ), 'admin_slogan_page_inner_custom_box', 'post', 'normal', 'high' );
    add_meta_box( 'admin_extra_content_page', __( 'Extra Content', TEXTDOMAIN ), 'admin_extra_content_page_inner_custom_box', 'page', 'normal', 'high' );
    
	// portfolio                                                                                                                                                                        
    add_meta_box( 'admin_bl_portfolio_video_url', __( 'Video URL thumb', TEXTDOMAIN ), 'admin_bl_portfolio_video_url_inner_custom_box', 'bl_portfolio', 'normal', 'high' );
}                         

/* When the post is saved, saves our custom data */
function admin_save_postdata( $post_id ) {

	if ( isset( $_POST['admin_noncename'] ) AND !wp_verify_nonce( $_POST['admin_noncename'], plugin_basename(__FILE__) )) 
		return $post_id;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;    
	
	if ( isset( $_POST['post_type'] ) AND 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		  return $post_id;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		  return $post_id;
	}
	
	$custom_keys['hidden'] = array();
	$custom_keys['public'] = array();
	
	if( isset( $_POST['post_type'] ) )
	{
		switch( $_POST['post_type'] )
		{
			case 'page' :
				$custom_keys['hidden'][] = 'layout_page';
				$custom_keys['hidden'][] = 'sidebar_choose_page';  
				$custom_keys['hidden'][] = 'sidebar_layout';  
				$custom_keys['hidden'][] = 'slider_type';  
				$custom_keys['hidden'][] = 'slogan_page';  
				$custom_keys['hidden'][] = 'show_title_page';
				$custom_keys['hidden'][] = 'page_remove_wpautop';
				$custom_keys['hidden'][] = 'page_extra_content';
				$custom_keys['hidden'][] = 'page_extra_content_autop';
			break;             
			
			case 'post' :    
				$custom_keys['hidden'][] = 'slogan_page';                         
			break;         
			
			case 'bl_portfolio' :    
				$custom_keys['hidden'][] = 'video';                        
			break;
		}    
	}
	
	// add post metas hidden
	foreach( $custom_keys['hidden'] as $key )
	{
		if( isset( $_POST[$key] ) )
			add_post_meta( $post_id, '_'.$key, $_POST[$key], true ) or update_post_meta( $post_id, '_'.$key, $_POST[$key] );	         
		else
			delete_post_meta( $post_id, '_'.$key );
	}
	
	return;
}



// ========================== OPTIONS PAGE ================================

/* Prints the box content */
function admin_options_page_inner_custom_box() {

	// Use nonce for verification
	wp_nonce_field( plugin_basename(__FILE__), 'admin_noncename' ); 
  
	$post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : false;
	
	// LAYOUT PAGE
	$select_layout = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_layout_page', true ) : ''; 
	if( $select_layout == '' ) $select_layout = 'sidebar-right';
	
	$layouts = array(
		'sidebar-no' => 'No Sidebar',
		'sidebar-left' => 'Left Sidebar',
		'sidebar-right' => 'Right Sidebar'
	);    
	?>
	
	<div class="yiw_metaboxes">
		<p><?php _e( 'You can configure this page as you want, setting these optional options.', TEXTDOMAIN ) ?></p>                                                         
		
		<?php $slider_type = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_slider_type', true ) : ''; ?>  
	
		<label for="slider_type"><?php _e( 'Slider', TEXTDOMAIN ); ?></label>
		
		<p>
			<select name="slider_type" id="slider_type">
			
				<option value=""<?php selected( '', $slider_type ) ?>></option>
			<?php
			foreach( $GLOBALS['sliders_type'] as $id_slider => $type )
			{				
				?><option value="<?php echo $id_slider ?>"<?php selected( $id_slider, $slider_type ) ?>><?php echo $type ?></option><?php
			} ?>
			                            
			</select>
			<span class="inline"><?php _e("Select the type of slider on this page.", TEXTDOMAIN ) ?></span>
		</p>             
		
		
		<?php $select_title = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_show_title_page', true ) : 'yes'; ?>   
		
		<label for="show_title_page"><?php _e( 'Show Title', TEXTDOMAIN ) ?></label> 
		<p>    
			<input type="radio" name="show_title_page" id="show_title_page_yes" value="yes"<?php checked( $select_title, 'yes' ) ?> /> <label for="show_title_page_yes"><?php _e( 'Yes', 'yiw' ) ?></label>     
			<input type="radio" name="show_title_page" id="show_title_page_no" value="no"<?php checked( $select_title, 'no' ) ?> /> <label for="show_title_page_no"><?php _e( 'No', 'yiw' ) ?></label>      
		</p>
	
		<label for="layout_page"><?php _e( 'Layout Page', TEXTDOMAIN ); ?></label>
		
		<p>
			<select name="layout_page" id="layout_page">
			
			<?php
			foreach( $layouts as $layout => $name_layout )
			{
				?><option value="<?php echo $layout ?>"<?php selected( $layout, $select_layout ) ?>><?php echo $name_layout ?></option><?php
			} ?>
			                            
			</select>
			<span class="inline"><?php _e("Select layout of page", TEXTDOMAIN ) ?></span>
		</p>                                         
		
		<?php
		// SIDEBAR
		$select_sidebar = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_sidebar_choose_page', true ) : '';     
		?>
		
		<label for="sidebar_choose_page">Sidebar Page</label>
		<p>
			<select name="sidebar_choose_page" id="sidebar_choose_page">
				<option></option>
			
				<?php
				foreach( $GLOBALS['wp_registered_sidebars'] as $sidebar )
				{
					$selected = '';
					if( $sidebar['name'] == $select_sidebar )
						$selected = ' selected="selected"';
					
					?><option value="<?php echo $sidebar['name'] ?>"<?php echo $selected ?>><?php echo $sidebar['name'] ?></option><?php
				} ?>
			                            
			</select>                
			<span class="inline"><?php _e("Select sidebar of page", TEXTDOMAIN ) ?></span>        
		</p>  
	</div><?php  
}

/* Enable or not the remove wpautop for main content */
function admin_remove_wpautop_page_inner_custom_box() {

  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'admin_noncename' );
  
  $post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : false;
    
  $select_autop = false;
  if ( $post_id != FALSE )
  	$select_autop = get_post_meta( $post_id, '_page_remove_wpautop', true );

  // The actual fields for data entry       
  echo '<label>';
  echo '<input type="checkbox" id="page_remove_wpautop" name="page_remove_wpautop" value="1"' . checked( $select_autop, true, false ) . ' /> ';
  _e( "Remove 'wpautop' filter to main content.", TEXTDOMAIN );
  echo '</label>';
}

/* Prints the box content */
function admin_extra_content_page_inner_custom_box() {

  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'admin_noncename' );
  
  $post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : false;
  
  $select_text = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_page_extra_content', true ) : '';     
  $select_autop = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_page_extra_content_autop', true ) : FALSE;

  // The actual fields for data entry       
  echo '<p>' . __( 'If you want, you can add some text to show above the footer, under content and sidebar.', TEXTDOMAIN ) . '</p>';
  echo '<textarea name="page_extra_content" id="page_extra_content" style="width:100%;height:200px;" />'.htmlentities($select_text).'</textarea>';   
  echo '<label>';
  echo '<input type="checkbox" id="page_extra_content_autop" name="page_extra_content_autop" value="1"' . checked( $select_autop, true, false ) . ' /> ';
  _e( 'Automatically add paragraphs', TEXTDOMAIN );
  echo '</label>';
}



// ========================== SLOGAN PAGE ================================

/* Prints the box content */
function admin_slogan_page_inner_custom_box() {

  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'admin_noncename' );     
  
  $post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : false;
  
  $select_main = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_slogan_page', true ) : '';   

  // The actual fields for data entry
  echo '<div class="yiw_metaboxes">';
  
  echo '<label for="slogan_page_main"><strong>' . __( 'Slogan Title', TEXTDOMAIN ) .'</strong></label>' ;    
  echo '<p>';
  echo '<input type="text" name="slogan_page" id="slogan_page" value="'.$select_main.'" class="widefat" />';          
  echo '</p>';                  
  
  echo '</div>';
} 



// ========================== PORTFOLIO ================================

/* Prints the box content */
function admin_bl_portfolio_credits_meta_inner_custom_box() {

  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'admin_noncename' );     
  
  $post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : false;
  
  $designers 	= ( $post_id != FALSE ) ? get_post_meta( $post_id, '_designers', true ) : '';
  $developers 	= ( $post_id != FALSE ) ? get_post_meta( $post_id, '_developers', true ) : '';
  $producers 	= ( $post_id != FALSE ) ? get_post_meta( $post_id, '_producers', true ) : '';
  ?>
  <p><label>Designed By:</label><br />
  <textarea cols="50" rows="5" name="designers"><?php echo $designers; ?></textarea></p>
  <p><label>Built By:</label><br />
  <textarea cols="50" rows="5" name="developers"><?php echo $developers; ?></textarea></p>
  <p><label>Produced By:</label><br />
  <textarea cols="50" rows="5" name="producers"><?php echo $producers; ?></textarea></p>
  <?php                        
}

/* Prints the box content */
function admin_bl_portfolio_year_completed_inner_custom_box() {

  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'admin_noncename' );  
  
	if( !isset( $_GET['post'] ) )
	  	return false;
  
  $year_completed = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_year_completed', true ) : '';
  ?>
  <label>Year:</label>
  <input type="text" name="year_completed" value="<?php echo $year_completed; ?>" />
  <?php
                 
}

/* Prints the box content */
function admin_bl_portfolio_video_url_inner_custom_box() {

  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'admin_noncename' );  
  
  $post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : false;
  
  $video = ( $post_id != FALSE ) ? get_post_meta( $post_id, '_video', true ) : '';
  ?>
  <label>Video URL:</label>
  <input type="text" name="video" value="<?php echo $video; ?>" style="width:80%;" />
  <p>Here, you can add an Youtube or Vimeo url video, to show on thumb of this portfolio element.</p>
  <?php
                 
}
?>