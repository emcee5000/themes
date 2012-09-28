<?php get_header(); ?>
        
                <div id="mainContainer">    
                        <div id="content">
                        
<?php the_post(); ?>                    
                        
                                <h1 class="searchResultsTitle"><?php _e( 'Tag:', 'your-theme' ) ?> <span><?php single_tag_title() ?></span></h1>

<?php rewind_posts(); ?>
                        
<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
                              
<?php } ?>                      

<?php while ( have_posts() ) : the_post(); ?>

                                  
                         <div class="searchPostContainer">


                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                  <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                    <div class="entry-meta">
                                      <div class="authorAvitar">
                                      <?php echo get_avatar( get_the_author_email(), '30' ); ?>
                                      </div>
                                  <div class="authorStuffCatView">
                                                <span class="meta-prep meta-prep-author"><?php _e('Posted by: ', 'your-theme'); ?></span>
                                                <span class="author vcard"><a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'your-theme' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
                                                	
                                        
                                        <div class="entry-utility">
                                                <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Category: ', 'your-theme' ); ?></span><?php echo get_the_category_list(', '); ?></span><br />
                                                
                                                <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged: ', 'your-theme' ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
                                                </div>
                                                </div>
                                                  <div id="digDig">
                                                    <span style="padding:5px;"><?php if(function_exists('dd_twitter_generate')){dd_twitter_generate('Normal','twitter_username');} ?></span>
													<span style="padding:5px;"><?php if(function_exists('dd_fblike_generate')){dd_fblike_generate('Like Box Count');} ?></span>
                                                </div>
                                                <div style="clear:both;"></div>
                                        <div class="entry-summary">     
											<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'your-theme' )  ); ?>
                                             
                                       </div><!-- .entry-summary -->
							                   <div class="commentStuff">
                                                <span class="comments-link"><?php comments_popup_link( __( 'Leave Comment', 'your-theme' ), __( '<span class="commentBubble">1</span><span class="commentText">View Comment</span> ', 'your-theme' ), __( ' <span class="commentBubble">%</span><span class="commentText">View Comments</span> <span class"clearFloat"></span>', 'your-theme' ) ) ?></span>
                                                
                                               <?php /* <span class="comments-link"><?php comments_popup_link( __( 'Leave Comment', 'your-theme' ), __( '1 Comment', 'your-theme' ), __( '% Comments', 'your-theme' ) ) ?></span>*/ ?> 
                                                <?php edit_post_link( __( 'Edit', 'your-theme' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
                                        </div><!-- #entry-utility -->   
                                        <div style="clear:both;"></div>
                            
                                </div><!-- #post-<?php the_ID(); ?> -->
                                
                       </div><!--postContainer-->

<?php endwhile; ?>                      

<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
                                <div id="nav-below" class="navigation">
                                        <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'your-theme' )) ?></div>
                                        <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'your-theme' )) ?></div>
                                </div><!-- #nav-below -->
<?php } ?>                      
<div id="nav-belowSearch" class="postsNav">
                                        <div><?php next_posts_link(__( 'Older posts', 'your-theme' )) ?></div>
                                        <div><?php previous_posts_link(__( 'Newer posts', 'your-theme' )) ?></div>
                                </div><!-- #nav-below -->
                        
                        </div><!-- #content -->         
                </div><!-- #container -->
                
<?php get_footer(); ?>