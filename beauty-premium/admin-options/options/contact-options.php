<?php    
        
$form = get_option( $shortname . '_contact_form_choosen', 'default' );

add_option( $shortname . '_default_contact_form', 'a:5:{i:0;a:8:{s:5:"title";s:4:"Name";s:9:"data_name";s:4:"name";s:11:"description";s:0:"";s:4:"type";s:4:"text";s:14:"label_checkbox";s:0:"";s:9:"msg_error";s:15:"Insert the name";s:8:"required";s:3:"yes";s:5:"class";s:0:"";}i:1;a:10:{s:5:"title";s:5:"Email";s:9:"data_name";s:5:"email";s:11:"description";s:13:"(valid email)";s:4:"type";s:4:"text";s:14:"label_checkbox";s:0:"";s:9:"msg_error";s:20:"Insert a valid email";s:8:"required";s:3:"yes";s:14:"email_validate";s:3:"yes";s:8:"reply_to";s:3:"yes";s:5:"class";s:0:"";}i:2;a:7:{s:5:"title";s:5:"Phone";s:9:"data_name";s:5:"phone";s:11:"description";s:0:"";s:4:"type";s:4:"text";s:14:"label_checkbox";s:0:"";s:9:"msg_error";s:0:"";s:5:"class";s:0:"";}i:3;a:7:{s:5:"title";s:8:"Web site";s:9:"data_name";s:7:"website";s:11:"description";s:0:"";s:4:"type";s:4:"text";s:14:"label_checkbox";s:0:"";s:9:"msg_error";s:0:"";s:5:"class";s:0:"";}i:4;a:8:{s:5:"title";s:7:"Message";s:9:"data_name";s:7:"message";s:11:"description";s:0:"";s:4:"type";s:8:"textarea";s:14:"label_checkbox";s:0:"";s:9:"msg_error";s:16:"Insert a message";s:8:"required";s:3:"yes";s:5:"class";s:0:"";}}' );
                         
