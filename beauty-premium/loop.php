       				<div class="clear"></div>
                    
                    <?php      
						global $wp_query, $post, $more;
						
						$tmp_query = $wp_query;
						
						if (have_posts()) : 
                    
                    $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                    <?php /* If this is a category archive */ if (is_category()) { ?>
                  <h3 class="red-normal"><?php printf(__('Archive for the &#8216;%s&#8217; Category', TEXTDOMAIN), single_cat_title('', false)); ?></h3>
                    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                  <h3 class="red-normal"><?php printf(__('Posts Tagged &#8216;%s&#8217;', TEXTDOMAIN), single_tag_title('', false) ); ?></h3>
                    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                  <h3 class="red-normal"><?php printf(__('Archive for %s | Daily archive page', TEXTDOMAIN), get_the_time(__('F jS, Y', TEXTDOMAIN))); ?></h3>
                    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                  <h3 class="red-normal"><?php printf(__('Archive for %s | Monthly archive page', TEXTDOMAIN), get_the_time(__('F Y', TEXTDOMAIN))); ?></h3>
                    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                  <h3 class="red-normal"><?php printf(__('Archive for %s | Yearly archive page', TEXTDOMAIN), get_the_time(__('Y', TEXTDOMAIN))); ?></h3>
                    <?php /* If this is a yearly archive */ } elseif (is_search()) { ?>
                  <h3 class="red-normal"><?php printf( __( 'Search Results for: %s', TEXTDOMAIN ), '<span>' . get_search_query() . '</span>' ); ?></h3>
                   <?php /* If this is an author archive */ } elseif (is_author()) { ?>               
                  <h3 class="red-normal"><?php _e('Author Archive', TEXTDOMAIN); ?></h3>
                    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                  <h3 class="red-normal"><?php _e('Blog Archives', TEXTDOMAIN); ?></h3>        
                    <?php }   
                    
                        if ( is_category() )
                            echo '<p>', category_description(), '</p>';
                                                                                   
                        while (have_posts()) : the_post(); 
                        
                        if ( !is_single() ) 
							$more = 0;
                        
                        $title = is_null( the_title( '', '', false ) ) ? __( '(this post has no title)', TEXTDOMAIN ) : the_title( '', '', false );
                    ?>        
                    
                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post'); ?>>                
                              
                        <div class="date">          
							<?php if ( is_single() ) : ?>                                                 
                            	<h2 class="title-blog"><?php echo $title ?></h2> 
                            <?php else : ?>	
								<h2 class="title-blog"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a></h2> 
                            <?php endif; ?>
                            
                            <div class="mon-year">
                                <?php echo '<span>' . get_the_time('M') . '</span><br />' . get_the_time('Y') ?>
                            </div>
                            
                            <div class="day">
                                <?php the_time('d') ?>
                            </div>
                            
                            <div class="clear"></div>
                        </div>
                        
                        <div class="clear line"></div>
                        <p class="meta left"><?php _e( 'posted by', TEXTDOMAIN ) ?> <?php the_author_posts_link() ?> <?php string_( __( 'on', TEXTDOMAIN ) . ' ', get_the_category_list( ', ' ) ) ?></p>
                        <?php if ( comments_open() && ! post_password_required() ) : ?>
                        	<p class="meta right"><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></p>
                        <?php endif; ?>
                        <div class="clear line space-content"></div>  
                            
                        <?php                  
                            $size = get_option( $GLOBALS['shortname'] . '_blog_image_size' );
                            
                            if( $size == 'custom' ) $size = array( get_option($GLOBALS['shortname'] . '_blog_image_width'), get_option($GLOBALS['shortname'] . '_blog_image_height') );
                        ?>
                    
                        <?php 
                            if ( !$video = get_post_meta( get_the_ID(), '_video', true ) )
                                the_post_thumbnail($size, array( 'class' => get_option( $GLOBALS['shortname'] . '_blog_image_align' ) ) ); 
                            else
                                echo apply_filters( 'the_content', $video );
                        ?>
                     
                        <?php 
                            if ( is_archive() || is_search() )
                                the_excerpt();
                            else
                                the_content( '|| ' . __('Read more', 'yiw')) 
                        ?>     
                        
                        <div class="clear"></div>
                        
                        <?php wp_link_pages(); ?>
                        
						<?php edit_post_link( __( 'Edit', TEXTDOMAIN ), '<span class="edit-link">', '</span>' ); ?>
                    
                        <div class="clear space"></div>                 
					
						<?php if( is_single() ) the_tags( '<p class="list-tags">Tags: ', ', ', '</p>' ) ?>    
                    
                    </div>          
                    
                    <?php 
						endwhile;
						
						else : ?>
						
							<div id="post-0" class="post error404 not-found">
								<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
								<div class="entry-content">
									<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
									<?php get_search_form(); ?>
								</div><!-- .entry-content -->
							</div><!-- #post-0 -->
						
						<?php
						endif;
						 
						$wp_query = $tmp_query;
						wp_reset_postdata();
					?>    
                
                    <?php 
                    if(function_exists('pagination')) : pagination(); else : ?> 
            
                        <div class="navigation">
                            <div class="alignleft"><?php next_posts_link(__('Next &raquo;', TEXTDOMAIN)) ?></div>
                            <div class="alignright"><?php previous_posts_link(__('&laquo; Back', TEXTDOMAIN)) ?></div>
                        </div>
                    
                    <?php endif; ?>       
        
                    <?php comments_template(); ?>
                
                	<?php clear( 'space' ) ?> 