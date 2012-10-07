<?php        
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */
 
/*
Template Name: Home
*/                      

global $wp_query;      

if ( ( is_home() || is_front_page() ) && get_option( 'show_on_front' ) == 'posts' || $wp_query->is_posts_page ) {
    global $yiw_is_posts_page;
    $yiw_is_posts_page = true;
    get_template_part( 'blog' ); 
    die;
} 

global $shortname;

if( is_home() && get_option( 'show_on_front' ) == 'posts' ) {
    get_template_part( 'blog', 'home' ); 
    die;
}                     

// if ( get_option( 'show_on_front' ) == 'page' && get_option( 'page_for_posts' ) != 0 ) {
//     get_template_part( 'blog' ); 
//     die;
// }

get_header() ?>     
        
		<?php get_template_part( 'slider' ); ?>     
        
        <div class="layout-<?php echo get_layout_page() ?>">
        
            <!-- START CONTENT -->
            <div id="content">
                <?php 
                	if ( is_front_page() )
						get_template_part( 'loop', 'page' ); 
					elseif ( is_home() )
						get_template_part( 'loop', 'index' ); 
				?> 
            </div>
            <!-- END CONTENT -->
            
            <!-- START LATEST NEWS -->
            <div id="sidebar">
            	<?php get_sidebar() ?>
            </div>
            <!-- END LATEST NEWS -->   
        
        </div>                        
            
        <?php clear() ?>
        
        <div class="boxs-home">    
		  <?php dynamic_sidebar( 'Home Row' ) ?>    
		</div>
    
        <div class="line clear"></div> 
        
<?php get_footer() ?>
