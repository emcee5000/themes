<?php                             
if ( get_magic_quotes_gpc() ) {
    $_POST      = array_map( 'stripslashes_deep', $_POST );
    $_GET       = array_map( 'stripslashes_deep', $_GET );
    $_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
    $_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
}                      

function get_panel_url()
{
	return get_template_directory_uri() . '/admin-options';
}     

$themename = "Theme Options";

function yiw_message()
{
	global $themename;
	
	$message = array(
		'element_exists' => '<div id="message" class="error fade"><p>' . __( sprintf( 'The element you have written is already exists. Please, add another name.' ) ) . '</p></div>',
		'saved' => '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved', TEXTDOMAIN).'.</strong></p></div>',
		'reset' => '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings reset', TEXTDOMAIN).'.</strong></p></div>',
		'delete' => '<div id="message" class="updated fade"><p><strong>' . __( 'Element deleted correctly.', TEXTDOMAIN ) . '</strong></p></div>',
		'updated' => '<div id="message" class="updated fade"><p><strong>' . __( 'Element updated correctly.', TEXTDOMAIN ) . '</strong></p></div>',
		'imported' => '<div id="message" class="updated fade"><p><strong>' . __( 'Database imported correctly.', TEXTDOMAIN ) . '</strong></p></div>',
		'no-imported' => '<div id="message" class="error fade"><p><strong>' . __( 'An error encoured during during import. Please try again.', TEXTDOMAIN ) . '</strong></p></div>',
	    'file-not-valid' => '<div id="message" class="error fade"><p><strong>' . __( "The file you have insert doesn't valid.", TEXTDOMAIN ) . '</strong></p></div>',
	    'cant-import' => '<div id="message" class="error fade"><p><strong>' . __( "I'm sorry, the import featured is disabled.", TEXTDOMAIN ) . '</strong></p></div>',
	    'ord' => '<div id="message" class="updated fade"><p><strong>' . __( "Sorting done correctly.", TEXTDOMAIN ) . '</strong></p></div>'
	); 
	
	if( isset( $_GET['message'] ) )
		echo $message[ $_GET['message'] ];
}                       

/**
 * ARRAYS
 */ 
require_once 'arrays.php';
// -------------

$options = array();             

include_once 'panel_functions.php';

$includes_file = array(
    'install' => dirname(__FILE__) . '/install/install.php',
);

//include_once 'homepage/homepage.php';
if( file_exists( $includes_file['install'] ) ) include_once $includes_file['install'];

// includes options array               
foreach( $submenu_items as $item => $v )
{
    $file = dirname(__FILE__) . '/' . "options/$item-options.php";
    
	if( !file_exists( $file ) )
	   unset( $submenu_items[$item] );
	elseif( isset( $_GET['tab'] ) AND $_GET['tab'] == $item )
	   require_once $file;
	else
	   require_once dirname(__FILE__) . '/' . "options/general-options.php";
	
	unset( $file );
}         

function yiw_add_admin() 
{     
    global $themename, $submenu_items, $includes_file;
    
    $page = 'yiw_panel.php';   
    
    add_theme_page( $themename, $themename, 'edit_theme_options', 'yiw_panel', 'yiw_panel' );
    
    if( file_exists( $includes_file['install'] ) )
        add_theme_page( 'Install theme data', 'Import/Export', 'edit_theme_options', 'install', 'install_panel' );
}                             
add_action('admin_menu', 'yiw_add_admin');     

// add items to admin bar
if( version_compare($wp_version, "3.1", ">=") && current_user_can( 'manage_options' ) )
{
	function yiw_add_items_admin_bar()
	{
		global $submenu_items, $wp_admin_bar, $themename;      
			
		$wp_admin_bar->add_menu( array(   
			'parent' => false,
			'title' => $themename,    
	        'id' => "theme-options-home",
	        'href' => admin_url('admin.php')."?page=yiw_panel" 
	    ) );
		
		foreach( $submenu_items as $item => $title )
		{			
			$wp_admin_bar->add_menu( array(   
				'parent' => "theme-options-home",
				'title' => $title,    
		        'id' => "theme-options-$item",
		        'href' => admin_url('themes.php')."?page=yiw_panel&tab=$item" 
		    ) );
		}
	}
	add_action( 'wp_before_admin_bar_render', 'yiw_add_items_admin_bar' );
}

