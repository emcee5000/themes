<?php 
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */
 ?>
 
	<?php $n = 0; //$n = get_option('nums_images_slideshow_home_f'); ?>
        
    <!-- START SLIDER -->
    <div id="slideshow">
        <div class="images">
            <div class="container">
                <?php               
	                $slides = get_slides($GLOBALS['shortname'] . '_slider_fullimages_slides');
	                 
	                if( is_array( $slides ) AND !empty( $slides ) ) 
					{
						$first = TRUE;
						
						foreach( $slides as $id => $slide ) :
						
							$the_ = split_title( $slide['slide_title'] );
							get_links_sliders( $link, $link_url, $slide );
					        
					        $a_before = ( $link ) ? '<a href="'.$link_url.'">' : '';
					        $a_after  = ( $link ) ? '</a>' : '';
	            
                            featured_content( $slide, $a_before, $a_after, false );      
							
							$first = FALSE;
							
						endforeach; 
					} 
				?>
            </div>
        </div>                    
    </div>                    

    <?php if($n != 1 OR !$n) : ?>
    <!-- START SLIDER JS -->
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('#slideshow .container').nivoSlider({
            	effect: '<?php echo get_option( $GLOBALS['shortname'] . '_slider_fullimages_effect', 'random' ) ?>',
                controlNav:true, 
                directionNav:false, 
                keyboardNav:false, 
                slices:20,
                captionOpacity:0,
                animSpeed: <?php echo get_option($GLOBALS['shortname'] . '_slider_fullimages_speed', 0.5) * 1000 ?>,
                pauseTime: <?php echo get_option($GLOBALS['shortname'] . '_slider_fullimages_timeout', 5) * 1000 ?>
            });
        });         
    </script>
    <!-- END SLIDER JS -->      
    <?php endif ?>
    <!-- END SLIDER --> 