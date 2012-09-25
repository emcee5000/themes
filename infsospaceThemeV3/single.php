<?php get_header(); ?>

<div id="mainWrapper">
    <div id="sidebar" class="clearfix"><?php dynamic_sidebar('SidebarInside'); ?>
    </div>
<div id="mainContainer">
  <div id="content">
    <?php the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="authorStuff">
				<span class="author vcard"><?php the_author_posts_link(); ?></span> | <span class="meta-prep meta-prep-author"><?php the_time( get_option( 'date_format' ) ); ?></span>       
			</div><!-- authorStuff-->
      <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
      <div class="entry-meta">
        <div class="entry-content">
          <?php the_content(); ?>
          <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
        </div>
        <div id="nav-below" class="navigation">
            <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> Previous Story' ) ?></span>
            <span class="nav-next"><?php next_post_link( '%link', 'Next Story <span class="meta-nav">&raquo;</span>' ) ?></span>
            <div class="clearFloat"></div>
        </div>

        <!-- .entry-content -->
    </div>
    <!-- #post-<?php the_ID(); ?> -->
    <?php comments_template('', true); ?>
  </div>
  <!-- #content --> 
    </div><!--#mainContainer -->
</div><!-- mainWrapper -->
<!-- #container -->
<?php get_footer(); ?>
