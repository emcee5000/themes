<?php get_header(); ?>
	<div id="featuredPosts">
       		<div class="subHead">
       			<img src="<?php bloginfo('template_directory');?>/images/subHeaderTrending.gif" alt="Trending Now"/> 
       		</div>
	
       		<div id="featuredSlider">
       			<?php include (ABSPATH . '/wp-content/plugins/front-slider/front-slider.php');?>
			
       		</div>     
       	</div>
	<div class="clearFloat"></div>
<div id="mainWrapper">
	<div id="sidebar"><?php dynamic_sidebar('Sidebar'); ?>
	</div>
 <div id="mainContainer">    	  
	<?php /* Nav Bar -----------------------------------------
	<div class="navBarTitle">
	   Posts On:
	</div>
	<div id="globalNav" class="catMenu">
		<ul>
		    <?php wp_list_categories('show_option_all=&depth=1&title_li='); ?>
		</ul>
	</div>
	 
<div id="content">	
        <div id="recentPosts">
        	<div class="subHead">
        		<img src="<?php bloginfo('template_directory');?>/images/subheadRecentPosts.png" alt="Recent Posts"/> 
        	</div>*/ ?>

<div class="subHead">
        <img src="<?php bloginfo('template_directory');?>/images/subHeaderAllStories.gif" alt="All Stories"/> 
</div>

<?php /* Sart the Loop ------------------------ */ ?>
<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?> <?php } ?>                      	  
<?php /* The Loop — with comments! */ ?>                        
<?php while ( have_posts() ) : the_post() ?>
	<div id="post">
		
         	<div class="postContainer">
		
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                               
        			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php /* Microformatted, translatable post meta */ ?>                                                               
            	<div class="authorAvitar">
            		<?php echo get_avatar( get_the_author_email(), '30' ); ?>
            	</div><!-- authorAvitar -->
            	<div class="authorStuff">
                	<span class="meta-prep meta-prep-author"><?php _e('Posted by: ', 'your-theme'); ?></span>
                	<span class="author vcard"><?php the_author_posts_link(); ?></span><br />
			<span class="meta-prep meta-prep-author"><?php the_time( get_option( 'date_format' ) ); ?></span>       
        		<div class="entry-utility">	
			</div><!-- entry-utility -->
		</div><!-- authorStuff-->
		<div class="clearFloat"></div>             
			<div class="entry-content">     
				  <?php the_excerpt( __( '<span class="postReadMore">Read More</span> <span class="meta-nav">&raquo;</span>', 'your-theme' )  ); ?>
				  <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
			</div><!-- .entry-content -->
			<div class="commentStuff">
				<span class="comments-link "><?php comments_popup_link( __( 'Leave Comment', 'your-theme' ), __( '<span class="commentBubble">1</span><span class="commentText">View Comment</span> ', 'your-theme' ), __( ' <span class="commentBubble">%</span><span class="commentText">View Comments</span><span class"clearFloat"></span>', 'your-theme' ) ) ?></span>			
				<span class="commentText"><?php edit_post_link( __( 'Edit', 'your-theme' ) ) ?></span>
			</div><!-- .commentStuff -->
			
		</div><!-- .Posts Container-->
	     <div class="clearFloat"></div>
	</div><!-- .#post -->
	
	<div class="clearFloat">&nbsp;</div>
<?php endwhile; ?>
<?php /* End the Loop --------------------------*/ ?>
</div><!-- #mainContainer -->
<div id="pnavigation">
		<p class="alignleft"><?php next_posts_link('&laquo; Older Posts') ?>
		</p>
		<p class="alignright"><?php previous_posts_link('Newer Posts &raquo;') ?>
		</p>
	</div>

</div>
</div>
<div class="clearFloat"></div>
</div>

<?php get_footer(); ?>

