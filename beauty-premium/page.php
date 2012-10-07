<?php        
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */                        

get_header() ?>                        
        
		<?php get_template_part( 'slider' ); ?>    
        
        <div class="layout-<?php echo get_layout_page() ?>">
        
            <!-- START CONTENT -->
            <div id="content">
                <?php get_template_part( 'loop', 'page' ) ?> 
                
                <?php comments_template() ?>
            </div>
            <!-- END CONTENT -->
            
            <!-- START LATEST NEWS -->
            <div id="sidebar">
            	<?php get_sidebar('home') ?>
            </div>
            <!-- END LATEST NEWS -->    
        
        </div>   
                              
        <!-- START EXTRA CONTENT -->
		<?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->
    
        <div class="line clear"></div>        
        
<?php get_footer() ?>
