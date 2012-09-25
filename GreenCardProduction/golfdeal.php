<?php
/*
Template Name: Golf Deal Page
*/
?>

<?php get_header(); ?>


<div id="header">
                <div id="masthead">
		<div id="globalNav" class="catMenu">
            <ul>
              <?php wp_list_pages('show_option_all=&depth=1&title_li='); ?>
	         </ul>
        </div>       
                    <div id="branding">
                       <div id="logo">
                        <?php /*?>
				
				
				<div id="profileBox">
						<div id="ProfileBoxWelcome">
								&nbsp;
						</div>
						<div id="ProfileBoxLinks">
								<a href="<?php bloginfo('template_directory'); ?>/wp-admin/profile.php">MY ACCOUNT</a>&nbsp;|&nbsp<a href=" <?php echo wp_logout_url( $redirect ); ?> ">LOGOUT</a>
						</div>
                        	</div>
                        	<?php */?>
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
                        
        </div><!-- #header -->
        
        <div id="main">        
                <div id="container">    
                        <div id="content">
                           <div id="content">
								<?php the_post(); ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                                  <h1 class="entry-title"><?php the_title(); ?></h1>
                                      <div id="pageContent">  
                                        <div class="entry-content">
                                        <?php if(function_exists('dd_digg_generate')){dd_digg_generate('Normal');} ?>
										<?php the_content(); ?>
                                        <?php
											$custom = get_post_custom();
										
											//print_r( $custom );
											$image = get_the_post_thumbnail( );
											//print_r( $image );
											
										    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 240, 180 ) );              
											//print_r( $image_url );
     

										?>
                                        </div><!-- .entry-content -->
                                     </div><!--#pageContent-->
                                </div><!-- #post-<?php the_ID(); ?> -->                 
                        <?php edit_post_link( __( 'Edit', 'your-theme' ), '<span class="edit-link">', '</span>' ) ?>
<?php if ( get_post_custom_values('comments') ) comments_template() // Add a custom field with Name and Value of "comments" to enable comments on this page ?>                  
                        
                        </div><!-- #content -->         
                </div><!-- #container -->
                
<?php get_sidebar(); ?> 
<?php get_footer(); ?>