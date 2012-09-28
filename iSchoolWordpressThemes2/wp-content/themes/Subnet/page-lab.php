<?php
/**
 * Template Name: Page Lab
 *
 *
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
					<div id="entry-title-container">	
						<h2 class="entry-title"><?php the_title(); ?></h2>
					</div>
					<?php } else { ?>	
						<div id="entry-title-container">	
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</div>
					<?php } ?>				

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
                        
                        <div>
<h2>iSchool Lab Related Articles</h2>

<?php echo do_shortcode('[catlist name=labs)]'); ?>

</div>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				

<?php endwhile; ?>


			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
