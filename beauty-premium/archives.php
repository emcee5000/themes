<?php
/*
Template Name: Archives
*/
get_header(); ?>                 
        
		<?php get_template_part( 'slider' ); ?>    
                       
        <!-- START CONTENT -->
		<div id="content" role="main">
		
			<?php      
            	$_active_title = get_post_meta( $post->ID, '_show_title_page', true );
			
			if( $_active_title == 'yes' || !$_active_title ) 
				the_title( '<h2 class="title-post-page">', '</h2>' );
			?>
			
			<div class="archive-list">
				<?php 
					$lastposts = new WP_Query( 'posts_per_page=30' ); 
					
					if ( $lastposts->have_posts() ) :
				?>
				<h3><?php printf( __( 'Last %d posts', TEXTDOMAIN ), 30 ) ?>:</h3>    
				<ul class="archive-posts group">
					<?php while( $lastposts->have_posts() ) : $lastposts->the_post(); ?>
					
					<li>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
							<span class="comments_number"><?php comments_number( '0', '1', '%' ) ?></span>
							<span class="archdate"><?php echo get_the_date( 'j.n.y' ) ?></span>
							<?php the_title() ?>
						</a>
					</li>
					
					<?php endwhile; ?>	
				</ul>
				<?php endif; ?>
				
				<h3><?php _e( 'Archives by Month', TEXTDOMAIN ) ?>:</h3>
				<ul class="archive-monthly group">
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
				
				<h3><?php _e( 'Archives by Subject', TEXTDOMAIN ) ?>:</h3>
				<ul class="archive-categories group">
					 <?php wp_list_categories( 'title_li=' ); ?>
				</ul>
			</div>
	
		</div>        
        <!-- END CONTENT -->    
                            
        <div id="sidebar">
        	<?php get_sidebar( 'blog' ) ?>  
        </div>
    
        <div class="line clear"></div>  

<?php get_footer(); ?>
