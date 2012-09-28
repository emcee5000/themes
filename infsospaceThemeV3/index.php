<?php get_header(); ?>
	<div id="featuredPosts">
		<div class="trending">Trending Now</div>
       		<div id="featuredSlider">
			<?php if ( function_exists( 'get_pointelle_slider' ) ) {
  get_pointelle_slider(); } ?>
       		</div>     
       	</div>
	<div class="postDivider"></div>
	<div class="trending">All Stories</div>
	<div id="mainWrapper">
		<div id="sidebar"><?php dynamic_sidebar('Sidebar'); ?>
	</div>
 <div id="mainContainer">
	<?php /* Sart the Loop ------------------------ */ ?>
	<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?> <?php } ?>                      	  
	<?php /* The Loop — with comments! */ ?>                        
	<div id="post">
	<?php while ( have_posts() ) : the_post() ?>	
		<div class="postContainer">
			<div class="authorStuff">
				<span class="author vcard"><?php the_author_posts_link(); ?></span> | <span class="meta-prep meta-prep-author"><?php the_time( get_option( 'date_format' ) ); ?></span>       
			</div><!-- authorStuff-->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                               
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="featuredImage"><?php the_post_thumbnail('category-thumb');?></div>     
			<div class="entry-content">     
				<?php the_excerpt( __( '<span class="postReadMore">Read More</span> <span class="meta-nav">&raquo;</span>', 'your-theme' )  ); ?>
				<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
			</div><!-- .entry-content -->
			<div class="commentStuff">
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'blankslate' ), __( '1 Comment', 'blankslate' ), __( '% Comments', 'blankslate' ) ) ?></span>					<?php edit_post_link( __( 'Edit', 'blankslate' ), "<span class=\"meta-sep\"> | </span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
			</div><!-- .commentStuff -->
			<div class="clearFloat"></div>
		</div><!-- .Posts Container-->	
	<?php endwhile; ?>
	<?php /* End the Loop --------------------------*/ ?>
</div><!-- .#post -->
</div><!-- #mainContainer -->
	<div id="nav-below" class="navigation">
		<span class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older Posts', 'blankslate' )) ?></span>
		<span class="nav-next"><?php previous_posts_link(__( 'Newer Posts <span class="meta-nav">&raquo;</span>', 'blankslate' )) ?></span>
	<div class="clearFloat"></div>
	</div>
</div>
</div>
<div class="clearFloat"></div>
</div>

<?php get_footer(); ?>