function init_panel()
{
    global $themename, $shortname, $options;     
    
    $ajax = FALSE;
    if( isset( $_REQUEST['type-send'] ) AND $_REQUEST['type-send'] == 'ajax' )
    	$ajax = TRUE;
    
    $tab = 'general';
    if( isset( $_GET['tab'] ) )
    	$tab = $_GET['tab'];
    
    $solo = false; // retrive the var for saving only specific options
    if( isset( $_REQUEST['save_only'] ) )
    	$solo = $_REQUEST['save_only'];
    
    if ( isset( $_GET['page'] ) AND ( $_GET['page'] == 'yiw_panel' ) ) 
    {
        if( isset( $_GET['tab'] ) )
            $vars = $options[ $_GET['tab'] ];
        else                 
            $vars = $options['general'];
			
		if ( isset( $_REQUEST['secondary-action'] ) )
		{
			// create example contact form
			if( 'create-contact-form' == $_REQUEST['secondary-action'] AND $_REQUEST['name-form'] != '' )
			{
				$forms = maybe_unserialize( get_option( $shortname . '_contact_forms', array() ) );
				$new_form = check_if_exists( sanitize_title( $_REQUEST['name-form'] ), $forms );
				
				// add new form
				$forms[] = $new_form;
				update_option( $shortname . '_contact_forms', serialize( $forms ) );
				
				// choose form to configure
				update_option( $shortname . '_contact_form_choosen', $new_form );
				
				// create fields
				update_option( $shortname . '_contact_fields_' . $new_form, get_option( $shortname . '_default_contact_form' ) );
                                                            
        		$url = "$_SERVER[PHP_SELF]?page=$_GET[page]&tab=$tab&message=saved"; 
        		if( !$ajax ) 
        			wp_redirect( $url );
        		else
        			echo $url;
        		die;
			}   
		}            
			
		if( !isset( $_REQUEST['action'] ) )
			return;
	    
		if ( 'save' == $_REQUEST['action'] ) 
        {        
            foreach($vars as $section => $options)
            {
                foreach($options as $value)
                {      
					// go next if is been set a specific option to save  
                	if( $solo != false AND $value['id'] != $solo )
                		continue;
                	
					// check if there is a cols key, to specific more values for the same var
        			$n = 1;
        			if( array_key_exists('cols', $value) )
        			{
                        $n = $value['cols'];
                    }
                    
                    for($i=1;$i<=$n;$i++)
                    {                                        
                        $ext = ($n > 1) ? "_$i" : '';
                        $val = $value['id'] . $ext;
                        
//                         echo '<pre>';
//                         print_r($value["control"]);
//                         echo '</pre>';
                        
                        if( isset( $_REQUEST[ $val ] ) AND $_REQUEST[ $val ] != '' ) 
                        {          
                            if( array_key_exists( 'data', $value ) AND $value['data'] == 'array' )
		                    {    	
		                    	if( !array_key_exists( 'control', $value ) OR ( array_key_exists( 'control', $value ) AND !array_key_exists( strtolower( str_replace( ' ', '_', $_REQUEST[ $value['id'] ] ) ), $value['control'] ) ) )
		                    	{
			                    	$data_array = get_option( $value['id'] );
			                    	
									if( $data_array AND $data_array != '' )
										$value_array = maybe_unserialize( $data_array ); 
									else
										$value_array = array(); 
									
									if( array_key_exists( 'mode', $value ) AND $value['mode'] == 'merge' )
										$value_array[] = $_REQUEST[ $value['id'] ];
									else
										$value_array = $_REQUEST[ $value['id'] ];
									
									update_option( $val, serialize( yiw_cleanArray( $value_array ) ) );    
								}
								else
								{
									$url = "$_SERVER[PHP_SELF]?page=$_GET[page]&message=element_exists";
									if( !$ajax ) 
										wp_redirect( $url );
									else
										echo $url;
									die;
								}
							}
                            elseif( is_array($_REQUEST[ $val ]) )
                            {
                				$cats = "-1";
                                
                				foreach($_REQUEST[ $val ] as $cat)
                                {
                					$cats .= "," . $cat;
                				}
                				
                                update_option( $val, str_replace("-1,", "", $cats) );
                            }
							else
							{
                            	update_option( $val, $_REQUEST[ $value['id'] ]  ); 
                            }
                        } 
                        else 
                        { 
                            if( !array_key_exists( 'data', $value ) OR $value['data'] != 'array' ) 
								delete_option( $val ); 	
                        } 
                    }
                }
            }
                                                            
			$url = "$_SERVER[PHP_SELF]?page=$_GET[page]&tab=$tab&message=saved"; 
			if( !$ajax ) 
				wp_redirect( $url );
			else
				echo $url;
			die;
        } 
        else if( 'reset' == $_REQUEST['action'] ) 
        {
            foreach($vars as $section => $options)
            {
                foreach ($options as $value) 
                {
                    if( !array_key_exists( 'noreset', $value ) OR ( array_key_exists( 'noreset', $value ) AND !$value['noreset'] ) )	
						delete_option( $value['id'] ); 
                }
            }
                          
            $url = "$_SERVER[PHP_SELF]?page=$_GET[page]&tab=$tab&message=reset";
			if( !$ajax ) 
				wp_redirect( $url );
			else
				echo $url;
			die;
        }
        else if( 'update-array' == $_REQUEST['action'] ) 
        {   
			$value_array = unserialize( get_option( $_REQUEST['id'] ) );
			$value_array[ $_REQUEST['c'] ] = $_REQUEST[ $_REQUEST['id'] ];
			                                                    
			//print_r($value_array);
			update_option( $_REQUEST['id'], serialize( $value_array ) );
			
			$url = "$_SERVER[PHP_SELF]?page=$_GET[page]&tab=$tab&message=updated";   
			if( !$ajax ) 
				wp_redirect( $url );
			else
				echo $url;
			die;
        }
		elseif( 'delete' == $_REQUEST['action'] )
		{         
            foreach($vars as $section => $options)
            {
                foreach ($options as $value) 
                {
					// check if passed delete mode on querystr, to delete specific vars
					if( isset( $_GET[ $value[ $_GET[ 'key' ] ] ] ) )
					{
						$value_array = unserialize( get_option( $value[ $_GET[ 'key' ] ] ) );
						unset( $value_array[ $_GET[ $value[ $_GET[ 'key' ] ] ] ] );
						                                                    
						//print_r($value_array);
						update_option( $value[ $_GET[ 'key' ] ], serialize( $value_array ) );
						
						$url = "$_SERVER[PHP_SELF]?page=$_GET[page]&tab=$tab&message=delete";   
						if( !$ajax ) 
							wp_redirect( $url );
						else
							echo $url;
						die;
					}
                }
            }
		} 
		elseif( 'array-ord' == $_REQUEST['action'] AND isset( $_REQUEST['id'] ) AND isset( $_REQUEST['dir'] ) AND isset( $_REQUEST['from'] ) )
		{         
			$a = maybe_unserialize( get_option( $_REQUEST['id'], array() ) );
			
			if( empty( $a ) )
				return;
			
            $el1 = $_REQUEST['from'];
            
            $offset = 1;
            if( $_REQUEST['dir'] == 'up' )
            	$offset *= -1;
            
			$el2 = $el1 + $offset;
			
			// change
			$temp = $a[ $el1 ];
			$a[ $el1 ] = $a[ $el2 ];
			$a[ $el2 ] = $temp;
			
			update_option( $_REQUEST['id'], serialize( $a ) );  
						
			$url = "$_SERVER[PHP_SELF]?page=$_GET[page]&tab=$tab&message=ord";   
			if( !$ajax ) 
				wp_redirect( $url );
			else
				echo $url;
			die;
		}                          
    }
    elseif ( isset( $_GET['page'] ) AND $_GET['page'] == 'install' )
    {                       
		if( !isset( $_REQUEST['action'] ) )
			return;
			
		if( 'export' == $_REQUEST['action'] )
		{
			$export = export_theme();
			$export_size = strlen( $export['content'] );
			
			header("Content-type: application/gzip-compressed");
			header("Content-Disposition: attachment; filename=$export[filename]");
			header("Content-Length: $export_size");                           
			header("Content-Transfer-Encoding: binary");
 			header('Accept-Ranges: bytes');         
			 
			/* The three lines below basically make the 
			    download non-cacheable */
			header("Cache-control: private");
			header('Pragma: private');
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			
			echo $export['content'];
			die;
		}
	}
}               
add_action( 'admin_init', 'init_panel' );


