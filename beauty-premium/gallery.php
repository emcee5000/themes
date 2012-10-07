<?php
 
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */
 
/*
Template Name: Gallery
*/

get_header() ?>                  
        
		<?php get_template_part( 'slider' ); ?>        
        
        <!-- START CONTENT -->
        <?php get_template_part( 'loop', 'page' ) ?> 
        
        <?php get_template_part( 'loop', 'gallery' ) ?>                                
		
		<?php clear() ?>           
            
        <?php if(function_exists('pagination')) : pagination(); else : ?> 

            <div class="navigation">
                <div class="alignleft"><?php next_posts_link(__('Next &raquo;', TEXTDOMAIN)) ?></div>
                <div class="alignright"><?php previous_posts_link(__('&laquo; Back', TEXTDOMAIN)) ?></div>
            </div>
        
        <?php endif; ?>
    
        <div class="line clear"></div> 
        
<?php get_footer() ?>