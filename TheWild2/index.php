<?php get_header(); ?>
 
 <div id="container">    
	  <?php /*?>Eric Place all your flash based magical stuff in the "placeHolder" div below.
       <?php */?>
        	<div style="clear:both;"></div>
        <div id="content">   
                                           
		  <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?> <?php } ?>                      	  
          <?php /* The Loop — with comments! */ ?>                        
		  <?php while ( have_posts() ) : the_post() ?>
     	  <div class="featuredImageIndex">
             <?php the_post_thumbnail(); ?>
             <?php /* featured image thumbnail */ ?>
          </div>
    <div class="postContainer">
<?php /* Create a div with a unique ID thanks to the_ID() and semantic classes with post_class() */ ?>          
    	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                               
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                        
<?php /* Microformatted, translatable post meta */ ?>                                                                           
          <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>                            
		
         <div class="entry-meta">
            <div class="authorAvitar">
            	<?php echo get_avatar( get_the_author_email(), '30' ); ?>
            </div>
            <div class="authorStuff">
                <span class="meta-prep meta-prep-author"><?php _e('Posted by: ', 'your-theme'); ?></span>
                <span class="author vcard"><?php the_author_posts_link(); ?></span>
             
        <div class="entry-utility">
                <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Category: ', 'your-theme' ); ?></span><?php echo get_the_category_list(', '); ?></span><br />
                <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged: ', 'your-theme' ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\"></span>\n" ) ?>
                </div>
              </div>
                <div id="digDig">
                    <span style="padding:5px;"><?php if(function_exists('dd_twitter_generate')){dd_twitter_generate('Normal','twitter_username');} ?></span>
                    <span style="padding:5px;"><?php if(function_exists('dd_fblike_generate')){dd_fblike_generate('Like Box Count');} ?></span>
                </div>
                <div style="clear:both;"></div>
                <!-- AuthorStuff -->
        </div><!-- .entry-meta -->

<?php /* The entry content */ ?>                                        
		<div class="entry-content">     
		  <?php the_excerpt( __( '<span class="postReadMore">Read More</span> <span class="meta-nav">&raquo;</span>', 'your-theme' )  ); ?>
		  <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
		</div><!-- .entry-content -->

<?php /* Microformatted category and tag links along with a comments link */ ?>                                 
                                        
		<div class="commentStuff">
        	<span class="comments-link"><?php comments_popup_link( __( 'Leave Comment', 'your-theme' ), __( '<span class="commentBubble">1</span><span class="commentText">View Comment</span> ', 'your-theme' ), __( ' <span class="commentBubble">%</span><span class="commentText">View Comments</span> <span class"clearFloat"></span>', 'your-theme' ) ) ?></span>  
               	<?php /* <span class="comments-link"><?php comments_popup_link( __( 'Leave Comment', 'your-theme' ), __( '1 Comment', 'your-theme' ), __( '% Comments', 'your-theme' ) ) ?></span>*/ ?> 
                <?php edit_post_link( __( 'Edit', 'your-theme' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
        </div><!-- #entry-utility -->   
	</div><!-- #post-<?php the_ID(); ?> -->
</div><!-- .post --> 
                                
<div style="clear:both;">&nbsp;</div>

<?php /* Close up the post div */ ?>                    
        
<?php endwhile; ?>              

<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
        <div id="nav-below">
                <div><?php next_posts_link(__( '<span class="postsNav">Older posts</span>', 'your-theme' )) ?></div>
                <div><?php previous_posts_link(__( '<span class="postsNav">Newer posts</span>', 'your-theme' )) ?></div>
        </div><!-- #nav-below -->
<?php } ?>                      
                        
      </div><!-- #content -->    
  	</div>
               
<?php get_sidebar(); ?> 
<?php get_footer(); ?>