$options['contact'] = array (         
	    
    /* =================== SIDEBARS =================== */
    "title" => array(    
        array( 	"name" => __('Contact Page Customize', TEXTDOMAIN),
        	   	"type" => "title")
    ),            
    
    "create" => array(    
        array( "name" => __("Create new", TEXTDOMAIN),
        	   "type" => "section",
			   "effect" => 0),
        array( "type" => "open"),   
         
        array( "name" => __("New contact form.", TEXTDOMAIN),
        	   "desc" => __("Add new empty contact form, that you can add into pages or posts. After adding new form, select it on option below and click on 'Configure' button to configure it.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_forms",
        	   "type" => "text",
        	   "button" => __( "Add Form", TEXTDOMAIN ),
        	   "data" => "array",
        	   "mode" => "merge",
        	   "show_value" => false,
			   "std" => ''),	
         
        array( "name" => __("Configure contact form.", TEXTDOMAIN),
        	   "desc" => __("Choose a contact form and save, to configure below your form choosen.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_choosen",
        	   "type" => "select",
        	   "button" => __( "Configure", TEXTDOMAIN ),
        	   "options" => get_list_forms(),
			   "std" => '' ),	
         
        array( "name" => __("Shortcode of form", TEXTDOMAIN),
        	   "desc" => __("Copy this and paste into editor of pages or posts. This is the shortcode of contact form choosen on option above.", TEXTDOMAIN),
        	   "type" => 'show-text',
			   "text" => get_contact_form_shortcode() ),	     
         
        array( "name" => __("Delete forms", TEXTDOMAIN),
        	   "desc" => __("Delete the forms that you have already created.", TEXTDOMAIN),
        	   "values" => $shortname."_contact_forms",
        	   "label" => array( 'Form', 'Forms' ),
        	   "type" => "sidebar-table"),		     
         
        array( "name" => __("Add example form.", TEXTDOMAIN),
        	   "desc" => __("Add a simple example form, specifing the name.", TEXTDOMAIN),
        	   "action" => "create-contact-form",
        	   "id" => 'name-form',
        	   "type" => "text",
        	   "button" => __( "Create Form", TEXTDOMAIN ) ),	
        	
        array( "type" => "close")
    ),
    
    "configuration" => array(    
        array( "name" => __("Contact Form Configuration for", TEXTDOMAIN) . ' ' . $form,
        	   "type" => "section"),
        array( "type" => "open"),   
        	
        array( "name" => __("To", TEXTDOMAIN),
        	   "desc" => __("Define the emails witch send the email written by the user. If they are more then one, you can write theme separated by a comma.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_to_" . $form,
        	   "type" => "text",
        	   "std" => get_option( 'admin_email' ) ),
        	
        array( "name" => __("From Email", TEXTDOMAIN),
        	   "desc" => __("Define from what email send the message.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_from_email_" . $form,
        	   "type" => "text",
        	   "std" => get_option( 'admin_email' ) ),
        	
        array( "name" => __("From Name", TEXTDOMAIN),
        	   "desc" => __("Define the name of email that send the message.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_from_name_" . $form,
        	   "type" => "text",
        	   "std" => 'Admin ' . get_bloginfo( 'name' ) ),
        	
        array( "name" => __("Subject", TEXTDOMAIN),
        	   "desc" => __("Define the subject of the email sent to you.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_subject_" . $form,
        	   "type" => "text",
        	   "std" => "" ),                
        	
        array( "name" => __("Body", TEXTDOMAIN),
        	   "desc" => __("Configure the body email that arrives to you. You can add some shortcode, to add some value insert by user on frontend module. The shortcodes are composed with 'data_name' that you have insert on each field, on below table, like: %data_name%.<br /><em>HTML is allowed.</em>", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_body_" . $form,
        	   "type" => "textarea",
        	   "std" => __( "%message%\n\n<small><i>This email is been sent by %name% (email. %email%).</i></small>", TEXTDOMAIN ) ),  
        	
        array( "name" => __("Label Submit Button", TEXTDOMAIN),
        	   "desc" => __("Define the label of submit button.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_submit_label_" . $form,
        	   "type" => "text",
        	   "std" => __( 'send message', TEXTDOMAIN ) ),            
        	
        array( "name" => __("Alignment Submit Button", TEXTDOMAIN),
        	   "desc" => __("Set the alignment of submit button.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_submit_alignment_" . $form,
        	   "type" => "select",
        	   "options" => array(
			   		'alignleft' => 'left',
			   		'alignright' => 'right',
			   		'aligncenter' => 'center',
			   ),
        	   "std" => 'alignright' ),       
        	
        array( "name" => __("Message Success", TEXTDOMAIN),
        	   "desc" => __("Define the message for success sending.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_success_sending_" . $form,
        	   "type" => "text",
        	   "std" => __( 'Email sent correctly!', TEXTDOMAIN ) ),   
        	
        array( "name" => __("Message Error", TEXTDOMAIN),
        	   "desc" => __("Define the message when there is an error on send of email.", TEXTDOMAIN),
        	   "id" => $shortname."_contact_form_error_sending_" . $form,
        	   "type" => "text",
        	   "std" => __( 'An error has been encountered. Please try again.', TEXTDOMAIN ) ),   
        	
        array( "type" => "close")
    ),
	        
    "table-contact" => array(    
        array( "name" => __("Customize Contact module", TEXTDOMAIN) . ': ' . get_option( $shortname . '_contact_form_choosen' ),
        	   "type" => "section",
			   "effect" => 0,
			   "show-submit" => false),
			   
        array( "type" => "open"),  
         
        array( "id" => $shortname."_contact_fields_" . $form,
        	   "type" => "contact-table",
			   "data" => "array",
			   "mode" => "merge"),	
        	
        array( "type" => "close")
    )        
    /* =================== END SIDEBARS =================== */
 
);                         

if( $form == '' OR $form == 'none' )
	unset( $options['contact']['configuration'], $options['contact']['table-contact'] );  
?>