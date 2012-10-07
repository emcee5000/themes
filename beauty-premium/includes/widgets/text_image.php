<?php
class text_image extends WP_Widget
{
    function text_image() 
    {
		$widget_ops = array( 
            'classname' => 'text-image', 
            'description' => __( 'Arbitrary text or HTML, with a simple image above text.', TEXTDOMAIN )
        );

		$control_ops = array( 'id_base' => 'text-image', 'width' => 430 );

		$this->WP_Widget( 'text-image', __( 'Text With Image', TEXTDOMAIN ), $widget_ops, $control_ops );      
		
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script( 'media-upload' );
        add_action( 'admin_print_footer_scripts', array( &$this, 'add_script_textimage' ), 999 );
	}
	
	function add_script_textimage()
	{
        ?>   
		<script type="text/javascript">               	

            jQuery(document).ready(function($){
                             
                 $('.upload-image').live('click', function(){
            		var yiw_this_object = $(this).prev();
            		
            		tb_show('', 'media-upload.php?type=image&TB_iframe=true');    
            	
            		window.send_to_editor = function(html) {
            			imgurl = $('img', html).attr('src');
            			yiw_this_object.val(imgurl);
            			
            			tb_remove();
            		}          
            		
            		return false;
            	});
                
//                 var yiw_this_object = null;
//                 
//                 $('.upload-image').click(function(){
//                     yiw_this_object = $(this).prev();
//                     alert(yiw_this_object + ' + ' + $(this).prev());
//                 });
//                     
//                 window.send_to_editor = function(html) {
//         			imgurl = $('img', html).attr('src');
//         			yiw_this_object.val(imgurl);
//         			yiw_this_object = null;
//         			
//         			tb_remove();
//         		}          
            });  
		</script> 
        <?php
    }
	
	function form( $instance )
	{
		global $icons_name;
		
        /* Impostazioni di default del widget */
		$defaults = array( 
            'title' => '',
            'link' => '',
            'image' => '',
            'text' => '',
            'autop' => false
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label>
				<strong><?php _e( 'Title', TEXTDOMAIN ) ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>            
		
		<p>
			<label>
				<strong><?php _e( 'Link', TEXTDOMAIN ) ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
			</label>
		</p>                  
		
		<p>
			<label><?php _e( 'Image', TEXTDOMAIN ) ?>:
				<input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
			    <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>
		
		<p>
			<label>
				<textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="20" rows="16"><?php echo $instance['text']; ?></textarea>
			</label>
		</p>
		
		<p>
			<label>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'autop' ); ?>" name="<?php echo $this->get_field_name( 'autop' ); ?>" value="1"<?php if( $instance['autop'] ) echo ' checked="checked"' ?> />
				<?php _e( 'Automatically add paragraphs' ) ?>
			</label>
		</p>         
		<?php
	}
	
	function widget( $args, $instance )
	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;        
        
        if ( ! empty( $instance['link'] ) ) {
            $before_title .= '<a href="'.$instance['link'].'">';
            $after_title = '</a>' . $after_title;
        }           

		if ( $title ) echo $before_title . $title . $after_title;
		
		if( $instance['autop'] )
			$instance['text'] = apply_filters( 'the_content', $instance['text'] );
		
		$text = '<img src="' . $instance['image'] . '" alt="' . $instance['title'] . '" />' . $instance['text'];
        echo apply_filters( 'widget_text', $text );  
		
		echo $after_widget;
	}                     

    function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['link'] = $new_instance['link'];
		
		$instance['image'] = $new_instance['image'];

		$instance['text'] = $new_instance['text'];

		$instance['autop'] = $new_instance['autop'];

		return $instance;
	}
	
}     
?>