function yiw_add_init() 
{
    $file_dir = get_template_directory_uri()."/admin-options/include";
                                                                                                    
    wp_enqueue_style( "functions", $file_dir."/functions.css", false, "1.0", "all" );
	wp_enqueue_style( "iphone-style-checkboxes", $file_dir."/iphone-style-checkboxes.css", false, "1.0", "all" );
    wp_enqueue_style( "jquery-ui-overcast", $file_dir."/overcast/jquery-ui-1.8.9.custom.css", false, "1.8.8", "all" );   
    wp_enqueue_style( "wp-admin" );
    add_thickbox();
    wp_enqueue_style( "farbtastic" );                                           
    //wp_admin_css( 'widgets' );        
		
	$deps = array(
		'jquery',     
		'jquery-ui-custom',   
		//'jquery-ui-sortable',  
		//'jquery-ui-draggable', 
		//'jquery-ui-droppable',  
		//'admin-widgets',
		'media-upload', 
		'thickbox', 
		'farbtastic' 
	);
	
	wp_deregister_script( 'jquery-ui-core' );
	wp_deregister_script( 'jquery-ui-sortable' );
	wp_deregister_script( 'jquery-ui-draggable' );
	wp_deregister_script( 'jquery-ui-droppable' );
                                                                                                                                            
    wp_enqueue_script( "jquery-ui-custom", $file_dir."/jquery-ui-1.8.9.custom.min.js", array(), '1.8.9', true );                              
    wp_enqueue_script( 'farbtastic');                                 
    wp_enqueue_script( "rm_script", $file_dir."/rm_script.js", $deps, '1.0', true );
    wp_enqueue_script( "iphone-style-checkboxes", $file_dir."/iphone-style-checkboxes.js", '1', true );  
}                   
if ( isset( $_GET['page'] ) AND ( $_GET['page'] == 'yiw_panel' ) ) 
	add_action('admin_init', 'yiw_add_init');   
   
function yiw_panel()
{
    global $options;
    
    $tab = 'general';
    
    if( isset( $_GET['tab'] ) )
        $tab = $_GET['tab'];
    
    yiw_admin( $options[ $tab ] );
}                                                  

