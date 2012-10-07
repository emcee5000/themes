<?php       
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */    

global $shortname, $paged;

get_header() ?>       
        
		<?php get_template_part( 'slider' ); ?>        
        
        <?php query_posts('cat=' . get_exclude_categories() . '&paged=' . $paged) ?>
        
        <!-- START CONTENT -->
        <div id="content">
            <?php get_template_part('loop', 'index') ?>
        </div>                       
        <!-- END CONTENT -->
        
        <!-- START SIDEBAR -->
        <div id="sidebar">
            <?php get_sidebar( 'blog' ) ?>  
        </div>
        <!-- END SIDEBAR -->  
    
        <div class="line clear"></div>        
        
<?php get_footer() ?>
