
        <ul id="portfolio">         
            <?php
            	global $paged;
                $args = array(
					'post_type' => 'bl_portfolio',
					'posts_per_page' => get_option($GLOBALS['shortname'] . '_portfolio_items'),
					'paged' => $paged
				);
                $portfolio = new WP_Query( $args );
                
                $i = 1;
                
                while( $portfolio->have_posts() ) : $portfolio->the_post();  
                    global $more;
                    $more = 0;
            ?>     
            
            <li <?php post_class( ($i % 3 == 0) ? 'last' : '' ) ?>>
            	
				<?php   
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
				?>
                
                <?php if( has_post_thumbnail() ) : ?>
                    <a class="thumb <?php echo $class ?>" href="<?php echo $thumb ?>" rel="prettyPhoto[movies]"><?php the_post_thumbnail('portfolio-thumb') ?></a>
                    <div class="shadow-thumb"></div>         
                <?php endif ?>  
            
                <h5><a href="<?php the_permalink() ?>"><?php convertTags( get_the_title() ) ?></a></h5>
                
                <?php the_content('') ?>
                
                <a href="<?php the_permalink() ?>" class="more-link"><?php echo get_option( $GLOBALS['shortname'] . '_portfolio_more_text', __( 'read more &raquo;', TEXTDOMAIN ) ) ?></a>
                
                <div class="clear line"></div>
            </li>       
            
            <?php 
                	if ($i % 3 == 0)
                		echo '<li class="clear"></li>';
					
					$i++; endwhile ?>        
        </ul>           
