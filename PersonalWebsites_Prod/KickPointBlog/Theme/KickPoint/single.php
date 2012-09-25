<?php get_header(); ?>
        
                <div id="container">   
                
                
                        <div id="content">
                        
                        
<?php the_post(); ?>

                                <?php /*?><div id="nav-above" class="navigation">
                                        <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
                                        <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
                                </div><!-- #nav-above --><?php */?>

                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <h1 class="entry-title"><?php the_title(); ?></h1>
                                        
                                        <div class="entry-meta">
                                        	<div class="authorAvitar">
                                            <?php echo get_avatar( get_the_author_email(), '30' ); ?>
                                            </div>
                                            
                                            <div class="authorStuff">
                                                <span class="meta-prep meta-prep-author"><?php _e('Posted by: ', 'your-theme'); ?></span>
                                                <span class="author vcard"><a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'your-theme' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
                                                	
                                        
                                        <div class="entry-utility">
                                                <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Category: ', 'your-theme' ); ?></span><?php echo get_the_category_list(', '); ?></span><br />
                                                
                                                <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged: ', 'your-theme' ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
                                                </div>
                                                                                        <p><?php edit_post_link( __( 'Edit', 'your-theme' ), '<span class="edit-link">', '</span>' ) ?></p>

                                                </div>
                                                <div id="digDig">
                                                    <span style="padding:5px;"><?php if(function_exists('dd_twitter_generate')){dd_twitter_generate('Normal','twitter_username');} ?></span>
													<span style="padding:5px;"><?php if(function_exists('dd_fblike_generate')){dd_fblike_generate('Like Box Count');} ?></span>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <!-- AuthorStuff -->
                                                
                                        <div class="featuredImage">
					<?php the_post_thumbnail(); ?>
                    
    			</div> 
                                        
                                        
                                        <div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
                                        </div><!-- .entry-content -->
                                        
                                        
                                                
                                               

                                        
                                        <?php /*?><div class="entry-utility">
                                        <?php printf( __( 'This entry was posted in %1$s%2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.', 'your-theme' ),
                                                get_the_category_list(', '),
                                                get_the_tag_list( __( ' and tagged ', 'your-theme' ), ', ', '' ),
                                                get_permalink(),
                                                the_title_attribute('echo=0'),
                                                comments_rss() ) ?>
												

<?php if ( ('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Comments and trackbacks open ?>
                                                <?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'your-theme' ), get_trackback_url() ) ?>
<?php elseif ( !('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Only trackbacks open ?>
                                                <?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'your-theme' ), get_trackback_url() ) ?>
<?php elseif ( ('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Only comments open ?>
                                                <?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'your-theme' ) ?>
<?php elseif ( !('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Comments and trackbacks closed ?>
                                                <?php _e( 'Both comments and trackbacks are currently closed.', 'your-theme' ) ?>
<?php endif; ?>
<?php edit_post_link( __( 'Edit', 'your-theme' ), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>" ) ?>
                                        </div><!-- .entry-utility -->                                                            <?php */?>                                       
                                </div><!-- #post-<?php the_ID(); ?> -->  
                                              
                                
                                <?php /*?><div id="nav-below" class="navigation">
                                        <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
                                        <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
                                </div><!-- #nav-below -->           <?php */?>         

                        
                        </div><!-- #content --> 
                        
                 <div id="comments">                                                   
					<?php comments_template('', true); ?>    
				</div>  <!-- #comments --> 
                    
                </div><!-- #container -->
                
                
<?php get_sidebar(); ?> 
<?php get_footer(); ?>