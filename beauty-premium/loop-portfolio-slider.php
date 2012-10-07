            <?php
            $categories_portfolio = get_terms('category-project', 'hide_empty=1&orderby=name');
            
            foreach ($categories_portfolio as $category ) 
            {
                $cat_slug = $category->slug;
                $cat_name = $category->name;
                $count_items = $category->count;      
                  
                if( $count_items > 0 )
                {                                    
					global $paged;
					     
             		$args = array(
						'post_type' => 'bl_portfolio',
						'category-project' => $cat_slug,
						'posts_per_page' => get_option( $GLOBALS['shortname'] . '_portfolio_items', -1 )
					);
	             
	             	//wp_reset_query();
	                $portfolio_items = new WP_Query( $args );   
					   
                    echo "<h3>$cat_name</h3>\n";        
                    echo '<div class="portfolio-slider">';
                    echo '<ul>'."\n";
                    
                    while( $portfolio_items->have_posts() ) : $portfolio_items->the_post();
                        
                        if( $thumb = get_post_meta(get_the_ID(), '_video', true) )
                        {
                            $class = 'video';
                        }
                        else
                        {
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                            $thumb = $thumb[0];
                            $class = 'img';
                        }
                        
                        echo '    <li class="post-'.get_the_ID().'"><a class="thumb '.$class.'" href="'.$thumb.'" rel="prettyPhoto[movies]" title="'.get_the_title().'">'.get_the_post_thumbnail( get_the_ID(), 'portfolio-thumb-slider' ).'</a></li>'."\n";
                        
                        
                    endwhile;           
                        
                    echo '</ul>'."\n";
                    echo '</div>';
                    echo '<div class="clear"></div>'."\n";   
                    
                	unset( $portfolio_items );
                }
            }                   
            ?>
            <script type="text/javascript">

                jQuery(document).ready(function() {
                    jQuery('.portfolio-slider').jcarousel();
                });
            
            </script>