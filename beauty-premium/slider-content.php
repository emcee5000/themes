<?php 
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */
 ?>

        <!-- START SLIDER -->
        <ul id="slider">
             <?php
                $slides = get_slides($GLOBALS['shortname'] . '_slider_content_slides');
                 
                if( is_array( $slides ) AND !empty( $slides ) ) 
				{
					$first = TRUE;
					
					foreach( $slides as $id => $slide ) :
						$the_ = split_title( $slide['slide_title'] );
						get_links_sliders( $link, $link_url, $slide );
				
						if( $more_text = get_option( $GLOBALS['shortname'] . '_slider_content_more_text' ) AND $more_text != '' AND $link ) 
							$more_text = " <a href=\"$link_url\">" . $more_text . "</a>";
						else 
						    $more_text = '';
							
						$content_slide = stripslashes( $slide['tooltip_content'] . ' ' . $more_text );
						$content_slide = apply_filters('the_content', $content_slide);
				        $content_slide = str_replace(']]>', ']]&gt;', $content_slide);
				        $content_slide = do_shortcode($content_slide);           
							
						if( !$first )
						    $class_first = ' style="display:none"';
						else
						    $class_first = '';
				        
				        $a_before = ( $link ) ? '<a href="'.$link_url.'">' : '';
				        $a_after  = ( $link ) ? '</a>' : '';
             ?>
                
            <li class="<?php if( $first ) echo 'first' ?>"<?php echo $class_first ?>>    
				<?php featured_content( $slide, $a_before, $a_after ) ?>   
        
                <div class="text">
                    <!-- TITLE -->
					<?php string_( '<h2>' . $a_before, $the_['title'], $a_after . '</h2>' ) ?>
					<?php string_( '<h4>', $the_['subtitle'], '</h4>' ) ?>
                    
                    <!-- TEXT -->
					<?php echo $content_slide ?>
                </div>
            </li>
			<?php $first = FALSE; endforeach; } ?>
        </ul>
        
        <div class="clear"></div>
        
        <div class="pagination p-slider"></div>  
				
		<?php $easing = ( $eas = get_option($GLOBALS['shortname'] . '_slider_easing') ) ? "easing: '$eas'," : '' ?>    
    
        <!-- START SLIDER JS -->
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $("#slider").cycle({
	            	fx: '<?php echo get_option($GLOBALS['shortname'] . '_slider_content_effect', 'fade') ?>',
					speed: <?php echo get_option($GLOBALS['shortname'] . '_slider_content_speed', 0.5) * 1000 ?>,
					timeout: <?php echo get_option($GLOBALS['shortname'] . '_slider_content_timeout', 5) * 1000 ?>,
					<?php echo $easing ?>
                	pager      	: ".p-slider"
                });
            });         
        </script>
        <!-- END SLIDER JS -->
        <!-- END SLIDER --> 