<?php /* Template Name: Deals Page */ ?>
<?php get_header(); ?>


<div id="header">
                <div id="masthead">
                    <div id="branding">
                        <div id="logo">
                        	<div id="logoPGA">
                       			 <a href="<?php echo get_settings('home'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/headerMastheadPGA.png" alt="Central New York Green Card" /></a>
                        	</div>
                        	<div id="logoGreenCard">
                        		<img src="<?php bloginfo('template_directory'); ?>/images/headerMastheadGreenCard.jpg" alt="Green Card" />
                        	</div>
                        	<div class="clearFloat"></div>
                        </div>
                       
                               
                        <?php /*?>Removing title and description.
                               
                                <div id="blog-title" class="blogTitle"><span><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></span></div>
<?php if ( is_home() || is_front_page() ) { ?>
                                <h1 id="blog-description" class="blogDescription"><?php bloginfo( 'description' ) ?></h1>
<?php } else { ?>       
                                <div id="blog-description" class="blogDescription"><?php bloginfo( 'description' ) ?></div>
<?php } ?>
                   
				   <?php */?>
                        </div><!-- #branding -->                     
                </div><!-- #masthead --> 
                        <div id="globalNav" class="catMenu">
            <ul>
              <?php wp_list_pages('show_option_all=&depth=1&title_li='); ?>
	         </ul>
        </div>       
        </div><!-- #header -->
        
        <div id="main">        
                <div id="container">    
                        <div id="content">
                           <div id="content">
                    
                        
<?php the_post(); ?>


                                
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <h1 class="entry-title"><?php the_title(); ?></h1>
                                        <div class="featuredImage">
					<?php the_post_thumbnail(); ?>
    			</div>
                                        
                                      <div id="pageContent">  
                                        <div class="entry-content">
                                        
                                        $args = array( 'post_type' => 'deals', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
	the_title();
	echo '<div class="entry-content">';
	the_content();
	echo '</div>';
endwhile;
<?php the_content(); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>                                       

                                        </div><!-- .entry-content -->
                                     </div><!--#pageContent-->
                                </div><!-- #post-<?php the_ID(); ?> -->                 
                        <?php edit_post_link( __( 'Edit', 'your-theme' ), '<span class="edit-link">', '</span>' ) ?>
<?php if ( get_post_custom_values('comments') ) comments_template() // Add a custom field with Name and Value of "comments" to enable comments on this page ?>                  
                        
                        </div><!-- #content -->         
                </div><!-- #container -->
                
<?php get_sidebar(); ?> 
<?php get_footer(); ?>