<?php get_header(); ?>
        
                <div id="container">    
                        <div id="content">
                           <div id="content">
                    
                        
<?php the_post(); ?>


                                
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <h1 class="entry-title"><?php the_title(); ?></h1>
                                        <div class="featuredImage">
					<?php the_post_thumbnail(); ?>
    			</div>
                                        
                                        <div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>                                       

                                        </div><!-- .entry-content -->
                                </div><!-- #post-<?php the_ID(); ?> -->    
'<?php comments_template(); ?>'             
                        <?php edit_post_link( __( 'Edit', 'your-theme' ), '<span class="edit-link">', '</span>' ) ?>
<?php if ( get_post_custom_values('comments') ) comments_template() // Add a custom field with Name and Value of "comments" to enable comments on this page ?>                  
                        
                        </div><!-- #content -->         
                </div><!-- #container -->
                
<?php get_sidebar(); ?> 
<?php get_footer(); ?>