function yiw_admin($vars) 
{
    global $themename, $shortname, $options, $submenu_items;
    
    $i = $show_form = 0;
    
    //if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved', TEXTDOMAIN).'.</strong></p></div>';
    //if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings reset', TEXTDOMAIN).'.</strong></p></div>';                    
    
    yiw_message();      
    
    $current_tab = 'general';
    if( isset( $_GET['tab'] ) )
    	$current_tab = $_GET['tab'];
    
    foreach($vars as $section => $values) 
    {
        foreach($values as $value)
        {
            if( !isset( $value['std'] ) )
                $value['std'] = '';
            
            switch ( $value['type'] ) 
            {
            
                // ================== OPEN =====================
                case "open":
                ?>
                
                <?php break;     
                
                
                // ================== SECTION =====================
                case "section":
                
                $i++;
                
                if( array_key_exists( 'effect', $value ) AND !$value['effect'] )
                {
                	$class_effect = '';         
                	$class_img = 'noeffect';   
                }
                else
                {
                	$class_effect = ' section_effect';
                	$class_img = 'inactive';
                }
                
                $img = '<img src="' . get_template_directory_uri() . '/admin-options/include/images/trans.png" class="'.$class_img.'" alt="">';
                
                if( array_key_exists( 'valueButton', $value ) )
                	$valueButton = __($value['valueButton'], TEXTDOMAIN);
                else
                	$valueButton = __('Save changes', TEXTDOMAIN);	
                
                ?>
                
                    <div class="rm_section<?php echo $class_effect ?>">
                    <div class="rm_title">
						<h3><?php echo $img . $value['name']; ?></h3>
						
						<?php if( !array_key_exists( 'show-submit', $value ) OR ( array_key_exists( 'show-submit', $value ) AND $value['show-submit'] ) ) : ?>
						<span class="submit">
							<input type="submit" value="<?php echo $valueButton ?>" />  
                    	</span>
                    	<?php endif ?>
						
						<div class="clearfix"></div>
					</div>
                    <div class="rm_options">
                
                
                <?php break;   
                
                
                // ================== CLOSE =====================
                case "close":
                ?>
                
                        </div>
                    </div>
                    <br />
                
                
                <?php break;
                
                
                // ================== TITLE =====================
                case "title":
                ?>
                    <!--<p><?php _e('To easily use the '.$themename.' theme, you can use the menu below.', TEXTDOMAIN) ?></p>--> 
    
                    <div class="wrap rm_wrap">   
                    
                    <div id="icon-options-general" class="icon32"><br></div>
                    <h2><?php echo $value['name']; ?></h2>  
                    <br />                                                       
    
                    <div class="rm_tabmenu">
                    
                        <ul id="sidemenu">
                            <?php foreach( $submenu_items as $tab => $tab_value ) : $current = ( ( isset( $_GET['tab'] ) AND $_GET['tab'] == $tab ) OR ( !isset( $_GET['tab'] ) AND $tab == 'general' ) ) ? ' class="current"' : ''; ?>
                            <li><a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $tab ?>"<?php echo $current ?>><?php echo $tab_value ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div class="rm_opts">
                    
                    <?php if ( !isset( $value['showform'] ) OR $value['showform'] ) $show_form = true; ?>
                    
                    <?php if( $show_form ) : ?>
                    <form method="post" action="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>">  
                    <?php endif; ?>                                       
                
                
                <?php break;
                
                
                // ================== ECHO TEXT =====================
                case 'show-text':
                	
                	// if button copy
                	$before_text = $after_text = $button = '';
					if( isset( $value['copy-button'] ) AND $value['copy-button'] )
					{
						$before_text = '<div class="copy-text">';
						$after_text = '</div>';
						$button = '<a href="#" class="button-secondary copy-to-clipboard">' . __( 'Copy to clipboard', TEXTDOMAIN ) . '</a>';
					}
                ?>
                
                    <div class="rm_input rm_text">
                        <label><?php echo $value['name']; ?></label>
                        <textarea type="text" style="width:340px;height:28px;" class="copy-text"><?php echo $value['text'] ?></textarea> <?php echo $button ?>
						
						<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    </div>
                <?php
                    break;
                
                
                // ================== TEXT =====================
                case 'text':
                ?>
                
                    <div class="rm_input rm_text">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        <input name="<?php echo $value['id']; ?>" 
							   id="<?php echo $value['id']; ?>" 
							   type="<?php echo $value['type']; ?>" 
							   <?php if( !array_key_exists( 'show_value', $value ) OR $value['show_value'] ) : ?>
							   value="<?php echo stripslashes_deep( get_option( $value['id'], $value['std'] ) ); ?>"
							   <?php endif ?>
							   <?php if( array_key_exists( 'button', $value ) ) : ?>style="width:240px;" <?php endif ?>/>
                        
						<?php if( array_key_exists( 'button', $value ) ) : ?>
						<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php echo $value['id']; ?>_save" id="<?php echo $value['id']; ?>_save">
						<?php endif ?>
                        
						<?php if( array_key_exists( 'action', $value ) ) : ?>
						<input type="hidden" name="secondary-action" value="<?php echo $value['action']; ?>" />
						<?php endif ?>
						
						<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    </div>
                <?php
                    break;
                
                
                // ================== TEXTAREA =====================
                case 'textarea':
                ?>
                
                    <div class="rm_input rm_textarea">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows="" class="listdata form-input-tip"><?php echo stripslashes_deep( get_option( $value['id'], $value['std'] ) ); ?></textarea>
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    </div>
                
                <?php
                    break;
                
                
                // ================== SELECT =====================
                case 'select':
                ?>
                
                    <div class="rm_input rm_select">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        
                        <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" <?php if( array_key_exists( 'button', $value ) ) : ?>style="width:240px;" <?php endif ?>>
                            <?php foreach ($value['options'] as $val => $option) { ?>
                                <option value="<?php echo $val ?>" <?php selected( get_option( $value['id'], $value['std'] ), $val ) ?>><?php echo $option; ?></option>
                            <?php } ?>
                        </select>                          
                        
						<?php if( array_key_exists( 'button', $value ) ) : ?>
						<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php echo $value['id']; ?>_save" id="<?php echo $value['id']; ?>_save">
						<?php endif ?>
                        
                        <small><?php echo $value['desc']; ?></small>
                        <div class="clearfix"></div>
                    </div>
                <?php
                    break;
                
                
                // ================== RADIO=====================
                case 'radio':
                ?>
                
                    <div class="rm_input">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        
                        <div class="rm_radio">
                        <?php foreach ($value['options'] as $val => $option) { ?>
                        	<label class="radio-inline">
                            	<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php echo $val ?>" <?php checked( get_option( $value['id'], $value['std'] ), $val ) ?> /> <?php echo $option ?>
                        	</label>
						<?php } ?>    
						</div>  
                        
                        <small><?php echo $value['desc']; ?></small>
                        <div class="clearfix"></div>
                    </div>
                <?php
                    break;
                
                
                // ================== CHECKBOX =====================
                case "checkbox":
                ?>
                
                    <div class="rm_input rm_checkbox">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        
                        <?php if( get_option( $value['id'], $value['std'] ) ){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        
                        
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    </div>
                <?php break;      
                
                
                // ================== BUTTON =====================
                case 'button':
                ?>
                
                    <div class="rm_input rm_text">
                        <label><?php echo $value['name']; ?></label>
                        
						<input type="submit" value="<?php echo $value['label']; ?>" class="button" />
						<input type="hidden" name="secondary-action" value="<?php echo $value['action']; ?>" />
						
						<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    </div>
                <?php
                    break;
                
                
                // ================== ON / OFF =====================
                case "on-off":
                ?>
                
                    <div class="rm_input rm_on_off">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        
                        <?php if( get_option( $value['id'] ) !== FALSE ){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
                        <div class="iphone-check"><input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="1" <?php echo $checked; ?> class="on_off" /></div>
                        
                        
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    </div>
                <?php break; 
                
                
                // ================== SLIDER CONTROL =====================
                case "slider_control":
                ?>
                
                    <div class="rm_input slider_control">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        
                        <?php $labels = ( array_key_exists( 'label', $value ) ) ? ' ' . $value['label'] : '' ?>
                        
                        <div class="ui-slider">
                            <span class="minCaption"><?php echo $value['min'] . $labels ?></span>
                            <span class="maxCaption"><?php echo $value['max'] . $labels ?></span>
                            <span id="feedback-<?php echo $value['id'] ?>" class="feedback"><strong><?php echo get_option( $value['id'], $value['std'] ) . $labels ?></strong></span>
                            <div id="<?php echo $value['id'] ?>" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                <input type="hidden" name="<?php echo $value['id'] ?>" value="<?php echo get_option( $value['id'], $value['std'] ); ?>" />
                            </div> 
                        </div> 
                        
                        <script type="text/javascript">
                            jQuery(document).ready(function($){
                                $('#<?php echo $value['id'] ?>').each(function(e){
                                    var val = <?php echo get_option( $value['id'], $value['std'] ); ?>; 
                                    var minValue = <?php echo $value['min'] ?>; 
                                    var maxValue = <?php echo $value['max'] ?>; 
                                    $(this).slider({
                                        value: val,
                                        min: minValue,
                                        max: maxValue,
                                        range: 'min',
                                        <?php if( array_key_exists( 'step', $value ) ) : ?>
                                        step: <?php echo $value['step'] ?>,
                                        <?php endif ?>
                                        slide: function( event, ui ) {
                                			$( 'input[name="<?php echo $value['id'] ?>"]' ).val( ui.value );
                                			$( '#feedback-<?php echo $value['id'] ?> strong' ).text( ui.value + '<?php echo $labels ?>' );
                                		}
                                    });
                                });
                            });
                        </script>
                        
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    </div>
                <?php break;   
                 
                 
                 // ================ EXCLUDE CATEGORIES ============
                case "cat":
                
                ?>
                
    			<div class="rm_input rm_multi_checkbox">
                    <?php
    				
                    $cats = get_categories('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0');
    						             
                    $class = $descr = $ext = '';
                    $cols = 1;      
    				if(array_key_exists('cols', $value) && $value['cols'])	
                    {
                        $heads = FALSE;
                        if(array_key_exists('heads', $value))
                        {
                            $heads = TRUE;    
                        }
                        $cols = $value['cols'];
                        $class = ' small';
                        if($cols > 1) $descr = "<small>$value[desc]</small>";
                    }	?>
                                                                                                          
        	        <label for="<?php echo $value['id'] . $ext; ?>"><?php echo $value['name'] . $descr; ?></label>
                    
                    <?php for($i=1;$i<=$cols;$i++) : $ext = ($cols > 1) ? "_$i" : '' ?>                           
                        <ul id="<?php echo $value['id'] . $ext; ?>" class="list-sortable<?php echo $class ?>">  
        				
                        <?php		                                
                
    			        $selected_cats = explode(",", get_option($value['id'] . $ext));
                        
                        if($heads) echo '<li class="head">'.$value['heads'][$i-1].'</li>';
                        
                        $c = 0;
        				foreach($cats as $cat) { 
                    
                            foreach ($selected_cats as $selected_cat) 
                            {
        	                    if($selected_cat == $cat->cat_ID){ $checked = "checked=\"checked\""; break; }else{ $checked = "";}				
            	            }?>
                        
                        	<li>
                                <input type="checkbox" name="<?php echo $value['id'] . $ext; ?>[]" value="<?php echo $cat->cat_ID; ?>" <?php echo $checked; ?> id="<?php echo $value['id']; ?>-<?php echo $c . $ext ?>" />&nbsp;
                                <label for="<?php echo $value['id']; ?>-<?php echo $c . $ext ?>" class="label-check"><?php echo $cat->cat_name; ?></label>
                            </li>
                        <?php $c++;	}  ?>
                        </ul>
                    <?php endfor ?>
                	<?php if($cols <= 1) : ?><small><?php echo $value['desc']; ?></small><?php endif ?><div class="clearfix"></div>
                </div>
                 
                <?php break;
                 
                 
                 // ================ EXCLUDE PAGES ============
                case "pag":
                
                $pags = get_pages('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0');
                
                $selected_pags = explode(",", get_option($value['id']));
                ?>
    			<div class="rm_input rm_multi_checkbox">
    	            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <ul>
                    <?php $c = 0 ?>
    	            <?php foreach($pags as $pag) { 
                    
        	            foreach ($selected_pags as $selected_pag) {
            	            if($selected_pag == $pag->ID){ $checked = "checked=\"checked\""; break; }else{ $checked = "";}				
                	    }?>
                
    	                <li><input type="checkbox" name="<?php echo $value['id']; ?>[]" value="<?php echo $pag->ID; ?>" <?php echo $checked; ?> id="<?php echo $value['id']; ?>-<?php echo $c ?>" />&nbsp;
                        <label for="<?php echo $value['id']; ?>-<?php echo $c ?>" class="label-check"><?php echo $pag->post_title; ?></label></li>
    	            <?php $c++; } ?>		
                    </ul>
                	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                </div>
                             
                <?php break;
                
                
                // ================== UPLOAD =====================
                case 'upload':
				                	
				    $id_image = 0;
				    
                	if( $upload = get_option( $value['id'] ) )
                	{	
                		$upload = unserialize( $upload );
						$url_image = $upload['url'];
						$id_image = $upload['id'];
					}
                	
                	if( !$upload OR $url_image == '' ) $url_image = $value['std']; 
                ?>
                
                    <div class="rm_input rm_text rm_upload">
                        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                        <div style="float:left; width:280px">    
                            <input type="text" name="<?php echo $value['id']; ?>[url]" id="<?php echo $value['id']; ?>-url" value="<?php echo $url_image ?>" /><br/>      
							<input type="hidden" name="<?php echo $value['id'] ?>[id]" id="<?php echo $value['id']; ?>-id" value="<?php echo $id_image ?>" class="idattachment" />
                            <input type="button" value="<?php _e('Upload Image', TEXTDOMAIN) ?>" id="<?php echo $value['id']; ?>-button" />
                        </div>
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    
                    </div>
                <?php
                    break;
                
                
                // ================== COLOR-PICKER =====================
                case 'color-picker':
                ?>
                
                    <div class="rm_input rm_color">                                                   
                        <div class="double">    
                            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                            <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo trim( stripslashes_deep( get_option( $value['id'], $value['std'] ) ) ); ?>" />
                            &nbsp;<img src="<?php echo get_template_directory_uri() ?>/admin-options/include/images/color_picker.png" alt="Color Picker" class="colorpicker-icon" /><br/>          
                            <div class="clearfix"></div>
                        </div>                                      
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                        <div class="colorpicker"></div>
                        <div class="clearfix"></div>
                    </div>
                <?php
                    break;
                
                
                // ================== TABLE SIDEBAR =====================
                case 'sidebar-table':
                	$i = 0;
                ?>
                
                    <div class="rm_input rm_sidebar"> 
                        <label><?php echo $value['name']; ?></label>
                        
                        <?php 
                        	$sidebars = get_option( $value['values'] );
                        	
                        	if( !is_array( $sidebars ) )
								$sidebars = unserialize( get_option( $value['values'] ) );
						?>
                        
						<table class="cc-options">
    						<tbody>                       
                                                                                 
                        	<?php if( is_array( $sidebars ) AND !empty( $sidebars ) ) : ?>
                        		
								<?php foreach( $sidebars as $id => $sidebar ) : ?>
								<tr>
						            <td>                                          
							            <div class="delete-btn"><a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=delete&<?php echo $value['values'] ?>=<?php echo $id ?>&key=values" title="<?php _e( 'Delete', TEXTDOMAIN ) ?>"><img src="<?php echo get_template_directory_uri() ?>/admin-options/include/images/close_16.png" alt="<?php _e( 'Delete', TEXTDOMAIN ) ?>" /></a></div>
							            <div class="name"><?php echo $sidebar ?></div>
							            <div class="loading-icon"><img alt="" src="<?php bloginfo('siteurl') ?>/wp-admin/images/wpspin_light.gif" style="display: none;" class="waiting"></div>
						            </td>
						        </tr>                                  
						        <?php endforeach ?> 
						
							<?php else : ?>
								
								<tr><td><?php _e( sprintf( 'No %s created!', strtolower( $value['label'][1] ) ) ) ?></td></tr>
						
							<?php endif ?>
					                                              
					        </tbody>
						</table>
						          
                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                    </div>
                <?php
                    break;    
                
                
                // ================== TABLE-SLIDES =====================
                case 'slides-table':
                	$value_array = get_option($value['id']);
                	
                	if( $value_array AND !is_array( $value_array ) )
						$value_array = subval_sort( unserialize( $value_array ), 'order' );
					if( !$value_array )
						$value_array = array();
					
					//echo '<pre>';
					//print_r( yiw_cleanArray($value_array) );
					//echo '</pre>';
					
					array_push( $value_array, array() );
					
					$config = explode( ',', str_replace(" ", "", $value['config']) );
                ?>
                
                    <div class="rm_input rm_slides">        
						<ul id="SlideShow">
							
							<?php foreach( $value_array as $id => $field ) : ?>
							<li class="isSortable slide-item noNesting">
								<div class="sortItem">              
									<table width="100%" cellspacing="0" cellpadding="3">
										<tbody>
											<tr>
												<td class="handle">
													<br/>
													&nbsp;<strong>Order:</strong>
													<input type="text" name="<?php echo $value['id'] ?>[<?php echo $id ?>][order]" class="item_order_value" id="item_order_<?php echo $id ?>" value="<?php echo $id ?>" />
													<div></div>
												</td>
												<td>  
													<?php if( isset( $field['content_type'] ) AND in_array('video', $config) AND $field['content_type'] == 'video' ) : ?>                                                      
													<div class="ss-ImageSample"><?php echo stripslashes_deep( $field['code_video'] ) ?></div>
													<?php else: ?>                      
													<img class="ss-ImageSample" src="<?php echo isset( $field['image_url'] ) ? $field['image_url'] : '' ?>">
													<?php endif ?>
													<table width="100%" cellspacing="5" cellpadding="0">
														<tbody>
															<?php if( in_array('title', $config) ) : ?>
															<tr>
																<td colspan="4">&nbsp;<strong><?php _e('Slide Title', TEXTDOMAIN) ?>:</strong><br> 
																	<input type="text" value="<?php echo isset( $field['slide_title'] ) ? $field['slide_title'] : '' ?>" alt="<?php _e('Slide Title', TEXTDOMAIN) ?>" class="ss-ImageTitle" name="<?php echo $value['id'] ?>[<?php echo $id ?>][slide_title]">
																</td>
															</tr>
															<?php endif ?>                
															<?php if( in_array('caption', $config) ) : ?>
															<tr>
																<td colspan="4">&nbsp;<strong><?php _e('Tooltip Content', TEXTDOMAIN) ?></strong> <em class="small">(<?php _e('HTML Tags allowed', TEXTDOMAIN) ?>)</em><br>
																	<textarea alt="<?php _e('Tooltip Content', TEXTDOMAIN) ?>" class="ss-ImageDesc" name="<?php echo $value['id'] ?>[<?php echo $id ?>][tooltip_content]" type="text"><?php echo isset( $field['tooltip_content'] ) ? stripslashes( $field['tooltip_content'] ) : '' ?></textarea>
																</td>
															</tr>                                   
															<?php endif ?>                
															<?php if( in_array('image', $config) ) : ?>
															<tr>
																<td align="left" colspan="3" class="rm_upload">
																	&nbsp;<input type="radio" name="<?php echo $value['id'] ?>[<?php echo $id ?>][content_type]" id="<?php echo $value['id'] ?>-contentimage-<?php echo $id ?>" value="image"<?php if( !isset( $field['content_type'] ) OR ( $field['content_type'] == '' OR $field['content_type'] == 'image' ) ) : ?> checked=""<?php endif ?> /> 
																	<label for="<?php echo $value['id'] ?>-contentimage-<?php echo $id ?>" style="color:#333;float:none;display:inline;line-height:1em;">
																		<strong><?php _e('Image URL', TEXTDOMAIN) ?>:</strong>
																	</label><br>
																	<input type="text" alt="<?php _e('Image URL', TEXTDOMAIN) ?>" class="ss-Image" name="<?php echo $value['id'] ?>[<?php echo $id ?>][image_url]" value="<?php echo isset( $field['image_url'] ) ? $field['image_url'] : '' ?>" />
																	<input type="button" value="<?php _e('Upload Image', TEXTDOMAIN) ?>" id="<?php echo $value['id']; ?>-upload" />
																	<input type="hidden" name="<?php echo $value['id'] ?>[<?php echo $id ?>][image_id]" value="<?php echo isset( $field['image_id'] ) ? $field['image_id'] : '' ?>" class="idattachment" />
																</td>
															</tr>              
															<?php endif ?>               
															<?php if( in_array('video', $config) ) : ?>
															<tr>
																<td align="left" colspan="3">
																	&nbsp;<input type="radio" name="<?php echo $value['id'] ?>[<?php echo $id ?>][content_type]" id="<?php echo $value['id'] ?>-contentvideo-<?php echo $id ?>" value="video"<?php if( $field['content_type'] == 'video' ) : ?> checked=""<?php endif ?> /> 
																	<label for="<?php echo $value['id'] ?>-contentvideo-<?php echo $id ?>" style="color:#333;float:none;display:inline;line-height:1em;">
																		<strong><?php _e('Code Video', TEXTDOMAIN) ?>:</strong>
																	</label>
																	<em class="small">(<?php _e( sprintf( 'NB: paste code with about %s video size.', $value['videoSize'] ), TEXTDOMAIN) ?>)</em><br>
																	<textarea alt="<?php _e('Code Video', TEXTDOMAIN) ?>" class="ss-ImageDesc" name="<?php echo $value['id'] ?>[<?php echo $id ?>][code_video]" type="text"><?php echo stripslashes_deep( $field['code_video'] ) ?></textarea>
																</td>
															</tr>              
															<?php endif ?>                
															<tr>
																<td colspan="2" align="left" style="white-space: nowrap;">  
																	<?php if( in_array('link', $config) ) : ?>
																	<br/>
																	<label style="color:#333">&nbsp;<strong><?php _e('Slide Link', TEXTDOMAIN) ?>:</strong></label>
																	
																	<?php $types = array(	'page' => __('page', TEXTDOMAIN), 
																							'category' => __('category', TEXTDOMAIN), 
																							//'post' => __('post', TEXTDOMAIN),
																							'url' => __('url', TEXTDOMAIN),
																							'none' => __('none', TEXTDOMAIN) ) ?>
																	
																	<?php 
																		$check = FALSE;
																		foreach($types as $type => $title_type) :  
																			if( ( ( isset( $field['link_type'] ) AND $field['link_type'] == $type ) OR $type == 'none' ) AND !$check ) 
																			{
																				$checked_class = 'checked ';
																				$checked = 'checked ';
																				$check = TRUE;
																			} 
																			else
																			{
																				$checked_class = '';
																				$checked = '';
																			}
																	?>
																	<label class="<?php echo $checked_class ?>radioLink" for="<?php echo $value['id'] . '-' . $id . '-' . $type; ?>">
																		<input type="radio" value="<?php echo $type ?>" id="<?php echo $value['id'] . '-' . $id . '-' . $type; ?>" name="<?php echo $value['id']; ?>[<?php echo $id ?>][link_type]" <?php echo $checked ?>/>&nbsp;<?php echo ucfirst($title_type) ?>
																	</label>
																	<?php endforeach ?>
																	
																	<?php foreach($types as $type => $title_type) : 
																			if( isset( $field['link_type'] ) AND $field['link_type'] == $type ) 
																			{
																				$checked = 'style="display: block;" ';
																			} 
																			else
																			{
																				$checked = '';
																			} 
																			
																			switch($type) {
																	
																	case 'page' : ?>		
																	<?php $pags = get_pages('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0'); ?>					
																	<select <?php echo $checked ?>name="<?php echo $value['id']; ?>[<?php echo $id ?>][link_page]" class="ss-Link <?php echo $type ?>">
																		<option value=""><?php _e('Choose a page...', TEXTDOMAIN) ?></option>
																		<?php foreach( $pags as $page ) : $selected = ( isset( $field['link_page'] ) AND $page->ID == $field['link_page'] ) ? ' selected="selected"' : '' ?>
																		<option value="<?php echo $page->ID ?>"<?php echo $selected ?>><?php echo $page->post_title ?></option>
																		<?php endforeach ?>
																	</select>
																	<?php break; ?>
																	
																	<?php case 'category' : ?>
																	<select <?php echo $checked ?>name="<?php echo $value['id']; ?>[<?php echo $id ?>][link_category]" class="ss-Link <?php echo $type ?>">
																		<?php foreach( $GLOBALS['wp_cats'] as $slug => $cat ) : $selected = ( isset( $field['link_category'] ) AND $slug == $field['link_category'] ) ? ' selected="selected"' : '' ?>
																		<option value="<?php echo $slug ?>"<?php echo $selected ?>><?php echo $cat ?></option>
																		<?php endforeach ?>
																	</select>			
																	<?php break; ?>
																	
																	<?php case 'post' : $list_posts = new WP_Query() ?>
																	<select <?php echo $checked ?>name="<?php echo $value['id']; ?>[<?php echo $id ?>][link_post]" class="ss-Link <?php echo $type ?>">
																		<?php while( $list_posts->have_posts() ) : $list_posts->the_post(); $selected = ( get_the_ID() == $field['link_post'] ) ? ' selected="selected"' : '' ?>
																		<option value="<?php the_ID() ?>"<?php echo $selected ?>><?php the_title() ?></option>
																		<?php endwhile ?>
																	</select>			
																	<?php break; ?>
																	
																	<?php case 'url' : ?>											
																	<input type="text" <?php echo $checked ?>class="ss-Link <?php echo $type ?>" value="<?php echo isset( $field['link_url'] ) ? $field['link_url'] : '' ?>" name="<?php echo $value['id']; ?>[<?php echo $id ?>][link_url]" />
																	<?php break; ?>
																	
																	<?php } endforeach; ?>
																<?php endif ?>
																</td>
																<td width="90" align="center" class="delete-button">
																	<div class="button-secondary delete-item"><a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=delete&<?php echo $value['id'] ?>=<?php echo $id ?>&key=id"><?php _e('Delete', TEXTDOMAIN) ?></a></div>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</li>
							<?php endforeach ?>
										
						</ul>
                    </div>
                <?php
                    break;          
                
                
                // ================== TABLE CONTACT =====================
                case 'contact-table':
                	
                	$contact_form = get_option( $shortname . '_contact_form_choosen' );
                	
                	$fields = maybe_unserialize( get_option( $value['id'] ) );  
					
					//echo '<pre>', print_r($fields), '</pre>';
                ?>
                
                    <div class="rm_input rm_contact">
					
						<p>
							<a href="<?php echo get_panel_url() ?>/include/contact_add.php?id=<?php echo $value['id'] ?>&action=new-field&page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&TB_iframe=true" class="button-primary thickbox">Add field</a>
						</p> 
                    
					    <table class="wp-list-table widefat fixed posts" cellpadding="0">
					    	<thead>
					    		<tr>                                                     
					    			<th scope="col" class="name-field"><?php _e( 'Field Title', TEXTDOMAIN ) ?></th>
					    			<th scope="col" class="info-field"><?php _e( 'Data Name', TEXTDOMAIN ) ?></th>
					    			<th scope="col" class="info-field"><?php _e( 'Required', TEXTDOMAIN ) ?></th>
					    			<th scope="col"><?php _e( 'Type', TEXTDOMAIN ) ?></th>      
					    			<th scope="col" class="controls-field">&nbsp;</th>
								</tr>	
					    	</thead>
					    	<tbody>
					    	
							<?php if( !empty( $fields ) ) : ?>	
					    		<?php foreach( $fields as $id => $field ) : ?>
								<tr<?php if( $id % 2 ) echo ' class="alternate"'; ?> valign="top">             
					    			<th class="name-field" scope="row"><?php echo stripslashes_deep( $field['title'] ) ?></th>
					    			<td class="info-field"><?php echo stripslashes_deep( $field['data_name'] ) ?></td>
					    			<td class="info-field"><?php echo ( isset( $field['required'] ) AND $field['required'] == 'yes' ) ? __( 'Yes', TEXTDOMAIN ) : __( 'No', TEXTDOMAIN ) ?></td>
					    			<td><?php echo $field['type'] ?></td>
					    			<td class="controls-field">      
										<span class="items-ord">                          
											<?php if( $id != 0 ) : ?>
											<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=array-ord&id=<?php echo $value['id'] ?>&dir=up&from=<?php echo $id ?>" class="item-move-up"><abbr title="<?php _e( 'Move up', TEXTDOMAIN ) ?>">&#8593;</abbr></a>   
											<?php else: ?>
											&nbsp;
											<?php endif; ?> 
											|                                     
											<?php if( $id != count( $fields ) - 1 ) : ?>
											<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=array-ord&id=<?php echo $value['id'] ?>&dir=down&from=<?php echo $id ?>" class="item-move-down"><abbr title="<?php _e( 'Move down', TEXTDOMAIN ) ?>">&#8595;</abbr></a>   
											<?php else: ?>
											&nbsp;
											<?php endif; ?>                                                                 
										</span>
										<a href="<?php echo get_panel_url() ?>/include/contact_add.php?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&id=<?php echo $value['id'] ?>&c=<?php echo $id ?>&action=edit-field&TB_iframe=true" title="<?php _e( 'Edit', TEXTDOMAIN ) ?>" class="button-primary thickbox"><?php _e( 'Edit', TEXTDOMAIN ) ?></a>
										<a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=delete&key=id&<?php echo $value['id'] ?>=<?php echo $id ?>&TB_iframe=true" title="<?php _e( 'Delete', TEXTDOMAIN ) ?>" class="button-secondary"><?php _e( 'Delete', TEXTDOMAIN ) ?></a>
									</td>
					    		</tr>
					    		<?php endforeach ?>
					    	<?php else : ?>
					    		<tr>
					    			<td colspan="4"><?php _e( 'No fields created yet.', TEXTDOMAIN ) ?></td>
					    		</tr>
					    	<?php endif ?>
					    		
					    	</tbody>
						</table>
						    
                    </div>
                <?php
                    break; 
                
                
                // ================== INCLUDE =====================
                case 'include':
                	
                	if ( file_exists( $value['file'] ) )
                	   include $value['file'];
                	   
                    break; 
                                           
                }
            }
        }
    ?>
    
    <?php if ( $show_form ) : ?>                                                                                                             
        <input type="hidden" name="action" value="save" />
        <input type="submit" value="<?php _e( 'Save changes', TEXTDOMAIN ) ?>" class="button-primary" style="float:left;" />
    </form>
    
    <form method="post">
        <div class="submit">
        	<?php $warning = __( 'If you continue with this action, you will reset all options are in this page.', TEXTDOMAIN ) ?>
            <input name="reset" type="submit" value="<?php _e("Reset", TEXTDOMAIN) ?>" title="<?php echo $warning ?>" onclick="return confirm('<?php echo $warning . '\n' . __( 'Are you sure of it?', TEXTDOMAIN ) ?>');" />
            <input type="hidden" name="action" value="reset" />
        </div>
    </form>
    <?php endif; ?>
    
    <div class="clear"></div>
    
    <div style="font-size:9px; margin-bottom:10px;">
        Icons: <a href="http://www.woothemes.com/2009/09/woofunction/">WooFunction</a></div>
    </div> 
    

<?php
}
?>