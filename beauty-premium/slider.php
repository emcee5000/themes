		<?php        
			$slider = get_post_meta( get_the_ID(), '_slider_type', true );
			
			if ( !$slider || $slider == '' )
				if (  is_home() || is_front_page() )
					$slider = get_option( $GLOBALS['shortname'] . '_slider_type', 'fixed-image' );
				else
					$slider = 'none';     
			
			if( $slider != 'none' )
				get_template_part( 'slider', $slider ); 
		?>       
        
        <div class="clear"></div>     
    
        <?php if ( $slider != 'none' ) : ?><div class="line clear space"></div><?php endif ?>