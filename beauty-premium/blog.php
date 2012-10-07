<?php       
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */
 
/*
Template Name: Blog
*/

get_header() ?>     
        
		<?php get_template_part( 'slider' ); ?>               
        
        <?php global $paged ?>
        <?php query_posts('cat=' . get_exclude_categories() . '&posts_per_page=' . get_option('posts_per_page') . '&paged=' . $paged) ?>
        
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
