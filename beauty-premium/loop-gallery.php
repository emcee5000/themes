				<div class="gallery-wrap">
		            <ul id="portfolio-gallery" class="image-grid">
		                    
		            	<?php 
						$count = 1;
		                $query = new WP_Query('post_type=bl_gallery&posts_per_page=-1');
		                
						while ($query->have_posts()) : $query->the_post(); 
							$terms = get_the_terms( get_the_ID(), 'category-photo' );
							if( !$terms ) $terms = array();
					
		                ?>
		                	
		                <li data-id="id-<?php echo $count; ?>" class="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)) . ' '; } ?>">
		            
		                    <!--BEGIN HENTRY -->
		                    <div class="post-thumb">
		                        <?php 
		                        if( $thum = get_post_meta(get_the_ID(), '_video', true) )
		                        {
		                            $class = 'video';
		                        }
		                        else
		                        {
		                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		                            $thumb = $thumb[0];
		                            $class = 'img';
		                        } 
								?>        
		                    	<a class="thumb <?php echo $class ?>" href="<?php echo $thumb ?>" rel="prettyPhoto[movies]" title="<?php echo get_the_title() ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'portfolio-thumb-gallery' ) ?></a>   
		                    	<?php clear() ?>
							</div>
							
							<?php the_title( '<h4 class="red-normal">', '</h4>' ) ?>
							<?php the_excerpt() ?>
							<?php clear() ?>
		                    <!--END HENTRY -->  
		                
		                <?php
						$count++;
						?>
		                
		                </li>
		                
		                <?php endwhile; wp_reset_query(); ?>
		              
		            </ul>  
		        </div>
